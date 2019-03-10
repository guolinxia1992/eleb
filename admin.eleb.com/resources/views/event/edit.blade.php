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
    <form class="layui-form" method="post" action="{{route('events.update',[$event])}}" enctype="multipart/form-data">
        <div class="layui-form-item">
            <label for="L_email" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>活动名称
            </label>
            <div class="layui-input-inline">
                <input type="text" id="" name="title" required="" lay-verify=""
                       autocomplete="off" class="layui-input" value="{{$event->title}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_email" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>内容
            </label>
            <div class="layui-input-inline" style="width: 600px">


            @include('vendor.ueditor.assets')
        <!-- 实例化编辑器 -->
            <script type="text/javascript">
                var ue = UE.getEditor('container');
                ue.ready(function() {
                    ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
                });
            </script>

            <!-- 编辑器容器 -->
            <script id="container" name="content" type="text/plain">{!! $event->content !!}</script>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_email" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>报名开始日期
            </label>
            <div class="layui-input-inline">
                <input type="date" id="" name="signup_start"  lay-verify=""
                       autocomplete="off" class="layui-input" value="{{date('Y-m-d',$event->signup_start)}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_email" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>报名结束日期
            </label>
            <div class="layui-input-inline">
                <input type="date" id="" name="signup_end"  lay-verify=""
                       autocomplete="off" class="layui-input" value="{{date('Y-m-d',$event->signup_end)}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_email" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>开奖日期
            </label>
            <div class="layui-input-inline">
                <input type="date" id="" name="prize_date"  lay-verify=""
                       autocomplete="off" class="layui-input" value="{{$event->prize_date}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_email" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>报名人数限制
            </label>
            <div class="layui-input-inline">
                <input type="text" id="" name="signup_num"  lay-verify=""
                       autocomplete="off" class="layui-input" value="{{$event->signup_num}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_email" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>是否已开奖
            </label>
            <div class="layui-input-inline">
                <select name="is_prize" id="">
                    <option value="1" @if($event->is_prize==1)selected @endif>是</option>
                    <option value="0" @if($event->is_prize==0)selected @endif>否</option>
                </select>
            </div>
        </div>
        {{csrf_field()}}
        {{method_field('patch')}}
        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label" style="width: 120px;">
            </label>
            <button  class="layui-btn" lay-filter="" lay-submit="" type="submit" >
                确认修改
            </button>
        </div>
    </form>
</div>
@include('layout._footer')