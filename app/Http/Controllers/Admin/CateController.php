<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Category;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CateController extends CommonController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		//list all categorys, url: '/admin/cate'

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

		return view('admin.cate_list')->with('data', $categorys_n);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //create new category, url: '/admin/cate/create'

		$first_level_cate = Category::where('cate_pid', 0)->get();

		return view('admin.cate_create_form', ['data'=>$first_level_cate]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //insert into category, [post] url: '/admin/cate'

		$input = Input::except('_token');

		$input['cate_name'] 	= isset($input['cate_name']) ? $input['cate_name'] : '';
		$input['cate_note'] 	= isset($input['cate_note']) ? $input['cate_note'] : '';
		$input['cate_keywords'] = isset($input['cate_keywords']) ? $input['cate_keywords'] : '';
		$input['cate_desc'] 	= isset($input['cate_desc']) ? $input['cate_desc'] : '';
		$input['cate_order'] 	= isset($input['cate_order']) ? $input['cate_order'] : '';
		$input['cate_pid']  	= isset($input['cate_pid']) ? $input['cate_pid'] : '';

        if($input){

            $rules = array(
                'cate_pid'	=> 'required|numeric',
                'cate_name'	=> 'required|between:1,50|unique:category,cate_name',
				'cate_order'=> 'required|numeric',
            );

            $error_msg = array(
                'cate_pid.required'		=> 'Parent Category is required',
                'cate_pid.numeric'		=> 'Parent Category format is incorrect',
                'cate_name.required'	=> 'Category Name is required',
                'cate_name.between'		=> 'Category Name is 50 charactors Max',
				'cate_name.unique'     	=> 'this Category Name is already existed',
				'cate_order.required'   => 'Order is required',
                'cate_order.numeric'    => 'Order format is incorrect',
            );

            $validator = Validator::make($input, $rules, $error_msg);

            if($validator->fails()){
                return back()->withErrors($validator);
            }else{
				$res = Category::create($input);

				return redirect('/admin/cate');	
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
        //show detail of a category by id, url: '/admin/cate/{id}'
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		
        //edit category by id, url: '/admin/cate/{id}/edit'

		$cate_info = Category::find($id);

		$first_level_cate = Category::where('cate_pid', 0)->get();

        return view('admin.cate_edit_form', ['cate_info'=>$cate_info, 'data'=>$first_level_cate]);

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
        //update a category, [PUT|PATCH] url: '/admin/cate/{id}'
		$input = Input::except('_token', '_method');

        $input['cate_name']     = isset($input['cate_name']) ? $input['cate_name'] : '';
        $input['cate_note']     = isset($input['cate_note']) ? $input['cate_note'] : '';
        $input['cate_keywords'] = isset($input['cate_keywords']) ? $input['cate_keywords'] : '';
        $input['cate_desc']     = isset($input['cate_desc']) ? $input['cate_desc'] : '';
        $input['cate_order']    = isset($input['cate_order']) ? $input['cate_order'] : '';
        $input['cate_pid']      = isset($input['cate_pid']) ? $input['cate_pid'] : '';

        if($input){

            $rules = array(
                'cate_pid'  => 'required|numeric',
                'cate_name' => 'required|between:1,50',
                'cate_order'=> 'required|numeric',
            );

            $error_msg = array(
                'cate_pid.required'     => 'Parent Category is required',
                'cate_pid.numeric'      => 'Parent Category format is incorrect',
                'cate_name.required'    => 'Category Name is required',
                'cate_name.between'     => 'Category Name is 50 charactors Max',
                'cate_name.unique'      => 'this Category Name is already existed',
                'cate_order.required'   => 'Order is required',
                'cate_order.numeric'    => 'Order format is incorrect',
            );

            $validator = Validator::make($input, $rules, $error_msg);

			$category = new Category();

            if($validator->fails()){
                return back()->withErrors($validator);
            }else{

				if ( count($category::where([['id', '!=', $id],['cate_name', $input['cate_name']]])->get()) > 0 ){
					return back()->with('errors', 'Category Name already taken');
				}else{
					$res = $category->where('id', $id)->update($input);
				
					if($res==1) {
						return '<h2 style="margin-top:50; margin-left:50px; color:green;">Category Info is updated successfully. <a href="/blog/admin/cate">Go Back</a></h2>';	
					}else{
						return back()->with('errors', 'Something went wrong while updating Category Info');
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
        //remove a category, [DELETE] url: '/admin/cate/{id}'

		$result = 0;

		$categorys = new Category();
		$record = $categorys->find($id);

		$record_children = $categorys->where('cate_pid', $id);
		$record_children->update(['cate_pid' => 0]);

		$result = $record->delete();

		if($result==1) {
            $data = array(
                'status'=> 'success',
                'msg'   => 'Category (ID#: '.$id.') is deleted : )',
            );
        }else{
            $data = array(
                'status'=> 'fail',
                'msg'   => 'Category (ID#: '.$id.') deletion failed : (',
            );
        }

		return $data;
    }

	public function UpdateOrder(){
		$result = 0;

		$input = Input::all();

		$categorys = new Category();
		$record = $categorys->find($input['cate_id']);
		$record->cate_order = $input['cate_order'];
		$result = $record->save();

		if($result) {
			$data = array(
				'status'=> 'success',
				'msg'	=> 'Category Order (ID#: '.$input['cate_id'].') is updated : )',
			);
		}else{
			$data = array(
                'status'=> 'fail',
                'msg'   => 'Category Order (ID#: '.$input['cate_id'].') updat failed : (',
            );
		}

		return $data;
	}
}
