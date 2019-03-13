<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    @yield('info')
    <link href="{{asset('home/style/css/base.css')}}" rel="stylesheet">
    <link href="{{asset('home/style/css/index.css')}}" rel="stylesheet">
    <link href="{{asset('home/style/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('home/style/css/new.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="{{asset('home/style/js/modernizr.js')}}"></script>
    <![endif]-->

	<script type='text/javascript'>
		{!! Config::get('myWebConfig._tracking_code_') !!}
	</script>
</head>
<body>
<header>
    <div id="logo"><a href="{{url('/')}}"></a></div>
    <nav class="topnav" id="topnav">
        @foreach($navs as $k=>$v)<a href="{{$v->nav_url}}"><span>{{$v->nav_name}}</span><span class="en">{{$v->nav_alias}}</span></a>@endforeach
    </nav>
</header>

@section('content')
    <h3>
        <p style="width:100px;">Most <span>Recent</span></p>
    </h3>
    <ul class="rank">
        @foreach($new as $n)
            <li><a href="{{url('article/'.$n->id)}}" title="{{$n->article_title}}" target="_blank">{{$n->article_title}}</a></li>
        @endforeach
    </ul>
    <h3 class="ph">
        <p style="width:100px;">Most <span>Views</span></p>
    </h3>
    <ul class="paih">
        @foreach($hot as $h)
            <li><a href="{{url('article/'.$h->id)}}" title="{{$h->article_title}}" target="_blank">{{$h->article_title}}</a></li>
        @endforeach
    </ul>
@show

<footer>
    <p>{!! Config::get('myWebConfig._copy_right_') !!}</p>
</footer>
</body>
</html>
