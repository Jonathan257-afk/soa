<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use App\Models\Association;
use App\Models\User;
use App\Models\PayPal;

class AssociationController extends Controller
{
    public function index() {
        if(auth()->user()->isAsso) {
            return view("page.asso.index");
        }
        return redirect(route("login"))->withErrors("Vous n'êtes pas autorisé à acceder à cette espace!");
    }

    public function configPaiement() {
        if(auth()->user()->isAsso) {
            return view("page.asso.configPaiement");
        }
        return redirect(route("login"))->withErrors("Vous n'êtes pas autorisé à acceder à cette espace!");
    }

    public function signIn() {
        return view("page.auth.signIn");
    }

    public function signUp(Request $request) {
        $request->validate([
            "name" => 'required|min:1|max:100',
            "email" => 'required',
            "password" => 'required|min:4',
            "confirm" => 'required|min:4',
            "interet" => 'required',
            "cerfa" => 'required',
        ]);

        if($request->input("password") == $request->input("confirm")) {
            $logo_name = $request->input("logo_name");
            if($logo_name == "")
                $logo_name = "logoGreen.png";

            $association = Association::store($request->input("name"), $request->input("email"), $logo_name, $request->input("interet"), $request->input("cerfa"));
            if($association) {
                if($request->has("logo"))
                    $request->file('logo')->move(public_path()."/assets/img/logo/". $association->id, $request->input('logo_name'));
                else  {
                    if(File::exists(public_path()."/assets/img/logoGreen.png")) {
                        $destinationPath = public_path()."/assets/img/logo/". $association->id ."/"."logoGreen.png";

                        if (!File::isDirectory(dirname($destinationPath))) {
                            File::makeDirectory(dirname($destinationPath), 0777, true, true);
                        }

                        File::copy(public_path()."/assets/img/logoGreen.png", $destinationPath);
                    }
                }

                if(User::signUpAssociation($request->input("name"), $request->input("email"), $request->input("password"), $association->id))
                    return redirect(route("usermessageConsultMail"))->with("success", "Votre compte a été crée avec success !");;
            }
            return  back()->withError("Une erreur est survenue ! Veuillez recommencer de nouveau");
        }
        
        return  back()->withError("Les deux mots de passe doit être identique !");
    }

    public function updateInfo(Request $request) {
        $res = [
            "res" =>false,
            "message" => "Vous n'êtes pas authorisé à effectuer cette action !"
        ];
        if(auth()->user()->isAsso) {
            $res["message"] = "Une erreur est survenue !";
            $request->validate([
                "name" => 'required|min:1|max:100',
                "email" => 'required',
                "interet" => 'required',
                "cerfa" => 'required',
            ]);
    
            
    
            if(Association::updateInfo($request->input("name"), $request->input("email"), $request->input("interet"), $request->input("cerfa"))) {
                $res["res"] = true;
                $res["message"] = "Modification effectué avec succèss !";
            }
        }
        
        return response()->json($res);
    }

    public function updateLogo(Request $request) {
        $res = [
            "res" =>false,
            "message" => "Vous n'êtes pas authorisé à effectuer cette action !"
        ];
        if(auth()->user()->isAsso) {
            $res["message"] = "Une erreur est survenue !";
            $request->validate([
                "logo" => 'required',
                "name" => 'required',
            ]);
    
            $association = Association::findOrFail(auth()->user()->association_id);
            if($association) {
                $ancienLogo = $association->logo;
                $update = $association->update([
                    'logo' => $request->input("name"),
                ]);

                if($update) {
                    if(File::exists(public_path()."/assets/img/logo/". $association->id."/".$ancienLogo))
                        unlink(public_path()."/assets/img/logo/". $association->id."/".$ancienLogo);

                    $request->file('logo')->move(public_path()."/assets/img/logo/". $association->id, $request->input('name'));

                    $res["res"] = true;
                    $res["message"] = "Modification effectué avec succèss !";
                }
            }
        }
        
        return response()->json($res);
    }

    public function updatePaiement(Request $request) {
        $res = [
            "res" =>false,
            "message" => "Vous n'êtes pas authorisé à effectuer cette action !",
            "data" => $request->all(),
        ];
        if(auth()->user()->isAsso) {
            $res["message"] = "Une erreur est survenue !";

            $paypal_id = null;
            if($request->has("paypal-clientId") && $request->input("paypal-clientId") != ""  && $request->input("paypal-clientId") != null && $request->has("paypal-clientSecret") && $request->input("paypal-clientSecret") != ""  && $request->input("paypal-clientSecret") != null ) {
                $account = PayPal::store($request->input("paypal-clientId"), $request->input("paypal-clientSecret"));
                if($account)
                    $paypal_id = $account->id;
            }
    
            if(Association::updatePaiement($request->input("stripe"), $paypal_id, $request->input("gpay"))) {
                $res["res"] = true;
                $res["message"] = "Modification effectué avec succèss !";
            }
        }
        
        return response()->json($res);
    }
}