<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CmsMultiversityBlogPost;


class CmsMultiversityBlogPostController extends Controller
{
    public function index()
    {
        $posts = CmsMultiversityBlogPost::all();
        return view('pages.blogs', ['posts' => $posts]);
    }
}
