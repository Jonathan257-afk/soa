<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Events\SendConfirmAccountEmailEvent;

class Confirmaccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'code',
    ];
    protected $table = 'confirmaccount';

    protected function store($email) {
        $isExist = Confirmaccount::where("email", $email)->first();
        if($isExist) {
            //event(new SendConfirmAccountEmailEvent($isExist->email, $isExist->code));
            return $isExist;
        }
            

        $newCode = false;
        $code = "";
        while(!$newCode || $code == "") {
            $code = Confirmaccount::createCodeConfirm();
            if(!Confirmaccount::where("code", $code)->first())
                $newCode = true;
        }
        $store = Confirmaccount::create([
            'email' => $email,
            'code' => $code,
        ]);

        if($store) {
            //event(new SendConfirmAccountEmailEvent($email, $code));
            return true;
        }

        return false;
    }

    protected function getById($id) {
        return Confirmaccount::findOrFail($id);
    }

    protected function supprimer($id) {
        $confirm = Confirmaccount::findOrFail($id);
        if($confirm)
            return $confirm->delete();
        return false;
    }

    protected function getTableName(){
        return $this->table;
    }

    protected function createCodeConfirm() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 20; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        $pass = implode("", $pass);

        return $pass;
    }
}
