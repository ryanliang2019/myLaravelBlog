@extends('admin.layouts.admin_edge')
@section('content')


<!--Top Start-->
<div class="top_box">
	<div class="top_left">
		<div class="logo">Backend Management</div>
		<ul>
			<li><a href="{{url('/')}}" target="_blank" class="active">Main Page</a></li>
			<li><a href="{{url('admin/info')}}" target="main">Management Page</a></li>
		</ul>
	</div>
	<div class="top_right">
		<ul>
			<li>
				Who are you: 
			  @if(Session::has('username'))
    			{{ Session::get('username') }}
			  @else
				??
			  @endif
			</li>
			<li><a href="{{url('admin/updatePwd')}}" target="main">Change Password</a></li>
			<li><a href="{{url('admin/logout')}}">Exit</a></li>
		</ul>
	</div>
</div>
<!--End of Tap-->


<!--Left Nav Start-->
<div class="menu_box">
	<ul>
		<li>
			<h3><i class="fa fa-fw fa-clipboard"></i>Content</h3>
			<ul class="sub_menu">
				<li><a href="{{url('admin/cate/create')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>Add Category</a></li>
				<li><a href="{{url('admin/cate')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>Category List</a></li>
				<li><a href="{{url('admin/article/create')}}" target="main"><i class="fa fa-fw fa-plus-square"></i>Add Article</a></li>
				<li><a href="{{url('admin/article')}}" target="main"><i class="fa fa-fw fa-list-ul"></i>Artile List</a></li>
			</ul>
		</li>
		<li>
			<h3><i class="fa fa-fw fa-cog"></i>System Setting</h3>
			<ul class="sub_menu" style="display: block;">
				<li><a href="{{url('admin/link')}}" target="main"><i class="fa fa-fw fa-cubes"></i>Links</a></li>
				<li><a href="{{url('admin/navs')}}" target="main"><i class="fa fa-fw fa-navicon"></i>Navigation</a></li>
				<li><a href="{{url('admin/config')}}" target="main"><i class="fa fa-fw fa-cogs"></i>Config</a></li>
			</ul>
		</li>
	</ul>
</div>
<!--End of Left Nav-->


<!--Main Start-->
<div class="main_box">
	<iframe src="{{url('admin/info')}}" frameborder="0" width="100%" height="100%" name="main"></iframe>
</div>
<!--End of Main-->


<!--Bottom Start-->
<div class="bottom_box">
	<a href="http://52.91.245.179/blog">http://52.91.245.179/blog</a>
</div>
<!--End of Bottom-->

@endsection


