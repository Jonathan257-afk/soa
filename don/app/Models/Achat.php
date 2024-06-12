<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achat extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tombola_id',
        'bingo_id',
        'ticket',
        'numero',
        "bienfetaire_id",
    ];
    protected $table = 'achat';

    protected function store($user_id = null, $tombola_id = null, $ticket, $bingo_id = null, $bienfetaire_id = null) {
        $numero = null;
        if($tombola_id != null)
            $numero = Tombola::getNewNumberForShell($tombola_id);
        return Achat::create([
            'user_id' => $user_id,
            'tombola_id' => $tombola_id,
            'bingo_id' => $bingo_id,
            'ticket' => $ticket,
            'numero' => $numero,
            'bingo_id' => $bingo_id,
            'bienfetaire_id' => $bienfetaire_id,
        ]);
    }

    protected function getAllByIdTombola($idTombola) {
        $res = Achat::where("tombola_id", $idTombola)->orderBy("created_at", "DESC")->get();
        return $res;
    }

    protected function getForTirage() {
        $res = [];
        $achats = Achat::where("user_id", auth()->user()->id)->join(Bingo::getTableName(), Achat::getTableName().'.bingo_id', '=', Bingo::getTableName().'.id')->where(Bingo::getTableName().'.date', '<', Bingo::getDateNow())->where(Bingo::getTableName().'.tirage', "!=", null)->selectRaw(Achat::getTableName().".*")->get();
        foreach($achats as $achat) {
            if(!Viewresult::where("user_id", auth()->user()->id)->where("bingo_id", $achat->bingo_id)->first())
                array_push($res, $achat);
        }
        return $res;
    }

    protected function getAllByIdBingo($idBingo) {
        $res = Achat::where("bingo_id", $idBingo)->orderBy("created_at", "DESC")->get();
        return $res;
    }

    protected function getAllByIdUser($user_id) {
        $res = Achat::where("user_id", $user_id)->orderBy("created_at", "DESC")->get();
        return $res;
    }

    protected function getAllByIdBienfetaire($bienfetaire_id) {
        $res = Achat::where("bienfetaire_id", $bienfetaire_id)->orderBy("created_at", "DESC")->get();
        return $res;
    }

    protected function getById($id) {
        $achat = Achat::findOrFail($id);
        if($achat) {
            if($achat->tombola_id != null)
                $achat->tombola = $achat->tombola ;
            if($achat->bingo_id != null)
                $achat->bingo = $achat->bingo ;
            $achat->users = $achat->users;
        }
        return $achat;
    }

    protected function getTableName(){
        return $this->table;
    }

    public function tombola() {
        return $this->belongsTo(Tombola::class);
    }

    public function bingo() {
        return $this->belongsTo(Bingo::class);
    }

    public function bingoticket() {
        return $this->hasMany(Bingoticket::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function bienfetaire() {
        return $this->belongsTo(Bienfetaire::class);
    }

    public function don() {
        return $this->hasMany(Don::class);
    }
}
