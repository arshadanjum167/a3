<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use App\Http\Requests\Admin\Testimonial\StoreRequest;
use App\Http\Requests\Admin\Testimonial\UpdateRequest;
use Illuminate\Support\Facades\Input;
use App\Traits\Paginatable;
use Illuminate\Support\Facades\Auth;
use Session;
use Redirect;
use CommonFunction;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use Paginatable;

    public function index(Request $request)
    {

        $query=Testimonial::where('is_deleted',0);
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
        return view('admin.testimonial.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $model = new Testimonial;
        return view('admin.testimonial.create',['model' => $model]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request,Testimonial $model)
    {
      $data = $this->fillableFields($request);
      $model->fill($data);
      if($model->route_name == ''){
        $model->route_name = $model->title;
      }
      $model->type =2;
      $model->route_name=str_replace(' ', '-', strtolower($model->route_name));
      $model->i_by=Auth::guard('admin')->user()->id;
      $model->u_by=Auth::guard('admin')->user()->id;
      $model->i_date = date('Y-m-d H:i:s');
      $model->u_date = date('Y-m-d H:i:s');
      
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
         
          $message=config('params.msg_success').'Testimonial successfully created !'.config('params.msg_end');
          $request->session()->flash('message',$message);
          return redirect()->route('admin.testimonial.index');
      }
      else {
          $message=config('params.msg_error').'Error in save !'.config('params.msg_end');
          $request->session()->flash('message',$message);
          return redirect()->route('admin.testimonial.index');
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
      $model=Testimonial::find($id);
      if(!$model)
      {
        $message=config('params.msg_error').'Testimonial not found !'.config('params.msg_end');
        $request->session()->flash('message',$message);
        return redirect()->route('admin.testimonial.index');
      }
      // $media=ProjectMedia::where(['is_deleted'=>0,'is_active'=>1])->where(['project_id'=>$model->id])->get()->toArray();
      
      // for($i=0; $i < config('params.project_image_count'); $i++){
      //   // echo "<pre>";
        
      //   $data['image'][$i]='/assets/img/no-image.png';
      //   $data['isImageExist'][$i]=0;
      //   $data['mediaId'][$i]=null;
      //   // $data['image'][$i]=';';
      //   if(isset($media[$i]) && $media[$i]['link']!='')
      //   {
      //     $data['image'][$i]=$media[$i]['link'];
      //     $data['isImageExist'][$i]=1;
      //     $data['mediaId'][$i]=$media[$i]['id'];
      //   }
      // }
      // dd($data);
      return view('admin.testimonial.edit',['model' => $model]);
    }
    public function removeImage(Request $request)
    {
      // dd($request->input('media_id'));
      if($request->input('media_id') != '' &&  $request->input('project_id') != ''){
        $media=ProjectMedia::where(['is_deleted'=>0,'is_active'=>1])->where(['project_id'=>$request->input('project_id'),'id'=>$request->input('media_id')])->first();
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
          $media->is_deleted=1;
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
      $model=Testimonial::find($id);
      // dd($request->file('image'));
      if(!$model)
      {
        $message=config('params.msg_error').'Testimonial not found !'.config('params.msg_end');

        $request->session()->flash('message',$message);
        return redirect()->route('admin.testimonial.index');
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
      
      if($model->save())
      {
        // if ($request->hasFile('image') && $request->file('image')!='')
        //   {
            
        //     for($i=0; $i < config('params.project_image_count'); $i++){
        //       if(isset($request->file('image')[$i]) && $request->file('image')[$i]!=''){
        //         $file = $request->file('image')[$i];
        //         $imageName=time().$file->getClientOriginalName();
        //         $value = CommonFunction::uploadImageonlocal($file,$imageName);
        //         // $value = CommonFunction::uploadImageInS3bucket($file,$imageName);
        //         $media = new ProjectMedia;
        //         $media->project_id = $model->id;
        //         $media->type = 1;//1=image
        //         $media->link=$value;
        //         $media->i_by=Auth::guard('admin')->user()->id;
        //         $media->u_by=Auth::guard('admin')->user()->id;
        //         $media->i_date = date('Y-m-d H:i:s');
        //         $media->u_date = date('Y-m-d H:i:s');
        //         $media->save();
        //       }

        //     }
        //   }
        $message=config('params.msg_success').'Testimonial successfully updated !'.config('params.msg_end');
        $request->session()->flash('message',$message);
        return redirect()->route('admin.testimonial.index');
        // return Redirect::to(Input::get('redirects_to'));
      }
      else {
        $message=config('params.msg_error').'Error in save !'.config('params.msg_end');
        $request->session()->flash('message',$message);
        return redirect()->route('admin.testimonial.index');
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
      $model=Testimonial::find($id);

      if(!$model)
      {
        $message=config('params.msg_error').'Testimonial not found !'.config('params.msg_end');

        $request->session()->flash('message',$message);
        // return redirect()->route('admin.testimonial.index');
        return Redirect::back();
      }
      $model->is_deleted = 1;
      $model->u_date = date('Y-m-d H:i:s');

      if($model->save())
      {
        $message=config('params.msg_success').'Testimonial successfully deleted !'.config('params.msg_end');
        $request->session()->flash('message',$message);
        // return redirect()->route('admin.testimonial.index');
        return Redirect::back();
      }
      else {
        $message=config('params.msg_error').'Error in save !'.config('params.msg_end');
        $request->session()->flash('message',$message);
        // return redirect()->route('admin.testimonial.index');
        return Redirect::back();
      }
    }

    private function fillableFields($request)
    {
        return $request->all();
    }

    public function statusChange(Request $request)
    {
      $model=Testimonial::find($request->query('id'));

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
