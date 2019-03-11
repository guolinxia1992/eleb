<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventMember;
use App\Models\EventPrize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class EventController extends Controller
{
    //抽奖活动页面
    public function index()
    {
//        $count = Event::count();
//        dd($count);
        $events = Event::all();
        return view('event.index',compact('events'));
    }
    //添加活动
    public function create()
    {
        return view('event.create');
    }

    public function store(Request $request)
    {
        //接收数据验证
        $this->validate($request,
            [
                'title'=>'required',
                'content'=>'required',
                'signup_start'=>'required',
                'signup_end'=>'required',
                'prize_date'=>'required',
                'signup_num'=>'required',
                'is_prize'=>'required',
            ],
            [
                'title.required'=>'请输入活动标题',
                'content.required'=>'请输入活动内容',
                'signup_start.required'=>'请输入活动开始时间',
                'signup_end.required'=>'请输入活动结束时间',
                'prize_date.required'=>'请输入开奖日期',
                'signup_num.required'=>'请输入报名人数',
                'is_prize.required'=>'请选择活动状态',
            ]);
        $event = new Event();
        $event->title = $request->title;
        $event->content = $request->content;
        $event->signup_start = strtotime($request->signup_start);
        $event->signup_end = strtotime($request->signup_end);
        $event->prize_date = $request->prize_date;
        $event->signup_num = $request->signup_num;
        $event->is_prize = $request->is_prize;
        $event->save();
        Redis::set($event->id,$request->signup_num);
        return redirect()->route('events.index')->with('success','添加成功');
    }
    public function edit(Event $event)
    {
        return view('event.edit',compact('event'));
    }

    public function update(Event $event,Request $request)
    {
        //接收数据验证
        $this->validate($request,
            [
                'title'=>'required',
                'content'=>'required',
                'signup_start'=>'required',
                'signup_end'=>'required',
                'prize_date'=>'required',
                'signup_num'=>'required',
                'is_prize'=>'required',
            ],
            [
                'title.required'=>'请输入活动标题',
                'content.required'=>'请输入活动内容',
                'signup_start.required'=>'请输入活动开始时间',
                'signup_end.required'=>'请输入活动结束时间',
                'prize_date.required'=>'请输入开奖日期',
                'signup_num.required'=>'请输入报名人数',
                'is_prize.required'=>'请选择活动状态',
            ]);
        $event->update([
            'title'=>$request->title,
            'content'=>$request->content,
            'signup_start'=>strtotime($request->signup_start),
            'signup_end'=>strtotime($request->signup_end),
            'prize_date'=>$request->prize_date,
            'signup_num'=>$request->signup_num,
            'is_prize'=>$request->is_prize,
        ]);
        return redirect()->route('events.index')->with('success','修改成功');
    }

    public function start(Event $event)
    {
        return view('event.start',compact('event'));
    }
    public function result(Event $event,EventPrize $eventPrize)
    {
        $a = [];
        $b = [];
        $data = [];
        $members = EventMember::where('events_id','=',$event->id)->get();
        foreach ($members as $member){
            $a[] = $member->member_id;
        }
        $member_index = array_rand($a);
//        var_dump($a[$member_index]);exit();
        $prizes = EventPrize::where('events_id','=',$event->id)->get();
//        $prize = array_rand($prizes->name,1);
//        $data=[$member=>$prize];
        foreach ($prizes as $prize){
            $b[] = $prize->id;
        }
        $prize_index = array_rand($b);
//        var_dump($b[$prize_index]);exit();
        $data = [$a[$member_index]=>$b[$prize_index]];
        $eventPrize->where('id','=',$b[$prize_index])->update([
            'member_id'=>$a[$member_index],
        ]);
        $event->update([
            'is_prize'=>1,
        ]);
        $title = '开奖结果通知';
        $content = '<p>您参加的活动已开奖,请登录商家管理中心查看中奖结果</p>';
        try{
            \Illuminate\Support\Facades\Mail::send('email.email',compact('title','content'),
                function($message){
                    $to = '592975640@qq.com';
                    $message->from(env('MAIL_USERNAME'))->to($to)->subject('饿了吧外卖平台');
                });
        }catch (Exception $e){
            return '邮件发送失败';
        }
        echo "<p>中奖商家ID:$a[$member_index],奖品ID:$b[$prize_index]</p>";
        return redirect()->route('events.index')->with('success','开奖成功');
    }

    public function end(Event $event)
    {
        $event->update([
            'is_prize'=>0,
        ]);
        $title = '开奖结果通知';
        $content = '<p>您参加的活动已开奖,请登录商家管理中心查看中奖结果</p>';
        try{
            \Illuminate\Support\Facades\Mail::send('email.email',compact('title','content'),
                function($message){
                    $to = '592975640@qq.com';
                    $message->from(env('MAIL_USERNAME'))->to($to)->subject('饿了吧外卖平台');
                });
        }catch (Exception $e){
            return '邮件发送失败';
        }
        return redirect()->route('shops.index')->with('success','已开奖');
    }
}
