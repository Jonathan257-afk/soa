<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session; 

use DomPDF;

use App\Models\Bingo;
use App\Models\Lotbingo;
use App\Models\Tombola;
use App\Models\Lot;
use App\Models\Don;
use App\Models\Achat;
use App\Models\User;
use App\Models\Bienfetaire;
use App\Models\Bingoticket;
use App\Models\Viewresult;

class BingoController extends Controller
{
    public function add() {
        if(auth()->user()->isAsso) {
            return view("page/asso/bingo/add");
        }
        return redirect(route("login"))->withErrors("Vous n'êtes pas autorisé à acceder à cette espace!");
    }

    public function buy(Request $request) {
        $ticket = 0;
        if($request->input("plus") != null && $request->input("plus")  > 0)
            $ticket =  $request->input("plus");
        else if($request->input("one-ticket-buy") == "on")
            $ticket =  1;

        if($ticket < 1)
            return back()->withErrors("Nombre de ticket à acheter invalide !");

        $don = ($request->input("don") != null) ? $request->input("don") : 0;

        $bingo_id = $request->input("bingoId");
        $bingo = Bingo::findOrFail($bingo_id);

        $buy = [
            "don" => $don,
            "bingo_id" => $bingo_id,
            "ticket" => $ticket,
        ];

        if(auth()->user()->isAsso) {
            $buy["acheteur"] = [
                "name" => $request->input("name"),
                "first_name" => $request->input("first_name"),
                "email" => $request->input("email"),
                "tel" => $request->input("tel"),
            ];
        }

        if(Session::has("buy"))
            Session::forget("buy");

        Session::push("buy", $buy);
        
        $paiement = ($request->has("paiement")) ? $request->input("paiement") : "";
        if($paiement == "stripe")
            return $this->buyByStripe($bingo, $ticket, $don);
        else if($paiement == "paypal")
            return $this->buyByPaypal($bingo, $ticket, $don);
        else if($paiement == "gpay")
            return $this->buyByGpay($bingo, $ticket, $don);
        else if (auth()->user()->isAsso)
            return $this->buySuccess();

        return back()->withErrors("Une erreur est survenue"); 

        
    }

    private function buyByStripe($bingo, $ticket, $don) {
        $stripe = ($bingo->association->stripe != null) ? $bingo->association->stripe : config("services.stripe.sk");
        
        \Stripe\Stripe::setApiKey($stripe);

        
        $bingoName = $bingo->libelle . '. Au Nombre de ' . $ticket . " ticket(s) + don " . $don . "  €";
        $price = ($bingo->montant * $ticket) + $don;
        $two0 = "00";
        $total = "$price$two0";

        $session = \Stripe\Checkout\Session::create([
            "line_items" => [
                [
                    "price_data" => [
                        "currency" => "EUR",
                        "product_data" => [
                            "name" => $bingoName,
                        ],
                        "unit_amount" => $total,
                    ],
                    'quantity' => 1,
                    
                ],
            ],
            'customer_email' => auth()->user()->email,
            "mode" => "payment",
            "success_url" => route("bingo-buy-success"),
            "cancel_url" => route("index"),
        ]);

        return redirect()->away($session->url);
    }

    private function buyByPaypal($bingo, $ticket, $don) {
        $clientId = env("PAYPAL_LIVE_CLIENT_ID");
        $clientSecret = env("PAYPAL_LIVE_CLIENT_SECRET");

        if($bingo->association->paypal_id != null) {
            $clientId = $bingo->association->paypal->clientId;
            $clientSecret = $bingo->association->paypal->clientSecret;
        }

        $amount = ($bingo->montant * $ticket) + $don;

        $paiement = new PayPalPayement($clientId, $clientSecret);
        return $paiement->pay($amount);
    }

    private function buyByGpay($bingo, $ticket, $don) {
        return "buy by gpay";
    }

    public function buySuccess() {
        
        if(Session::has("buy") && Session::get("buy") != null && isset(Session::get("buy")[0])) {
            $buy = Session::get('buy')[0];
            $isUserStore = false;
            
            if(auth()->user() && isset($buy["bingo_id"])) {
                $bingo = Bingo::findOrFail($buy["bingo_id"]);
                $user_id = auth()->user()->id;
                $bienfetaire_id = null;
                
                if(auth()->user()->isAsso && isset($buy["acheteur"]) && $buy["acheteur"] != null) {
                    $isUserStore = Bienfetaire::store($buy["acheteur"]["name"], $buy["acheteur"]["first_name"], $buy["acheteur"]["email"], $buy["acheteur"]["tel"]);   
                    $bienfetaire_id = $isUserStore->id;
                    $user_id = null;
                }
                    
                $achat = null;
                if(isset($buy["ticket"])) {
                    $achat = Achat::store($user_id, null, $buy["ticket"], $bingo->id, $bienfetaire_id);
                    if($achat) {
                        Bingo::venteTickets($bingo->id, $buy["ticket"]);
                        for($i = 1; $i <= $achat->ticket; $i++) {
                            Bingoticket::store($achat->id , $bingo->id);
                        }
                    }
                }
                
                    
                if(isset($buy["don"])){
                    $achat_id = ($achat != null && $achat) ? $achat->id : null; 
                    $don = $buy["don"];
                    
                    $ticket = Don::getNombreTicketForDon($don, null, $bingo->id);
                   
                    $don = Don::store($user_id, null, $buy["don"], $ticket,  $achat_id, $bingo->id);

                    if($don){
                        Bingo::venteTickets($bingo->id, $ticket);
                        for($i = 1; $i <= $ticket; $i++) {
                            Bingoticket::store($achat->id, $bingo->id);
                        }
                    }
                        
                }
            }  



            if(Session::has("buy"))
                Session::forget("buy");

            if(auth()->user()->isAsso) {
                if($isUserStore)
                    return back()->with("success", "Acheteur ajouté avec success !");
                return back()->withErrors("Une erreur est survenue");
            }

            return redirect(route("index"))->with("success", "Achat effectué avec success !");
        }
        
        return redirect(route("index"))->withErrors("Une erreur est survenue");
    }

    public function getById(Request $request) {
        return Bingo::getById($request->input("id"));
    }

    public function index() {
        if(auth()->user()->isAsso) {
            $bingos = Bingo::getAllByIdAsso(auth()->user()->association_id);
            return view("page/asso/bingo/index", compact(["bingos"]));
        }
        return redirect(route("login"))->withErrors("Vous n'êtes pas autorisé à acceder à cette espace!");
    }

    public function info($id) {
        if(auth()->user()->isAsso) {
            $bingo = Bingo::getById($id);
            return view("page/asso/bingo/info", compact(["bingo"])); 
        }
        return redirect(route("login"))->withErrors("Vous n'êtes pas autorisé à acceder à cette espace!");
    }

    public function printTicket($id) {
        $ticket = Bingoticket::getById($id);
        if($ticket && $ticket->bingo_id != null) {
            $QRpath = public_path('assets/img/etoile.png');
            $QRtype = pathinfo($QRpath, PATHINFO_EXTENSION);
            $QRdata = file_get_contents($QRpath);
            $Qrbase64 = 'data:image/' . $QRtype . ';base64,' . base64_encode($QRdata);
            
            $data = [
                'ticket' => $ticket,
                'bingo' => $ticket->bingo,
                "etoile" =>  $Qrbase64,
            ];

            $pdf = DomPDF::loadView('print/ticketBingoOne', $data);
        
            $customPaper = array(0,0,1000,500);
            $pdf->setPaper($customPaper);
            $pdf = $pdf->stream("ticket pour le bingo ".$ticket ->bingo->libelle.'.pdf');

            return $pdf;
        }
    }

    
    public function site($id) {
        $bingo = Bingo::getById($id);
        return view("page/index/miniSiteBingo", compact(["bingo"])); 
    }
    
    public function store(Request $request) {
        if(auth()->user()->isAsso) {
            $request->validate([
                "dateDebut" => 'required',
                "date" => 'required',
                "libelle" => 'required',
                "ticket" => 'required',
                "montant" => 'required',
            ]);
            
            $date = $request->input("date");
            $dateDebut = $request->input("dateDebut");
            $libelle = $request->input("libelle");
            $montant = $request->input("montant");
            $ticket = $request->input("ticket");

            if($dateDebut != "" && $date != "" && $libelle != ""  && $montant > 0  && $ticket  > 0 ) {
                
                $bingo = Bingo::store($dateDebut, $date, $libelle, $montant, $ticket);
                if($bingo) {      
                    if($request->has("numberLotAdd")) {
                        $nombreLot = intval($request->input("numberLotAdd"));
                        for($i = 0; $i < $nombreLot ; $i++) { 
                            if($request->has("libelleLot". $i) && $request->has("numberLot". $i)  && $request->has("nameImageLot". $i) ) {
                                $link = ($request->has("linkLot". $i)) ? $request->input("linkLot". $i) : null;
                                
                                $lot = Lotbingo::store( $request->input("numberLot". $i), $request->input("libelleLot". $i), $request->input("nameImageLot". $i), $bingo->id,  $request->input("price". $i), $link);
                                
                                if($lot && File::exists(public_path()."/assets/file/tmp/".$request->input("nameImageLot". $i))) {
                                    $destinationPath = public_path()."/assets/img/lot/bingo/".$bingo->id."/".$request->input("nameImageLot". $i);

                                    if (!File::isDirectory(dirname($destinationPath))) {
                                        File::makeDirectory(dirname($destinationPath), 0777, true, true);
                                    }

                                    File::move(public_path()."/assets/file/tmp/".$request->input("nameImageLot". $i), $destinationPath);
                                }
                                    
                            }
                            
                        }
                    }
                    return redirect(route("asso-bingo-index"))->with("success", "Bingo ajouté avec success !");
                }
            }
            return back()->withErrors("Vous devez remplir correctement les champs !");
        }
        return redirect(route("login"))->withErrors("Vous n'êtes pas autorisé à acceder à cette espace!");
    }

    public function tirageUser($id) {
        $bingo = Bingo::getById($id);
        if($bingo) {
            if(!Viewresult::where("user_id", auth()->user()->id)->where("bingo_id", $bingo->id)->first())
                Viewresult::store(auth()->user()->id, null, $bingo->id);

            $gagnantbingo = $bingo->gagnantbingo;
            foreach($gagnantbingo as $index => $gagnant) {
                if($gagnant->bingoticket->achat->user_id != null)
                    $gagnantbingo[$index]->gagnant = $gagnant->bingoticket->achat->user->name . " ". $gagnant->bingoticket->achat->user->first_name ;
                if($gagnant->bingoticket->achat->bienfetaire_id != null)
                    $gagnantbingo[$index]->gagnant = $gagnant->bingoticket->achat->bienfetaire->name . " ". $gagnant->bingoticket->achat->bienfetaire->first_name ;

                $gagnantbingo[$index]->lot = $gagnant->lotbingo->libelle;
            }
            return  view("page/user/tiragebingo", compact(["bingo", "gagnantbingo"])); 
        }
        return redirect(route("user-achat"))->withErrors("Bingo non trouvé!");
    }

    public function tirageAsso($id) {
        $bingo = Bingo::getById($id);
        if($bingo) {
            if(!Viewresult::where("user_id", auth()->user()->id)->where("bingo_id", $bingo->id)->first())
                Viewresult::store(auth()->user()->id, null, $bingo->id);

            $gagnantbingo = $bingo->gagnantbingo;
            foreach($gagnantbingo as $index => $gagnant) {
                if($gagnant->bingoticket->achat->user_id != null)
                    $gagnantbingo[$index]->gagnant = $gagnant->bingoticket->achat->user->name . " ". $gagnant->bingoticket->achat->user->first_name ;
                if($gagnant->bingoticket->achat->bienfetaire_id != null)
                    $gagnantbingo[$index]->gagnant = $gagnant->bingoticket->achat->bienfetaire->name . " ". $gagnant->bingoticket->achat->bienfetaire->first_name ;

                $gagnantbingo[$index]->lot = $gagnant->lotbingo->libelle;
            }
            return  view("page/asso/bingo/tiragebingo", compact(["bingo", "gagnantbingo"])); 
        }
        return redirect(route("asso-bingo-index"))->withErrors("Bingo non trouvé!");
    }

    public function tirageMiniSite($id) {
        $bingo = Bingo::getById($id);
        if($bingo) {
            if(auth() != null && auth()->user() != null && !Viewresult::where("user_id", auth()->user()->id)->where("bingo_id", $bingo->id)->first())
                Viewresult::store(auth()->user()->id, null, $bingo->id);

            $gagnantbingo = $bingo->gagnantbingo;
            foreach($gagnantbingo as $index => $gagnant) {
                if($gagnant->bingoticket->achat->user_id != null)
                    $gagnantbingo[$index]->gagnant = $gagnant->bingoticket->achat->user->name . " ". $gagnant->bingoticket->achat->user->first_name ;
                if($gagnant->bingoticket->achat->bienfetaire_id != null)
                    $gagnantbingo[$index]->gagnant = $gagnant->bingoticket->achat->bienfetaire->name . " ". $gagnant->bingoticket->achat->bienfetaire->first_name ;

                $gagnantbingo[$index]->lot = $gagnant->lotbingo->number;
            }
            return  view("page/index/tiragebingo", compact(["bingo", "gagnantbingo"])); 
        }
        return redirect(route("index"))->withErrors("Bingo non trouvé!");
    }

    public function toBuy($id) {
        $bingo = Bingo::findOrFail($id);
        return view("page/index/buyBingo", compact(["bingo"]));
    }
}
