<?php

namespace App\Http\Controllers\Frontend\Gallery;

use App\Models\Gallery\Album\Album;
use App\Http\Controllers\Controller;
use App\Models\Gallery\Images\Images;

/**
 * Class AdminGalleryController.
 */
class GalleryController extends Controller
{
    public function albumView()
    {
        $model = Album::with('images')->get();
        $albums = [];

        foreach ($model as $album) {
            $albums[] = $album;
        }

        return view('frontend.gallery.albums')->with([
            'albums' => (object) $albums,
        ]);
    }

    public function imageView($id)
    {
        $model = Images::get()->where('album_id', $id);
        $album = Album::find($id)->first();
        $images = [];

        foreach ($model as $image) {
            $images[] = $image;
        }

        return view('frontend.gallery.images')->with([
            'albumName' => $album->name,
            'albumId'   => $id,
            'images'    => (object) $images,
        ]);
    }
}
