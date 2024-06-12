<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayPal extends Model
{
    use HasFactory;

    protected $fillable = [
        'clientId',
        'clientSecret',
    ];
    protected $table = 'paypal';

    protected function store($clientId, $clientSecret) {
        $isExist = PayPal::where("clientId", $clientId)->where("clientSecret", $clientSecret)->first();
        if($isExist)
            return $isExist;

        if(auth()->user()->isAsso && auth()->user()->association->paypal_id != null)
            return PayPal:: modify(auth()->user()->association->paypal_id, $clientId, $clientSecret);

        return PayPal::create([
            'clientId' => $clientId,
            'clientSecret' => $clientSecret,
        ]);
    }

    protected function modify($id, $clientId, $clientSecret) {
        $account = PayPal::findOrFail($id);
        if($account) {
            return $account->update([
                'clientId' => $clientId,
                'clientSecret' => $clientSecret,
            ]);
        }
        return false;
    }

    protected function getById($id) {
        return PayPal::findOrFail($id);
    }

    protected function getTableName(){
        return $this->table;
    }
}
