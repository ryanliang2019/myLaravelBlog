<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Link;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class LinkController extends CommonController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //[GET] /admin/link
	
		$links = Link::orderBy('link_order')->get();

        return view('admin.link_list')->with('data', $links);	
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //[GET] /admin/link/create
		return "In Dev...";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //[GET] /admin/link/{id}/edit/
		return "In Dev...";
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //[DELETE] url: '/admin/link/{id}'

        $result = 0;

        $links = new Link();
        $record = $links->find($id);

        $result = $record->delete();

        if($result==1) {
            $data = array(
                'status'=> 'success',
                'msg'   => 'Link (ID#:'.$id.') is deleted : )',
            );
        }else{
            $data = array(
                'status'=> 'fail',
                'msg'   => 'Link (ID#:'.$id.') deletion failed : (',
            );
        }

        return $data;
    }

	public function UpdateOrder(){

        $result = 0;

        $input = Input::all();

        $links = new Link();
        $record = $links->find($input['link_id']);
        $record->link_order = $input['link_order'];
        $result = $record->save();

        if($result) {
            $data = array(
                'status'=> 'success',
                'msg'   => 'Link Order (ID#: '.$input['link_id'].') is updated : )',
            );
        }else{
            $data = array(
                'status'=> 'fail',
                'msg'   => 'Link Order (ID#: '.$input['link_id'].') updat failed : (',
            );
        }

        return $data;
    }
}
