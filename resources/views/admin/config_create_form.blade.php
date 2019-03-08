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
    <form action="{{url('admin/config')}}" method="post">
        {{csrf_field()}}

        <table class="add_tab">
            <tbody>
            <tr>
                <th><i class="require">*</i>Config Name:</th>
                <td>
                    <input type="text" name="config_name">
                    <span><i class="fa fa-exclamation-circle yellow"></i>This field must be unique</span>
                </td>
            </tr>
			<tr>
                <th><i class="require">*</i>Config Title:</th>
                <td>
                    <input type="text" name="config_title">
                    <span><i class="fa fa-exclamation-circle yellow"></i>This field must be unique</span>
                </td>
            </tr>
            <tr>
                <th>Type:</th>
                <td>
                    <input type="radio" name="field_type" value="input" checked onclick="showTr()">input　
                    <input type="radio" name="field_type" value="textarea" onclick="showTr()">textarea　
                    <input type="radio" name="field_type" value="radio" onclick="showTr()">radio
                </td>
            </tr>
            <tr class="field_note_box">
                <th>Type Value:</th>
                <td>
                    <input type="text" class="lg" name="field_note">
                    <p><i class="fa fa-exclamation-circle yellow"></i>value|status (example: Y|ON,N|OFF)</p>
                </td>
            </tr>
            <tr>
                <th>Order:</th>
                <td>
                    <input type="text" class="sm" name="config_order" value="0">
                </td>
            </tr>
            <tr>
                <th>Note:</th>
                <td>
                    <textarea id="" cols="30" rows="10" name="conf_note"></textarea>
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
<script>
    showTr();
    function showTr() {
        var type = $('input[name=field_type]:checked').val();
        if(type=='radio'){
            $('.field_note_box').show();
        }else{
            $('.field_note_box').hide();
        }
    }
</script>
@endsection
