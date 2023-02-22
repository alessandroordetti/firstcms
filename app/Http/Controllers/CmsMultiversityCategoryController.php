<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\CmsMultiversityCategory;

class CmsMultiversityCategoryController extends Controller
{
    public function index(){
        $categories = CmsMultiversityCategory::all();
        return view('pages.categoria-index', ['categories' => $categories]);
    }

    public function create()
    {
        return view('pages.categoria-create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string',
            'slug' => 'required|string'
        ]);

        if($validator->fails()){
            return redirect()->route('categoria-create')->with('errorMessage', 'Controllare i dati inseriti');
        }

        $category = new CmsMultiversityCategory;
        $category->nome = $data['nome'];
        $category->slug = $data['slug'];
        $category->deleted = 0;

        if(CmsMultiversityCategory::where('nome', '=', $data['nome'])->where('slug', '=', $data['slug'])->exists()){
            return redirect()->route('categoria-create')->with('queryError', 'La categoria è già presente nel DB. Riprovare');
        } 

        $category->save();

        return redirect()->route('categoria-edit', ['id' => $category->id])->with('success', 'Categoria registrata correttamente');
    }

    public function edit(CmsMultiversityCategory $category, $id)
    {
        $category = CmsMultiversityCategory::find($id);
        return view('pages.categoria-edit', ['category' => $category]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $category = CmsMultiversityCategory::find($id);

        
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string',
            'slug' => 'required|string'
        ]);

        if($validator->fails()){
            return redirect()->route('categoria-create')->with('errorMessage', 'Controllare i dati inseriti');
        }

        $category->nome = $data['nome'];
        $category->slug = $data['slug'];
        $category->save();

        return redirect()->route('categoria-edit', ['id' => $category->id])->with('success', 'Categoria registrata correttamente');
    }

    public function delete(CmsMultiversityCategory $category, $id)
    {
        $category = CmsMultiversityCategory::find($id);
        $category->deleted = 1;
        $category->save();

        return redirect()->route('categoria-index')->with('deleteMessage', 'Categoria rimosso correttamente');
    }
}
