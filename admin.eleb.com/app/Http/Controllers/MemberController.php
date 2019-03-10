<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    //显示会员列表
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $wheres = [];
        if($keyword){
            $wheres[] = ['username','like',"%$keyword%"];
        }
        $members = Member::where($wheres)->get();
        return view('member.index',compact('members'));
    }
    //查看会员
    public function show(Member $member)
    {
        $show = Member::where('order_id','=',$member->id)->get();
        return view('member.show',compact('show'));
    }
    //禁用会员
    public function disable(Member $member)
    {
        $member->update(['status'=>0]);
        return redirect()->route('members.index')->with('success','已禁用');
    }
}
