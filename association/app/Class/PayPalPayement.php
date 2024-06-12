<?php
use Omnipay\Omnipay;

class PayPalPayement {
    private $geteway;

    public function __construct($clientId, $clientSecret) {
        $this->geteway = Omnipay::create("PayPal_Rest");
        $this->geteway->setClientId($clientId);
        $this->geteway->setSecret($clientSecret);
        $this->geteway->setTestMode(true);
    }

    public function pay($amount, $isTombola = true, $isBingo = false) {
        try {
            $route = route("buy-success");
            if($isBingo)
                $route = route("bingo-buy-success");
            $response = $this->geteway->purchase(array(
                "amount" => $amount,
                "currency" => "EUR",
                "returnUrl" => $route,
                "cancelUrl" => route("index"),
            ))->send();

            if($response->isRedirect())
                $response->redirect();
            else
                return $response->getMessage;
        } catch (\Throwable $th) {
            return $th->getMessage;
            return back()->withErros($th->getMessage);
        }
    }
}
