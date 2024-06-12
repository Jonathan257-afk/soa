<?php

namespace App\Exports;

use App\Models\Navette;
use App\Models\Ligne;
use App\Models\Fournisseur;
use App\Models\User;
use App\Models\Fonction;
use Maatwebsite\Excel\Concerns\FromCollection;

class NavetteExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $lignes =  Ligne::join(Navette::getTableName(), Navette::getTableName().".id", Ligne::getTableName().".id_navette")->join(User::getTableName(), User::getTableName().".id", Navette::getTableName().".id_collaborateur")->join(Fonction::getTableName(), Fonction::getTableName().".id", User::getTableName().".id_fonction")->selectRaw(Ligne::getTableName().".created_at,".Navette::getTableName().".reference,".User::getTableName().".nom,".User::getTableName().".prenom,".Fonction::getTableName().".name fonction,".Ligne::getTableName().".description,".Ligne::getTableName().".motif,".Ligne::getTableName().".qte,".Ligne::getTableName().".id_fournisseur fournisseur,".Ligne::getTableName().".pu,".Ligne::getTableName().".devis,".Ligne::getTableName().".justification,".Ligne::getTableName().".imputation,".Ligne::getTableName().".activite,".Ligne::getTableName().".code_tiger,".Ligne::getTableName().".numero_bl,".Ligne::getTableName().".etat,".Ligne::getTableName().".date_livraison,".Ligne::getTableName().".commentaire")->orderBy(Ligne::getTableName().".created_at", "DESC")->get();
        
        foreach($lignes as $key => $ligne){
            //$lignes[$key]->created_at = $this->dateToString($ligne->created_at);
            $lignes[$key]->pu = $this->spaceNumber($ligne->pu);
            $lignes[$key]->etat = $this->showEtat($ligne->etat);
            $lignes[$key]->fournisseur = $this->getNameFournisseurs($ligne->fournisseur);
            $lignes[$key]->devis = $ligne->devis . " devis";
        }

        return $lignes;
    }

    protected function dateToString($date){
        $result = explode("T",$date);
        $result =$result[0];
        return $result;
    }

    protected function showEtat($etat){
        $name = "";

        if($etat == "0" || $etat == 0) $name =  "En cours de validation chez le Chef de Service";
        if($etat == "1" || $etat == 1) $name =  "En cours de validation chez ALSG";
        if($etat == "2" || $etat == 2) $name =  "En cours de validation chez l'Acheteur";
        if($etat == "3" || $etat == 3) $name =  "En cours de validation chez le Responsable Administratif et Financier";
        if($etat == "4" || $etat == 4) $name =  "En cours de validation chez le Contrôlleur de Gestion";
        if($etat == "5" || $etat == 5) $name =   "En cours de validation chez le Directeur de Programme";
        if($etat == "6" || $etat == 6) $name =  "Navette Validé";
        if($etat == "7" || $etat == 7) $name =  "Navette Refusée";
        if($etat == "8" || $etat == 8) $name =  "Pris dans le magasin";

        return $name;
    }
    protected function getNameFournisseurs($id_fournisseur){
        $name = "";
        foreach(Fournisseur::all() as $frs){
            if($frs->id == $id_fournisseur){
                $name = $frs->name;
            }
        }
        return $name;
    }

    protected function spaceNumber($nombre){
        $stringNombre = $nombre."";
        $count = strlen($stringNombre);
        $resultat = "";
        $j = 1;

        for ($i = $count - 1; $i >= 0; $i--) {
            if ($j % 3 == 0) {
                $resultat = " " . $stringNombre[$i] . $resultat;
                $j = 0;
            }
            else {
                $resultat = $stringNombre[$i] . $resultat;
            }

            $j++;
        }

        return $resultat . " Ar";
    }


}
