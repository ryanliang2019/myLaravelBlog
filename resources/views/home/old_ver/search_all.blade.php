@extends('home.layouts.home_header_footer')
@section('info')
    <title>Search - {{Config::get('myWebConfig._web_title_')}}</title>
    <meta name="keywords" content="{{$search}}" />
    <meta name="description" content="" />
@endsection
@section('content')
    <article>
        <h1 class="t_nav">
			<span>Search all</span>
			<a href="{{url('/')}}" class="n1">Home</a>
		</h1>
        <div class="newblog left">
		  @if($msg)
			<h2>{{$msg}}</h2>
		  @endif

			<div class="box" style="padding:20px; ">
            	<form action="{{url('search/all')}}" method="post">
                	{{csrf_field()}}

                	<input type="text" placeholder="Search for article" name="search" style="line-height:16px;font-size:16px;width:50%;margin-right:5px;padding:6px 5px;">
                	<button type="submit" style="line-height:16px;font-size:16px;height:30px;width:80px;">Search</button>
            	</form>
        	</div>

		  @if(count($data)>=1)
            @foreach($data as $d)
            <h2>{{$d->article_title}}</h2>
            <p class="dateview" style="padding-left:35px;"><span style="margin-right:30px;">{{date($d->creation_date)}}</span><span style="margin-right:30px;">By: {{$d->article_by}}</span><span>Category: [<a href="{{url('cate/'.$d->id)}}">{{$d->cate_name}}</a>]</span></p>
            <figure><img src="@if(!empty($d->article_thumb)){url($d->article_thumb)}}@else{{url('gfx/ryan_logo.png')}}@endif"></figure>
            <ul class="nlist">
                <p>{{$d->article_desc}}</p>
                <a title="{{$d->article_title}}" href="{{url('article/'.$d->id)}}" target="_blank" class="readmore">Read Article >></a>
            </ul>
            <div class="line"></div>
            @endforeach

            <div class="page">
                {{$data->links()}}
            </div>
		  @endif
        </div>
        <aside class="right">

            <!-- Baidu Button BEGIN -->
			<!--
            <div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare"><a class="bds_tsina"></a><a class="bds_qzone"></a><a class="bds_tqq"></a><a class="bds_renren"></a><span class="bds_more"></span><a class="shareCount"></a></div>
            <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6574585" ></script>
            <script type="text/javascript" id="bdshell_js"></script>
            <script type="text/javascript">
                document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
            </script>
			-->
            <!-- Baidu Button END -->
			@include('home.social_share')

            <div class="news" style="float:left;">
            </div>
        </aside>
    </article>
@endsection


