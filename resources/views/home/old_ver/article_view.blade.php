@extends('home.layouts.home_header_footer')
@section('info')
    <title>{{$article_info->article_title}} - {{Config::get('myWebConfig._web_title_')}}</title>
    <meta name="keywords" content="{{$article_info->article_keywords}}" />
    <meta name="description" content="{{$article_info->article_desc}}" />
@endsection
@section('content')
	<style>
        article {
            width: 95%;
        }
        .index_about {
            width: calc(100% - 250px);
        }
    </style>

    <article class="blogs">
        <h1 class="t_nav">
			<span>Your Location: <a href="{{url('/')}}">Home</a>&nbsp;&gt;&nbsp;<a href="{{url('cate/'.$article_info->article_cate_id)}}">{{$article_info->cate_name}}</a></span>
			<a href="{{url('/')}}" class="n1">Home</a><a href="{{url('cate/'.$article_info->article_cate_id)}}" class="n2">{{$article_info->cate_name}}</a>
		</h1>
        <div class="index_about">
            <h2 class="c_titile">{{$article_info->article_title}}</h2>
            <p class="box_c"><span class="d_time">Creation Time:{{$article_info->creation_date}}</span><span>By:{{$article_info->article_by}}</span><span>Views:{{$article_info->article_views}}</span></p>
            <ul class="infos">
				<style>
					ul.infos p{
						margin-bottom: 0px;
						font-family: "Operator Mono", "Fira Code", Consolas, Monaco, "Andale Mono", monospace;
						font-size: 16px;
  margin-left: 0;
  margin-right: 0;
					}
				</style>
                {!! $article_info->article_content !!}
            </ul>
            <div class="keybq">
                <p><span>Keywords</span>: {{$article_info->article_keywords}}</p>
            </div>
            <div class="ad"> </div>
            <div class="nextinfo">
                <p>Previous Article:
                    @if($article_pre)
                        <a href="{{url('article/'.$article_pre->id)}}">{{$article_pre->article_title}}</a>
                    @else
                        <span>N/A</span>
                    @endif
                </p>
                <p>Next Article:
                    @if($article_next)
                        <a href="{{url('article/'.$article_next->id)}}">{{$article_next->article_title}}</a>
                    @else
                        <span>N/A</span>
                    @endif
                </p>
            </div>
            <div class="otherlink">
                <h2>Other Articles from {{$article_info->cate_name}}</h2>
                <ul>
                    @foreach($others as $d)
                    <li><a href="{{url('article/'.$d->id)}}" title="{{$d->article_title}}">{{$d->article_title}}</a></li>
                    @endforeach
                </ul>
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

            <div class="blank"></div>
            <div class="news">
                @parent
            </div>
        </aside>
    </article>
@endsection
