@extends('home.layouts.home_outter')

@section('info')
    <title>{{$cate_info->cate_name}} - {{Config::get('myWebConfig._web_title_')}}</title>
    <meta name="keywords" content="{{$cate_info->cate_keywords}}" />
    <meta name="description" content="{{$cate_info->cate_desc}}" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
@endsection

@section('content')

  <!-- Page Header -->
  <header class="masthead" style="background-image: url({{asset('home/img/about-bg.jpg')}})">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading" style="padding: 100px 0;">
			<h1>{{$cate_info->cate_name}}</h1>
            <span class="subheading">{{$cate_info->cate_desc}}</span>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">

		<ol class="breadcrumb">
  			<li><a href="{{url('/')}}">Home</a></li>&nbsp;&nbsp;>>&nbsp;&nbsp;
  			<li><a href="{{url('cate/'.$cate_info->id)}}">{{$cate_info->cate_name}}</a></li>
		</ol>

		<div class="sub_cate">
		  @if($sub_cate->all())
            <div class="rnav">
                <ul>
                    @foreach($sub_cate as $k=>$s)
                    <li class="rnav{{$k+1}}"><a href="{{url('cate/'.$s->id)}}" target="_blank">{{$s->cate_name}}</a></li>
                    @endforeach
                </ul>
            </div>
          @endif
		</div>

		<div class="box" style="margin-top: 40px; margin-bottom: 20px">
        	<form class="form-inline mr-auto" action="{{url('search/cate/'.$cate_info->id)}}" method="post">
            	{{csrf_field()}}
            	<input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="search" style="width:100%; margin-bottom:20px;">
            	<button class="btn btn-outline-success btn-rounded btn-sm my-0" type="submit">&nbsp;Search "{{$cate_info->cate_name}}"&nbsp;</button>
        	</form>
    	</div>

	  @foreach($data as $d)
		<div class="post-preview">
			<a href="{{url('article/'.$d->id)}}">
				<h2 class="post-title">
					{{$d->article_title}}
				</h2>
				<h3 class="post-subtitle">
					{{$d->article_desc}}
				</h3>
			</a>
			<p class="post-meta">
				<span style="padding-right:30px;">By: {{$d->article_by}}</span> <span style="padding-right:30px;">On: {{$d->creation_date}}</span> <span>[Catergory: <a href="{{url('cate/'.$d->article_cate_id)}}">[{{$cate_info->cate_name}}]</a></span>
			</p>
		</div>
		<hr>

			<!--
            <h3>{{$d->article_title}}</h3>
            <figure><img src="@if(!empty($d->article_thumb)){url($d->article_thumb)}}@else{{url('gfx/ryan_logo.png')}}@endif"></figure>
            <ul>
                <p>{{$d->article_desc}}</p>
                <a title="{{$d->article_title}}" href="{{url('article/'.$d->id)}}" target="_blank" class="readmore">Read Article >></a>
            </ul>
            <p class="dateview" style="padding-left:35px;"><span style="margin-right:30px;">{{$d->creation_date}}</span><span>By: {{$d->article_by}}</span></p>
			-->

	  @endforeach
      	<div class="page" style="text-align:center;">
        	{{$data->links()}}
        </div>

      </div>
    </div>
  </div>

  <hr>

@endsection

