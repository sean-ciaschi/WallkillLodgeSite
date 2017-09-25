<?php

namespace App\Http\Controllers\Backend\Gallery;

use Illuminate\Http\Request;
use App\Models\Gallery\Album\Album;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Models\Gallery\Images\Images;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use function GuzzleHttp\Psr7\mimetype_from_filename;

/**
 * Class AdminGalleryController.
 */
class AdminGalleryController extends Controller
{
    /**
     * Create Album View.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function Albums()
    {
        $albums = Album::all();

        return view('backend.gallery.albums')->with([
            'albums' => $albums,
        ]);
    }

    /**
     * Create Album View.
     *
     * @param Request $request
     * @return mixed
     */
    public function createAlbumView(Request $request)
    {
        return view('backend.gallery.create-album');
    }

    /**
     * Create Edit Album View.
     *
     * @param $id
     * @param Request $request
     * @return mixed
     */
    public function createEditAlbumView($id, Request $request)
    {
        $album = Album::find($id);
        $images = Images::all()->where('album_id', $id);
        $imageArr = [];

        foreach ($images as $image) {
            $imageUrl = 'public/gallery/'.$id.'/'.$image->image;
            $imageArr[] = [
                'name'  => $image->image,
                'size'  => Storage::size($imageUrl),
                'type'  => mimetype_from_filename($image->image),
                'file'  => route('frontend.storage.album.images', ['albumId' => $id, 'filename' => $image->image]),
                'data'  => [
                    'id'    => $image->id,
                    'url'   => Storage::disk('gallery')->url($id.'/file1.jpg'),
                ],
            ];
        }

        return view('backend.gallery.create-album')->with([
            'id'        => $album->id,
            'albumName' => $album->name,
            'albumDesc' => $album->description,
            'images'    => json_encode($imageArr),
        ]);
    }

    /**
     * Edit Album.
     *
     * @param $id
     * @param Request $request
     * @return mixed
     */
    public function editAlbum($id, Request $request)
    {
        $album = Album::find($id);

        if (isset($album) && $album instanceof Album) {
            $album->name = $request->album_name;
            $album->description = $request->album_desc;
            $album->save();

            $this->addImages($id, $request);
        }

        Session::flash('flash_message', 'Album edited successfully!');

        return redirect()->route('admin.gallery.edit-album', [
            'id' => $id,
        ]);
    }

    /**
     * Create Album.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createAlbum(Request $request)
    {
        $data = (object) $request->all();

        $albumId = Album::create([
            'name'          => $request->album_name,
            'description'   => $request->album_desc,
        ])->id;

        $this->addImages($albumId, $request);

        Session::flash('flash_message', 'Album successfully created!');

        return redirect(route('admin.gallery.create-album'));
    }

    /**
     * Delete Album.
     *
     * @param Request $request
     * @param $id
     * @return bool|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function deleteAlbum($id, Request $request)
    {
        $album = Album::find($id);

        if (isset($album) && $album != '') {
            Album::destroy($id);
            Session::flash('flash_message', 'Album successfully deleted!');

            return redirect(route('admin.gallery.create-album'));
        }

        return false;
    }

    /**
     * Add Images.
     *
     * @param null $albumId
     * @param Request $request
     * @return mixed
     */
    public function addImages($albumId, Request $request)
    {
        $data = (object) $request->all();
        $images = (object) $data->images;

        if (isset($images) && $images != 'undefined') {
            foreach ($images as $image) {
                $storagePath = Storage::disk('gallery')->put('images/'.$albumId != null ? $albumId : $data->album_sel, $image);

                Images::create([
                    'album_id'  => $albumId != null ? $albumId : $data->album_sel,
                    'image'     => basename($storagePath),
                ]);
            }

            return [
                'result' => 'Successfully added images?',
            ];
        }

        return false;
    }

    /**
     * Remove Image.
     *
     * @param Request $request
     * @return mixed
     */
    public function removeImage(Request $request)
    {
        $image = Images::find($request->get('imageId'));
        if ($image != null) {
            $image->delete();
        }

        Session::flash('flash_message', 'Image Removed');

        return json_encode([
            'result' => 'success',
        ]);
    }
}
