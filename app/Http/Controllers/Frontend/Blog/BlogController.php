<?php

namespace App\Http\Controllers\Frontend\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Blog\BlogPost\LodgeOfficer as BlogPost;

class BlogController extends Controller
{
    /**
     * Index.
     *
     * @return mixed
     */
    public function index()
    {
        return view('frontend.blog.index')->with('posts', $this->getPosts());
    }

    /**
     * Get Posts.
     *
     * @return mixed
     */
    public function getPosts()
    {
        $posts = LodgeOfficer::orderBy('created_at', 'desc')->get();

        return $posts;
    }

    /**
     * Download Attachment.
     *
     * @param Request $request
     * @param $fileName
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadAttachment(Request $request, $fileName)
    {
        return response()->download(Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix().'uploads/'.$fileName, 'attachment.'.File::extension($fileName));
    }

    /**
     * Delete Post.
     *
     * @param Request $request
     * @param $id
     * @return bool
     * @throws \Exception
     */
    public function deletePost(Request $request, $id)
    {
        $post = LodgeOfficer::find($id);

        if (isset($post) && ! empty($post)) {
            $post->delete();

            return redirect(route('frontend.trestle-board.index'));
        }

        return redirect(route('frontend.trestle-board.index'));
    }
}
