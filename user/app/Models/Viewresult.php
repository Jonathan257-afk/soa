<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Viewresult extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'bingo_id',
        'tombola_id',
    ];
    protected $table = 'viewresult';

    protected function store($user_id, $tombola_id, $bingo_id) {
        return Viewresult::create([
            'user_id' => $user_id,
            'tombola_id' => $tombola_id,
            'bingo_id' => $bingo_id,
        ]);
    }

    protected function getById($id) {
        $view = Viewresult::findOrFail($id);
        if($view) {
            $view->user = $view->user ;
            if($view->tombola_id != null)
                $view->tombola = $view->tombola;
            if($view->bingo_id != null)
                $view->bingo = $view->bingo;
        }
        return $view;
    }

    protected function getTableName(){
        return $this->table;
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function tombola() {
        return $this->belongsTo(Tombola::class);
    }

    public function bingo() {
        return $this->belongsTo(Bingo::class);
    }
}
