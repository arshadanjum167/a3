<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Http\Requests\Admin\Emailtemplate\StoreRequest;
use App\Http\Requests\Admin\Emailtemplate\UpdateRequest;
use Illuminate\Support\Facades\Input;
use App\Traits\Paginatable;
use Illuminate\Support\Facades\Auth;
use Session;
use Redirect;
use CommonFunction;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use Paginatable;

    public function index(Request $request)
    {

        $query=Blog::where('is_deleted',0);
        $searh_var=$request->input('search');
        $query->where(function($query1) use ($searh_var) {
        $query1->where('title', 'like', '%' . $searh_var . '%')
                ->orWhere('route_name', 'like', '%' . $searh_var . '%')
                // ->orWhere('slip_number', 'like', '%' . $searh_var . '%')
                ->orWhere('content', 'like', '%' . $searh_var . '%');
                // ->orWhereHas('marina', function($q) use ($searh_var) {
                //         $q->where('title', 'like', '%'.$searh_var.'%');
                // });
        });
        if ($request->has('read_count') && $request->input('read_count')!=null
           && $request->has('sort') && $request->input('sort')!=null) {
          $query->orderBy($request->input('read_count') ,$request->input('sort') );
        }
        else{
        $query->orderBy('id','DESC');
        }
        $data = $query->paginate($this->returnPageSize());
        return view('admin.blog.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['image']='/assets/img/no-image.png';
        return view('admin.blog.create',['model' => new Blog,'data'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request,Blog $model)
    {
      $data = $this->fillableFields($request);
      if ($request->hasFile('image') && $request->file('image')!='')
      {
      //   $old_image = public_path('/images/').$model->image;
      //   if(isset($old_image) && $old_image!='' && isset($model->image) && $model->image!='')
      //   {
      //     if(file_exists($old_image)) 
      //     { 
      //         unlink($old_image);
      //     }
      //   }
        $file = $request->file('image');
        $imageName=time().$file->getClientOriginalName();
        $value = CommonFunction::uploadImageonlocal($file,$imageName);
        // $value = CommonFunction::uploadImageInS3bucket($file,$imageName);
        
        $model->image=$value;
      }
      
      $model->fill($data);
      $model->i_by=Auth::guard('admin')->user()->id;
      $model->u_by=Auth::guard('admin')->user()->id;
      $model->i_date = date('Y-m-d H:i:s');
      $model->u_date = date('Y-m-d H:i:s');
      
      if($model->save())
      {
          $message=config('params.msg_success').'Blog successfully created !'.config('params.msg_end');
          $request->session()->flash('message',$message);
          return redirect()->route('admin.blog.index');
      }
      else {
          $message=config('params.msg_error').'Error in save !'.config('params.msg_end');
          $request->session()->flash('message',$message);
          return redirect()->route('admin.blog.index');
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
      $model=Blog::find($id);
      if(!$model)
      {
        $message=config('params.msg_error').'Blog not found !'.config('params.msg_end');
        $request->session()->flash('message',$message);
        return redirect()->route('admin.blog.index');
      }
      $data['image']='/assets/img/no-image.png';
      if($model->image!='')
      {
        $data['image']=$model->image;
      }
      return view('admin.blog.edit',['model' => $model,'data'=>$data]);
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
      $model=Blog::find($id);

      if(!$model)
      {
        $message=config('params.msg_error').'Blog not found !'.config('params.msg_end');

        $request->session()->flash('message',$message);
        return redirect()->route('admin.blog.index');
        // return Redirect::to(Input::get('redirects_to'));
      }
      $data = $this->fillableFields($request);
      $model->fill($data);
      // $key = str_replace(' ', '_', $data['title']);
      // $model->key = $key;
      $model->u_date = date('Y-m-d H:i:s');
      if($request->hasFile('image') && $request->file('image')!='')
      {
        $old_image = $model->image;
        
        if(isset($old_image) && $old_image!='' && isset($model->image) && $model->image!='')
        {
          
          $file_path=public_path('images').'/'.basename($old_image);
          // dd('aaabccb',file_exists($file_path)); 
          if(file_exists($file_path)) 
          {
              unlink($file_path);
          }
        }
        // dd('aaa',$old_image);
        $file = $request->file('image');
        $imageName=time().$file->getClientOriginalName();
        $value = CommonFunction::uploadImageonlocal($file,$imageName);
        // $value = CommonFunction::uploadImageInS3bucket($file,$imageName);
        
        $model->image=$value;
      }
      if($model->save())
      {
        $message=config('params.msg_success').'Blog successfully updated !'.config('params.msg_end');
        $request->session()->flash('message',$message);
        return redirect()->route('admin.blog.index');
        // return Redirect::to(Input::get('redirects_to'));
      }
      else {
        $message=config('params.msg_error').'Error in save !'.config('params.msg_end');
        $request->session()->flash('message',$message);
        return redirect()->route('admin.blog.index');
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
      $model=Blog::find($id);

      if(!$model)
      {
        $message=config('params.msg_error').'Blog not found !'.config('params.msg_end');

        $request->session()->flash('message',$message);
        // return redirect()->route('admin.blog.index');
        return Redirect::back();
      }
      $model->is_deleted = 1;
      $model->u_date = date('Y-m-d H:i:s');

      if($model->save())
      {
        $message=config('params.msg_success').'Blog successfully deleted !'.config('params.msg_end');
        $request->session()->flash('message',$message);
        // return redirect()->route('admin.blog.index');
        return Redirect::back();
      }
      else {
        $message=config('params.msg_error').'Error in save !'.config('params.msg_end');
        $request->session()->flash('message',$message);
        // return redirect()->route('admin.blog.index');
        return Redirect::back();
      }
    }

    private function fillableFields($request)
    {
        return $request->all();
    }

    public function statusChange(Request $request)
    {
      $model=Blog::find($request->query('id'));

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
