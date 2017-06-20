<?php namespace App\Http\Controllers\Backend\Gallery;


use App\Http\Controllers\Controller;
use App\Models\Gallery\Album\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
    public function createAlbumView()
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
        $album = Album::find($id);

        return view('backend.gallery.create-album')->with([
            'id'        => $album->id,
            'albumName' => $album->name,
            'albumDesc' => $album->description,
            'image'     => $album->image
        ]);
    }

    /**
     * Create Album
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createAlbum(Request $request)
    {
        $imageName = $request->album_name . '.' . $request->file('cover_img')->getClientOriginalExtension();

        $request->file('cover_img')->move(storage_path() . '/app/public/gallery/images/', $imageName);

        Album::create([
            'name'          => $request->album_name,
            'description'   => $request->album_desc,
            'cover_image'   => storage_path() . '/app/public/gallery/images/', $imageName
        ]);

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
    public function editAlbum($id, Request $request)
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
     * Delete Album
     *
     * @param Request $request
     * @return mixed
     */
    public function addImagesView(Request $request)
    {
        $albumCollection = Album::all();

        $albums = (object) [];

        foreach($albumCollection as $album)
        {
            $albums[] = [
                'name'      => $album->name,
                'desc'      => $album->description,
                'cover_img' => $album->cover_image,
            ];
        }

        return view('backend.gallery.add-images')->with([
            'albums' => $albums
        ]);
    }
}