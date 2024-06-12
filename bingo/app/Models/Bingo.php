<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

class Bingo extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'libelle',
        'montant',
        'ticket',
        "association_id",
        "max",
        "dateDebut",
        "tirage",
    ];
    protected $table = 'bingo';

    protected function addTirage($id, $tirage) {
        $bingo = Bingo::findOrFail($id) ;
        if($bingo) {
            return $bingo->update([
                "tirage" => $tirage
            ]);
        }
        return false;
    }

    protected function store($dateDebut, $date, $libelle, $montant, $ticket, $association_id) {
        return Bingo::create([
            'dateDebut' => $dateDebut,
            'date' => $date,
            'libelle' => $libelle,
            'montant' => $montant,
            'ticket' => $ticket,
            "association_id" => $association_id,
            "max" => $ticket,
        ]);
    }

    protected function venteTickets($id, $ticket) {
        $bingo = Bingo::findOrFail($id);
        if($bingo) {
            return $bingo->update([
                "ticket" => $bingo->ticket - $ticket
            ]);
        }
        return false;
    }

    protected function getAllByIdAsso($idAsso) {
        $res = Bingo::where("association_id", $idAsso)->orderBy("created_at", "DESC")->get();
        return $res;
    }

    protected function getAllEnCoursByIdAsso($idAsso) {
        $dateActuelle = $this->getDateNow();
        return Bingo::where("association_id", $idAsso)->where('date', '>', $dateActuelle)->orderBy('date', 'ASC')->get();
    } 

    protected function getAllForIndex() {
        $dateActuelle = $this->getDateNow();

        $res = Bingo::where('dateDebut', '<', $dateActuelle)->where('date', '>', $dateActuelle)->where("ticket", '>', 0)
            ->orderBy('date', 'ASC')
            ->get();
        return $res;
    }

    protected function setAllTirage() {
        $dateActuelle = $this->getDateNow();

        $bingos = Bingo::where('date', '<', $dateActuelle)->where("tirage", null)
            ->orderBy('date', 'ASC')
            ->get();

        foreach($bingos as $bingo) {
            Gagnantbingo::generateGagnant($bingo->id);
        }

        return $bingos;
    }

    protected function getAllPaginationForIndex() {
        $dateActuelle = $this->getDateNow();

        $res = Bingo::where('dateDebut', '<', $dateActuelle)->where('date', '>', $dateActuelle)->where("ticket", '>', 0)
            ->orderBy('date', 'ASC')
            ->paginate(10);
        return $res;
    }

    protected function getNotViewResultInAsso() {
        $dateActuelle = $this->getDateNow();
        $res = [];
        $bingos = Bingo::where("association_id", auth()->user()->association_id)->where('date', '<', $dateActuelle)->get();

        foreach($bingos as $bingo) {
            if(!Viewresult::where("user_id", auth()->user()->id)->where("bingo_id", $bingo->id)->first())
                array_push($res, $bingo);
        }

        return $res;
    }

    protected function getById($id) {
        $bingo = Bingo::findOrFail($id);
        if($bingo) {
            $bingo->users = $bingo->users ;
            $bingo->lotbingo = $bingo->lotbingo;
        }
        return $bingo;
    }

    protected function getTableName(){
        return $this->table;
    }

    public function association() {
        return $this->belongsTo(Association::class);
    }

    public function lotbingo() {
        return $this->hasMany(Lotbingo::class);
    }

    public function don() {
        return $this->hasMany(Don::class);
    }

    public function achat() {
        return $this->hasMany(Achat::class);
    }

    public function bingoticket() {
        return $this->hasMany(Bingoticket::class);
    }

    public function gagnantbingo() {
        return $this->hasMany(Gagnantbingo::class);
    }

    protected function getDateNow() {
        if(Auth::user() != null && isset(Auth::user()->timezone))
            return Carbon::now(Auth::user()->timezone);
        return Carbon::now();
    }
}
