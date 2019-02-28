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
    <form class="layui-form" method="post" action="{{route('activities.update',[$activity])}}" enctype="multipart/form-data">
        <div class="layui-form-item">
            <label for="L_email" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>活动名称
            </label>
            <div class="layui-input-inline">
                <input type="text" id="" name="title" required="" lay-verify=""
                       autocomplete="off" class="layui-input" value="{{$activity->title}}">
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
            <script id="container" name="content" type="text/plain">
                {!!$activity->content!!}
            </script>
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_email" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>开始日期
            </label>
            <div class="layui-input-inline">
                <input type="datetime-local" id="" name="start_time" required="" lay-verify=""
                       autocomplete="off" class="layui-input" value="{{$start_time}}">
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_email" class="layui-form-label" style="width: 120px;">
                <span class="x-red">*</span>结束日期
            </label>
            <div class="layui-input-inline">
                <input type="datetime-local" id="" name="end_time" required="" lay-verify=""
                       autocomplete="off" class="layui-input" value="{{$end_time}}">
            </div>
        </div>
        {{csrf_field()}}
        {{method_field('patch')}}
        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label" style="width: 120px;">
            </label>
            <button  class="layui-btn"  type="submit" >
                确认修改
            </button>
        </div>
    </form>
</div>
@include('layout._footer')