@extends('admin.layouts.admin_edge')
@section('content')
<!--Top Nav Start-->
<div class="crumb_warp">
    <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">Home</a> &raquo; Change Password
</div>
<!--End of Top Nav-->

<div class="result_wrap">
    <div class="result_title">
        <h3>Change Password</h3>
        @if(count($errors)>0)
            <div class="mark">
                @if(is_object($errors))
                    @foreach($errors->all() as $error)
                        <p style="color:red;">-- {{$error}}</p>
                    @endforeach
                @else
                    <p>{{$errors}}</p>
                @endif
            </div>
        @endif
    </div>
</div>

<div class="result_wrap">
    <form method="post" action="">
        {{csrf_field()}}

        <table class="add_tab">
            <tbody>
            <tr>
                <th width="200"><i class="require">*</i>Old Password:</th>
                <td>
                    <input type="password" name="o_password"> </i>Enter the old password</span>
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>New Password:</th>
                <td>
                    <input type="password" name="n_password"> </i>Enter the new password 4-20 charactors</span>
                </td>
            </tr>
            <tr>
                <th><i class="require">*</i>Confirm New Password:</th>
                <td>
                    <input type="password" name="n_password_confirmation"> </i>Enter the new password again</span>
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
