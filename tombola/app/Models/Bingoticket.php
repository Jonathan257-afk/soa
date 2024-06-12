<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bingoticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'achat_id',
        'bingo_id',
        "num_ticket",
        'number',
    ];
    protected $table = 'bingoticket';

    protected function store($achat_id, $bingo_id) {
        $num_ticket = Bingoticket::getNewNumberForShell($bingo_id);
        return Bingoticket::create([
            'achat_id' => $achat_id,
            'bingo_id' => $bingo_id,
            'num_ticket'=> $num_ticket,
            'number' => json_encode(Bingoticket::generateCard()),
        ]);
    }

    protected function getNewNumberForShell($bingo_id) {
        $number = 1;
        foreach(Bingoticket::where("bingo_id", $bingo_id)->get() as $ticket){
            $number++;
        }
        // $bingo = Bingo::findOrFail($bingo_id);
        // if($bingo)
        //     $number = $bingo->max - $bingo->ticket + 1;
        
        return  $number ;
    }

    protected function generateCard() {
        $card = [];
        $b = range(1, 15);
        $i = range(16, 30);
        $n = range(31, 45);
        $g = range(46, 60);
        $o = range(61, 75);
        shuffle($b);
        shuffle($i);
        shuffle($n);
        shuffle($g);
        shuffle($o);

        // Générez la carte de bingo
        for ($j = 1; $j <= 5; $j++) {
            if($j != 3)
                $card[] = [array_shift($b), array_shift($i), array_shift($n),  array_shift($g), array_shift($o)];
            else 
                $card[] = [array_shift($b), array_shift($i), "free",  array_shift($g), array_shift($o)];
        }

        return $card;
    }

    protected function getAllByIdBingo($bingo_id) {
        $res = Bingoticket::where("bingo_id", $bingo_id)->orderBy("created_at", "DESC")->get();
        return $res;
    }

    protected function getByIdAchat($achat_id) {
        return Bingoticket::where("achat_id", $achat_id)->first();
    } 

    protected function getById($id) {
        $ticket = Bingoticket::findOrFail($id);
        if($ticket) {
            $ticket->achat = $ticket->achat ;
            $ticket->bingo = $ticket->bingo;
        }
        return $ticket;
    }

    protected function getTableName(){
        return $this->table;
    }

    public function bingo() {
        return $this->belongsTo(Bingo::class);
    }

    public function achat() {
        return $this->belongsTo(Achat::class);
    }
}
