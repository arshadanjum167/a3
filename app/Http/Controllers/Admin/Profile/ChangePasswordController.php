<?php

namespace App\Http\Controllers\Admin\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Http\Requests\Admin\Profile\ChangePasswordRequest;
use Hash;
use Illuminate\Support\Facades\Auth;

class ChangePasswordController extends Controller
{
    public function showChangePasswordForm()
    {
      return view('admin.profile.change_password');
    }

    // public function changePassword(ChangePasswordRequest $request)
    public function changePassword(Request $request)
    {
      if(Hash::check($request->input('old_password'),Auth::guard('admin')->user()->password)){

        $model = Admin::find(Auth::guard('admin')->user()->id);
        $model->password = Hash::make($request->input('password'));
        if($model->save())
        {
          $message=config('params.msg_success').'Password successfully changed !'.config('params.msg_end');
          $request->session()->flash('message',$message);
          Auth::guard('admin')->logout();
          return redirect('admin/login');
          // return redirect()->route('admin.show_change_password_form');
        }
        else {
          $message=config('params.msg_error').'Error in save !'.config('params.msg_end');
          $request->session()->flash('message',$message);
          return redirect()->route('admin.show_change_password_form');
        }
      }
      else {
        $message=config('params.msg_error').' Invalid Old Password !'.config('params.msg_end');
        $request->session()->flash('message',$message);
        return view('admin.profile.change_password');
      }
    }

    public function checkOldPassword(Request $request)
    {
      if($request->query('oldpassword'))
      {
        if(Hash::check($request->query('oldpassword'),Auth::guard('admin')->user()->password)){
          return response(1);
        }
        else{
          return response(0);
        }
      }
      else {
       return response(0);
      }
    }
}
