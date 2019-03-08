@extends('home.layouts.home_header_footer')
@section('info')
    <title>{{$cate_info->cate_name}} - {{Config::get('myWebConfig._web_title_')}}</title>
    <meta name="keywords" content="{{$cate_info->cate_keywords}}" />
    <meta name="description" content="{{$cate_info->cate_desc}}" />
@endsection
@section('content')
    <article>
        <h1 class="t_nav">
			<span>{{$cate_info->cate_note}}</span>
			<a href="{{url('/')}}" class="n1">Home</a>
			<a href="{{url('cate/'.$cate_info->id)}}" class="n2">{{$cate_info->cate_name}}</a>
		</h1>
		<div class="box" style="padding:20px; ">
            <form action="{{url('search/cate/'.$cate_info->id)}}" method="post">
                {{csrf_field()}}

                <input type="text" placeholder="Search for article" name="search" style="line-height:16px;font-size:16px;width:40%;margin-right:5px;padding:6px 5px;">
            	<button type="submit" style="line-height:16px;font-size:16px;height:30px;">&nbsp;Search "{{$cate_info->cate_name}}"&nbsp;</button>
        	</form>
        </div>
        <div class="newblog left">
            @foreach($data as $d)
            <h2>{{$d->article_title}}</h2>
            <p class="dateview" style="padding-left:35px;"><span style="margin-right:30px;">{{date($d->creation_date)}}</span><span style="margin-right:30px;">By: {{$d->article_by}}</span><span>Category: [<a href="{{url('cate/'.$cate_info->id)}}">{{$cate_info->cate_name}}</a>]</span></p>
            <figure><img src="@if(!empty($d->article_thumb)){{$d->article_thumb}}@else{{url('gfx/ryan_logo.png')}}@endif"></figure>
            <ul class="nlist">
                <p>{{$d->article_desc}}</p>
                <a title="{{$d->article_title}}" href="{{url('article/'.$d->id)}}" target="_blank" class="readmore">Read Article >></a>
            </ul>
            <div class="line"></div>
            @endforeach

            <div class="page">
                {{$data->links()}}
            </div>
        </div>
        <aside class="right">
            @if($sub_cate->all())
            <div class="rnav">
                <ul>
                    @foreach($sub_cate as $k=>$s)
                    <li class="rnav{{$k+1}}"><a href="{{url('cate/'.$s->id)}}" target="_blank">{{$s->cate_name}}</a></li>
                    @endforeach
                </ul>
            </div>
            @endif

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
                @parent
            </div>
        </aside>
    </article>
@endsection


