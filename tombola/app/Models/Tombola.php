<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Tombola extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'libelle',
        'montant',
        'ticket',
        "association_id",
        "max",
        "useTirage",
        "debut",
        "dateDebut",
    ];
    protected $table = 'tombola';

    protected function store($dateDebut, $date, $libelle, $montant, $ticket, $useTirage, $debut = 0, $association_id = 1) {
        return Tombola::create([
            'dateDebut' => $dateDebut,
            'date' => $date,
            'libelle' => $libelle,
            'montant' => $montant,
            'ticket' => $ticket,
            "association_id" => $association_id,
            "max" => $ticket,
            "useTirage" => $useTirage,
            "debut" => $debut,
        ]);
    }

    protected function getNewNumberForShell($id) {
        $number = 0;
        $tombola = Tombola::findOrFail($id);
        if($tombola) {
            $number = $tombola->debut;
            if($tombola->debut == 0)
                $number++;
                
            foreach($tombola->achat as $achat) {
                if($achat->numero != null) {
                    $achatNumber = $achat->numero +  $achat->ticket;
                    if($achatNumber > $number)
                        $number = $achatNumber;
                }
            }

            foreach($tombola->don as $don) {
                if($don->numero != null) {
                    $donNumber =  $don->numero +  $don->ticket;
                    if($donNumber > $number)
                        $number = $donNumber;
                }
            }
        }
        return $number;
    }

    protected function venteTickets($id, $ticket) {
        $tombola = Tombola::findOrFail($id);
        if($tombola) {
            return $tombola->update([
                "ticket" => $tombola->ticket - $ticket
            ]);
        }
        return false;
    }

    protected function getAllByIdAsso($idAsso) {
        $res = Tombola::where("association_id", $idAsso)->orderBy("created_at", "DESC")->get();
        return $res;
    }

    protected function getAllEnCoursByIdAsso($idAsso) {
        $dateActuelle = $this->getDateNow();
        return Tombola::where("association_id", $idAsso)->where('date', '>', $dateActuelle)->orderBy('date', 'ASC')->get();
    } 

    protected function getAllForIndex() {
        $dateActuelle = $this->getDateNow();

        $res = Tombola::where('dateDebut', '<', $dateActuelle)->where('date', '>', $dateActuelle)->where("ticket", '>', 0)->orWhere("useTirage", 1)
            ->orderBy('date', 'ASC')
            ->get();
        return $res;
    }

    protected function getAllPaginationForIndex() {
        $dateActuelle = $this->getDateNow();

        $tombolasFutures = Tombola::where('dateDebut', '<', $dateActuelle)->where('date', '>', $dateActuelle)->where("ticket", '>', 0)->orWhere("useTirage", 1)
            ->orderBy('date', 'ASC')
            ->paginate(10);
        return $tombolasFutures;
    }

    protected function getById($id) {
        $tombola = Tombola::findOrFail($id);
        if($tombola) {
            $tombola->users = $tombola->users ;
            $tombola->lot = $tombola->lot;
        }
        return $tombola;
    }

    protected function getTableName(){
        return $this->table;
    }

    public function association() {
        return $this->belongsTo(Association::class);
    }

    public function lot() {
        return $this->hasMany(Lot::class);
    }

    public function don() {
        return $this->hasMany(Don::class);
    }

    public function achat() {
        return $this->hasMany(Achat::class);
    }

    private function getDateNow() {
        return Carbon::now();
    }
}
