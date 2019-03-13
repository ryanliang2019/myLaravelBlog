<!DOCTYPE html>

@if(Config::get('myWebConfig._web_status_')==='N')
	{{exit('<h2>be back soon!</h2>')}}
@endif

<html lang="en">

<head>

  <meta charset="utf-8">

  @yield('info')

  <!-- Bootstrap core CSS -->
  <link href="{{asset('helper/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="{{asset('helper/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

  <!-- Custom styles for this template -->
  <link href="{{asset('home/css/clean-blog.min.css')}}" rel="stylesheet">
  <link href="{{asset('home/css/home-blog.css')}}" rel="stylesheet">

  <script type='text/javascript'>
	{!! Config::get('myWebConfig._tracking_code_') !!}
  </script>
</head>

<body>

<header>
  <!--Nvigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <div id="logo">
        <a class="navbar-brand" href="{{url('/')}}"></a>
      </div>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto topnav">
          @foreach($navs as $k=>$v)
            <li class="nav-item">
                <a class="nav-link" href="{{$v->nav_url}}" style="padding:0px; margin:0px;"><span style="font-size:18px;">{{$v->nav_name}}</span><span class="en" style="font-size:16px;">{{$v->nav_alias}}</span></a>
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  </nav>
</header>

@section('content')
@show

  <!-- Footer -->
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">

          <!--
          <ul class="list-inline text-center">
            <li class="list-inline-item">
              <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
            <li class="list-inline-item">
              <a href="#">
                <span class="fa-stack fa-lg">
                  <i class="fas fa-circle fa-stack-2x"></i>
                  <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                </span>
              </a>
            </li>
          </ul>
          -->

          @include('home.social_share')

		  <p>{!! Config::get('myWebConfig._copy_right_') !!}</p>

        </div>
      </div>
    </div>
  </footer>


  <!-- Bootstrap core JavaScript -->
  <script src="{{asset('helper/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('helper/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Custom scripts for this template -->
  <script src="{{asset('home/js/clean-blog.min.js')}}"></script>

</body>

</html>





