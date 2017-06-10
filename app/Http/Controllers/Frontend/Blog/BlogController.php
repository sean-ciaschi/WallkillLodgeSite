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
     * Index
     *
     * @return mixed
     */
    public function index()
    {
        return view('frontend.blog.index')->with('posts', $this->getPosts());
    }

    /**
     * Get Posts
     *
     * @return mixed
     */
    public function getPosts()
    {
        $posts = BlogPost::get();

        return $posts;
    }

    /**
     * Download Attachment
     *
     * @param Request $request
     * @param $fileName
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadAttachment(Request $request, $fileName)
    {
        return response()->download(Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix()."uploads/".$fileName, 'attachment.'.File::extension($fileName));
    }

    /**
     * Delete Post
     *
     * @param Request $request
     * @param $id
     * @return bool
     */
    public function deletePost(Request $request, $id)
    {
        $post = BlogPost::find($id);

        if(isset($post) && !empty($post))
        {
           $post->delete();
           return redirect(route('frontend.trestle-board.index'));
        }

        return redirect(route('frontend.trestle-board.index'));
    }
}