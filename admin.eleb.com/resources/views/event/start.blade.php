@include('layout._header')

<div class="x-body layui-anim layui-anim-up" >
    @if(count($errors)>0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>
                        {{$error}}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
        <a href="{{route('events.result',[$event])}}" class="layui-btn">开始抽奖</a>
    {{--<form class="layui-form" method="get" action="{{route('events.result',[$event])}}" enctype="multipart/form-data">--}}
        {{--{{csrf_field()}}--}}
        {{--<div class="layui-form-item">--}}
            {{--<label for="L_repass" class="layui-form-label" style="width: 120px;">--}}
            {{--</label>--}}
            {{--<button  class="layui-btn" lay-filter="" lay-submit="" type="submit" >--}}
                {{----}}
            {{--</button>--}}
        {{--</div>--}}
    {{--</form>--}}
</div>
@include('layout._footer')