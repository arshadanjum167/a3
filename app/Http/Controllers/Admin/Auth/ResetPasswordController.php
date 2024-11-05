<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Http\Requests\Admin\Auth\ResetPasswordRequest;
use Hash;

class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request, $token)
    {
      $model = Admin::where('forgot_password_token',$token)->where('actor',1)->first();

      if($model){
        if(strtotime("now") > strtotime($model->forgot_password_token_timeout))
        {
          $message=config('params.msg_error').' Forgot password link expired !'.config('params.msg_end');
          $request->session()->flash('message',$message);
          return view('admin.auth.acknowledgement');
        }
        return view('admin.auth.reset',['token'=>$token]);
      }
      else {
        $message=config('params.msg_error').' Invalid Token !'.config('params.msg_end');
        $request->session()->flash('message',$message);
        return view('admin.auth.acknowledgement');
      }
    }

    public function reset(ResetPasswordRequest $request)
    {
      $model = Admin::where('forgot_password_token',$request->input('reset_token'))->where('actor',1)->first();

      if($model){
        $model->forgot_password_token = null;
        $model->forgot_password_token_timeout = null;
        $model->password= Hash::make($request->input('password'));
        if($model->save())
        {
          $message=config('params.msg_success').'Password changed successfully.'.config('params.msg_end');
          $request->session()->flash('message',$message);
          return redirect('admin/login');
        }
        else {
          $message=config('params.msg_error').'Error in save !'.config('params.msg_end');
          $request->session()->flash('message',$message);
          return redirect('admin/password/reset');
        }
      }
      else {
        $message=config('params.msg_error').' Invalid Token !'.config('params.msg_end');
        $request->session()->flash('message',$message);
        return view('admin.auth.acknowledgement');
      }
    }
}
