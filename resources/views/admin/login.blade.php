<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<!--link rel="stylesheet" href="{{ asset('css/app.css') }}"-->
	<link rel="stylesheet" href="{{ asset('admin/style/css/ch-ui.admin.css') }}">
	<link rel="stylesheet" href="{{ asset('admin/style/font/css/font-awesome.min.css') }}">
</head>
<body style="background:#F3F3F4;">
	<div class="login_box">
		<h1>Blog</h1>
		<h2>Welcome! Thanks for using my blog management system</h2>
		<div class="form">
		  @if(session('msg'))
			<p style="color:red">{{session('msg')}}</p>
		  @endif

			<form action="" method="post">
				{{csrf_field()}}

				<ul>
					<li>
					<input type="text" name="login_user" class="text" placeholder="User Name"/>
						<span><i class="fa fa-user"></i></span>
					</li>
					<li>
						<input type="password" name="login_pass" class="text" placeholder="Password"/>
						<span><i class="fa fa-lock"></i></span>
					</li>
					<li>
						<input type="text" class="code" name="login_code" placeholder="Code"/>
						<span><i class="fa fa-check-square-o"></i></span>
						<img src="{{ url('admin/login/ver_code') }}" alt="" onclick="this.src='{{ url('admin/login/ver_code') }}?'+Math.random()">
					</li>
					<li>
						<input type="submit" value="Login"/>
					</li>
				</ul>
			</form>
			<p>
				<a href="#">Back to main page</a>
				<a href="http://52.91.245.179/blog" target="_blank">http://52.91.245.179/blog</a>
			</p>
		</div>
	</div>
</body>
</html>
