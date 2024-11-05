<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Paginatable;
use App\Models\Cmspage;
use Illuminate\Support\Facades\Auth;
use Redirect;
use Session;
class CmspageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use Paginatable;

    public function index()
    {
      if(Session::has('cms'))
          Session::put('cms',"");
        $model=Cmspage::where('is_deleted',0)
        ->orderBy('id','DESC')->paginate($this->returnPageSize());
        return view('admin.cmspages.index',['model'=>$model]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function show($id,Request $request)
    {
      $model=Cmspage::find($id);
      if(!$model)
      {
          $message=config('params.msg_error').'Cms Page not found !'.config('params.msg_end');
          $request->session()->flash('message',$message);
          return redirect()->route('admin.cmspages.index');
      }
      return view('admin.cmspages.show',['model'=>$model]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $model=Cmspage::find($id);
      if(!$model)
      {
          $message=config('params.msg_error').'Cms Page not found !'.config('params.msg_end');
          $request->session()->flash('message',$message);
          return redirect()->route('admin.cmspages.index');
      }
      return view('admin.cmspages.edit',['model' => $model]);
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
      $model=Cmspage::find($id);

      if(!$model)
      {
          $message=config('params.msg_error').'Cms Page not found !'.config('params.msg_end');
          $request->session()->flash('message',$message);
          return redirect()->route('admin.cmspages.index');
      }

      $model->description=$request->input('description');
      $model->name=$request->input('name');
      $model->u_by=Auth::guard('admin')->user()->id;
      $model->u_date = date('Y-m-d H:i:s');
      if($model->save())
      {
          $message=config('params.msg_success').'Cms Page successfully updated !'.config('params.msg_end');
          $request->session()->flash('message',$message);
          if($request->session()->has('cms') && $request->session()->get('cms') != "")
          {
            return Redirect::to($request->session()->get('cms'));
          }
          else {
              // return redirect()->route('admin.gpstracking.index');
              return redirect()->route('admin.cmspages.index');
          }
      }
      else {
          $message=config('params.msg_error').'Error in save !'.config('params.msg_end');
          $request->session()->flash('message',$message);
          return redirect()->route('admin.cmspages.index');
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
        //
    }
}
