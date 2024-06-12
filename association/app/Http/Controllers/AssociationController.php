<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use App\Models\Association;
use App\Models\User;
use App\Models\PayPal;

class AssociationController extends Controller
{
    public function store(Request $request) {

        $logo_name = $request->input("logo_name");
        if($logo_name == "")
            $logo_name = "logoGreen.png";
        //return response()->json(Association::all());
        $association = Association::store($request->input("name"), $request->input("email"), $logo_name, $request->input("interet"), $request->input("cerfa"));
        if($association) {
            return response()->json([
                "res" => true,
                "msg" => "votre compte a été creer avec success",
                "data" => $association
            ]);
        }
        return response()->json([
            "res" => false,
            "msg" => "une erreur est survenu",
            "data" => $association,
            "request" => $request->all()
        ]);
    }

    public function getName(Request $request) {
        $name = "";
        $association = Association::where("id", $request->input("id"))->first();
        if($association)
            $name = $association->name;
        
        return response()->json([
            "res" => true,
            "data" => $name
        ]);
    }

    public function updateInfo(Request $request) {
        $res = [
            "res" =>false,
            "message" => "Vous n'êtes pas authorisé à effectuer cette action !"
        ];
         
    
        if(Association::updateInfo($request->input("name"), $request->input("email"), $request->input("interet"), $request->input("cerfa"))) {
            $res["res"] = true;
            $res["message"] = "Modification effectué avec succèss !";
        }
        
        return response()->json($res);
    }

    public function updateLogo(Request $request) {
        $res = [
            "res" =>false,
            "message" => "Vous n'êtes pas authorisé à effectuer cette action !"
        ];
        $association = Association::findOrFail($request->input("id"));
        if($association) {
            $ancienLogo = $association->logo;
            $update = $association->update([
                'logo' => $request->input("name"),
            ]);

            if($update) {
                $res["res"] = true;
                $res["message"] = "Modification effectué avec succèss !";
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
        
        return response()->json($res);
    }
}