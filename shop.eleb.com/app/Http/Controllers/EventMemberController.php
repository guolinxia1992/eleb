<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventMember;
use App\Models\EventPrize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class EventMemberController extends Controller
{
    //显示活动详情
    public function index()
    {
        $events = Event::all();
        return view('eventmember.index',compact('events','count'));
    }

    public function create()
    {
        return view('eventmember.create');
    }

    public function store(Request $request)
    {
        //添加报名信息
//        dd(Redis::get($request->id));
        $count = Redis::decr($request->id);
//        dd($count);
        if($count<0){
            Redis::incr($request->id);
            return back()->with('danger','报名人数已满');
        }else{
            $eventmember = new EventMember();
            $eventmember->events_id = $request->id;
            $eventmember->member_id = auth()->user()->id;
            $eventmember->save();
            return redirect()->route('eventmembers.index')->with('success','报名成功');
        }

    }
}
