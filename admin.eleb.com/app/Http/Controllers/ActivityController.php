<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    //活动列表页
    public function index(Request $request)
    {
        $time = time();
//        var_dump(convert_uudecode('222'));exit;
        $keyword = $request->keyword;
//        var_dump(date('Y-m-d H:i:s'));
//        var_dump($keyword);
        $wheres = [];
        if($keyword=='all'){
            $activities = Activity::all();
        }else{
            if($keyword==0) $wheres[]=['start_time','>',date('Y-m-d H:i:s')];
            if($keyword==1){
                $wheres[]= ['start_time','<',date('Y-m-d H:i:s')];
                $wheres[]=['end_time','>',date('Y-m-d H:i:s')];
            }
            if($keyword==-1) $wheres[]=['end_time','<',date('Y-m-d H:i:s')];
//            dd($wheres);
            $activities = Activity::where($wheres)->get();
        }
        return view('activity.index',compact('activities'));
    }

    public function create()
    {
        //调用视图
        return view('activity.create');
    }

    public function store(Request $request)
    {
        //验证数据,有误返回提示
//        dd($request);
        $this->validate($request,
            [
                'title'=>'required',
                'content'=>'required',
                'start_time'=>'required',
                'end_time'=>'required',
            ],
             [
                 'title.required'=>'请输入标题',
                 'content.required'=>'请输入内容',
                 'start_time,required'=>'请选择开始时间',
                 'end_time,required'=>'请选择结束时间',
             ]);
        //数据无误,保存
//        dd($request);
        $activity = new Activity();
        $activity->content = $request->content;
        $activity->title = $request->title;
        $activity->start_time = $request->start_time;
        $activity->end_time = $request->end_time;
        $activity->save();
        return redirect()->route('activities.index')->with('success','添加成功');
    }

    public function destroy(Activity $activity)
    {
        $activity->delete();
        return redirect()->route('activities.index')->with('success','删除成功');
    }

    public function edit(Activity $activity)
    {
        //调用视图
        $data=$activity->start_time;
        $start_time=substr($data,0,10)."T".substr($data,11,5);
        $end_time=substr($activity->end_time,0,10)."T".substr($activity->end_time,11,5);
        return view('activity.edit',compact('activity','start_time','end_time'));
    }

    public function update(Activity $activity,Request $request)
    {
        //验证数据,有误返回提示
        $this->validate($request,
            [
                'title'=>'required',
                'content'=>'required',
                'start_time'=>'required',
                'end_time'=>'required',
            ],
            [
                'title.required'=>'请输入标题',
                'content.required'=>'请输入内容',
                'start_time,required'=>'请选择开始时间',
                'end_time,required'=>'请选择结束时间',
            ]);
        //数据无误,保存
        $activity->update([
            'title'=>$request->title,
            'content'=>$request->content,
            'start_time'=>$request->start_time,
            'end_time'=>$request->end_time,
        ]);
        return redirect()->route('activities.index')->with('success','修改成功');
    }


}
