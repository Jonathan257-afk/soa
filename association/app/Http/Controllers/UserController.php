<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Gagnantbingo;
use App\Models\Bingoticket;
use App\Models\Confirmaccount;

class UserController extends Controller
{
    public function achat(Request $request) {
        $allAchats = auth()->user()->achat;
        $achats = [];
        $gagnants = [];
        $perdants = [];

        foreach($allAchats as $achat) {
            if($achat->bingo_id != null && isset($achat->bingo)  && $achat->bingo != null  && isset($achat->bingo->date) && $achat->bingo->date > now())
                array_push($achats, $achat);

            else if($achat->tombola_id != null && isset($achat->tombola)  && $achat->tombola != null  && isset($achat->tombola->date) && $achat->tombola->date > now())
                array_push($achats, $achat);
            
            else {
                foreach(Bingoticket::where("achat_id", $achat->id)->orderBy("created_at", "DESC")->get() as $ticket) {
                    if($ticket != null) {
                        $g = Gagnantbingo::where("bingoticket_id", $ticket->id)->first();
                        if($g)
                            $gagnants[] = $g;
                        else
                            $perdants[] = $ticket;
                    }
                }
            }
        }
        
        return view("page.user.achat", compact(["achats", "gagnants", "perdants"]));
    }

    public function don(Request $request) {
        return view("page.user.don");
    }

    public function authentificate(Request $request) {
        $request->validate([
            "email" => 'required|string|min:4',
            "password" => 'required|min:4',
        ]);

        $user = User::where("email", $request->input("email"))->first();
            
        if($user && !$user->verified)
           return  back()->withErrors("Vous devez d’abord vérifier votre compte ! Veuillez regarder dans votre boite mail.");

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials,false)) {
            $request->session()->regenerate();
            
            if($user->isAsso) {
                if( ($user->association->stripe == null || $user->association->stripe == "") && ($user->association->paypal_id == null || $user->association->paypal_id == "") && ($user->association->gpay == null || $user->association->gpay == "") )
                    return redirect(route('asso-index'));
                return redirect(route('asso-dashboard'));
            }
            return redirect(route('user-dashboard'));
        }
        return back()->withErrors("Email ou/et Mot de passe incorrect !");
    }

    public function confirmAccount($code) {
        $confirm = Confirmaccount::where("code", $code)->first();
        if($confirm) {
            if(User::emailConfirmed($confirm->email)) {
                $user = User::where("email", $confirm->email)->first();
                if($user) {
                    $confirm->delete();
                    
                    Auth::loginUsingId($user->id);

                    return view("page.auth.confirmaccount");
                }
            }
        }
        return view("page.auth.404");
    }

    public function login() {
        if(auth()->user()) {
            if(auth()->user()->isAsso) {
                if( (auth()->user()->association->stripe == null || auth()->user()->association->stripe == "") && (auth()->user()->association->paypal_id == null || auth()->user()->association->paypal_id == "") && (auth()->user()->association->gpay == null || auth()->user()->association->gpay == "") )
                    return redirect(route('asso-index'));
                return redirect(route('asso-dashboard'));
            }
            return redirect(route('user-dashboard'));
        }
        return view("page.auth.login");
    }

    public function logout(Request $request)
    {
        User::findOrFail(Auth()->user()->id)->update(['remember_token' => Null]);
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('index'));

    }

    public function messageConsultMail(Request $request) {
        return view("page.auth.messageconsultmail");
    }

    public function signUp(Request $request) {
        $request->validate([
            "name" => 'required|min:1|max:100',
            "email" => 'required',
            "password" => 'required|min:4',
            "confirm" => 'required|min:4',
        ]);

        if($request->input("password") == $request->input("confirm")) {
            if(User::where("email", $request->input("email"))->first())
                return  back()->withError("Un utilisateur utilise déjà cette adresse email");

            if(User::store($request->input("name"), $request->input("first"), $request->input("email"), $request->input("tel"),$request->input("password")))
                return redirect(route("usermessageConsultMail"))->with("success", "Votre compte a été crée avec success !");;
            
            return  back()->withError("Une erreur est survenue ! Veuillez recommencer de nouveau");
        }
        
        return  back()->withError("Les deux mots de passe doit être identique !");
    }


    public function selectSignIn(Request $request) {
        return view("page.auth.selectSignIn");
    }

    public function userSignIn(Request $request) {
        return view("page.auth.userSignIn");
    }
}
