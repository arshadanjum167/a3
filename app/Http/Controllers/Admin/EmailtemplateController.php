<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Emailtemplate;
use App\Http\Requests\Admin\Emailtemplate\StoreRequest;
use App\Http\Requests\Admin\Emailtemplate\UpdateRequest;
use Illuminate\Support\Facades\Input;
use App\Traits\Paginatable;
use Session;
use Redirect;

class EmailtemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use Paginatable;

    public function index(Request $request)
    {

        $query=Emailtemplate::where('is_deleted',0);
        $query->orderBy('id','DESC');
        $data = $query->paginate($this->returnPageSize());
        return view('admin.emailtemplate.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     return view('admin.emailtemplates.create',['model' => new Emailtemplate]);
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request,Emailtemplate $model)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
      $model=Emailtemplate::find($id);
      if(!$model)
      {
        $message=config('params.msg_error').'Emailtemplate not found !'.config('params.msg_end');
        $request->session()->flash('message',$message);
        return redirect()->route('admin.emailtemplates.index');
      }
      return view('admin.emailtemplate.edit',['model' => $model]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
      $model=Emailtemplate::find($id);

      if(!$model)
      {
        $message=config('params.msg_error').'Emailtemplate not found !'.config('params.msg_end');

        $request->session()->flash('message',$message);
        return redirect()->route('admin.emailtemplates.index');
        // return Redirect::to(Input::get('redirects_to'));
      }
      $data = $this->fillableFields($request);
      $model->fill($data);
      $key = str_replace(' ', '_', $data['title']);
      $model->key = $key;
      $model->u_date = date('Y-m-d H:i:s');

      if($model->save())
      {
        $message=config('params.msg_success').'Emailtemplate successfully updated !'.config('params.msg_end');
        $request->session()->flash('message',$message);
        return redirect()->route('admin.emailtemplates.index');
        // return Redirect::to(Input::get('redirects_to'));
      }
      else {
        $message=config('params.msg_error').'Error in save !'.config('params.msg_end');
        $request->session()->flash('message',$message);
        return redirect()->route('admin.emailtemplates.index');
        // return Redirect::to(Input::get('redirects_to'));
      }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
      $model=Emailtemplate::find($id);

      if(!$model)
      {
        $message=config('params.msg_error').'Emailtemplate not found !'.config('params.msg_end');

        $request->session()->flash('message',$message);
        // return redirect()->route('admin.emailtemplates.index');
        return Redirect::back();
      }
      $model->is_deleted = 1;
      $model->u_date = date('Y-m-d H:i:s');

      if($model->save())
      {
        $message=config('params.msg_success').'Emailtemplate successfully deleted !'.config('params.msg_end');
        $request->session()->flash('message',$message);
        // return redirect()->route('admin.emailtemplates.index');
        return Redirect::back();
      }
      else {
        $message=config('params.msg_error').'Error in save !'.config('params.msg_end');
        $request->session()->flash('message',$message);
        // return redirect()->route('admin.emailtemplates.index');
        return Redirect::back();
      }
    }

    private function fillableFields($request)
    {
        return $request->all();
    }

    // public function statusChange(Request $request)
    // {
    //   $model=Emailtemplate::find($request->query('id'));

    //   if(!$model)
    //   {
    //     return response(0);
    //   }
    //   $model->is_active = $request->query('status');
    //   $model->u_date = date('Y-m-d H:i:s');

    //   if($model->save())
    //   {
    //     return response(1);
    //   }
    //   else {
    //     return response(0);
    //   }
    // }
}
