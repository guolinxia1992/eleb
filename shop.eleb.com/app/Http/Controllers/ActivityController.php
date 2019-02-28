<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    //显示活动页面
    public function index()
    {
        $activities = Activity::where('end_time','>',date('Y-m-d H:i:s'))->get();
        return view('activity.index',compact('activities'));
    }
}
