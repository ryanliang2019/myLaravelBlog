@extends('home.layouts.home_outter')

@section('info')
    <title>{{$article_info->article_title}} - {{Config::get('myWebConfig._web_title_')}}</title>
    <meta name="keywords" content="{{$article_info->article_keywords}}" />
    <meta name="description" content="{{$article_info->article_desc}}" />
@endsection

@section('content')
  <!-- Page Header -->
  <header class="masthead" style="background-image: url({{asset('home/img/post-bg.jpg')}})">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading" style="padding: 100px 0;">
            <h1>Article</h1>
            <span class="subheading"></span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="">
    <div class="row">
      <div class="col-lg-10 col-md-12 mx-auto">

	  	<ol class="breadcrumb">
            <li><a href="{{url('/')}}">Home</a></li>&nbsp;&nbsp;>>&nbsp;&nbsp;
            <li><a href="{{url('cate/'.$article_info->article_cate_id)}}">{{$article_info->cate_name}}</a></li>
        </ol>

		<div class="index_about">
            <h2 class="c_titile">{{$article_info->article_title}}</h2>
			<p class="post-meta" style="border: #ccc 1px dashed; text-align: center;">
                <span style="padding-right:30px;">By: {{$article_info->article_by}}</span> <span style="padding-right:30px;">On: {{$article_info->creation_date}}</span> <span style="padding-right:30px;">View: {{$article_info->article_views}}</span>
            </p>

            <ul class="infos">
                <style>
                    p{
                        font-family: Consolas,monaco,monospace;
                        font-size: 16px;
 						margin: 0px;
                    }
					.keybq{
						margin-top: 20px;
						padding-left: 40px;
						border: 1px solid #F0F0F0;
						margin-right: 20px;
						background: url({{asset('gfx/tag_6264.png')}}) 10px center no-repeat;
					}
					.keybq span{
						color: #099;
					}
					.nextinfo p{
						margin-top: 20px;
						color: #756F71;
					}
					.otherlink h2{
						margin-top: 20px;
						border-bottom: #099 2px solid;
						background: url({{asset('gfx/book_5794.png')}}) 10px center no-repeat;
    					padding-left: 40px;
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



	  </div>
    </div>
  </div>

  <hr>


@endsection
