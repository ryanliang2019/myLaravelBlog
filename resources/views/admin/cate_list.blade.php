@extends('admin.layouts.admin_edge')
@section('content')

<!--Top Nav Start-->
<div class="crumb_warp">
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">Home</a> &raquo; Category Management
</div>
<!--End of Top Nav-->


<form action="#" method="post">
    <div class="result_wrap">
        <div class="result_title">
            <h3>Category List</h3>
        </div>
        <!--Quick Navi Start-->
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/cate/create')}}"><i class="fa fa-plus"></i>Add Category</a>
                <a href="{{url('admin/cate')}}"><i class="fa fa-recycle"></i>Category List</a>
            </div>
        </div>
        <!--End of Quick Navi-->
    </div>

    <div class="result_wrap">
        <div class="result_content">
            <table class="list_tab">
                <tr>
                    <th class="tc" width="5%">Order</th>
                    <th class="tc" width="5%">ID</th>
                    <th>Category Name</th>
                    <th>Category Note</th>
                    <th>Category Description</th>
                    <th>Operation</th>
                </tr>

                @foreach($data as $v)
                <tr>
                    <td class="tc">
                        <input type="text" onchange="changeOrder(this,{{$v->id}})" value="{{$v->cate_order}}">
                    </td>
                    <td class="tc">{{$v->id}}</td>
                    <td>
                        <a href="#">@if($v->cate_pid!=0)&#8594;@endif {{$v->cate_name}}</a>
                    </td>
                    <td>{{$v->cate_note}}</td>
                    <td>{{$v->cate_desc}}</td>
                    <td>
                        <a href="{{url('admin/cate/'.$v->id.'/edit')}}">Update</a>
                        <a href="javascript:;" onclick="deleteCate({{$v->id}})">Delete</a>
                    </td>
                </tr>
                @endforeach
            </table>

        </div>
    </div>
</form>


<script>
    function changeOrder(obj,cate_id){
        var cate_order = $(obj).val();
        $.post(
			"{{url('admin/cate/updateOrder')}}",
			{
				'_token':'{{csrf_token()}}',
				'cate_id':cate_id,
				'cate_order':cate_order
			}
		)
		.done(function(response){
            if(response.status == 'success'){
               	layer.msg(response.msg, {icon: 6});
           	}else{
               	layer.msg(response.msg, {icon: 5});
           	}
       	})
		.fail(function(xhr, status, error) {
       		alert('Sorry, something is wrong with [changeOrder]');
			//layer.msg('Sorry, something is wrong with [changeOrder]', {icon: 5});
    	});
    }

 
    function deleteCate(cate_id) {
        layer.confirm('Please confirm you want to DELETE ID# ' + cate_id, {
            btn: ['Yes','Cancel']
        }, function(){
            $.post(
				"{{url('admin/cate/')}}/"+cate_id,
				{
					'_method':'delete',
					'_token':"{{csrf_token()}}"
				}
			)
			.done(function (response) {
                if(response.status == 'success'){
                    layer.msg(response.msg, {icon: 6});
					//location.href = location.href;
					setTimeout(function(){
						location.href = location.href;
					}, 1000);
                }else{
                    layer.msg(response.msg, {icon: 5});
                }
            })
			.fail(function(xhr, status, error) {
            	alert('Sorry, something is wrong with [deleteCate]');
            	//layer.msg('Sorry, something is wrong with [changeOrder]', {icon: 5});
        	});
        }, function(){

        });
    }



</script>

@endsection
