@extends('admin.layouts.admin_edge')
@section('content')


<!--Top Nav Start-->
<div class="crumb_warp">
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">Home</a> &raquo; Website Configuration Management
</div>
<!--End of Top Nav-->


    <div class="result_wrap">
        <div class="result_title">
            <h3>Configuration List</h3>
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
                <a href="{{url('admin/config/create')}}"><i class="fa fa-plus"></i>Add Configuration</a>
                <a href="{{url('admin/config')}}"><i class="fa fa-recycle"></i>Configuration List</a>
            </div>
        </div>

    </div>

    <div class="result_wrap">
        <div class="result_content">
            <form action="{{url('admin/config/updateContent')}}" method="post">
                {{csrf_field()}}
            <table class="list_tab">
                <tr>
                    <th class="tc" width="5%">Order</th>
                    <th class="tc" width="5%">ID</th>
                    <th>Name</th>
					<th>Title</th>
                    <th>Content</th>
                    <th>Operation</th>
                </tr>

                @foreach($data as $v)
                <tr>
                    <td class="tc">
                        <input type="text" onchange="changeOrder(this,{{$v->id}})" value="{{$v->config_order}}">
                    </td>
                    <td class="tc">{{$v->id}}</td>
					<td>{{$v->config_name}}</td>
                    <td>
                        <a href="#">{{$v->config_title}}</a>
                    </td>
                    <td>
                        <input type="hidden" name="config_id[]" value="{{$v->id}}">
                        {!! $v->_html !!}
                    </td>
                    <td>
                        <a href="{{url('admin/config/'.$v->id.'/edit')}}">Update</a>
                        <a href="javascript:;" onclick="deleteConfig({{$v->id}})">Delete</a>
                    </td>
                </tr>
                @endforeach
            </table>
	
            <div class="btn_group">
                <input type="submit" value="Submit">
                <input type="button" class="back" onclick="history.go(-1)" value="Return" >
            </div>

            </form>
        </div>
    </div>


<script>
    function changeOrder(obj,config_id){
		var config_order = $(obj).val();
        $.post(
            "{{url('admin/config/updateOrder')}}",
            {
                '_token':'{{csrf_token()}}',
                'config_id':config_id,
                'config_order':config_order
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

    function deleteConfig(config_id) {
		layer.confirm('Please confirm you want to DELETE ID# ' + config_id, {
            btn: ['Yes','Cancel']
        }, function(){
            $.post(
                "{{url('admin/config/')}}/"+config_id,
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
                alert('Sorry, something is wrong with [deleteConfig]');
                //layer.msg('Sorry, something is wrong with [changeOrder]', {icon: 5});
            });
        }, function(){

        });
    }



</script>

@endsection
