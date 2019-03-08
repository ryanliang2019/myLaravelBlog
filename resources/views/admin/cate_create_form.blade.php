@extends('admin.layouts.admin_edge')
@section('content')


<!--Top Nav Start-->
<div class="crumb_warp">
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">Home</a> &raquo; Category Management
</div>
<!--End of Top Nav-->


<div class="result_wrap">
    <div class="result_title">
        <h3>Add Category</h3>
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
            <a href="{{url('admin/cate/create')}}"><i class="fa fa-plus"></i>Add Category</a>
            <a href="{{url('admin/cate')}}"><i class="fa fa-recycle"></i>Category List</a>
        </div>
    </div>
</div>


<div class="result_wrap">
    <form action="{{url('admin/cate')}}" method="post">
        {{csrf_field()}}

        <table class="add_tab">
            <tbody>
            <tr>
                <th width="200"><i class="require">*</i>Parent Category:</th>
                <td>
                    <select name="cate_pid">
                        <option value="0">==Top Category==</option>
                      @foreach($data as $d)
                        <option value="{{$d->id}}">{{$d->cate_name}}</option>
                      @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>Category Name:</th>
                <td>
                    <input type="text" name="cate_name">
                    <span><i class="fa fa-exclamation-circle yellow"></i>Category Name should be unique</span>
                </td>
            </tr>
            <tr>
                <th>Category Note:</th>
                <td>
                    <input type="text" class="lg" name="cate_note">
                </td>
            </tr>
            <tr>
                <th>Keywords:</th>
                <td>
                    <textarea name="cate_keywords"></textarea>
                </td>
            </tr>
            <tr>
                <th>Category Description:</th>
                <td>
                    <textarea name="cate_desc"></textarea>
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>Order:</th>
                <td>
                    <input type="text" class="sm" name="cate_order">
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
