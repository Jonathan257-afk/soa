<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Events\SetTirageEvent;

use App\Models\Tombola;
use App\Models\Don;
use App\Models\Bingo;
use App\Models\Achat;
use App\Models\Bingoticket;
use App\Models\Gagnantbingo;

class DashboardController extends Controller
{
    public function assoDashboard() {
        //event(new SetTirageEvent());

        if(auth()->user()->isAsso) {
            $achat = null;
            $resTombola = toApiGetway("tombola", "getAllByIdAsso",[
                "id" => auth()->user()->association_id,
            ]);

            $resBingo = toApiGetway("bingo", "getAllByIdAsso",[
                "id" => auth()->user()->association_id,
            ]);

            $tombola = ($resTombola != null && $resTombola["res"] && $resTombola["data"]) ? $resTombola["data"] : [];
            $bingo = ($resBingo != null && $resBingo["res"] && $resBingo["data"]) ? $resBingo["data"] : [];

            $resTombola = toApiGetway("tombola", "getAllEnCoursByIdAsso",[
                "id" => auth()->user()->association_id,
            ]);

            $resBingo = toApiGetway("bingo", "getAllEnCoursByIdAsso",[
                "id" => auth()->user()->association_id,
            ]);
            
            $countOuvert =  ($resTombola != null && $resTombola["res"] && $resTombola["data"]) ? count($resTombola["data"]) : 0;
            $countOuvert += ($resBingo != null && $resBingo["res"] && $resBingo["data"]) ? count($resBingo["data"]) : 0;
            $don =  0;

            $montant = 0;
            
            foreach($tombola as $t) {
                if(isset($t["achat"]) && $t["achat"] != null) 
                    $montant += $t["montant"] * $t["achat"]->sum("ticket");
                if(isset($t["don"]) && $t["don"] != null)
                    $don += $t["don"]->sum("montant");
            }

            foreach($bingo as $b) {
                if(isset($b["achat"]) && $b["achat"] != null) 
                    $montant += $b["montant"] * $b["achat"]->sum("ticket");
                if(isset($b["don"]) && $b["don"] != null)
                    $don += $b["don"]->sum("montant");
            }
            //Bingo

            // foreach(Don::where("association_id" , auth()->user()->association_id)->where("tombola_id", null)->where("bingo_id", null)->get() as $t) {
            //         $don += $t->montant;
            // }

            return view("page/asso/dashboard", compact(["countOuvert", "don", "montant"]));
        }
        return redirect(route("login"))->withErrors("Vous n'êtes pas autorisé à acceder à cette espace!");
    }

    public function userDashboard() {
        event(new SetTirageEvent());

        $achat = null;
        $notView = Achat::getForTirage();
        if(count($notView) > 0){
            $achat = $notView[0];
            if($achat->bingo_id != null)
                return redirect(route("mini-site-bingo-tirage", $achat->bingo_id));
        }

        $donTotal = (auth()->user() != null && isset(auth()->user()->don) && auth()->user()->don != null) ? auth()->user()->don->sum("montant") : 0;

        $ticket_tombola = 0;
        foreach(Achat::where("user_id", auth()->user()->id)->where("tombola_id", "!=", null)->get() as $t) {
            $ticket_tombola += $t->ticket;
        }

        $ticket_bingo = 0;
        foreach(Achat::where("user_id", auth()->user()->id)->where("bingo_id", "!=", null)->get() as $b) {
            $ticket_bingo += $b->ticket;
        }

        $gains =0;
        $achats = auth()->user()->achat;
        foreach($achats as $achat) {
            foreach(Bingoticket::where("achat_id", $achat->id)->orderBy("created_at", "DESC")->get() as $ticket) {
                if($ticket != null) {
                    $g = Gagnantbingo::where("bingoticket_id", $ticket->id)->first();
                    if($g) 
                        $gains += $g->lotbingo->price;
                }
            }
        }

        return view("page/user/dashboard", compact(["ticket_tombola", "ticket_bingo", "donTotal", "gains"]));
    }
}
