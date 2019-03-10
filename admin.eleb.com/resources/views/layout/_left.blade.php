
@auth
<div class="left-nav">
    <div id="side-nav">
            <ul id="nav">
                <li>
                    <a href="javascript:;">
                        <i class="iconfont">&#xe6b8;</i>
                        <cite>菜单管理</cite>
                        <i class="iconfont nav_right">&#xe697;</i>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a _href="{{route('navs.index')}}">
                                <i class="iconfont">&#xe6a7;</i>
                                <cite>菜单列表</cite>
                            </a>
                        </li >
                    </ul>
                </li>
            </ul>

    </div>
    <div id="side-nav">
        @foreach($topnavs as $topnav)
        <ul id="nav">
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe6b8;</i>
                    <cite>{{$topnav->name}}</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                @foreach($navs as $nav)
                    @if($topnav->id == $nav->pid)
                        <ul class="sub-menu">
                            <li>
                                <a _href="{{route($nav->url)}}">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>{{$nav->name}}</cite>
                                </a>
                            </li >
                        </ul>
                    @endif
                @endforeach
            </li>
        </ul>
        @endforeach
    </div>
</div>
@endauth


