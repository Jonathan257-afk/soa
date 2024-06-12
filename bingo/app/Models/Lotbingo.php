<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lotbingo extends Model
{
    use HasFactory;

    protected $fillable = [
        "number",
        'libelle',
        'image',
        'bingo_id',
        "link",
        "price"
    ];
    protected $table = 'lotbingo';

    protected function store($number, $libelle, $image, $bingo_id, $price = 0, $link = null) {
        return Lotbingo::create([
            'number' => $number,
            'libelle' => $libelle,
            'image' => $image,
            'bingo_id' => $bingo_id,
            'price' => $price,
            "link" => $link
        ]);
    }

    protected function getAllByIdBingo($idBingo) {
        $res = Lotbingo::where("bingo_id", $idBingo)->orderBy("created_at", "DESC")->get();
        return $res;
    }

    protected function getTableName(){
        return $this->table;
    }

    public function bingo() {
        return $this->belongsTo(Bingo::class);
    }
}
