<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Category;
use Illuminate\Support\Facades\Session;
use App\Http\Models\Logins;
use Illuminate\Support\Facades\Input;
use App\Http\Models\Article;
use Illuminate\Support\Facades\Validator;

class ArticleController extends CommonController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //[get] admin/article

		$article = new Article();

		$articles = $article->orderBy('id', 'desc')->paginate(10);

		return view('admin.article_list')->with(['data' => $articles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //[get] admin/article/create

		$categorys = Category::orderBy('cate_order')->get();

        //re-arrange categorys list by parent_id
        $categorys_n = array();
        foreach($categorys as $k => $v){
            if($v->cate_pid ==0){
                $categorys_n[] = $v;
                foreach($categorys as $kk => $vv){
                    if($v->id == $vv->cate_pid){
                        $categorys_n[] = $vv;
                    }
                }
            }
        }


		$user = Session::get('username');
		$logins = new Logins();
		$login = $logins->where('username', $user)->get();

		return view('admin.article_create_form')->with(['data' => $categorys_n, 'login'=>$login[0]]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //[post] admin/article 
	
		$input = Input::except('_token');

        $input['article_title']		= isset($input['article_title']) ? $input['article_title'] : '';
        $input['article_cate_id']	= isset($input['article_cate_id']) ? $input['article_cate_id'] : 0;
        $input['article_keywords']	= isset($input['article_keywords']) ? $input['article_keywords'] : '';
		$input['article_desc']  	= isset($input['article_desc']) ? $input['article_desc'] : '';
        $input['article_thumb']		= isset($input['article_thumb']) ? $input['article_thumb'] : '';
        $input['article_content']	= isset($input['article_content']) ? $input['article_content'] : '';
        $input['article_by']		= isset($input['article_by']) ? $input['article_by'] : 'Unknown';

		$input['creation_date']     = date('Y-m-d H:i:s');

        if($input){

            $rules = array(
                'article_title' => 'required|unique:article,article_title',
            );

            $error_msg = array(
                'article_title.required'    => 'Article Title is required',
                'article_title.unique'      => 'this Article Title is already existed',
            );

            $validator = Validator::make($input, $rules, $error_msg);

            if($validator->fails()){
                return back()->withErrors($validator);
            }else{
                $res = Article::create($input);
                return redirect('/admin/article');
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //[get] admin/article/{{$id}}/edit

		$categorys = Category::orderBy('cate_order')->get();

        //re-arrange categorys list by parent_id
        $categorys_n = array();
        foreach($categorys as $k => $v){
            if($v->cate_pid ==0){
                $categorys_n[] = $v;
                foreach($categorys as $kk => $vv){
                    if($v->id == $vv->cate_pid){
                        $categorys_n[] = $vv;
                    }
                }
            }
        }


		$article = Article::find($id);

        return view('admin.article_edit_form')->with(['data' => $categorys_n, 'article' => $article]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //[PUT] 'admin/article/{{$id}}'

		$input = Input::except('_token', '_method');

        $input['article_title']     = isset($input['article_title']) ? $input['article_title'] : '';
        $input['article_cate_id']   = isset($input['article_cate_id']) ? $input['article_cate_id'] : 0;
        $input['article_keywords']  = isset($input['article_keywords']) ? $input['article_keywords'] : '';
        $input['article_desc']      = isset($input['article_desc']) ? $input['article_desc'] : '';
        $input['article_thumb']     = isset($input['article_thumb']) ? $input['article_thumb'] : '';
        $input['article_content']   = isset($input['article_content']) ? $input['article_content'] : '';
        $input['article_by']        = isset($input['article_by']) ? $input['article_by'] : 'Unknown';

        $input['last_update']     = date('Y-m-d H:i:s');

        if($input){

            $rules = array(
                'article_title' => 'required',
            );

            $error_msg = array(
                'article_title.required'    => 'Article Title is required',
            );

            $validator = Validator::make($input, $rules, $error_msg);

            if($validator->fails()){
                return back()->withErrors($validator);
            }else{
				if ( count(Article::where([['id', '!=', $id],['article_title', $input['article_title']]])->get()) > 0 ){
                    return back()->with('errors', 'Article Title already taken');
                }else{
					$res = Article::where('id', $id)->update($input);

					if($res==1) {
                        return '<h2 style="margin-top:50; margin-left:50px; color:green;">Article is updated successfully. <a href="/blog/admin/article">Go Back</a></h2>';
                    }else{
                        return back()->with('errors', 'Something went wrong while updating Article');
                    }

				}
            }
        }
		
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //[DELETE] /admin/article/{id}

		$result = 0;

        $article = new Article();
        $record = $article->find($id);
        $result = $record->delete();

        if($result==1) {
            $data = array(
                'status'=> 'success',
                'msg'   => 'Article (ID#:'.$id.') is deleted : )',
            );
        }else{
            $data = array(
                'status'=> 'fail',
                'msg'   => 'Article (ID#:'.$id.') deletion failed : (',
            );
        }

        return $data;
    }


	public function saveImg(Request $request){
		$validation = Validator::make($request->all(), [
      		'select_file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
     	]);
     
		if($validation->passes()){
      		$image = $request->file('select_file');
      		//$new_name = rand() . '.' . $image->getClientOriginalExtension();
			$new_name = $image->getClientOriginalName();

      		$image->move(public_path('/admin/uploads/img'), $new_name);
			$src = '/blog/admin/uploads/img/';
      		return response()->json([
				'status' => 'success',
       			'message'   => 'Image Upload Successfully',
       			'uploaded_image' => '<img src="'.$src.$new_name.'" class="img-thumbnail" width="300" />',
				'src' => $src.$new_name,
       			'class_name'  => 'alert-success'
      		]);
     	}else{
      		return response()->json([
				'status' => 'failed',
       			'message'   => $validation->errors()->all(),
       			'uploaded_image' => '',
				'src' => '',
       			'class_name'  => 'alert-danger'
      		]);
     	}
	}
}
