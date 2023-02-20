<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\CmsMultiversitySede;
use App\Models\CmsRegione;
use App\Models\CmsProvincia;
use App\Models\CmsComune;

class LocationController extends Controller
{
    public function getLocations(Request $request)
    {
        // validazione
        
        $regione = CmsRegione::where('nome', $request->regione)->first();
        
        // verifica se esiste regione

        $province = CmsProvincia::where('id_regione', $regione->id)->get();
        return $province;
    }

    public function getComuni(Request $request)
    {
        $regione = CmsRegione::where('nome', $request->regione)->first();
        $provincia = CmsProvincia::where('nome', $request->provincia)->first();

        $comuni = CmsComune::where('id_provincia', $provincia->id)->get();

        return $comuni;

        
    }
    
}
