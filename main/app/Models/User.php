<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'first_name',
        'email',
        'tel',
        'password',
        "isAsso",
        "association_id",
        "verified"
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected function emailConfirmed($email) {
        $user = User::where("email", $email)->first();
        if($user) {
            return $user->update([
                "verified" => true,
            ]);
        }
        return false;
    }

    protected function store($name, $first_name, $email, $tel, $password = null) {
        if(User::where("email", $email)->first()) 
            return false;
        $password = ($password != null) ? Hash::make( $password) : null;
        $store = User::create([
            'name' => $name,
            'first_name' => $first_name,
            'email' => $email,
            'tel' => $tel,
            'password' => $password,
            "isAsso" => false,
            "verified"=> true,
        ]);

        if($store) {
            //Confirmaccount::store($email);
            return $store;
        }
        return false;
    }

    protected function signUpAssociation($name, $email, $password, $association_id) {
        $association = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make( $password),
            "isAsso" => true,
            'association_id' => $association_id,
            "verified"=> true,
        ]);

        if($association) {
            //Confirmaccount::store($email);
            return $association;
        }
        return false;
    }

    public function association() {
        return $this->belongsTo(Association::class);
    }

    public function achat() {
        return $this->hasMany(Achat::class);
    }

    public function don() {
        return $this->hasMany(Don::class);
    } 
}
