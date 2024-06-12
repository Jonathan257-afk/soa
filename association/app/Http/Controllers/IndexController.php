<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Events\SetTirageEvent;

use App\Models\Tombola;
use App\Models\Bingo;

class IndexController extends Controller
{
    public function index() {
        event(new SetTirageEvent());
        
        $tombolas = Tombola::getAllPaginationForIndex();
        $bingos = Bingo::getAllPaginationForIndex();

        return view("index", compact(["tombolas", "bingos"]));
    }

    public function game() {
        $tombolas = Tombola::getAllForIndex();
        $bingos = Bingo::getAllForIndex();

        return view("page.game", compact(["tombolas", "bingos"]));
    }
}
