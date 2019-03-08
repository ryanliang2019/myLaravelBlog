<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Models\Configuration;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ConfigController extends CommonController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //list all Configration, url: '/admin/config'

        $configurations = Configuration::orderBy('config_order')->get();

		//convert config_content
		foreach($configurations as $k => $v){
			switch($v->field_type){
				case 'input':
					$configurations[$k]->_html = '<input type="text" class="lg" name="config_content['.$v->id.']" value="'.$v->config_content.'">';
					break;
				case 'textarea':
					$configurations[$k]->_html = '<textarea type="text" class="md" name="config_content['.$v->id.']">'.$v->config_content.'</textarea>';
                    break;
				case 'radio':
					$options = explode(',', $v->field_note);
					$str = '';
					foreach($options as $kk=>$vv){
                        $arr = explode('|', $vv);
                        $copy = ($v->config_content==$arr[0])?' checked ':'';
                        $str .= '<input type="radio" name="config_content['.$v->id.']" value="'.$arr[0].'"'.$copy.'>'.$arr[1].'　';
                    }
                    $configurations[$k]->_html = $str;
                    break;
			}
		}

        return view('admin.config_list')->with('data', $configurations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //create new configuration, url: '/admin/config/create'

        return view('admin.config_create_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //insert into configuration, [post] url: '/admin/config'

        $input = Input::except('_token');

        $input['config_name']	= isset($input['config_name']) ? $input['config_name'] : '';
        $input['config_title']	= isset($input['config_title']) ? $input['config_title'] : '';
        $input['conf_note']		= isset($input['conf_note']) ? $input['conf_note'] : '';
        $input['config_order']	= isset($input['config_order']) ? $input['config_order'] : 0;
        $input['field_type']	= isset($input['field_type']) ? $input['field_type'] : '';
        $input['field_note']	= isset($input['field_note']) ? $input['field_note'] : '';

        if($input){

            $rules = array(
				'config_name'   => 'required|unique:configuration,config_name',
				'config_title'  => 'required|unique:configuration,config_title',
				'field_type'	=> 'required|in:input,textarea,radio',
                'config_order'	=> 'required|numeric',
            );

            $error_msg = array(
				'config_name.required'  => 'Config Name is required',
                'config_name.unique'    => 'this Config Name is already existed',
                'config_title.required'	=> 'Config Title is required',
				'config_title.unique'	=> 'this Config Title is already existed',
                'field_type.required'   => 'Type is required',
				'field_type.in'   		=> 'Type value is incorrect',
				'config_order.required'	=> 'Order is required',
                'config_order.numeric'	=> 'Order format is incorrect',
            );

            $validator = Validator::make($input, $rules, $error_msg);

            if($validator->fails()){
                return back()->withErrors($validator);
            }else{
                $res = Configuration::create($input);

                return redirect('/admin/config');
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
        //
		echo "In Dev...";
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
		//$this->writeToConfigFolder('myWebConfig.php');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //remove a config, [DELETE] url: '/admin/config/{id}'

        $result = 0;

        $configurations = new Configuration();
        $record = $configurations->find($id);

        $result = $record->delete();

        if($result) {
			$this->writeToConfigFolder('myWebConfig.php');

            $data = array(
                'status'=> 'success',
                'msg'   => 'Config (ID#: '.$id.') is deleted : )',
            );
        }else{
            $data = array(
                'status'=> 'fail',
                'msg'   => 'Config (ID#: '.$id.') deletion failed : (',
            );
        }

        return $data;
    }


	public function updateOrder() {
		$result = 0;

        $input = Input::all();

        $configurations = new Configuration();
        $record = $configurations->find($input['config_id']);
        $record->config_order = $input['config_order'];
        $result = $record->save();

        if($result==1) {
            $data = array(
                'status'=> 'success',
                'msg'   => 'Config Order (ID#: '.$input['config_id'].') is updated : )',
            );
        }else{
            $data = array(
                'status'=> 'fail',
                'msg'   => 'Config Order (ID#: '.$input['config_id'].') updat failed : (',
            );
        }

        return $data;
	}

	public function updateContent(){
		
		$input = Input::except('_token');

		foreach($input['config_id'] as $k=>$v){
			$content = isset($input['config_content'][$v]) ? $input['config_content'][$v] : '';
            Configuration::find($v)->update(['config_content'=>$content]);
        }

        $this->writeToConfigFolder('myWebConfig.php');

        return back()->with('errors','Configuration update successfully!');
	}

	public function writeToConfigFolder($fileName){
		$configuration = new Configuration();
		$configurations = $configuration->all();

		$config = $configurations->pluck('config_content','config_name')->all();
        $path = base_path().'/config/'.$fileName;

        $str = '<?php return '.var_export($config, true).';';
        file_put_contents($path, $str);
	}
}
