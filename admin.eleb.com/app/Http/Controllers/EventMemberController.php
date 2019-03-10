<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventMember;
use App\Models\User;
use Illuminate\Http\Request;

class EventMemberController extends Controller
{
    //报名列表首页
    public function index()
    {
        $members = EventMember::all();
//        dump($members);exit;
        $users = User::all();
        $events = Event::all();
        return view('member.index',compact('members','users','events'));
    }

}
