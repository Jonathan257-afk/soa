<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session; 

use PayPalPayement;

use App\Models\Tombola;
use App\Models\Lot;
use App\Models\Don;
use App\Models\Achat;
use App\Models\User;

class TombolaController extends Controller
{
    public function add() {
        if(auth()->user()->isAsso) {
            return view("page/asso/tombola/add");
        }
        return redirect(route("login"))->withErrors("Vous n'êtes pas autorisé à acceder à cette espace!");
    }

    public function info($id) {
        if(auth()->user()->isAsso) {
            $tombola = Tombola::getById($id);
            return view("page/asso/tombola/info", compact(["tombola"])); 
        }
        return redirect(route("login"))->withErrors("Vous n'êtes pas autorisé à acceder à cette espace!");
    }

    public function site($id) {
        $tombola = Tombola::getById($id);
        return view("page/index/miniSiteTombola", compact(["tombola"])); 
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

        $tombola_id = $request->input("tombolaId");
        $tombola = Tombola::findOrFail($tombola_id);

        $buy = [
            "don" => $don,
            "tombola_id" => $tombola_id,
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
            return $this->buyByStripe($tombola, $ticket, $don);
        else if($paiement == "paypal")
            return $this->buyByPaypal($tombola, $ticket, $don);
        else if($paiement == "gpay")
            return $this->buyByGpay($tombola, $ticket, $don);
        else if (auth()->user()->isAsso)
            return $this->buySuccess();

        return back()->withErrors("Une erreur est survenue"); 

        
    }

    private function buyByStripe($tombola, $ticket, $don) {
        $stripe = ($tombola->association->stripe != null) ? $tombola->association->stripe : config("services.stripe.sk");
        
        \Stripe\Stripe::setApiKey($stripe);

        
        $tombolaName = $tombola->libelle . '. Au Nombre de ' . $ticket . " ticket(s) + don " . $don . "  €";
        $price = ($tombola->montant * $ticket) + $don;
        $two0 = "00";
        $total = "$price$two0";

        $session = \Stripe\Checkout\Session::create([
            "line_items" => [
                [
                    "price_data" => [
                        "currency" => "EUR",
                        "product_data" => [
                            "name" => $tombolaName,
                        ],
                        "unit_amount" => $total,
                    ],
                    'quantity' => 1,
                ],
            ],
            "mode" => "payment",
            "success_url" => route("buy-success"),
            "cancel_url" => route("index"),
        ]);

        return redirect()->away($session->url);
    }

    private function buyByPaypal($tombola, $ticket, $don) {
        $clientId = env("PAYPAL_LIVE_CLIENT_ID");
        $clientSecret = env("PAYPAL_LIVE_CLIENT_SECRET");

        if($tombola->association->paypal_id != null) {
            $clientId = $tombola->association->paypal->clientId;
            $clientSecret = $tombola->association->paypal->clientSecret;
        }

        $amount = ($tombola->montant * $ticket) + $don;

        $paiement = new PayPalPayement($clientId, $clientSecret);
        return $paiement->pay($amount);
    }

    private function buyByGpay($tombola, $ticket, $don) {
        return "buy by gpay";
    }

    public function buySuccess() {
        
        if(Session::has("buy") && Session::get("buy") != null && isset(Session::get("buy")[0])) {
            $buy = Session::get('buy')[0];
            $isUserStore = false;

            if(auth()->user() && isset($buy["tombola_id"])) {
                $tombola = Tombola::findOrFail($buy["tombola_id"]);
                $user_id = auth()->user()->id;
                $bienfetaire_id = null;
                
                if(auth()->user()->isAsso && isset($buy["acheteur"]) && $buy["acheteur"] != null) {
                    $isUserStore = Bienfetaire::store($buy["acheteur"]["name"], $buy["acheteur"]["first_name"], $buy["acheteur"]["email"], $buy["acheteur"]["tel"]);   
                    $bienfetaire_id = $isUserStore->id;
                    $user_id = null;
                }
                    
                $achat = null;
                if(isset($buy["ticket"])) {
                    $achat = Achat::store($user_id, $tombola->id, $buy["ticket"], null, $bienfetaire_id);
                    if($achat)
                        Tombola::venteTickets($tombola->id, $buy["ticket"]);
                }
                    
                if(isset($buy["don"])){
                    $achat_id = ($achat != null && $achat) ? $achat->id : null; 
                    $don = $buy["don"];
                    $ticket = Don::getNombreTicketForDon($don, $tombola->id);

                   
                    $don = Don::store($user_id, $tombola->id, $buy["don"], $ticket,  $achat_id);

                    if($don)
                        Tombola::venteTickets($tombola->id, $ticket);
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
        return Tombola::getById($request->input("id"));
    }

    public function index() {
        if(auth()->user()->isAsso) {
            $tombolas = Tombola::getAllByIdAsso(auth()->user()->association_id);
            return view("page/asso/tombola/index", compact(["tombolas"]));
        }
        return redirect(route("login"))->withErrors("Vous n'êtes pas autorisé à acceder à cette espace!");
    }

    public function store(Request $request) {
        if(auth()->user()->isAsso) {
            $request->validate([
                "dateDebut" => 'required',
                "date" => 'required',
                "libelle" => 'required',
                "montant" => 'required',
                "tirage" => 'required',
            ]);
            $useTirage = ($request->input("tirage") == "no") ? false : $request->input("tirage");
            $useTirage = ($useTirage == "yes") ? true : $useTirage;

            $date = $request->input("date");
            $dateDebut = $request->input("dateDebut");
            $libelle = $request->input("libelle");
            $montant = $request->input("montant");
            $ticket = 0;
            $debut = 0;

            if(!$useTirage) {
                $request->validate([
                    "ticket" => 'required',
                    "debut" => 'required',
                ]);

                $ticket = $request->input("ticket");
                $debut = $request->input("ticket");
            }

            if($dateDebut != "" && $date != "" && $libelle != ""  && $montant > 0  && ( $useTirage || ( !$useTirage && $ticket  > 0 && $debut  > 0 ) )) {
                
                $tombola = Tombola::store($dateDebut, $date, $libelle, $montant, $ticket, $useTirage, $debut);
                if($tombola) {      
                    if($request->has("numberLotAdd")) {
                        $nombreLot = intval($request->input("numberLotAdd"));
                        for($i = 0; $i < $nombreLot ; $i++) { 
                            if($request->has("libelleLot". $i) && $request->has("numberLot". $i)  && $request->has("nameImageLot". $i) ) {
                                $link = ($request->has("linkLot". $i)) ? $request->input("linkLot". $i) : null;
                                
                                $lot = Lot::store( $request->input("numberLot". $i), $request->input("libelleLot". $i), $request->input("nameImageLot". $i), $tombola->id,  $request->input("price". $i), $link);
                                
                                if($lot && File::exists(public_path()."/assets/file/tmp/".$request->input("nameImageLot". $i))) {
                                    $destinationPath = public_path()."/assets/img/lot/".$tombola->id."/".$request->input("nameImageLot". $i);

                                    if (!File::isDirectory(dirname($destinationPath))) {
                                        File::makeDirectory(dirname($destinationPath), 0777, true, true);
                                    }

                                    File::move(public_path()."/assets/file/tmp/".$request->input("nameImageLot". $i), $destinationPath);
                                }
                                    
                            }
                            
                        }
                    }
                    return redirect(route("asso-tombola"))->with("success", "Tombola ajouté avec success !");
                }
            }
            return back()->withErrors("Vous devez remplir correctement les champs !");
        }
        return redirect(route("login"))->withErrors("Vous n'êtes pas autorisé à acceder à cette espace!");
    }

    public function toBuy($id) {
        $tombola = Tombola::findOrFail($id);
        return view("page/buy", compact(["tombola"]));
    }
}
