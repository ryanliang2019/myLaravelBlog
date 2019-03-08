<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use App\Http\Models\Logins;


class IndexController extends CommonController
{
    public function index() {
		return view('admin.index');
	}

	public function info() {
        return view('admin.info');
    }

	public function updatePwd() {
		$input = Input::all();

		if($input){
			$username = Session::get('username');	

			$rules = array(
        		'o_password'		=> 'required|exists:logins,real_pass,username,'.$username,
        		'n_password'		=> 'required|between:4,20|confirmed',
    		);

			$error_msg = array(
				'o_password.required'	=> 'Please enter old password',
				'o_password.exists'   	=> 'Old password does not match with user: '.$username,
				'n_password.required'	=> 'Please enter New password',
				'n_password.between'	=> 'New password should be between 4 - 20 charactors',
				'n_password.confirmed'	=> 'Confirm New Password is not match',
			);

			$validator = Validator::make($input, $rules, $error_msg);

			if($validator->fails()){
				return back()->withErrors($validator);
    		}else{
				$user = Logins::where('username', $username)->first();
				if(!$user){
					return "Did you login correctly?";
            	}else{
					$user->real_pass = $input['n_password'];
					$user->password = Crypt::encrypt($input['n_password']);
					$user->save();

					return '<h2 style="margin-top:50; margin-left:50px; color:green;">New password is save successfully. <a href="/blog/admin/info">Go Back</a></h2>';
            	}

			}
		}		

		return view('admin.pwdUpdate');
	}
	
}
