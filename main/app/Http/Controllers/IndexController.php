<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index() {
        $tombolas = toApiGetway("tombola", "getAll", []);
        $bingos = toApiGetway("bingo", "getAll", []);

        $tombolas = ($tombolas != null && $tombolas["res"] && $tombolas["data"]) ? $tombolas["data"] : [];
        $bingos = ($bingos != null && $bingos["res"] && $bingos["data"]) ? $bingos["data"] : [];

        return view("index", compact(["tombolas", "bingos"]));
    }

    public function game() {
        $tombolas = toApiGetway("tombola", "getAll", []);
        $bingos = toApiGetway("bingo", "getAll", []);
        
        $tombolas = ($tombolas != null && $tombolas["res"] && $tombolas["data"]) ? $tombolas["data"] : [];
        $bingos = ($bingos != null && $bingos["res"] && $bingos["data"]) ? $bingos["data"] : [];

        return view("page.game", compact(["tombolas", "bingos"]));
    }
}
