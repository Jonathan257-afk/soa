<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Association extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
        'stripe',
        'email',
        'interet',
        'cerfa',
        "paypal_id",
        "gpay",
    ];
    protected $table = 'association';

    protected function store($name, $email, $logo, $interet = false, $cerfa = false) {
        if(Association::where("email", $email)->first())
            return false;
        $interet = ($interet == "no") ? false : $interet;
        $interet = ($interet == "yes") ? true : $interet;

        $cerfa = ($cerfa == "no") ? false : $cerfa;
        $cerfa = ($cerfa == "yes") ? true : $cerfa;

        return Association::create([
            'name' => $name,
            'logo' => $logo,
            'email' => $email,
            'interet' => $interet,
            'cerfa' => $cerfa,
        ]);
    }

    protected function getById($id) {
        return Association::findOrFail($id);
    }

    protected function getTableName(){
        return $this->table;
    }

    public function paypal() {
        return $this->belongsTo(Paypal::class);
    }

    public function users() {
        return $this->hasMany(User::class);
    }

    public function tombola() {
        return $this->hasMany(Tombola::class);
    }

    protected function updateInfo($name, $email, $interet = false, $cerfa = false) {
        $association = Association::findOrFail(auth()->user()->association_id);
        if($association) {
            $interet = ($interet == "no") ? false : $interet;
            $interet = ($interet == "yes") ? true : $interet;

            $cerfa = ($cerfa == "no") ? false : $cerfa;
            $cerfa = ($cerfa == "yes") ? true : $cerfa;

            return $association->update([
                'name' => $name,
                'email' => $email,
                'interet' => $interet,
                'cerfa' => $cerfa,
            ]);
        }
        return false;
    }

    protected function updatePaiement($stripe = null, $paypal_id = null, $gpay = null) {
        $association = Association::findOrFail(auth()->user()->association_id);
        if($association) {
            return $association->update([
                'stripe' => $stripe,
                'paypal_id' => $paypal_id,
                'gpay' => $gpay,
            ]);
        }
        return false;
    }
}
