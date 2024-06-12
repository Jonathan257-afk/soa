<?php

namespace App\Exports;

use App\Models\Registre;use App\Models\Navette;
use App\Models\Ligne;
use App\Models\Fonction;
use App\Models\Valideur;use Maatwebsite\Excel\Concerns\FromCollection;

class RegistreExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Registre::join(Navette::getTableName(), Navette::getTableName().".id", Registre::getTableName().".id_navette")->join(Fonction::getTableName(), Fonction::getTableName().".id", Registre::getTableName().".id_fonction")->selectRaw(Registre::getTableName().".created_at,".Navette::getTableName().".reference,".Fonction::getTableName().".name")->orderBy(Registre::getTableName().".created_at", "DESC")->get();
    }
}
