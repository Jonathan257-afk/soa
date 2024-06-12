<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function storeTmp(Request $request) {
        
        $request->file('fileToSave')->move(public_path()."/assets/file/tmp", $request->input('name'));

        return response()->json([
            "res" => true,
        ]);
    }
}
