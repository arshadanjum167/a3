<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Casestudy;
use App\Http\Requests\Admin\Casestudy\StoreRequest;
use App\Http\Requests\Admin\Casestudy\UpdateRequest;
use Illuminate\Support\Facades\Input;
use App\Traits\Paginatable;
use Illuminate\Support\Facades\Auth;
use Session;
use Redirect;
use CommonFunction;

class CasestudyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use Paginatable;

    public function index(Request $request)
    {

        $query=Casestudy::where('is_deleted',0);
        $searh_var=$request->input('search');
        $query->where(function($query1) use ($searh_var) {
        $query1->where('title', 'like', '%' . $searh_var . '%')
                ->orWhere('description', 'like', '%' . $searh_var . '%');
                // ->orWhere('slip_number', 'like', '%' . $searh_var . '%')
                // ->orWhere('content', 'like', '%' . $searh_var . '%');
                // ->orWhereHas('marina', function($q) use ($searh_var) {
                //         $q->where('title', 'like', '%'.$searh_var.'%');
                // });
        });
        
        $query->orderBy('id','DESC');
    
        $data = $query->paginate($this->returnPageSize());
        return view('admin.casestudy.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        for($i=0; $i < 1; $i++){
          $data['image'][$i]='/assets/img/no-image.png';
          $data['isImageExist'][$i]=0;
        }
        $model = new Casestudy;
        return view('admin.casestudy.create',['model' => $model,'data'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request,Casestudy $model)
    {
      $data = $this->fillableFields($request);
      $model->fill($data);
      if($model->route_name == ''){
        $model->route_name = $model->title;
      }
      $model->type =1;
      $model->route_name=str_replace(' ', '-', strtolower($model->route_name));
      $model->i_by=Auth::guard('admin')->user()->id;
      $model->u_by=Auth::guard('admin')->user()->id;
      $model->i_date = date('Y-m-d H:i:s');
      $model->u_date = date('Y-m-d H:i:s');
      if ($request->hasFile('image') && $request->file('image')!='')
          {
            // $old_image = public_path('/images/').$model->image;
            // if(isset($old_image) && $old_image!='' && isset($model->image) && $model->image!='')
            // {
            //   if(file_exists($old_image)) 
            //   { 
            //       unlink($old_image);
            //   }
            // }
            for($i=0; $i < 1; $i++){
              if(isset($request->file('image')[$i]) && $request->file('image')[$i]!=''){
                $file = $request->file('image')[$i];
                $imageName=time().$file->getClientOriginalName();
                $value = CommonFunction::uploadImageonlocal($file,$imageName);
                // $value = CommonFunction::uploadImageInS3bucket($file,$imageName);
                
                $model->link=$value;
                
              }

            }
          }
      if($model->save())
      { 
          // if ($request->hasFile('image') && $request->file('image')!='')
          // {
          //   for($i=0; $i < config('params.project_image_count'); $i++){
          //     if(isset($request->file('image')[$i]) && $request->file('image')[$i]!=''){
          //       $file = $request->file('image')[$i];
          //       $imageName=time().$file->getClientOriginalName();
          //       $value = CommonFunction::uploadImageonlocal($file,$imageName);
          //       // $value = CommonFunction::uploadImageInS3bucket($file,$imageName);
          //       $media = new ProjectMedia;
          //       $media->project_id = $model->id;
          //       $media->type = 1;//1=image
          //       $media->link=$value;
          //       $media->i_by=Auth::guard('admin')->user()->id;
          //       $media->u_by=Auth::guard('admin')->user()->id;
          //       $media->i_date = date('Y-m-d H:i:s');
          //       $media->u_date = date('Y-m-d H:i:s');
          //       $media->save();
          //     }

          //   }
          // }
         
          $message=config('params.msg_success').'Case-study successfully created !'.config('params.msg_end');
          $request->session()->flash('message',$message);
          return redirect()->route('admin.case-study.index');
      }
      else {
          $message=config('params.msg_error').'Error in save !'.config('params.msg_end');
          $request->session()->flash('message',$message);
          return redirect()->route('admin.case-study.index');
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
      $model=Casestudy::find($id);
      if(!$model)
      {
        $message=config('params.msg_error').'Case-study not found !'.config('params.msg_end');
        $request->session()->flash('message',$message);
        return redirect()->route('admin.case-study.index');
      }
      
      
      for($i=0; $i <1; $i++){
        // echo "<pre>";
        
        $data['image'][$i]='/assets/img/no-image.png';
        $data['isImageExist'][$i]=0;
        
        // $data['image'][$i]=';';
        if(isset($model) && $model['link']!='')
        {
          $data['image'][$i]=$model['link'];
          $data['isImageExist'][$i]=1;
          $data['mediaId'][$i]=$model->id;
        }
        
      }
      // dd($data);
      return view('admin.casestudy.edit',['model' => $model,'data'=>$data]);
    }
    public function removeImage(Request $request)
    {
      // dd($request->input('media_id'));
      if($request->input('media_id') != '' &&  $request->input('project_id') != ''){
        $media=Casestudy::where(['is_deleted'=>0,'is_active'=>1])->where(['id'=>$request->input('media_id')])->first();
        if(isset($media) && $media!=''){
          $old_image = $media->link;
          $base_url = url('/'); // Dynamically fetch the base URL with a trailing slash
          $relative_path = str_replace($base_url, "", $old_image); // Remove base URL
          $old_image = public_path($relative_path); // Get the absolute path
          if(isset($old_image) && $old_image!='' && isset($media->link) && $media->link!='')
          {
            if(file_exists($old_image)) 
            { 
                unlink($old_image);
            }
          }
          $media->link=null;
          $media->u_by=Auth::guard('admin')->user()->id;
          $media->u_date = date('Y-m-d H:i:s');
          $media->save();
          return response()->json(['success' => true]);
        }else{
          return response()->json(['success' => false, 'message' => 'Image not found or could not be deleted.']);  
        }
      }else{
        return response()->json(['success' => false, 'message' => 'Image not found or could not be deleted.']);
      }

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
      $model=Casestudy::find($id);
      // dd($request->file('image'));
      if(!$model)
      {
        $message=config('params.msg_error').'Case-study not found !'.config('params.msg_end');

        $request->session()->flash('message',$message);
        return redirect()->route('admin.case-study.index');
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
      if ($request->hasFile('image') && $request->file('image')!='')
      {
        
        for($i=0; $i < 1; $i++){
          if(isset($request->file('image')[$i]) && $request->file('image')[$i]!=''){
            $file = $request->file('image')[$i];
            $imageName=time().$file->getClientOriginalName();
            $value = CommonFunction::uploadImageonlocal($file,$imageName);
            // $value = CommonFunction::uploadImageInS3bucket($file,$imageName);
            
            $model->type = 1;//1=image
            $model->link=$value;
            
          }

        }
      }
      if($model->save())
      {
        
        $message=config('params.msg_success').'Case-study successfully updated !'.config('params.msg_end');
        $request->session()->flash('message',$message);
        return redirect()->route('admin.case-study.index');
        // return Redirect::to(Input::get('redirects_to'));
      }
      else {
        $message=config('params.msg_error').'Error in save !'.config('params.msg_end');
        $request->session()->flash('message',$message);
        return redirect()->route('admin.case-study.index');
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
      $model=Casestudy::find($id);

      if(!$model)
      {
        $message=config('params.msg_error').'Case-study not found !'.config('params.msg_end');

        $request->session()->flash('message',$message);
        // return redirect()->route('admin.casestudy.index');
        return Redirect::back();
      }
      $model->is_deleted = 1;
      $model->u_date = date('Y-m-d H:i:s');

      if($model->save())
      {
        $message=config('params.msg_success').'Case-study successfully deleted !'.config('params.msg_end');
        $request->session()->flash('message',$message);
        // return redirect()->route('admin.casestudy.index');
        return Redirect::back();
      }
      else {
        $message=config('params.msg_error').'Error in save !'.config('params.msg_end');
        $request->session()->flash('message',$message);
        // return redirect()->route('admin.casestudy.index');
        return Redirect::back();
      }
    }

    private function fillableFields($request)
    {
        return $request->all();
    }

    public function statusChange(Request $request)
    {
      $model=Casestudy::find($request->query('id'));

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
