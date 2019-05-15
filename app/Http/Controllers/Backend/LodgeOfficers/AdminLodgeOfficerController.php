<?php

namespace App\Http\Controllers\Backend\LodgeOfficers;

use App\Repositories\Backend\Blog\EloquentBlogRepository;
use App\Repositories\Backend\Blog\EloquentLodgeOfficerRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Models\Blog\BlogPost\LodgeOfficer;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AdminLodgeOfficerController extends Controller
{
    /**
     * @var EloquentLodgeOfficerRepository
     */
    private $repository;

    /**
     * AdminBlogController constructor.
     */
    public function __construct()
    {
        $this->repository = new EloquentLodgeOfficerRepository();
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('backend.lodge-officers.lodge-officers')->with([
            'officers' => LodgeOfficer::all(),
        ]);
    }

    public function create()
    {
        return view('backend.blog.create-officer')->with([
            'pageType'      => 'create'
        ]);
    }

    public function update($id, Request $request)
    {
        $blogPost = LodgeOfficer::find($id);

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
        return redirect()->route('admin.officers')->withFlashSuccess('Officer has been successfully deleted');
    }

    /**
     * Create Post.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createOfficer(Request $request)
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
    public function updateOfficer($id, Request $request)
    {
        $this->repository->updatePost($request);
        return redirect()->route('blog.edit-post')->withFlashSuccess('Order has been successfully updated');
    }
}
