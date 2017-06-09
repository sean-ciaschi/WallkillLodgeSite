<?php namespace App\Http\Controllers\Frontend\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog\BlogPost\BlogPost as BlogPost;
use function GuzzleHttp\Psr7\mimetype_from_filename;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.blog.index')->with('posts', $this->getPosts());
    }

    /**
     * Create Post
     *
     */
    public function getPosts()
    {
        $posts = BlogPost::get();

        return $posts;
    }

    public function downloadAttachment(Request $request, $fileName)
    {
        return response()->download(Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix()."uploads/".$fileName, 'attachment.'.File::extension($fileName));
    }
}