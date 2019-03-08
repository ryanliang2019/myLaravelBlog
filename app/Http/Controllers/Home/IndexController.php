<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Article;
use App\Http\Models\Link;
use App\Http\Models\Category;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class IndexController extends CommonController
{
	public function index(){

        //get the most recently added articles, with paginatione(5)
        $data = Article::orderBy('id', 'desc')->paginate(5);

		//get all the links
		$links = Link::get();

		return view('home.index')->with(['data'=>$data, 'links'=>$links]);
	}

	public function list_cate($id){
		$category_tb = new Category();
		$cate_info = $category_tb->find($id);

		$article_tb = new Article();
		$data = $article_tb->where('article_cate_id', $id)->orderBy('id', 'desc')->paginate(5);

		$sub_cate = $category_tb->where('cate_pid', $id)->orderBy('cate_order', 'asc')->get();

		return view('home.cate_list')->with(['cate_info'=>$cate_info, 'data'=>$data, 'sub_cate'=>$sub_cate]);
	}

	public function view_article($id){
		$article_tb = new Article();
		$category_tb = new Category();

		//$article_info = $article_tb->find($id);
		$article_info = $article_tb->Join('category', 'article.article_cate_id', '=', 'category.id')->find($id);

		$article_pre = $article_tb->where('id', '<', $id)->orderBy('id', 'desc')->first();
		$article_next = $article_tb->where('id', '>', $id)->orderBy('id', 'asc')->first();

		$others = $article_tb->where('article_cate_id', '=', $article_info->article_cate_id)->where('id', '!=', $id)->orderBy('id', 'desc')->take(6)->get();

		//update the views numbers of this article
        $article_tb->find($id)->increment('article_views', 1);

		return view('home.article_view')->with(['article_info'=>$article_info, 'article_pre'=>$article_pre, 'article_next'=>$article_next, 'others'=>$others]);
	}

	public function search_all(){
		$search = Input::get('search');

		if(trim($search)==''){
			$msg = 'You search for an empty string';
			return view('home.search_all')->with(['msg'=>$msg, 'data'=>array(), 'search'=>$search]);
		}

		$arr = explode(',', $search);

		$article_tb = new Article();

		$result = $article_tb->Join('category', 'article.article_cate_id', '=', 'category.id');
		foreach($arr as $k => $v){
			$result = $result->orWhere('article.article_keywords', 'like', '%'.trim($v).'%');
		}
		$result = $result->paginate(5);

		$msg = count($result).' results are found for "'.$search.'"';
		return view('home.search_all')->with(['msg'=>$msg, 'data'=>$result, 'search'=>$search]);
	}

	public function search_cate($id){
		$category_tb = new Category();
        $cate_info = $category_tb->find($id);

		$search = Input::get('search');

		if(trim($search)==''){
            $msg = 'You search for an empty string';
            return view('home.search_all')->with(['msg'=>$msg, 'data'=>array(), 'search'=>$search, 'cate_info'=>$cate_info]);
        }

		$arr = explode(',', $search);

        $article_tb = new Article();

        $result = $article_tb->Join('category', 'article.article_cate_id', '=', 'category.id');
        foreach($arr as $k => $v){
            $result = $result->orWhere('article.article_keywords', 'like', '%'.trim($v).'%');
        }
        $result = $result->where('article.article_cate_id', '=', $id)->paginate(5);

        $msg = count($result).' results are found for "'.$search.'"';
        return view('home.search_cate')->with(['msg'=>$msg, 'data'=>$result, 'search'=>$search, 'cate_info'=>$cate_info]);
	}
}
