<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\CmsMultiversityEvent;

class CmsMultiversityEventController extends Controller
{
    public function index(){
        $events = CmsMultiversityEvent::all();
        return view('pages.event-index', ['events' => $events]);
    }

    public function create()
    {
        return view('pages.event-create');
    }

    public function store(Request $request){
        $validation = Validator::make($request->all(), [
            'ateneo' => ['required','string', Rule::in(['mercatorum', 'unipegaso'])],
            'titolo' => 'required|string',
            'slug' => 'required|string',
            'tipologia' => 'required|string',
            'data' => 'required',
            'time' => 'required',
            'luogo' => 'required|string',
            'contenuto' => 'required|string',
            'seo_title' => 'required|string',
            'seo_description' => 'required|string',
            'stato' => 'required',
            'deleted' => 'nullable|numeric'
        ]);

        if($validation->fails()){
            return redirect()->route('event-create')->with('response', 'Per favore, controlla i dati inseriti');
        }

        $data = $request->all();
        $event = new CmsMultiversityEvent;
        $event->ateneo= $data['ateneo'];
        $event->titolo = $data['titolo'];
        $event->slug= $data['slug'];
        $event->tipologia= $data['tipologia'];
        $event->data= $data['data'];
        $event->ora= $data['time'];
        $event->luogo= $data['luogo'];
        $event->contenuto= $data['contenuto'];
        $event->seo_title= $data['seo_title'];
        $event->seo_description= $data['seo_description'];

        if(CmsMultiversityEvent::where('ateneo', '=', $data['ateneo'])->where('slug', '=', $data['slug'])->exists()){
            return redirect()->route('event-create')->with('queryError', 'L\'evento è già presente nel DB. Riprovare');
        } 

        $event->save();

        return redirect()->route('event-edit', ['id' => $event->id])->with(['success' => 'Evento registrato correttamente', 'event' => $event]);
    }

    public function edit($id, CmsMultiversityEvent $event)
    {
        $event = CmsMultiversityEvent::find($id);
        return view('pages.event-edit', ['event' => $event]);
    }

    public function update(Request $request, $id)
    {
        $event = CmsMultiversityEvent::find($id);
        $data = $request->all();

        $validation = Validator::make($request->all(), [
            'ateneo' => ['required','string', Rule::in(['mercatorum', 'unipegaso'])],
            'titolo' => 'required|string',
            'slug' => 'required|string',
            'tipologia' => 'required|string',
            'data' => 'required',
            'time' => 'required',
            'luogo' => 'required|string',
            'contenuto' => 'required|string',
            'seo_title' => 'required|string',
            'seo_description' => 'required|string',
            'stato' => 'int|in:0,1|required',
            'deleted' => 'nullable|numeric'
        ]);

        if($validation->fails()){
            return redirect()->route('event-edit', ['id' => $event->id])->with('response', 'Per favore, controlla i dati inseriti');
        }

        $event->ateneo= $data['ateneo'];
        $event->titolo = $data['titolo'];
        $event->slug= $data['slug'];
        $event->tipologia= $data['tipologia'];
        $event->data= $data['data'];
        $event->ora= $data['time'];
        $event->luogo= $data['luogo'];
        $event->contenuto= $data['contenuto'];
        $event->seo_title= $data['seo_title'];
        $event->seo_description= $data['seo_description'];
        $event->stato= $data['stato'];

        if(CmsMultiversityEvent::where('ateneo', '=', $data['ateneo'])->where('slug', '=', $data['slug'])->exists()){
            return redirect()->route('event-edit', ['id' => $event->id])->with('queryError', 'L\'evento è già presente nel DB. Riprovare');
        } 

        $event->save();

        return redirect()->route('event-edit', ['id' => $event->id])->with('response', 'Evento modificato correttamente');
    }


    public function delete(CmsMultiversityEvent $event, $id)
    {
        $event = CmsMultiversityEvent::find($id);
        $event->deleted = 1;
        $event->save();

        return redirect()->route('event-index')->with('deleteMessage', 'Evento rimosso correttamente');
    }
}
