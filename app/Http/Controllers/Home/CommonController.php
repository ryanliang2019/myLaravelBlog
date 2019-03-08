<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\View;
use App\Http\Models\Article;

class CommonController extends Controller
{
    public function __construct(){
	
		//Top Navigation	
		$navs_arr = array();
		$navs_arr[0] = (object) [];
		$navs_arr[0]->nav_url 	= 'http://52.91.245.179/blog/cate/12';
		$navs_arr[0]->nav_name 	= 'Laravel';
		$navs_arr[0]->nav_alias	= 'Laravel Notes';
		$navs_arr[1] = (object) [];
		$navs_arr[1]->nav_url   = 'http://52.91.245.179/blog/cate/18';
        $navs_arr[1]->nav_name  = 'ES6';
        $navs_arr[1]->nav_alias = 'ECMAScript 6';
		View::share('navs', $navs_arr);

		//Most Views on the right side
        //get the top 5 articles with most views
        $hot = Article::orderBy('article_views', 'desc')->limit(6)->get();
		View::share('hot', $hot);

		//Most Recent on the right side
		//get the 8 most recently added articles
		$new = Article::orderBy('creation_date', 'desc')->limit(8)->get();
		View::share('new', $new);		
	}
}
