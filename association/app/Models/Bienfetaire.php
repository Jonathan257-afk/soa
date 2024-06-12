<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bienfetaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'first_name',
        'email',
        'tel',
    ];
    protected $table = 'bienfetaire';

    protected function store($name, $first_name, $email, $tel) {
        return Bienfetaire::create([
            'name' => $name,
            'first_name' => $first_name,
            'email' => $email,
            'tel' => $tel,
        ]);
    }

    protected function getById($id) {
        $bienfetaire = Bienfetaire::findOrFail($id);
        if($bienfetaire) {
            $bienfetaire->tombola = $bienfetaire->tombola ;
            $bienfetaire->don = $bienfetaire->don;
        }
        return $bienfetaire;
    }

    protected function getTableName(){
        return $this->table;
    }

    public function don() {
        return $this->hasMany(Don::class);
    }
}
