<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use App\Models\Admin;
//use App\Models\Setting;
use Session;
use Hash;
use URL;
use CommonFunction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
  public function showLoginForm()
  {
    if(isset(Auth::guard('admin')->user()->id) && Auth::guard('admin')->user()->id!='')
    {
      return redirect('admin.login');
    }
    $user_data = CommonFunction::getRememberUserData();
    return view('admin.auth.login',['user_data'=>$user_data]);
  }

  public function login(LoginRequest $request)
  {
    $model = Admin::where('email',$request->input('email'))->where('actor',1)->first();

    if($model){
      if(Hash::check($request->input('password'),$model->password)){

          Auth::guard('admin')->login($model);

          if($request->has('remember_me') && $request->has('remember_me')!=null)
          {
            CommonFunction::rememberUser($request);
          }
          else {
            CommonFunction::removeRememberCookie();
          }

          ////set page size
          //$page_size=config('params.page_size');
          //try {
          //  $setting_data=Setting::where('key','page_setting')->where('is_deleted',0)->get();
          //  if($setting_data)
          //  {
          //    $page_size=(isset($setting_data->value) && $setting_data->value!='')?$setting_data->value:$page_size;
          //  }
          //}
          //catch (\Exception $e) {
          //
          //}
          //Session::put('page.size', $page_size);
          //set page size

          return redirect('admin/dashboard');
      }
      else {
        $message=config('params.msg_error').' Invaid email or password !'.config('params.msg_end');
        $request->session()->flash('message',$message);
        return redirect('admin/login');
      }
    }
    else {
      $message=config('params.msg_error').' Email not found !'.config('params.msg_end');
      $request->session()->flash('message',$message);
      return redirect('admin/login');
    }

    return view('admin.auth.login');
  }

  public function logout(Request $request)
  {
    Auth::guard('admin')->logout();
    return redirect('admin/login');
  }

}
