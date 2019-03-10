<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventPrize;
use Illuminate\Http\Request;

class EventPrizeController extends Controller
{
    public function show(Event $event)
    {
        $results = EventPrize::where('events_id',$event->id)->get();
//        var_dump($results);exit;
        return view('eventprize.show',compact('results','event'));
    }
}
