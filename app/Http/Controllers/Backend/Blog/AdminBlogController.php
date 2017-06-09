<?php namespace App\Http\Controllers\Backend\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog\BlogPost\BlogPost as BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AdminBlogController extends Controller
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

    /**
     * Create Post
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createPost(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'body' => 'required'
        ]);

        $userId     = auth()->user()->id;

        if(Input::hasFile('attachment'))
        {
            $fileName = Input::file('attachment')->hashName();
            Storage::disk('local')->put('uploads', Input::file('attachment'), 'public');

            $rowData = [
                'user_id'           => $userId,
                'title'             => $request->title,
                'content'           => $request->body,
                'attachment_path'   => $fileName
            ];
        }
        else
        {
            $rowData = [
                'user_id'           => $userId,
                'title'             => $request->title,
                'content'           => $request->body,
                'attachment_path'   => null
            ];
        }

        BlogPost::create($rowData);

        Session::flash('flash_message','Post successfully added.'); //<--FLASH MESSAGE

        return redirect(route('admin.blog.create'));
    }
}