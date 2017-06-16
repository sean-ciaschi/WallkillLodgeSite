<?php namespace App\Http\Controllers\Backend\Gallery;

use App\Http\Controllers\Controller;
use App\Models\Blog\BlogPost\BlogPost as BlogPost;
use App\Models\Gallery\Album\Album;
use function GuzzleHttp\Psr7\mimetype_from_filename;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Validator;

class AlbumsController extends Controller
{
    /**
     * Get List
     *
     * @return mixed
     */
    public function getList()
    {
        $albums = Album::with('photos')->get();

        return View::make('index')->with('albums',$albums);
    }

    /**
     * Get Album
     *
     * @param $id
     * @return mixed
     */
    public function getAlbum($id)
    {
        $album = Album::with('photos')->find($id);

        return View::make('album')->with('album',$album);
    }

    /**
     * Get Form
     *
     * @return mixed
     */
    public function getForm()
    {
        return View::make('backend/album/createalbum');
    }

    /**
     * Post Create
     *
     * @return mixed
     */
    public function postCreate()
    {
        $rules = array(
            'name'          => 'required',
            'cover_image'   =>'required|image'
        );

        $validator = Validator::make(Input::all(), $rules);

        if($validator->fails())
        {

            return Redirect::route('create_album_form')
                ->withErrors($validator)
                ->withInput();
        }

        $file               = Input::file('cover_image');
        $random_name        = str_random(8);
        $destinationPath    = 'albums/';
        $extension          = $file->getClientOriginalExtension();
        $filename           = $random_name.'_cover.'.$extension;
        $uploadSuccess      = Input::file('cover_image')->move($destinationPath, $filename);

        $album = Album::create(array(
            'name'          => Input::get('name'),
            'description'   => Input::get('description'),
            'cover_image'   => $filename,
        ));

        return Redirect::route('show_album',array('id'=>$album->id));
    }

    /**
     * Get Delete
     *
     * @param $id
     * @return mixed
     */
    public function getDelete($id)
    {
        $album = Album::find($id);

        $album->delete();

        return Redirect::route('index');
    }
}