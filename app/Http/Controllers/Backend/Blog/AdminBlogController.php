<?php namespace App\Http\Controllers\Backend\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog\BlogPost\BlogPost;
use Carbon\Carbon;
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
        return view('backend.blog.blog-posts')->with([
            'posts' => BlogPost::all()
        ]);
    }

    public function create()
    {
        $baseDate = Carbon::now();
        $firstWednesday = Carbon::parse('first wednesday of this month');
        $thirdWednesday = Carbon::parse('third wednesday of this month');

        $result = null;

        if($baseDate->diffInDays($firstWednesday) < $baseDate->diffInDays($thirdWednesday))
        {
            $result = $firstWednesday;
        }
        else
        {
            $result = $thirdWednesday;
        }

        return view('backend.blog.create-post')->with([
            'pageType'      => 'create',
            'meetingDate'   => Carbon::parse($result)->format('m/d/y')
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
            'meetingDate'   => Carbon::parse($blogPost->date)->format('m/d/y')
        ]);
    }

    public function delete($id, Request $request)
    {
        $blogPost = BlogPost::find($id);

        return view('backend.blog.create-post')->with([
            'pageType'      => 'edit',
            'postId'        => $blogPost->id,
            'title'         => $blogPost->title,
            'content'       => $blogPost->content,
            'meetingDate'   => Carbon::parse($blogPost->date)->format('m/d/y')
        ]);
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

        $userId = auth()->user()->id;

        if(Input::hasFile('attachment'))
        {
            $fileName = Input::file('attachment')->hashName();
            Storage::disk('local')->put('uploads', Input::file('attachment'), 'public');

            $rowData = [
                'user_id'           => $userId,
                'title'             => $request->title,
                'content'           => $request->body,
                'attachment_path'   => $fileName,
                'date'              => Carbon::parse($request->meetingDate),
            ];
        }
        else
        {
            $rowData = [
                'user_id'           => $userId,
                'title'             => $request->title,
                'content'           => $request->body,
                'attachment_path'   => null,
                'date'              => Carbon::parse($request->meetingDate)
            ];
        }

        BlogPost::create($rowData);

        Session::flash('flash_message','Post successfully added.'); //<--FLASH MESSAGE

        return redirect(route('admin.blog.create'));
    }

    /**
     * Update Post
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updatePost($id, Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'body' => 'required'
        ]);

        $userId = auth()->user()->id;

        if(Input::hasFile('attachment'))
        {
            $fileName = Input::file('attachment')->hashName();
            Storage::disk('local')->put('uploads', Input::file('attachment'), 'public');

            $rowData = [
                'user_id'           => $userId,
                'title'             => $request->title,
                'content'           => $request->body,
                'attachment_path'   => $fileName,
                'date'              => Carbon::parse($request->meetingDate),
            ];
        }
        else
        {
            $rowData = [
                'user_id'           => $userId,
                'title'             => $request->title,
                'content'           => $request->body,
                'attachment_path'   => null,
                'date'              => Carbon::parse($request->meetingDate)
            ];
        }

        BlogPost::find($id)->update($rowData);

        Session::flash('flash_message','Post successfully updated.'); //<--FLASH MESSAGE

        return redirect()->route('admin.blog.edit-post', ['id' => $id]);
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
            return redirect()->route('admin.blog');
        }

        return redirect()->route('admin.blog');
    }
}