<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\CmsMultiversityBlog;


class CmsMultiversityBlogController extends Controller
{
    public function index()
    {
        $blogs = CmsMultiversityBlog::all();
        return view('pages.blog-index', ['blogs' => $blogs]);
    }

    public function create()
    {
        return view('pages.blog-create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validation = Validator::make($request->all(), [
            'nome' => 'required|string',
            'slug' => 'required|string'
        ]);

        if($validation->fails()){
            return redirect()->route('blog-create')->with('errorMessage', 'Controlla i dati per favore');
        }

        $blog = new CmsMultiversityBlog;
        $blog->nome = $data['nome'];
        $blog->slug = $data['slug'];

        if(CmsMultiversityBlog::where('nome', '=', $data['nome'])->where('slug', '=', $data['slug'])->exists()){
            return redirect()->route('blog-create')->with('queryError', 'Il blog è già presente nel DB. Riprovare');
        } 

        $blog->save();

        return redirect()->route('blog-edit', ['id' => $blog->id])->with('success', 'Blog registrato correttamente');

    }

    public function edit(Request $request, $id)
    {
        $blog = CmsMultiversityBlog::find($id);
        return view('pages.blog-edit', ['blog' => $blog]);
    }

    public function update(Request $request, $id)
    {
        $blog = CmsMultiversityBlog::find($id);
        $data = $request->all();

        $validation = Validator::make($request->all(), [
            'nome' => 'required|string',
            'slug' => 'required|string'
        ]);

        if($validation->fails()){
            return redirect()->route('blog-edit', ['id' => $blog->id])->with('response', 'Controlla i dati inseriti');
        }

        $blog->nome = $data['nome'];
        $blog->slug = $data['slug'];
        $blog->save();

        return redirect()->route('blog-edit', ['id' => $blog->id])->with('response', 'Blog modificato correttamente');
    }

    public function delete(CmsMultiversityBlog $blog, $id)
    {
        $deletedBlog = CmsMultiversityBlog::find($id);
        $deletedBlog->deleted = 1;
        $deletedBlog->save();

        return redirect()->route('blog-index')->with('deleteMessage', 'Blog rimossa correttamente');


    }
}
