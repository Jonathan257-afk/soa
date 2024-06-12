<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Don;
use App\Models\Tombola;
use App\Models\User;
use App\Models\Bienfetaire;
use App\Models\Bingo;

class DonController extends Controller
{
    public function getById(Request $request) {
        return Don::getById($request->input("id"));
    }

    public function index() {
        if(auth()->user()->isAsso) {
            $dons = Don::getAllByIdAsso(auth()->user()->association_id);
            $tombolas = Tombola::getAllEnCoursByIdAsso(auth()->user()->association_id);
            $bingos = Bingo::getAllEnCoursByIdAsso(auth()->user()->association_id);
            return view("page/asso/don/index", compact(["dons", "tombolas", "bingos"]));
        }
        return redirect(route("login"))->withErrors("Vous n'êtes pas autorisé à acceder à cette espace!");
    }

    public function store(Request $request) {
        if(auth()->user()->isAsso) {
            $request->validate([
                "name" => 'required',
                "don" => 'required',
            ]);
            $bienfetaire = Bienfetaire::store($request->input("name"), $request->input("first_name"), $request->input("email"), $request->input("tel"));
            if($bienfetaire) {
                $ticket = 0;
                $don = $request->input("don");

                $tombola_id = $request->input("tombola");
                $bingo_id = $request->input("bingo");

                $isInputAsTombola = $tombola_id != null && $tombola_id != "null" && $tombola_id != "";
                $isInputAsBingo = $bingo_id != null && $bingo_id != "null" && $bingo_id != "";

                if($isInputAsTombola) 
                   $ticket = Don::getNombreTicketForDon($don, $tombola_id);
                else if($isInputAsBingo) 
                    $ticket = Don::getNombreTicketForDon($don, null, $bingo_id);
                 

                
                $don = Don::store(null, ($isInputAsTombola) ? $tombola_id : null, $don, $ticket,  null,  ($isInputAsBingo) ? $bingo_id : null, $bienfetaire->id);

                if($don) {
                    if($isInputAsTombola)
                        Tombola::venteTickets($tombola_id, $ticket);

                    if($isInputAsBingo)
                        Bingo::venteTickets($bingo_id, $ticket);

                    return  back()->with("success", "Donateur ajouté avec success !");
                }
                    
            }   
            return back()->withErrors("Une erreur est survenue !");
        }
        return redirect(route("login"))->withErrors("Vous n'êtes pas autorisé à acceder à cette espace!");
    }
}
