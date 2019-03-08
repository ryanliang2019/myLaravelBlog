<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

//LoginController is in the same directory as CommonController, so we don't need this
//use App\Http\Controllers\Admin\CommonController;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use App\Http\Models\Logins;

class LoginController extends CommonController
{
	public function login(){
		
		$input = Input::all();

		if($input){
			include_once('../resources/helper/code/Code.class.php');

			//check loging_code
			$code = new \Code();
            $stored_code = $code->get();

			if(strtolower($input['login_code'])!=strtolower($stored_code)){
				return back()->with('msg', 'Code does NOT match!');
			}


			//check login_user and login_password
			$user = Logins::where('username', $input['login_user'])->first();
			if(!$user){
				return back()->with('msg', 'user does NOT exist!');
			}elseif($input['login_pass']!=Crypt::decrypt($user->password)){
				return back()->with('msg', 'password is NOT correct!');
			}

			Session::put('username', $input['login_user']);

			return redirect('admin/index');
		}else{
			return view('admin.login');
		}
	}

	public function logout(){
        Session::forget('username');
        return redirect('admin/logout');
    }

}
