<div class="left-nav">
    @auth
    <div id="side-nav">
        <ul id="nav">
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe6b8;</i>
                    <cite>管理员管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a _href="{{route('admins.index')}}">
                            <i class="iconfont">&#xe6a7;</i>
                            <cite>管理员列表</cite>
                        </a>
                    </li >
                </ul>
            </li>
        </ul>
    </div>
    <div id="side-nav">
        <ul id="nav">
            <li>
                <a href="javascript:;">
                    <i class="iconfont">&#xe6b8;</i>
                    <cite>商户管理</cite>
                    <i class="iconfont nav_right">&#xe697;</i>
                </a>
                <ul class="sub-menu">

                    <li>
                        <a href="javascript:;">
                            <i class="iconfont">&#xe70b;</i>
                            <cite>商家管理</cite>
                            <i class="iconfont nav_right">&#xe697;</i>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a _href="{{route('shops.index')}}">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>商家列表</cite>

                                </a>
                            </li >
                            <li>
                                <a _href="{{route('users.create')}}">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>商家注册</cite>

                                </a>
                            </li >
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="iconfont">&#xe70b;</i>
                            <cite>商家账号管理</cite>
                            <i class="iconfont nav_right">&#xe697;</i>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a _href="{{route('users.index')}}">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>商家账号列表</cite>

                                </a>
                            </li >
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="iconfont">&#xe70b;</i>
                            <cite>商家分类管理</cite>
                            <i class="iconfont nav_right">&#xe697;</i>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a _href="{{route('shopcategories.index')}}">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>商家分类列表</cite>

                                </a>
                            </li >
                            <li>
                                <a _href="{{route('shopcategories.create')}}">
                                    <i class="iconfont">&#xe6a7;</i>
                                    <cite>添加商家分类</cite>
                                </a>
                            </li >


                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
        <div id="side-nav">
            <ul id="nav">
                <li>
                    <a href="javascript:;">
                        <i class="iconfont">&#xe6b8;</i>
                        <cite>活动管理</cite>
                        <i class="iconfont nav_right">&#xe697;</i>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a _href="{{route('activities.index')}}">
                                <i class="iconfont">&#xe6a7;</i>
                                <cite>活动列表</cite>
                            </a>
                        </li >
                    </ul>
                </li>
            </ul>
        </div>
    @endauth
</div>