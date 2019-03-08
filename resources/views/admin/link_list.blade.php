@extends('admin.layouts.admin_edge')
@section('content')

<!--Top Nav Start-->
<div class="crumb_warp">
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">Home</a> &raquo; Links Management
</div>
<!--End of Top Nav-->


<form action="#" method="post">
    <div class="result_wrap">
        <div class="result_title">
            <h3>Link List</h3>
        </div>
        <!--Quick Navi Start-->
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/link/create')}}"><i class="fa fa-plus"></i>Add Link</a>
                <a href="{{url('admin/link')}}"><i class="fa fa-recycle"></i>Link List</a>
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
                    <th>Link Name</th>
                    <th>Link Title</th>
                    <th>Link URL</th>
                    <th>Operation</th>
                </tr>

                @foreach($data as $v)
                <tr>
                    <td class="tc">
                        <input type="text" onchange="changeOrder(this,{{$v->id}})" value="{{$v->link_order}}">
                    </td>
                    <td class="tc">{{$v->id}}</td>
                    <td>
                        <a href="#">{{$v->link_name}}</a>
                    </td>
                    <td>{{$v->link_title}}</td>
                    <td>{{$v->lnk_url}}</td>
                    <td>
                        <a href="{{url('admin/link/'.$v->id.'/edit')}}">Update</a>
                        <a href="javascript:;" onclick="deleteLink({{$v->id}})">Delete</a>
                    </td>
                </tr>
                @endforeach
            </table>

        </div>
    </div>
</form>


<script>
    function changeOrder(obj,link_id){
        var link_order = $(obj).val();
        $.post(
			"{{url('admin/link/updateOrder')}}",
			{
				'_token':'{{csrf_token()}}',
				'link_id':link_id,
				'link_order':link_order
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

 
    function deleteLink(link_id) {
        layer.confirm('Please confirm you want to DELETE ID# ' + link_id, {
            btn: ['Yes','Cancel']
        }, function(){
            $.post(
				"{{url('admin/link/')}}/"+link_id,
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
            	alert('Sorry, something is wrong with [deleteLink]');
            	//layer.msg('Sorry, something is wrong with [changeOrder]', {icon: 5});
        	});
        }, function(){

        });
    }



</script>

@endsection
