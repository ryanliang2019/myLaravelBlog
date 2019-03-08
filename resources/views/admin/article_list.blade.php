@extends('admin.layouts.admin_edge')
@section('content')


<!--Top Nav Start-->
<div class="crumb_warp">
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">Home</a> &raquo; Article Management
</div>
<!--End of Top Nav-->


<form action="#" method="post">
    <div class="result_wrap">
        <div class="result_title">
            <h3>Article List</h3>
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/article/create')}}"><i class="fa fa-plus"></i>Add Article</a>
                <a href="{{url('admin/article')}}"><i class="fa fa-recycle"></i>Article List</a>
            </div>
        </div>
    </div>

    <div class="result_wrap">
        <div class="result_content">
            <table class="list_tab">
                <tr>
                    <th class="tc">ID</th>
                    <th>Artitle Title</th>
                    <th>Category ID</th>
                    <th>Create By</th>
                    <th>creation Time</th>
                    <th>Operation</th>
                </tr>
                @foreach($data as $v)
                <tr>
                    <td class="tc">{{$v->id}}</td>
                    <td>
                        <a href="#">{{$v->article_title}}</a>
                    </td>
                    <td>{{$v->article_cate_id}}</td>
                    <td>{{$v->article_by}}</td>
                    <td>{{$v->creation_date}}</td>
                    <td>
                        <a href="{{url('admin/article/'.$v->id.'/edit')}}">Edit</a>
                        <a href="javascript:;" onclick="deleteArticle({{$v->id}})">Delete</a>
                    </td>
                </tr>
                @endforeach
            </table>

            <div class="page_list" style="text-align:center;">
                {{$data->links()}}
            </div>
        </div>
    </div>
</form>


<style>
    .result_content ul li span {
        font-size: 15px;
        padding: 6px 12px;
    }
</style>

<script>
    function deleteArticle(art_id) {
        layer.confirm('Please confirm to delete article ID# '+art_id, {
            btn: ['Yes', 'Cancel']
        }, function(){
            $.post(
				"{{url('admin/article/')}}/"+art_id,
				{
					'_method':'delete',
					'_token':"{{csrf_token()}}"
				}
			)
			.done(function (response) {
                if(response.status == 'success'){
                    //location.href = location.href;
                    layer.msg(response.msg, {icon: 6});
					setTimeout(function(){
                        location.href = location.href;
                    }, 1000);
                }else{
                    layer.msg(response.msg, {icon: 5});
                }
            })
			.fail(function(xhr, status, error) {
                alert('Sorry, something is wrong with [deleteArticle]');
                //layer.msg('Sorry, something is wrong with [changeOrder]', {icon: 5});
            });
        }, function(){

        });
    }
</script>

@endsection
