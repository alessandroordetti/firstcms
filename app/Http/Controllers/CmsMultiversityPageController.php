<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\CmsMultiversityPage;
use Illuminate\Support\Facades\DB;


class CmsMultiversityPageController extends Controller
{
    public function index()
    {   
        $pages = CmsMultiversityPage::all();
        return view('pages.pagina-index', ['pages' => $pages]);
    }

    public function create()
    {

        return view('pages.pagina-create');
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'ateneo' => 'required',
            'titolo' => 'required|string',
            'slug' => 'required',
            'template' => 'required',
            'seo_title' => 'required|string',
            'categoria' => 'required|numeric',
            'seo_description' => 'required|string',
            'contenuto' => 'required',
            'stato' => 'required' 
        ]);

        if($validation->fails()){
            return redirect()->route('pagina-create')->with('errorMessage', 'Controlla i dati per favore');
        } 

        $data = $request->all();

        $newPage = new CmsMultiversityPage;
        $newPage->ateneo = $data['ateneo'];
        $newPage->titolo = $data['titolo'];
        $newPage->template = $data['template'];
        $newPage->slug = $data['slug'];
        $newPage->seo_title = $data['seo_title'];
        $newPage->seo_description = $data['seo_description'];
        $newPage->contenuto = $data['contenuto'];
        $newPage->stato = $data['stato'];
        $newPage->deleted = 0;

        /* CHECK PER VEDERE SE NEL DB E' GIÀ PRESENTE UN RECORD CON LO STESSO SLUG ED ATENEO CONTEMPORANEAMENTE */
        if(CmsMultiversityPage::where('slug', '=', $data['slug'])->where('ateneo', '=', $data['ateneo'])->exists()){
            return redirect()->route('pagina-create')->with('queryTitleError', 'La pagina è già presente nel DB. Riprovare con un nuovo nome');
        }

        $newPage->save();
        
        return redirect()->route('pagina-edit', ['id' => $newPage->id])->with(['success' => 'Pagina registrata correttamente', 'newPage' => $newPage]);
    }

    public function edit($id, CmsMultiversityPage $page)
    {
        $page = CmsMultiversityPage::find($id);
        return view('pages.pagina-edit', ['page' => $page]);
    }

    public function update(Request $request, $id)
    {
        $page = CmsMultiversityPage::find($id);
        $data = $request->all();

        $validation = Validator::make($request->all(), [
            'ateneo' => 'required',
            'titolo' => 'required|string',
            'slug' => 'required',
            'categoria' => 'required|numeric',
            'seo_title' => 'required|string',
            'seo_description' => 'required|string',
            'contenuto' => 'required',
            'stato' => 'required' 
        ]);

        if($validation->fails()){
            return redirect()->route('pagina-edit', ['id' => $page->id])->with('response', 'Per favore, controlla i dati inseriti');
        }

        $page->ateneo = $data['ateneo'];
        $page->titolo = $data['titolo'];
        $page->categoria = $data['categoria'];
        $page->slug = $data['slug'];
        $page->seo_title = $data['seo_title'];
        $page->seo_description = $data['seo_description'];
        $page->contenuto = $data['contenuto'];
        $page->stato = $data['stato'];
        $page->deleted = 0;

        $page->save();

        return redirect()->route('pagina-updatefix', ['id' => $page->id])->with('response', 'Pagina modificata correttamente');
    }

    public function delete(CmsMultiversityPage $page, $id)
    {
        $deletedPage = CmsMultiversityPage::find($id);
        $deletedPage->deleted = 1;
        $deletedPage->save();

        return redirect()->route('pagina-index')->with('deleteMessage', 'Pagina rimossa correttamente');
    }
}
