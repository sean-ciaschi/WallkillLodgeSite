<?php

namespace App\Http\Controllers\Backend\Blog;

use App\Repositories\Backend\Blog\EloquentBlogRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Models\Blog\BlogPost\BlogPost;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AdminBlogController extends Controller
{

    public function __construct()
    {
        $this->repository = new EloquentBlogRepository();
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.blog.blog-posts')->with([
            'posts' => BlogPost::all(),
        ]);
    }

    public function create()
    {
        $baseDate       = Carbon::now();
        $firstWednesday = Carbon::parse('first wednesday of this month');
        $thirdWednesday = Carbon::parse('third wednesday of this month');

        $result = null;

        if ($baseDate->diffInDays($firstWednesday) < $baseDate->diffInDays($thirdWednesday)) {
            $result = $firstWednesday;
        } else {
            $result = $thirdWednesday;
        }

        return view('backend.blog.create-post')->with([
            'pageType'      => 'create',
            'meetingDate'   => Carbon::parse($result)->format('m/d/y'),
        ]);
    }

    public function update($id, Request $request)
    {
        $blogPost = BlogPost::find($id);

        return view('backend.blog.create-post')->with([
            'pageType'      => 'edit',
            'postId'        => $blogPost->id,
            'title'         => $blogPost->title,
            'content'       => $blogPost->content,
            'meetingDate'   => Carbon::parse($blogPost->date)->format('m/d/y'),
        ]);
    }

    /**
     * Delete Order
     *
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        $this->repository->destroy($id);
        return redirect()->route('admin.blog')->withFlashSuccess('Post has been successfully deleted');
    }

    /**
     * Create Post.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createPost(Request $request)
    {
        $item = $this->repository->createPost($request);
        return redirect()->route('admin.blog.edit-post', ['id' => $item->id])->withFlashSuccess('Order has been successfully created');
    }

    /**
     * Update Post.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updatePost($id, Request $request)
    {
        $this->repository->updatePost($request);
        return redirect()->route('blog.edit-post')->withFlashSuccess('Order has been successfully updated');
    }
}
