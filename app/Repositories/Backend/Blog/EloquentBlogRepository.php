<?php namespace App\Repositories\Backend\Blog;


use App\Http\Requests\Request;
use App\Models\Blog\BlogPost\LodgeOfficer;
use App\Models\System\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class EloquentBlogRepository
{
    /**
     * Destroy Blog Post
     *
     * @param $id
     * @return bool
     */
    public function destroy($id = null)
    {
        $model = LodgeOfficer::where('id', $id)->first();

        try
        {
            $model->delete();
        }
        catch (\Exception $e)
        {
            dd("balls" . $e);
        }

        return true;
    }

    /**
     * Create Post.
     *
     * @param $request
     * @return LodgeOfficer|\Illuminate\Database\Eloquent\Model
     */
    public function createPost($request)
    {
//        $this->validate($request, [
//            'title' => 'required|max:255',
//            'body' => 'required',
//        ]);

        $userId = auth()->user()->id;

        if (Input::hasFile('attachment'))
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
                'date'              => Carbon::parse($request->meetingDate),
            ];
        }

        $blogPost = LodgeOfficer::create($rowData);

//        Session::flash('flash_message', 'Post successfully added.'); //<--FLASH MESSAGE

        return $blogPost;
    }

    /**
     * Update Post.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updatePost($id, Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'body' => 'required',
        ]);

        $userId = auth()->user()->id;

        if (Input::hasFile('attachment')) {
            $fileName = Input::file('attachment')->hashName();
            Storage::disk('local')->put('uploads', Input::file('attachment'), 'public');

            $rowData = [
                'user_id'           => $userId,
                'title'             => $request->title,
                'content'           => $request->body,
                'attachment_path'   => $fileName,
                'date'              => Carbon::parse($request->meetingDate),
            ];
        } else {
            $rowData = [
                'user_id'           => $userId,
                'title'             => $request->title,
                'content'           => $request->body,
                'attachment_path'   => null,
                'date'              => Carbon::parse($request->meetingDate),
            ];
        }

        LodgeOfficer::find($id)->update($rowData);

        Session::flash('flash_message', 'Post successfully updated.'); //<--FLASH MESSAGE

        return redirect()->route('admin.blog.edit-post', ['id' => $id]);
    }
}