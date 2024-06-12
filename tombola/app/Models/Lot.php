<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lot extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'libelle',
        'image',
        'tombola_id',
        "link",
        "price"
    ];
    protected $table = 'lot';

    protected function store($number, $libelle, $image, $tombola_id, $price = 0, $link = null) {
        return Lot::create([
            'number' => $number,
            'libelle' => $libelle,
            'image' => $image,
            'tombola_id' => $tombola_id,
            'price' => $price,
            "link" => $link
        ]);
    }

    protected function getAllByIdTombola($idTombola) {
        $res = Lot::where("tombola_id", $idTombola)->orderBy("created_at", "DESC")->get();
        return $res;
    }

    protected function getTableName(){
        return $this->table;
    }

    public function tombola() {
        return $this->belongsTo(Tombola::class);
    }
}
