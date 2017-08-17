<?php namespace App\Http\Controllers\Backend\Gallery;


use App\Http\Controllers\Controller;
use App\Models\Gallery\Album\Album;
use App\Models\Gallery\Images\Images;
use function GuzzleHttp\Psr7\mimetype_from_filename;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

/**
 * Class AdminGalleryController
 * @package App\Http\Controllers\Backend\Gallery
 */
class AdminGalleryController extends Controller
{

    /**
     * Create Album View
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function Albums()
    {
        $albums = Album::all();

        return view('backend.gallery.albums')->with([
            'albums' => $albums
        ]);
    }

    /**
     * Create Album View
     *
     * @param Request $request
     * @return mixed
     */
    public function createAlbumView(Request $request)
    {

        return view('backend.gallery.create-album');
    }

    /**
     * Create Edit Album View
     *
     * @param $id
     * @param Request $request
     * @return mixed
     */
    public function createEditAlbumView($id, Request $request)
    {
        $album      = Album::find($id);
        $images     = Images::all()->where('album_id', $id);
        $imageArr   = [];

        foreach($images as $image)
        {
            $imageUrl   = 'public/gallery/images/'.$id.'/'.$image->image;
            $imageArr[] = [
                'name'  => $image->image,
                'size'  => Storage::size($imageUrl),
                'type'  => mimetype_from_filename($image->image),
                'file'  => route('frontend.storage.album.images', ['albumId' => $id,'filename' => $image->image]),
                'data'  => []
            ];
        }

        return view('backend.gallery.create-album')->with([
            'id'        => $album->id,
            'albumName' => $album->name,
            'albumDesc' => $album->description,
            'images'    => json_encode($imageArr)
        ]);
    }

    /**
     * Edit Album
     *
     * @param $id
     * @param Request $request
     * @return mixed
     */
    public function editAlbum($id, Request $request)
    {
        $album  = Album::find($id);
        $images = Images::all()->where('album_id', $id);

        dd($request->all());
        if(isset($album) && $album instanceof Album)
        {
            $album->name        = $request->album_name;
            $album->description  = $request->album_desc;
            $album->save();

            if(isset($images) && $images instanceof Collection && $images != [])
            {
                $images->delete();
                $this->addImages($id, $images);
            }

        }

        Session::flash('flash_message','Album edited successfully!');

        return view('backend.gallery.create-album');
    }

    /**
     * Create Album
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createAlbum(Request $request)
    {
        $data = (object) $request->all();

        $albumId = Album::create([
            'name'          => $request->album_name,
            'description'   => $request->album_desc
        ])->id;

        $this->addImages($albumId, $data->images);

        Session::flash('flash_message','Album successfully created!');

        return redirect(route('admin.gallery.create-album'));
    }

    /**
     * Edit Album
     *
     * @param $id
     * @param Request $request
     * @return mixed
     */
    public function updateAlbum($id, Request $request)
    {
        $album = Album::find($id);

        if(isset($album) && $album instanceof Album)
        {
            $album->name        = $request->album_name;
            $album->description  = $request->album_desc;

            if(isset($request->cover_img) && $request->cover_img != '')
            {
                $album->cover_image = $request->cover_img;
            }

            $album->save();
        }

        Session::flash('flash_message','Album edited successfully!');

        return view('backend.gallery.create-album');
    }

    /**
     * Delete Album
     *
     * @param Request $request
     * @param $id
     * @return bool|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function deleteAlbum($id, Request $request)
    {
        $album = Album::find($id);

        if(isset($album) && $album != '')
        {
            Album::destroy($id);
            Session::flash('flash_message','Album successfully created!');

            return redirect(route('admin.gallery.create-album'));
        }

        return false;
    }


    /**
     * Add Images
     *
     * @param $albumId
     * @param $imagesArr
     * @return mixed
     * @internal param Request $request
     */
    public function addImages($albumId,$imagesArr)
    {
        $images = (object) $imagesArr;

        if(isset($images) && $images != 'undefined')
        {
            foreach($images as $image)
            {

                $imageName = md5($image->getClientOriginalName()) . '.' . $image->getClientOriginalExtension();

                $image->move(storage_path('/app/public/gallery/images/'. $albumId), $imageName);

                Images::create([
                    'album_id'  => $albumId,
                    'image'     => $imageName,
                ]);
            }
        }
    }
}