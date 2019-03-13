<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::any('admin/login', 'Admin\LoginController@login');
Route::get('admin/login/ver_code', function(){
	include_once('../resources/helper/code/Code.class.php');
	$code = new Code();
	$code->make();
});

Route::group(
	[
		'middleware'=> ['loginCheck'],	//apply middleware 'loginCheck' to this route group
		'prefix'	=> 'admin',			//add 'admin/' to url of this route group
		'namespace'	=> 'Admin',			//add 'Admin\' to this route group
	], function(){
		Route::get('index', 'IndexController@index');
		Route::get('info', 'IndexController@info');
		Route::get('logout', 'LoginController@logout');
		Route::any('updatePwd', 'IndexController@updatePwd');

		Route::resource('cate', 'CateController');
		Route::post('cate/updateOrder', 'CateController@updateOrder');

		Route::resource('article', 'ArticleController');
		Route::post('article/uploadArticleImg', 'ArticleController@saveImg');

		//Route::any('uploadImg', 'CommonController@uploadImg');

		Route::resource('link', 'LinkController');
		Route::post('link/updateOrder', 'LinkController@updateOrder');

		Route::get('navs', function(){
			return "<h2>this part is temporarily done on Home - CommonController</h2>";
		});

		Route::resource('config', 'ConfigController');
		Route::post('config/updateContent', 'ConfigController@updateContent');
		Route::post('config/updateOrder', 'ConfigController@updateOrder');
	}
);

Route::group(
	[
		'namespace' => 'Home',			//add 'Home\' to this route group
	], function(){
		Route::get('/', 'IndexController@index');
		Route::get('/cate/{id}', 'IndexController@list_cate');
		Route::get('/article/{id}', 'IndexController@view_article');

		Route::any('/search/all', 'IndexController@search_all');
		Route::any('/search/cate/{id}', 'IndexController@search_cate');
	}
);


Route::get('/get_encript', function () {
	echo Illuminate\Support\Facades\Crypt::encrypt(Request::get('pass'));
});

Route::get('/test', function () {
    //echo base_path();
	//Storage::disk('local')->put('file.txt', 'Contents');
});

