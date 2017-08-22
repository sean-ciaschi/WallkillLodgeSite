<?php namespace App\Http\Controllers\Frontend\Event;

use App\Http\Controllers\Controller;
use App\Models\Event\Event;
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
 * Class EventController
 * @package App\Http\Controllers\Backend\Gallery
 */
class EventController extends Controller
{
    /**
     * Index
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $event = Event::where('is_active', 1)->get();

        return view('backend.gallery.albums')->with([
            'event' => $event
        ]);
    }
}