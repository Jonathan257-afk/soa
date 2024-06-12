<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DomPDF;

use App\Models\Achat;

class AchatController extends Controller
{
    public function printTicket($id) {
        $achat = Achat::getById($id);

        $data = [
            'ticket' => $achat,
        ];


        $pdf = DomPDF::loadView('print/tombola', $data);
        
        $customPaper = array(0,0,500,300);
        $pdf->setPaper($customPaper);
        $pdf = $pdf->stream("ticket pour le tombola ".$achat->tombola->libelle.'.pdf');

        return $pdf;
    }

    public function printTicketBingoAllUser($id) {
        $achat = Achat::getById($id);
        if($achat && $achat->bingo_id != null && isset($achat->bingoticket) && $achat->bingoticket != null && count($achat->bingoticket) > 0) {
            $QRpath = public_path('assets/img/etoile.png');
            $QRtype = pathinfo($QRpath, PATHINFO_EXTENSION);
            $QRdata = file_get_contents($QRpath);
            $Qrbase64 = 'data:image/' . $QRtype . ';base64,' . base64_encode($QRdata);
            
            $data = [
                'tickets' => $achat->bingoticket,
                'bingo' => $achat->bingo,
                "etoile" =>  $Qrbase64,
            ];

            $pdf = DomPDF::loadView('print/bingo', $data);
        
            $customPaper = array(0,0,1000,500);
            $pdf->setPaper($customPaper);
            $pdf = $pdf->stream("ticket pour le bingo ".$achat->bingo->libelle.'.pdf');

            return $pdf;
        }
    }
}
