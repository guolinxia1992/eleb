<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventPrize;
use Illuminate\Http\Request;

class EventPrizeController extends Controller
{
    //奖品列表
    public function index()
    {
        $prizes = EventPrize::all();
        return view('eventprize.index',compact('prizes'));
    }
    //添加管理员
    public function create()
    {
        $events = Event::where('prize_date','>',date('Y-m-d'))->get();
        return view('eventprize.create',compact('events'));
    }

    public function store(Request $request)
    {
        //接收数据验证,有错返回提示
        $this->validate($request,
            ['events_id'=>'required','name'=>'required','description'=>'required'],
            [   'name.required'=>'请输入奖品名称',
                'events_id.required'=>'请选择活动',
                'description.email'=>'请输入奖品描述',
            ]);
        //数据无误,保存
        $eventprize = new EventPrize();
        $eventprize->name = $request->name;
        $eventprize->events_id = $request->events_id;
        $eventprize->description = $request->description;
        $eventprize->save();
        return redirect()->route('eventprizes.index')->with('success','奖品添加成功');
    }
    public function destroy(EventPrize $eventprize)
    {
        $eventprize->delete();
        return redirect()->route('eventprizes.index')->with('success','删除成功');
    }
    public function edit(EventPrize $eventprize)
    {
        $events = Event::where('prize_date','>',date('Y-m-d'))->get();
        //加载页面
        return view('eventprize.edit',compact('eventprize','events'));
    }

    public function update(Eventprize $eventprize,Request $request)
    {
        //接收数据验证表单,有误返回提示
        $this->validate($request,
            ['events_id'=>'required','name'=>'required','description'=>'required'],
            [   'name.required'=>'请输入奖品名称',
                'events_id.required'=>'请选择活动',
                'description.email'=>'请输入奖品描述',
            ]);
        //数据无误,保存
        $eventprize->update(['name'=>$request->name,
            'events_id'=>$request->events_id,
            'description'=>$request->description,
        ]);
        return redirect()->route('eventprizes.index')->with('success','修改成功');
    }
}
