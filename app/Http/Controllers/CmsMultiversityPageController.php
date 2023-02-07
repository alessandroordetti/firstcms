<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\CmsMultiversityPage;


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
            'titolo' => 'required|min:8',
            'categoria' => 'required',  
            'slug' => 'required',
            'seo_title' => 'required|min:8',
            'seo_description' => 'required|min:8',
            'contenuto' => 'required',
            'stato' => 'required' 
        ]);

        if($validation->fails()){
            return redirect()->route('pagina-index')->with('errorMessage', 'Controlla i dati per favore');
        }

        $data = $request->all();
        $newPage = new CmsMultiversityPage;
        $newPage->ateneo = $data['ateneo'];
        $newPage->titolo = $data['titolo'];
        $newPage->template = 'prova';
        $newPage->categoria = 1;
        $newPage->seo_title = $data['seo_title'];
        $newPage->seo_description = $data['seo_description'];
        $newPage->contenuto = $data['contenuto'];
        $newPage->stato = $data['stato'];
        $newPage->save();

        $allPages = CmsMultiversityPage::all();
        
        return redirect()->route('pagina-edit', ['id' => $newPage->id])->with(['success' => 'Pagina registrata correttamente', 'newPage' => $newPage]);
    }

    public function show($id)
    {
        $page = CmsMultiversityPage::findOrFail($id);
        return redirect()->route('page-show', ['id' => $page->id]);
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
            'titolo' => 'required|min:8',
            'categoria' => 'required',  
            'slug' => 'required',
            'seo_title' => 'required|min:8',
            'seo_description' => 'required|min:8',
            'contenuto' => 'required',
            'stato' => 'required' 
        ]);

        $page->ateneo = $data['ateneo'];
        $page->titolo = $data['titolo'];
        $page->categoria = $data['categoria'];
        /* $page->slug = $data['slug']; */
        $page->seo_title = $data['seo_title'];
        $page->seo_description = $data['seo_description'];
        $page->stato = $data['stato'];
        $page->contenuto = $data['contenuto'];
        $page->save();

        return redirect()->route('pagina-edit', ['id' => $page->id])->with('response', 'Pagina modificata correttamente');
    }

    public function delete(CmsMultiversityPage $page, $id)
    {
        $deletedPage = CmsMultiversityPage::find($id);
        $deletedPage->deleted_at = 1;
        $deletedPage->save();

        return redirect()->route('pagina-index')->with('deleteMessage', 'Pagina rimosso correttamente');
    }
}
