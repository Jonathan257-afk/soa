<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gagnantbingo extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'bingoticket_id',
        'bingo_id',
        'lotbingo_id',
        "gagnant_at",
    ];
    protected $table = 'gagnantbingo';

    protected function store($bingoticket_id, $bingo_id, $lot_id, $gagnant_at) {
        return Gagnantbingo::create([
            'bingoticket_id' => $bingoticket_id,
            'bingo_id' => $bingo_id,
            'lotbingo_id' => $lot_id,
            "gagnant_at" => $gagnant_at,
        ]);
    }

    protected function generateGagnant($idBingo) {
        $bingo = Bingo::getById($idBingo);
       
        if($bingo) {
            $tirage = [];
            $idGagnant = [];

            $allTicket = $bingo->bingoticket;
            $allLot = $bingo->lotbingo;
            
            $participant = count($allTicket);
            $count_gagnant = 0;
            $count_lot = count($allLot);
            $tmp_count_lot = count($allLot);

            $numbers_tirage = range(1, 75);
            shuffle($numbers_tirage);
            
            while($count_lot > 0 && $participant > 0 &&  $count_gagnant <= $tmp_count_lot) {
                $t = array_shift($numbers_tirage);
                $tirage[] = $t;
                
                foreach($allTicket as $key => $ticket) {
                   
                    if($ticket != null && isset($ticket->number) && $ticket->number != null) {
                        $tmp_number_ticket = $ticket->number;

                        if(gettype($tmp_number_ticket) == "string")
                            $tmp_number_ticket = json_decode($ticket->number, true);

                        
                        foreach($tmp_number_ticket as $kk => $vv) {
                            foreach($vv as $k => $v) {
                                if($v == $t || $v == "free") $tmp_number_ticket[$kk][$k] = 0;
                            }
                        }

                        if( !isset($idGagnant[$ticket->id]) && Gagnantbingo::isTicketGagnant($tmp_number_ticket))  {
                            Gagnantbingo::store($ticket->id, $idBingo, $allLot[$count_gagnant]->id, $t);
                            $idGagnant[$ticket->id] = $ticket->id;
                            $participant--;
                            $count_lot--;
                            $count_gagnant++;
                        }
                            
                        
                        $allTicket[$key]->number =  $tmp_number_ticket;
                    }
                }
            }
            
            Bingo::addTirage($idBingo, json_encode($tirage));
            return true;
        }

        return false;
    }

    protected function getAllByIdBingo($bingo_id) {
        $res = Gagnantbingo::where("bingo_id", $bingo_id)->orderBy("created_at", "DESC")->get();
        return $res;
    }

    protected function getById($id) {
        $gagnant = Gagnantbingo::findOrFail($id);
        if($gagnant) {
            $gagnant->lot = $gagnant->lot ;
            $gagnant->bingo = $gagnant->bingo;
            $gagnant->bingoticket = $gagnant->bingoticket;
        }
        return $gagnant;
    }

    protected function getTableName(){
        return $this->table;
    }

    public function bingo() {
        return $this->belongsTo(Bingo::class);
    }

    public function lotbingo() {
        return $this->belongsTo(Lotbingo::class);
    }

    public function bingoticket() {
        return $this->belongsTo(Bingoticket::class);
    }

    protected function isTicketGagnant($ticket) {
        $isGagnant = false;
        if($ticket != null) {
            if($ticket[0][0] == 0 && $ticket[1][1] == 0  && $ticket[2][2] == 0   && $ticket[3][3] == 0  && $ticket[4][4] == 0 )
                return true;
            else if($ticket[0][4] == 0 && $ticket[1][3] == 0  && $ticket[2][2] == 0 && $ticket[3][1] == 0  && $ticket[4][0] == 0 ) 
                return true;
            else{
                foreach($ticket as $index => $t) {
                    if($ticket[$index][0] == 0 && $ticket[$index][1] == 0  && $ticket[$index][2] == 0  && $ticket[$index][3] == 0  && $ticket[$index][4] == 0 )
                        $isGagnant =  true;
                    else  if($ticket[0][$index] == 0 && $ticket[1][$index] == 0  && $ticket[2][$index] == 0  && $ticket[3][$index] == 0  && $ticket[4][$index] == 0 )
                        $isGagnant =  true;
                    
                }
            }

        }

        return $isGagnant;
    }
}
