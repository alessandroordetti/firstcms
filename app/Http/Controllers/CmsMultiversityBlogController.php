<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\CmsMultiversityBlogPost;
use App\Models\CmsMultiversityBlogCategoria;


class CmsMultiversityBlogController extends Controller
{
    public function index()
    {
        $blogs = CmsMultiversityBlogPost::all();
        return view('pages.blog-index', ['blogs' => $blogs]);
    }

    public function create()
    {
        $categories = CmsMultiversityBlogCategoria::all();
        return view('pages.blog-create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validation = Validator::make($request->all(), [
            'titolo' => 'required|string',
            'slug' => 'required|string',
            'contenuto' => 'required|string',
            'category_id' => 'required',
            'stato' => 'required|numeric'
        ]);

        if($validation->fails()){
            return redirect()->route('blog-create')->with('errorMessage', 'Controlla i dati per favore');
        }

        $blog = new CmsMultiversityBlogPost;
        $blog->titolo = $data['titolo'];
        $blog->slug = $data['slug'];
        $blog->category_id = $data['category_id'];
        $blog->contenuto = $data['contenuto'];
        $blog->stato = $data['stato'];



        if(CmsMultiversityBlogPost::where('titolo', '=', $data['titolo'])->where('slug', '=', $data['slug'])->exists()){
            return redirect()->route('blog-create')->with('queryError', 'Il blog è già presente nel DB. Riprovare');
        } 

        $blog->save();

        return redirect()->route('blog-edit', ['id' => $blog->id])->with('success', 'Blog registrato correttamente');

    }

    public function edit(Request $request, $id)
    {
        $blog = CmsMultiversityBlogPost::find($id);
        $categories = CmsMultiversityBlogCategoria::all();                       
        return view('pages.blog-edit', ['blog' => $blog, 'categories' => $categories]);
    }

    public function update(Request $request, $id)
    {
        $blog = CmsMultiversityBlogPost::find($id);
        $data = $request->all();

        $validation = Validator::make($request->all(), [
            'titolo' => 'required|string',
            'slug' => 'required|string',
            'contenuto' => 'required|string',
            'category_id' => 'required',
            'stato' => 'required|numeric'
        ]);

        if($validation->fails()){
            return redirect()->route('blog-edit', ['id' => $blog->id])->with('response', 'Controlla i dati inseriti');
        }

        $blog->titolo = $data['titolo'];
        $blog->slug = $data['slug'];
        $blog->contenuto = $data['contenuto'];
        $blog->category_id = $data['category_id'];
        $blog->stato = $data['stato'];
        $blog->save();

        return redirect()->route('blog-edit', ['id' => $blog->id])->with('success', 'Blog modificato correttamente');
    }

    public function delete(CmsMultiversityBlogPost $blog, $id)
    {
        $deletedBlog = CmsMultiversityBlogPost::find($id);
        $deletedBlog->deleted = 1;
        $deletedBlog->save();

        return redirect()->route('blog-index')->with('deleteMessage', 'Blog rimossa correttamente');


    }
}
