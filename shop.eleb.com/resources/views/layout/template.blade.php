@include('layout._header')
<div style="background: url('./images/timg1.jpg');width: 1920px;height: 1000px;">
    <div class="container" style="background: url('./images/bg.png');height: 1000px;">
        <div style="border: 0px solid ;width: 1200px;height: 1000px;margin: 0 auto;">
            @include('layout._navbar')
            @foreach(['success','info','warning','danger'] as $status)
                @if(session()->has($status))
                    <div class="alert alert-{{ $status }} alert-dismissible" role="alert" style="width: 180px;height: 50px;float: right;">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        {{ session($status) }}
                    </div>
                @endif
            @endforeach
            @yield('contents')
        </div>

    </div>
</div>

@include('layout._footer')
