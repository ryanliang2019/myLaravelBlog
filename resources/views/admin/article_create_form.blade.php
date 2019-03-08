@extends('admin.layouts.admin_edge')
@section('content')


<!--Top Nav Start-->
<div class="crumb_warp">
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">Home</a> &raquo; Article Management
</div>
<!--End of Top Nav-->


<div class="result_wrap">
    <div class="result_title">
        <h3>Add Atricle</h3>
        @if(count($errors)>0)
            <div class="mark">
                @if(is_object($errors))
                    @foreach($errors->all() as $error)
                        <p>{{$error}}</p>
                    @endforeach
                @else
                    <p>{{$errors}}</p>
                @endif
            </div>
        @endif
    </div>
    <div class="result_content">
        <div class="short_wrap">
            <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>Add Atricle</a>
            <a href="{{url('admin/article')}}"><i class="fa fa-recycle"></i>Atricle List</a>
        </div>
    </div>
</div>


<div class="result_wrap">
	<form method="post" id="upload_form" enctype="multipart/form-data">
    	{{ csrf_field() }}
        
		<table class="table add_tab">
        <tr>
			<th width="120">Image:</th>
			<td>
				<input type="file" name="select_file" id="select_file" />
				<input type="submit" name="upload" id="upload" class="btn btn-primary" value="Upload">
				<span class="text-muted">jpg, png, gif</span>
			</td>
		</tr>
		<tr>
			<th width="120"></th>
			<td>
				<span id="uploaded_image"></span>
			</td>
		</tr>
       	</table>

        <script type="text/javascript">

        $('#upload_form').on('submit', function(event){
        	event.preventDefault();
            $.ajax({
                                    url:"{{url('admin/article/uploadArticleImg')}}",
                                    method:"POST",
                                    data:new FormData(this),
                                    dataType:'JSON',
                                    contentType: false,
                                    cache: false,
                                    processData: false,
                                    success:function(data){
                                        //alert(data);
										if(data.status=='success'){
   											$('#uploaded_image').html(data.uploaded_image);
											$('#article_thumb').val(data.src);
                                    	}
									}
            });
       	});
    	</script>
	</form>

    <form action="{{url('admin/article')}}" method="post">
        {{csrf_field()}}

        <table class="add_tab">
            <tbody>
            <tr>
                <th width="120">Category:</th>
                <td>
                    <select name="article_cate_id">
						<option value="0">=Please Select=</option>
                        @foreach($data as $d)
                        <option value="{{$d->id}}">@if($d->cate_pid!=0)&#8594;@endif {{$d->cate_name}}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>Title:</th>
                <td>
                    <input type="text" class="lg" name="article_title">
                </td>
            </tr>
            <tr>
                <th>Post By:</th>
                <td>
                    <input type="text" class="sm" name="article_by" value="{{$login->fname}} {{$login->lname}}" readonly>
                </td>
            </tr>
            <tr>
                <th>Keywords</th>
                <td>
                    <input type="text" class="lg" name="article_keywords">
                </td>
            </tr>
            <tr>
                <th>Description:</th>
                <td>
                    <textarea name="article_desc"></textarea>
                </td>
            </tr>

            <tr>
                <th>Content:</th>
                <td>
					<!--
                    <script type="text/javascript" charset="utf-8" src="{{asset('admin/assist/ueditor/ueditor.config.js')}}"></script>
                    <script type="text/javascript" charset="utf-8" src="{{asset('admin/assist/ueditor/ueditor.all.min.js')}}"> </script>
                    <script type="text/javascript" charset="utf-8" src="{{asset('admin/assist/ueditor/lang/zh-cn/zh-cn.js')}}"></script>
                    <script id="editor" name="article_content" type="text/plain" style="width:860px;height:500px;"></script>
                    <script type="text/javascript">
                        var ue = UE.getEditor('editor');
                    </script>
                    <style>
                        .edui-default{line-height: 28px;}
                        div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
                        {overflow: hidden; height:20px;}
                        div.edui-box{overflow: hidden; height:22px;}
                    </style>
					-->
					<textarea name="article_content" id="article_content" style="width:860px;height:500px;"></textarea>
					<script src="{{asset('admin/assist/nicEdit/nicEdit.js')}}" type="text/javascript"></script>
					<script type="text/javascript">
						area2 = new nicEditor({fullPanel : true, iconsPath:"{{asset('admin/assist/nicEdit/nicEditorIcons.gif')}}"}).panelInstance('article_content');
					</script>	
                </td>
            </tr>

			<tr>
				<th></th>
				<td>
					<input type="hidden" name="article_thumb" id='article_thumb' readonly>
				</td>
			</tr>

            <tr>
                <th></th>
                <td>
                    <input type="submit" value="Submit">
                    <input type="button" class="back" onclick="history.go(-1)" value="Return">
                </td>
            </tr>
            </tbody>
        </table>
    </form>
</div>

@endsection
