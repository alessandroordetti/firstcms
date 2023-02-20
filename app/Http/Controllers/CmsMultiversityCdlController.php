<?php

namespace App\Http\Controllers;

use App\Models\CmsMultiversityCdl;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class CmsMultiversityCdlController extends Controller
{
    public function index()
    {
        $corsi = CmsMultiversityCdl::all();
        return view('pages.cdl-index', ['corsi' => $corsi]);
    }

    public function create()
    {
        return view('pages.cdl-create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
       
        $validation = Validator::make($request->all(), [
            'ateneo' => 'required',
            'titolo' => 'string|required|min:5',
            'slug' => 'string|required',
            'codice' => 'required',
            'classe' => 'required',
            'tipologia' => 'required',
            'durata' => 'required',
            'prezzo' => 'required',
            'descrizione' => 'required',
            'obiettivi' => 'required',
            'sbocchi' => 'required',
            'conoscenze' => 'required',
            'tirocinio' => 'int|in:0,1|required',
            'stage' => 'int|in:0,1|required',
            'seo_title' => 'required|min:8',
            'seo_description' => 'required|min:8',
            'stato' => 'int|in:0,1|required' 
        ]);


        if($validation->fails()){
            return redirect()->route('cdl-create')->with('errorMessage', 'Controlla i dati per favore');
        } 


        $newCdl = new CmsMultiversityCdl;
        $newCdl->ateneo = $data['ateneo'];
        $newCdl->titolo = $data['titolo'];
        $newCdl->slug = $data['slug'];
        $newCdl->codice = $data['codice'];
        $newCdl->classe = $data['classe'];
        $newCdl->tipologia = $data['tipologia'];
        $newCdl->durata = $data['durata'];
        $newCdl->prezzo = $data['prezzo'];
        $newCdl->descrizione = $data['descrizione'];
        $newCdl->obiettivi = $data['obiettivi'];
        $newCdl->sbocchi = $data['sbocchi'];
        $newCdl->conoscenze = $data['conoscenze'];
        $newCdl->tirocinio = $data['tirocinio'];
        $newCdl->stage = $data['stage'];
        $newCdl->seo_title = $data['seo_title'];
        $newCdl->seo_description = $data['seo_description'];
        $newCdl->stato = $data['stato'];
        $newCdl->deleted = 0;

        if(CmsMultiversityCdl::where('ateneo', '=', $data['ateneo'])->where('slug', '=', $data['slug'])->exists()){
            return redirect()->route('cdl-create')->with('queryError', 'Il corso è già presente nel DB. Riprovare');
        } 

        $newCdl->save();

        return redirect()->route('cdl-edit', ['id' => $newCdl->id])->with('success', 'Corso registrato correttamente');
    }

    public function edit(CmsMultiversityCdl $cdl, $id)
    {
        $cdl = CmsMultiversityCdl::find($id);
        return view('pages.cdl-edit', ['cdl' => $cdl]);
    }

    public function update(Request $request, $id)
    {
        $cdl = CmsMultiversityCdl::find($id);
        $data = $request->all();
    
        $validation = Validator::make($request->all(), [
            'ateneo' => 'required',
            'titolo' => 'required|min:5',
            'slug' => 'required',
            'codice' => 'required',
            'classe' => 'required',
            'tipologia' => 'required',
            'durata' => 'required',
            'prezzo' => 'required',
            'descrizione' => 'required',
            'obiettivi' => 'required',
            'sbocchi' => 'required',
            'conoscenze' => 'required',
            'tirocinio' => 'int|in:0,1|required',
            'stage' => 'int|in:0,1|required',
            'seo_title' => 'required|min:8',
            'seo_description' => 'required|min:8',
            'stato' => 'int|in:0,1|required'
        ]);


        if($validation->fails()){
            return redirect()->route('cdl-edit', ['id' => $cdl->id])->with('errorMessage', 'Controlla i dati per favore');
        }

        $cdl->ateneo = $data['ateneo'];
        $cdl->titolo = $data['titolo'];
        $cdl->slug = $data['slug'];
        $cdl->codice = $data['codice'];
        $cdl->classe = $data['classe'];
        $cdl->tipologia = $data['tipologia'];
        $cdl->durata = $data['durata'];
        $cdl->prezzo = $data['prezzo'];
        $cdl->descrizione = $data['descrizione'];
        $cdl->obiettivi = $data['obiettivi'];
        $cdl->sbocchi = $data['sbocchi'];
        $cdl->conoscenze = $data['conoscenze'];
        $cdl->tirocinio = $data['tirocinio'];
        $cdl->stage = $data['stage'];
        $cdl->seo_title = $data['seo_title'];
        $cdl->seo_description = $data['seo_description'];
        $cdl->stato = $data['stato'];

        $cdl->save();

        return redirect()->route('cdl-edit', ['id' => $cdl->id])->with('successMessage', 'Corso modificato correttamente');
    }

    public function delete(CmsMultiversityCdl $cdl, $id)
    {
        $deltedCdl =  CmsMultiversityCdl::find($id);
        $deltedCdl->deleted_at = 1;
        $deltedCdl->save();

        return redirect()->route('cdl-index')->with('deleteMessage', 'Corso rimosso correttamente');
    }
}
