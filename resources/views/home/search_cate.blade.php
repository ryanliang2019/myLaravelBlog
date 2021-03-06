@extends('home.layouts.home_outter')

@section('info')
	<title>Search - {{Config::get('myWebConfig._web_title_')}}</title>
    <meta name="keywords" content="{{$search}}" />
    <meta name="description" content="" />
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
			<h1>Search {{$cate_info->cate_name}}</h1>
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
  			<li><a href="{{url('/')}}">Home</a></li>
		</ol>

		@if($msg)
            <h2>{{$msg}}</h2>
        @endif

		<div class="box" style="margin-bottom: 20px; ">
            <form class="form-inline mr-auto" action="{{url('search/cate/'.$cate_info->id)}}" method="post">
                {{csrf_field()}}
                <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="search" style="width:100%; margin-bottom:20px;" value="@if(isset($search)){{$search}}@endif">
                <button class="btn btn-outline-success btn-rounded btn-sm my-0" type="submit">Search {{$cate_info->cate_name}}</button>
            </form>
            <hr/>
        </div>


	  @if(count($data)>=1)
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
                <span style="padding-right:30px;">By: {{$d->article_by}}</span> <span style="padding-right:30px;">On: {{$d->creation_date}}</span> <span>[Catergory: <a href="{{url('cate/'.$d->article_cate_id)}}">{{$d->cate_name}}]</a></span>
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
		  @if(isset($search))
        	{{$data->appends(['search' => $search])->links()}}
		  @else
			{{$data->links()}}
		  @endif
        </div>
	  @endif

      </div>
    </div>
  </div>

  <hr>

@endsection

