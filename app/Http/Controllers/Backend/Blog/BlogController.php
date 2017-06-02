<?php namespace App\Http\Controllers\Backend\Blog;

use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.blog');
    }

    public function create()
    {
        return view('backend.blog.create-post');
    }
}