<?php 
if(!function_exists('getCurrentRoute')){
    function getCurrentRoute(){
        $str = "";

        $allRoute = config("route.all");

        foreach($allRoute as $route => $name) {
            if(Route::is($route))
                $str = $name;
        }
        
        return $str;
    }
}

if(!function_exists('getTitle')){
    function getTitle(){
        $title = getCurrentRoute() ;
        if($title != "")
            $title .=  " | " ;

        $title .=config("app.name");
        
        return $title;
    }
}

if(!function_exists('spaceNombre')){
    function spaceNombre($nombre, $unite = "") {
        $stringNombre = $nombre ."";
        $count = strlen($stringNombre);
        $resultat = "";
        $j = 1;
    
        for ($i = $count - 1; $i >= 0; $i--) {
            if ($j % 3 == 0) {
                $resultat = " " ." " . $stringNombre[$i] . $resultat;
                $j = 0;
            }
            else {
                $resultat = $stringNombre[$i] . $resultat;
            }
    
            $j++;
        }
    
        return $resultat . " " . $unite;
    }
    
}

if(!function_exists('monthToString')){
    function monthToString($month){
        if($month == "01" || $month == 1) return " Janvier ";
        else if($month == "02" || $month == 2) return " Février ";
        else if($month == "03" || $month == 3) return " Mars ";
        else if($month == "04" || $month == 4) return " Avril ";
        else if($month == "05" || $month == 5) return " Mei ";
        else if($month == "06" || $month == 6) return " Juin ";
        else if($month == "07" || $month == 7) return " Juillet ";
        else if($month == "08" || $month == 8) return " Août ";
        else if($month == "09" || $month == 9) return " Septembre ";
        else if($month == "10" || $month == 10) return " Octobre ";
        else if($month == "11" || $month == 11) return " Novembre ";
        else if($month == "12" || $month == 12) return " Décembre ";
    }
}

if(!function_exists('dateToString')){
    function dateToString($dateToChange) {
        $time = "";
        $res =  explode(".", $dateToChange)[0];
        $res =  explode(" ", $res);
        $date = $res[0];

        if(isset($res[1]) || count($res) > 1)
            $time = " à " . $res[1];
        
        $dateSplit = explode("-", $date);
        $mois = monthToString($dateSplit[1]);
        

        return $dateSplit[2] . $mois . $dateSplit[0] . $time;
    }
}

if(!function_exists('getMontInDate')){
    function getMontInDate($dateToChange) {
        $res =  explode(".", $dateToChange)[0];
        $res =  explode(" ", $res);
        $date = $res[0];
        
        $dateSplit = explode("-", $date);
        return monthToString($dateSplit[1]);
    }
}