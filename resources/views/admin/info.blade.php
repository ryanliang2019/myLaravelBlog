@extends('admin.layouts.admin_edge')
@section('content')

        
<!--Top Nav Start-->
<div class="crumb_warp">
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">Home</a> &raquo; System Info
</div>
<!--End of Top Nav-->

<!--
<div class="result_wrap">
    <div class="result_title">
        <h3>Quick Operation</h3>
    </div>
    <div class="result_content">
        <div class="short_wrap">
            <a href="#"><i class="fa fa-plus"></i>New Article</a>
            <a href="#"><i class="fa fa-recycle"></i>Batch Deletion</a>
            <a href="#"><i class="fa fa-refresh"></i>Edit Sorting</a>
        </div>
    </div>
</div>
-->


<div class="result_wrap">
    <div class="result_title">
        <h3>System Info</h3>
    </div>
    <div class="result_content">
        <ul>
            <li>
                <label>Operation System:</label><span>{{PHP_OS}}</span>
            </li>
            <li>
                <label>Running environment:</label><span>{{$_SERVER['SERVER_SOFTWARE']}}</span>
            </li>
            <li>
                <label>Version:</label><span>v-1.0</span>
            </li>
            <li>
                <label>Max Upload File Size:</label><span><?php echo get_cfg_var ("upload_max_filesize")?get_cfg_var ("upload_max_filesize"):"Do not allow file upload"; ?></span>
            </li>
            <li>
                <label>System Time:</label><span><?php echo date('Y-m-d H:i:s')?></span>
            </li>
            <li>
                <label>Domain/IP:</label><span>{{$_SERVER['SERVER_NAME']}} [ {{$_SERVER['SERVER_ADDR']}} ]</span>
            </li>
            <li>
                <label>Host:</label><span>{{$_SERVER['SERVER_ADDR']}}</span>
            </li>
        </ul>
    </div>
</div>


<div class="result_wrap">
    <div class="result_title">
        <h3>Help</h3>
    </div>
    <div class="result_content">
        <ul>
            <li>
                <label>Email:</label><span><a href="mailto:itryanliang@gmail.com" target="_blank">itryanliang@gmail.com</a></span>
            </li>
        </ul>
    </div>
</div>
@endsection
