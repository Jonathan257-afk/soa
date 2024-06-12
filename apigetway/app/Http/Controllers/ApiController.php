<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{

    public function index(Request $request) {
        $url = $this->getUrlOfService($request->input("service")) . "/".$request->input("action");
        
        $response = Http::post($url, $request->input("data"));
        return $response->json();
    }

    private function getUrlOfService($service) {
        $url = "";

        switch($service) {
            case "association":
                $url = $this->getServiceAssociationUrl();
                break;
            case "tombola":
                $url = $this->getServiceTombolaUrl();
                break;
            case "bingo":
                $url = $this->getServiceBingoUrl();
                break;
            case "don":
                $url = $this->getServiceDonUrl();
                break;
            case "user":
                $url = $this->getServiceUserUrl();
                break;
        }

        return $url;
    }

    private function getDefaultUrlOfService() {
        return "http://localhost/soa/";
    }

    private function getServiceBingoUrl() {
        return $this->getDefaultUrlOfService() . "bingo/public";
    }

    private function getServiceTombolaUrl() {
        return $this->getDefaultUrlOfService() . "tombola/public";
    }

    private function getServiceAssociationUrl() {
        return $this->getDefaultUrlOfService() . "association/public";
    }

    private function getServiceDonUrl() {
        return $this->getDefaultUrlOfService() . "don/public";
    }

    private function getServiceUserUrl() {
        return $this->getDefaultUrlOfService() . "user/public";
    }
}
