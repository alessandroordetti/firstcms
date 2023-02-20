<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\CmsMultiversitySede;
use App\Models\CmsRegione;
use App\Models\CmsProvincia;
use App\Models\CmsComune;

class CmsMultiversitySedeController extends Controller
{
    public function index()
    {
        $sedi = CmsMultiversitySede::all();
        return view('pages.sede-index', ['sedi' => $sedi]);
    }

    public function create()
    {
        $regioni = CmsRegione::all();
        $province = CmsProvincia::all();
        $comuni = CmsComune::all(); 
        return view('pages.sede-create', ['regioni' => $regioni, 'province' => $province, 'comuni' => $comuni]);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validation = Validator::make($request->all(), [
            'ateneo' => 'required|string',
            'titolo' => 'required|string',
            'slug' => 'required|string',
            'regione' => 'required|string',
            'provincia' => 'required|string',
            'comune' => 'required|string',
            'indirizzo' => 'required|string',
            'referenti' => 'required|string',
            'telefono' => 'required|string',
            'email' => 'required|string',
            'lat' => 'required',
            'lng' => 'required',
            'stato' => 'required|numeric',
            'deleted' => 'nullable|numeric'
        ]);


        if($validation->fails()){
            return redirect()->route('sede-create')->with('errorMessage', 'Controlla i dati per favore');
        } 


        $sede = new CmsMultiversitySede;
        $sede->ateneo = $data['ateneo'];
        $sede->titolo = $data['titolo'];
        $sede->slug = $data['slug'];
        $sede->regione = $data['regione'];
        $sede->provincia = $data['provincia'];
        $sede->citta = $data['comune'];
        $sede->indirizzo = $data['indirizzo'];
        $sede->referenti = $data['referenti'];
        $sede->telefono = $data['telefono'];
        $sede->stato = $data['stato'];
        $sede->email = $data['email'];
        $sede->lat = $data['lat'];
        $sede->lng = $data['lng'];


        if(CmsMultiversitySede::where('ateneo', '=', $data['ateneo'])->where('slug', '=', $data['slug'])->exists()){
            return redirect()->route('sede-create')->with('queryError', 'La sede è già presente nel DB. Riprovare');
        } 

        $sede->save();

        return redirect()->route('sede-edit', ['id' => $sede->id])->with('success', 'Sede registrata correttamente');
    }

    public function edit(CmsMultiversitySede $sede, $id)
    {

        $sede = CmsMultiversitySede::find($id);
        $regioni = CmsRegione::all();
        $province = CmsProvincia::all();
        $comuni = CmsComune::all(); 
        $selectedRegione = CmsRegione::where('nome', '=', $sede->regione)->first();
        $selectedProvincia = CmsProvincia::where('nome', '=', $sede->provincia)->first();
        $selectedComune = CmsComune::where('nome', '=', $sede->citta)->first(); 
        return view('pages.sede-edit', ['sede' => $sede,'selectedRegione' => $selectedRegione, 'selectedProvincia' => $selectedProvincia, 'selectedComune' => $selectedComune,'regioni' => $regioni, 'province' => $province, 'comuni' => $comuni]);
    }

    public function update(Request $request, $id)
    {

        $sede = CmsMultiversitySede::find($id);
        $data = $request->all();
    
        $validation = Validator::make($request->all(), [
            'ateneo' => 'required|string',
            'titolo' => 'required|string',
            'slug' => 'required|string',
            'regione' => 'required|string',
            'provincia' => 'required|string',
            'citta' => 'required|string',
            'indirizzo' => 'required|string',
            'referenti' => 'required|string',
            'telefono' => 'required|numeric',
            'email' => 'required|string',
            'stato' => 'required|numeric',
            'lat' => 'required',
            'lng' => 'required',
            'deleted' => 'nullable|numeric'
        ]);


        if($validation->fails()){
            return redirect()->route('sede-edit', ['id' => $sede->id])->with('errorMessage', 'Controlla i dati per favore');
        }

        $sede->ateneo = $data['ateneo'];
        $sede->titolo = $data['titolo'];
        $sede->slug = $data['slug'];
        $sede->regione = $data['regione'];
        $sede->provincia = $data['provincia'];
        $sede->citta = $data['citta'];
        $sede->indirizzo = $data['indirizzo'];
        $sede->referenti = $data['referenti'];
        $sede->telefono = $data['telefono'];
        $sede->stato = $data['stato'];
        $sede->email = $data['email'];
        $sede->lat = $data['lat'];
        $sede->lng = $data['lng'];

/*         if(CmsMultiversitySede::where('ateneo', '=', $data['ateneo'])->where('slug', '=', $data['slug'])->exists()){
            return redirect()->route('sede-edit', ['id' => $sede->id])->with('queryError', 'La sede è già presente nel DB. Riprovare');
        }  */

        $sede->save();

        return redirect()->route('sede-edit', ['id' => $sede->id])->with('success', 'Sede modificata correttamente');
    }

    public function delete(CmsMultiversitySede $sede, $id)
    {
        $sede =  CmsMultiversitySede::find($id);
        $sede->deleted = 1;
        $sede->save();

        return redirect()->route('sede-index')->with('deleteMessage', 'Sede rimosso correttamente');
    }
}
