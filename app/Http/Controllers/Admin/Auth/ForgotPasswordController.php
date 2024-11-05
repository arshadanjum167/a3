<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\ForgotPasswordRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPassword;
use App\Models\Admin;
use URL;


class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
      return view('admin.auth.forgot');
    }

    public function sendResetLinkEmail(ForgotPasswordRequest $request)
    {
      $model = Admin::where('email',$request->input('email'))->where('actor',1)->first();
      if($model){
        $token = uniqid(base64_encode(str_random(60)));
        $model->forgot_password_token = $token;
        $model->forgot_password_token_timeout = date('Y-m-d H:i:s', strtotime('+24 hour'));

        if($model->save())
        {
          $link =  URL::to('admin/password/reset/'.$token);
          Mail::to($model->email)->send(new ForgotPassword($link, $model));

          $message=config('params.msg_success').'Reset password link sent to given email id !'.config('params.msg_end');
          $request->session()->flash('message',$message);
          return redirect('admin/login');
        }
        else {
          $message=config('params.msg_error').' something went wrong !'.config('params.msg_end');
          $request->session()->flash('message',$message);
          return redirect('admin/login');
        }
      }
      else {
        $message=config('params.msg_error').' Email not found !'.config('params.msg_end');
        $request->session()->flash('message',$message);
        return redirect('admin/login');
      }
    }
}
