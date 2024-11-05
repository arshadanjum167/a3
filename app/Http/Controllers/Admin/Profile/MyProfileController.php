<?php

namespace App\Http\Controllers\Admin\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use App\Http\Requests\Admin\Profile\EditProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use CommonFunction;

class MyProfileController extends Controller
{
    public function showProfile(Request $request)
    {
        
        
        $data['profile_image']='/assets/img/no-image.png';
        $data['full_name']='';
        $data['email']='';
        $data['contact_number']='';
        $data['country_code']='';
        $data['address']='';
        if(Auth::guard('admin')->user()->full_name && Auth::guard('admin')->user()->full_name!=null){
            $data['full_name']=Auth::guard('admin')->user()->full_name;
        }
        if(Auth::guard('admin')->user()->profile_image && Auth::guard('admin')->user()->profile_image!=null){
            $data['profile_image']=Auth::guard('admin')->user()->profile_image;
        }
        if(Auth::guard('admin')->user()->email && Auth::guard('admin')->user()->email!=null){
            $data['email']=Auth::guard('admin')->user()->email;
        }
        if(Auth::guard('admin')->user()->contact_number && Auth::guard('admin')->user()->contact_number!=null){
            $data['contact_number']=Auth::guard('admin')->user()->contact_number;
        }
        if(Auth::guard('admin')->user()->country_code && Auth::guard('admin')->user()->country_code!=null){
            $data['country_code']=Auth::guard('admin')->user()->country_code;
        }
        if(Auth::guard('admin')->user()->address && Auth::guard('admin')->user()->address!=null){
            $data['address']=Auth::guard('admin')->user()->address;
        }
        return view('admin.profile.profile',['data'=>$data]);
    }

    public function showEditProfileForm(Request $request)
    {
        $data['profile_image']='/assets/img/no-image.png';
        $data['id']=Auth::guard('admin')->user()->id;
        $data['full_name']='';
        $data['email']='';
        $data['contact_number']='';
        $data['country_code']='';
        $data['address']='';

        if(Auth::guard('admin')->user()->full_name && Auth::guard('admin')->user()->full_name!=null){
            $data['full_name']=Auth::guard('admin')->user()->full_name;
        }
        if(Auth::guard('admin')->user()->profile_image && Auth::guard('admin')->user()->profile_image!=null){
            $data['profile_image']=Auth::guard('admin')->user()->profile_image;
        }
        if(Auth::guard('admin')->user()->email && Auth::guard('admin')->user()->email!=null){
            $data['email']=Auth::guard('admin')->user()->email;
        }
        if(Auth::guard('admin')->user()->contact_number && Auth::guard('admin')->user()->contact_number!=null){
            $data['contact_number']=Auth::guard('admin')->user()->contact_number;
        }
        if(Auth::guard('admin')->user()->contact_number && Auth::guard('admin')->user()->contact_number!=null){
            $data['country_code']=Auth::guard('admin')->user()->country_code;
        }
        if(Auth::guard('admin')->user()->address && Auth::guard('admin')->user()->address!=null){
            $data['address']=Auth::guard('admin')->user()->address;
        }
        return view('admin.profile.edit-profile',['data'=>$data]);
    }

    public function editProfile(EditProfileRequest $request)
    {
        $model = User::find(Auth::guard('admin')->user()->id);
        if($request->has('email') && $request->input('email') !="")
          $model->email = $request->input('email');
        $model->full_name = $request->input('full_name');
        $model->contact_number = $request->input('contact_number');
        $model->country_code = $request->input('country_code');
        // $model->address = $request->input('address');

        if ($request->hasFile('profile_image') && $request->file('profile_image')!='')
        {
        //   $old_image = public_path('/images/').$model->profile_image;
        //   if(isset($old_image) && $old_image!='' && isset($model->profile_image) && $model->profile_image!='')
        //   {
        //     if(file_exists($old_image)) 
        //     { 
        //         unlink($old_image);
        //     }
        //   }
          $file = $request->file('profile_image');
          $imageName=time().$file->getClientOriginalName();
          //$value = CommonFunction::uploadImageonlocal($file,$imageName);
          $value = CommonFunction::uploadImageInS3bucket($file,$imageName);
          
          $model->profile_image=$value;
        }

        if($model->save())
        {
          $message=config('params.msg_success').'Profile Updated !'.config('params.msg_end');
          $request->session()->flash('message',$message);
          return redirect()->route('admin.show_profile');
        }
        else {
          $message=config('params.msg_error').' something went wrong !'.config('params.msg_end');
          $request->session()->flash('message',$message);
          return redirect()->route('admin.show_profile');
        }
    }




}
