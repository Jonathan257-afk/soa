<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Don extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bienfetaire_id',
        'tombola_id',
        'bingo_id',
        'montant',
        'ticket',
        'numero',
        'achat_id',
        'association_id',
    ];
    protected $table = 'don';

    protected function store($user_id, $tombola_id = null, $montant, $ticket = 0, $achat_id = null, $bingo_id = null, $bienfetaire_id = null) {
        $numero = null;
        $association_id = (auth()->user()->isAsso) ? auth()->user()->association_id : null;
        if($ticket > 0 && $tombola_id != null)
            $numero = Tombola::getNewNumberForShell($tombola_id);
        return Don::create([
            'user_id' => $user_id,
            'bienfetaire_id' => $bienfetaire_id,
            'tombola_id' => $tombola_id,
            'montant' => $montant,
            'ticket' => $ticket,
            'numero' => $numero,
            'achat_id' => $achat_id,
            'bingo_id' => $bingo_id,
            'association_id' => $association_id,
        ]);
    }

    protected function getAllByIdTombola($idTombola) {
        $res = Don::where("tombola_id", $idTombola)->orderBy("created_at", "DESC")->get();
        return $res;
    }

    protected function getAllByIdBingo($idBingo) {
        $res = Don::where("bingo_id", $idBingo)->orderBy("created_at", "DESC")->get();
        return $res;
    }

    protected function getAllByIdBienfetaire($user_id) {
        $res = Don::where("user_id", $user_id)->orderBy("created_at", "DESC")->get();
        return $res;
    }

    protected function getAllByIdAsso($idAsso) {
        $res = [];
        $idDon = [];
        $tombolas = Tombola::where("association_id", $idAsso)->get();
        $bingos = Bingo::where("association_id", $idAsso)->get();
        
        foreach($tombolas as $tombola) {
            if(isset($tombola->don) && $tombola->don != null && count($tombola->don) > 0) {
                foreach($tombola->don as $don) {
                    $don->users = $don->users;
                    array_push($res, $don);
                    $idDon[$don->id] = $don->id;
                }
            }
        }

        foreach($bingos as $bingo) {
            if(isset($bingo->don) && $bingo->don != null && count($bingo->don) > 0) {
                foreach($bingo->don as $don) {
                    $don->users = $don->users;
                    array_push($res, $don);
                    $idDon[$don->id] = $don->id;
                }
            }
        }

        $dons = Don::where("association_id", $idAsso)->get();
        foreach($dons as $don) {
            if($don != null && !isset( $idDon[$don->id])) {
                $don->users = $don->users;
                array_push($res, $don);
            }
        }

        return $res;
    }

    protected function getById($id) {
        $don = Don::findOrFail($id);
        if($don) {
            $don->tombola = $don->tombola ;
            $don->users = $don->users;
        }
        return $don;
    }

    protected function getNombreTicketForDon($don, $tombola_id = null, $bingo_id = null) {
        $ticket = 0;
        $montant = 1;
        if($tombola_id != null && $tombola_id != "") {
            $tombola = Tombola::getById($tombola_id);
            $montant = $tombola->montant;
        } 
        else if($bingo_id != null && $bingo_id != "") {
            $bingo = Bingo::getById($bingo_id);
            $montant = $bingo->montant;
        } 

        if( round($don / 3) > 74)
            $ticket = round(74 / $montant);
        else
            $ticket = round(($don / 3) / $montant);

        return $ticket;
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

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function bienfetaire() {
        return $this->belongsTo(Bienfetaire::class);
    }

    public function association() {
        return $this->belongsTo(Association::class);
    }
}
