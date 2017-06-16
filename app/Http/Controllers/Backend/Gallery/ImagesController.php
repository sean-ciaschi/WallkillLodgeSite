<?php namespace App\Http\Controllers\Backend\Gallery;

use App\Http\Controllers\Controller;
use App\Models\Blog\BlogPost\BlogPost as BlogPost;
use App\Models\Gallery\Album\Album;
use App\Models\Gallery\Images\Images;
use function GuzzleHttp\Psr7\mimetype_from_filename;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Validator;

class ImagesController extends Controller
{
    /**
     * Get Form
     *
     * @param $id
     * @return mixed
     */
    public function getForm($id)
    {
        $album = Album::find($id);
        return View::make('addimage')->with('album',$album);
    }

    /**
     * Add Post
     *
     * @return mixed
     */
    public function postAdd()
    {
        $rules = array(

            'album_id' => 'required|numeric|exists:albums,id',
            'image'=>'required|image'

        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails())
        {

            return Redirect::route('add_image',array('id' =>Input::get('album_id')))
                ->withErrors($validator)
                ->withInput();
        }

        $file               = Input::file('image');
        $random_name        = str_random(8);
        $destinationPath    = 'albums/';
        $extension          = $file->getClientOriginalExtension();
        $filename           = $random_name.'_album_image.'.$extension;
        $uploadSuccess      = Input::file('image')->move($destinationPath, $filename);

        Images::create(array(
            'description' => Input::get('description'),
            'image' => $filename,
            'album_id'=> Input::get('album_id')
        ));

        return Redirect::route('show_album',array('id'=>Input::get('album_id')));
    }

    public function getDelete($id)
    {
        $image = Images::find($id);
        $image->delete();
        return Redirect::route('show_album',array('id'=>$image->album_id));
    }
}