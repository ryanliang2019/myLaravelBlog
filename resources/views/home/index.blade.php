@extends('home.layouts.home_header_footer')
@section('info')
    <title>{{Config::get('myWebConfig._web_title_')}} - {{Config::get('myWebConfig._seo_title_')}}</title>
    <meta name="keywords" content="{{Config::get('myWebConfig._keywords_')}}" />
    <meta name="description" content="{{Config::get('myWebConfig._desc_')}}" />
@endsection

@section('content')
    <div class="banner">
        <section class="box">
            <ul class="texts" style="font-weight:bold;">
                <p>There is no life without water...</p>
                <p>Because without water, there is no coffee...</p>
                <p>And without coffee, I'll kill you all</p>
				<p>E=MC^2</p>
				<p>Energy=My Coffee^2</p>
            </ul>
            <div class="avatar"><a href="#"><span>Ryan</span></a> </div>
        </section>
    </div>
    <div class="template">
        <div class="box">
            <h3>
                <p><span>Ryan</span> Recommends</p>
            </h3>
            <ul>
                {{--@foreach($pics as $p)--}}
				@foreach($hot as $p)
                <li><a href="{{url('article/'.$p->id)}}"  target="_blank"><img src="@if(!empty($d->article_thumb)){url($d->article_thumb)}}@else{{url('gfx/ryan_logo.png')}}@endif"></a><span>{{$p->article_title}}</span></li>
                @endforeach
            </ul>
        </div>
    </div>
	<div>
		<div class="box" style="padding:20px; ">
			<form action="{{url('search/all')}}" method="post">
				{{csrf_field()}}

      			<input type="text" placeholder="Search for article" name="search" style="line-height:16px;font-size:16px;width:50%;margin-right:5px;padding:6px 5px;">
    			<button type="submit" style="line-height:16px;font-size:16px;height:30px;width:80px;">Search</button>
    		</form>
		</div>
	</div>
    <article class="blogs">
        <h2 class="title_tj">
            <p style="width:110px;">Article <span>List</span></p>
        </h2>
        <div class="bloglist left">
            @foreach($data as $d)
            <h3>{{$d->article_title}}</h3>
            <figure><img src="@if(!empty($d->article_thumb)){url($d->article_thumb)}}@else{{url('gfx/ryan_logo.png')}}@endif"></figure>
            <ul>
                <p>{{$d->article_desc}}</p>
                <a title="{{$d->article_title}}" href="{{url('article/'.$d->id)}}" target="_blank" class="readmore">Read Article >></a>
            </ul>
            <p class="dateview" style="padding-left:35px;"><span style="margin-right:30px;">{{$d->creation_date}}</span><span>By: {{$d->article_by}}</span></p>
            @endforeach
            <div class="page" style="text-align:center;">
                {{$data->links()}}
            </div>
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
                @parent
                <h3 class="links">
                    <p style="width:140px;">Recommended <span>Links</span></p>
                </h3>
                <ul class="website">
                    @foreach($links as $l)
                    <li style="text-align:left;"><a href="{{$l->link_url}}" target="_blank">{{$l->link_name}}</a></li>
                    @endforeach
                </ul>
            </div>

        </aside>
    </article>
@endsection
