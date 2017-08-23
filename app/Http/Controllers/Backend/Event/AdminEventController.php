<?php namespace App\Http\Controllers\Backend\Event;

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
 * Class AdminEventController
 * @package App\Http\Controllers\Backend\Gallery
 */
class AdminEventController extends Controller
{
    /**
     * Index
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $events = Event::all();

        return view('backend.event.events')->with([
            'events' => $events
        ]);
    }

    /**
     * Create Event View
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('backend.event.create-event');
    }

    /**
     * Update Event View
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update($id)
    {
        $event = Event::find($id);

        return view('backend.event.create-event')->with([
            'event' => $event
        ]);
    }

    public function ajaxCreateEvent(Request $request)
    {
        $data = (object) $request->all();

        if(isset($data) && $data != null)
        {
            $currentlyActiveEvents = Event::where('is_active', 1)->get();
            foreach($currentlyActiveEvents as $activeEvent)
            {
                $activeEvent->is_active = 0;
                $activeEvent->save();
            }

            Event::create([
               'name'           => $data->event_name,
               'description'    => $data->event_desc,
               'location'       => $data->event_location,
               'date'           => $data->event_date,
               'price'          => $data->event_cost,
               'is_active'      => ($data->event_is_active == 'on') ? 1 : 0,
            ]);

            return redirect()->route('admin.events.index');
        }

        return redirect()->route('admin.events.index');
    }

    public function ajaxUpdateEvent($id, Request $request)
    {
        $data = (object) $request->all();

        if(isset($data) && $data != null)
        {
            if(isset($data->event_is_active))
            {
                $currentlyActiveEvents = Event::where('is_active', 1)->get();
                foreach($currentlyActiveEvents as $activeEvent)
                {
                    $activeEvent->is_active = 0;
                    $activeEvent->save();
                }
            }

            $currentEvent = Event::find($id);

            $currentEvent->name         = $data->event_name;
            $currentEvent->description  = $data->event_desc;
            $currentEvent->location     = $data->event_location;
            $currentEvent->price        = $data->event_cost;
            $currentEvent->date         = $data->event_date;
            if(isset($data->event_is_active))
            {
                $currentEvent->is_active = ($data->event_is_active == 'on') ? 1 : 0;
            }


            $currentEvent->save();

            return redirect()->route('admin.events.index');
        }

        return redirect()->route('admin.events.index');
    }

    public function ajaxDeleteEvent()
    {

    }
}