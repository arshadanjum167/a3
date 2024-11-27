<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectMedia;
use App\Http\Requests\Admin\Project\StoreRequest;
use App\Http\Requests\Admin\Project\UpdateRequest;
use Illuminate\Support\Facades\Input;
use App\Traits\Paginatable;
use Illuminate\Support\Facades\Auth;
use Session;
use Redirect;
use CommonFunction;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use Paginatable;

    public function index(Request $request)
    {

        $query=Project::where('is_deleted',0);
        $searh_var=$request->input('search');
        $query->where(function($query1) use ($searh_var) {
        $query1->where('title', 'like', '%' . $searh_var . '%')
                ->orWhere('address', 'like', '%' . $searh_var . '%');
                // ->orWhere('slip_number', 'like', '%' . $searh_var . '%')
                // ->orWhere('content', 'like', '%' . $searh_var . '%');
                // ->orWhereHas('marina', function($q) use ($searh_var) {
                //         $q->where('title', 'like', '%'.$searh_var.'%');
                // });
        });
        
        $query->orderBy('id','DESC');
    
        $data = $query->paginate($this->returnPageSize());
        return view('admin.project.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['image']='/assets/img/no-image.png';
        return view('admin.project.create',['model' => new Project,'data'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request,Project $model)
    {
      $data = $this->fillableFields($request);
      // if ($request->hasFile('image') && $request->file('image')!='')
      // {
      // //   $old_image = public_path('/images/').$model->image;
      // //   if(isset($old_image) && $old_image!='' && isset($model->image) && $model->image!='')
      // //   {
      // //     if(file_exists($old_image)) 
      // //     { 
      // //         unlink($old_image);
      // //     }
      // //   }
      //   $file = $request->file('image');
      //   $imageName=time().$file->getClientOriginalName();
      //   $value = CommonFunction::uploadImageonlocal($file,$imageName);
      //   // $value = CommonFunction::uploadImageInS3bucket($file,$imageName);
        
      //   $model->image=$value;
      // }
      
      $model->fill($data);
      if($model->route_name == ''){
        $model->route_name = $model->title;
      }
      $model->route_name=str_replace(' ', '-', strtolower($model->route_name));
      $model->i_by=Auth::guard('admin')->user()->id;
      $model->u_by=Auth::guard('admin')->user()->id;
      $model->i_date = date('Y-m-d H:i:s');
      $model->u_date = date('Y-m-d H:i:s');
      
      if($model->save())
      {
          $message=config('params.msg_success').'Project successfully created !'.config('params.msg_end');
          $request->session()->flash('message',$message);
          return redirect()->route('admin.project.index');
      }
      else {
          $message=config('params.msg_error').'Error in save !'.config('params.msg_end');
          $request->session()->flash('message',$message);
          return redirect()->route('admin.project.index');
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
      $model=Project::find($id);
      if(!$model)
      {
        $message=config('params.msg_error').'Project not found !'.config('params.msg_end');
        $request->session()->flash('message',$message);
        return redirect()->route('admin.project.index');
      }
      $data['image']='/assets/img/no-image.png';
      if($model->image!='')
      {
        $data['image']=$model->image;
      }
      return view('admin.project.edit',['model' => $model,'data'=>$data]);
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
      $model=Project::find($id);

      if(!$model)
      {
        $message=config('params.msg_error').'Project not found !'.config('params.msg_end');

        $request->session()->flash('message',$message);
        return redirect()->route('admin.project.index');
        // return Redirect::to(Input::get('redirects_to'));
      }
      $data = $this->fillableFields($request);
      $model->fill($data);
      // $key = str_replace(' ', '_', $data['title']);
      // $model->key = $key;
      $model->u_by=Auth::guard('admin')->user()->id;
      $model->u_date = date('Y-m-d H:i:s');
      if($model->route_name == ''){
        $model->route_name = $model->title;
      }
      $model->route_name=str_replace(' ', '-', strtolower($model->route_name));
      // if($request->hasFile('image') && $request->file('image')!='')
      // {
      //   $old_image = $model->image;
        
      //   if(isset($old_image) && $old_image!='' && isset($model->image) && $model->image!='')
      //   {
          
      //     $file_path=public_path('images').'/'.basename($old_image);
      //     // dd('aaabccb',file_exists($file_path)); 
      //     if(file_exists($file_path)) 
      //     {
      //         unlink($file_path);
      //     }
      //   }
      //   // dd('aaa',$old_image);
      //   $file = $request->file('image');
      //   $imageName=time().$file->getClientOriginalName();
      //   $value = CommonFunction::uploadImageonlocal($file,$imageName);
      //   // $value = CommonFunction::uploadImageInS3bucket($file,$imageName);
        
      //   $model->image=$value;
      // }
      if($model->save())
      {
        $message=config('params.msg_success').'Project successfully updated !'.config('params.msg_end');
        $request->session()->flash('message',$message);
        return redirect()->route('admin.project.index');
        // return Redirect::to(Input::get('redirects_to'));
      }
      else {
        $message=config('params.msg_error').'Error in save !'.config('params.msg_end');
        $request->session()->flash('message',$message);
        return redirect()->route('admin.project.index');
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
      $model=Project::find($id);

      if(!$model)
      {
        $message=config('params.msg_error').'Project not found !'.config('params.msg_end');

        $request->session()->flash('message',$message);
        // return redirect()->route('admin.project.index');
        return Redirect::back();
      }
      $model->is_deleted = 1;
      $model->u_date = date('Y-m-d H:i:s');

      if($model->save())
      {
        $message=config('params.msg_success').'Project successfully deleted !'.config('params.msg_end');
        $request->session()->flash('message',$message);
        // return redirect()->route('admin.project.index');
        return Redirect::back();
      }
      else {
        $message=config('params.msg_error').'Error in save !'.config('params.msg_end');
        $request->session()->flash('message',$message);
        // return redirect()->route('admin.project.index');
        return Redirect::back();
      }
    }

    private function fillableFields($request)
    {
        return $request->all();
    }

    public function statusChange(Request $request)
    {
      $model=Project::find($request->query('id'));

      if(!$model)
      {
        return response(0);
      }
      $model->is_active = $request->query('status');
      $model->u_date = date('Y-m-d H:i:s');

      if($model->save())
      {
        return response(1);
      }
      else {
        return response(0);
      }
    }
}
