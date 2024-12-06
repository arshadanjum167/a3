<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Auth;
use Session;
use App\Models\User;
use App\Models\Project;
use App\Models\Blogauthor;
use App\Models\Casestudy;
use App\Models\Cmspage;
use App\Http\Requests\Admin\Auth\ResetPasswordRequest;
use App\Http\Requests\Admin\Iosimage\IosImageRequest;
use Hash;
use Spatie\Sitemap\SitemapGenerator;

use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;
use ZipArchive;
use File;
use CommonFunction;

class DefaultController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        //$this->middleware('auth:web');
    }
    //********************************************************************************
    //Title : User Email Verification
    //Developer:Arshad Shaikh
    //Email:arshadrockingstar@gmail.com
    //Company:By Own
    //Project:A3 Projects
    //Created By : Arshad Shaikh
    //Created Date : 06-01-2018
    //Updated Date :
    //Updated By :
    //********************************************************************************
    public function index()
    { 

        $meta_description = config('params.home_page_meta_description');
        $meta_keyword = config('params.home_page_meta_keyword');
        return view('web.default.home',[
          'meta_description'=>$meta_description,
          'meta_keyword'=>$meta_keyword,
          'home_page_content'=>config('params.home_page_content'),
          'about_page_content'=>config('params.home_about'),
        ]);
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //********************************************************************************
    //Title : User Email Verification
    //Developer:Arshad Shaikh
    //Email:arshadrockingstar@gmail.com
    //Company:By Own
    //Project:A3 Projects
    //Created By : Arshad Shaikh
    //Created Date : 06-01-2018
    //Updated Date :
    //Updated By :
    //********************************************************************************
    public function useremailverification(Request $request)
    {

        if(isset($_REQUEST['args']) && $_REQUEST['args'] != null && isset($_REQUEST['type']) && $_REQUEST['type'] != null )
        {


            $token = $_REQUEST['args'];
      			$type = $_REQUEST['type'];
      			if($type=='G')
            {

              $findUser = User::where(['google_token'=>$token])->first();
            }
            elseif($type=='I')
            {

              $findUser = User::where(['instagram_token'=>$token])->first();
            }
            elseif($type=='F')
            {

              $findUser = User::where(['facebook_token'=>$token])->first();
            }
            elseif($type=='A')
            {

              $findUser = User::where(['apple_token'=>$token])->first();
            }
            else {
              $findUser = User::where(['email_verification_token'=>$token])->first();

            }
            if($findUser != array())
            {

              if($type=='G' && $findUser->is_google_verified == 0)
              {
                $findUser->is_google_verified=1;
                $findUser->google_token='';
                $findUser->save();
                //$msg = "Your email address has been verified.";
                        $msg = config("api_messages.success_email_verified");
                $flash_msg = config('params.msg_success').$msg.config('params.msg_end');
                        Session::flash('flash_msg', $flash_msg);
                //\Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
                //return $this->redirect('useremailverified');
                        return redirect('/useremailverified');
              }
              elseif($type=='I' && $findUser->is_instagram_verified == 0)
              {
                $findUser->is_instagram_verified=1;
                $findUser->instagram_token='';
                $findUser->save();
                //$msg = "Your email address has been verified.";
                        $msg = config("api_messages.success_email_verified");
                $flash_msg = config('params.msg_success').$msg.config('params.msg_end');
                        Session::flash('flash_msg', $flash_msg);
                //\Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
                //return $this->redirect('useremailverified');
                        return redirect('/useremailverified');
              }
              elseif($type=='F' && $findUser->is_facebook_verified == 0)
              {
                $findUser->is_facebook_verified=1;
                $findUser->facebook_token='';
                $findUser->save();
                //$msg = "Your email address has been verified.";
                        $msg = config("api_messages.success_email_verified");
                $flash_msg = config('params.msg_success').$msg.config('params.msg_end');
                        Session::flash('flash_msg', $flash_msg);
                //\Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
                //return $this->redirect('useremailverified');
                        return redirect('/useremailverified');
              }
              elseif($type=='A' && $findUser->is_apple_verified == 0)
              {
                $findUser->is_apple_verified=1;
                $findUser->apple_token='';
                $findUser->save();
                //$msg = "Your email address has been verified.";
                        $msg = config("api_messages.success_email_verified");
                $flash_msg = config('params.msg_success').$msg.config('params.msg_end');
                        Session::flash('flash_msg', $flash_msg);
                //\Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
                //return $this->redirect('useremailverified');
                        return redirect('/useremailverified');
              }
              else if($type=='N' && $findUser->email_verified == 0)
              {
                          if(strtotime("now") > strtotime($findUser->email_verification_token_timeout))
                          {
                              $msg = config("api_messages.error_email_verification_expire");
                              $flash_msg=config('params.msg_error').$msg.config('params.msg_end');
                              Session::flash('flash_msg', $flash_msg);
                              return redirect('/useremailverified');
                          }
                          $findUser->is_email_verified=1;
                          $findUser->email_verification_token='';
                          $findUser->email_verification_token_timeout=null;
                          $findUser->save();

                          $msg = config("api_messages.success_email_verified");
                          $flash_msg = config('params.msg_success').$msg.config('params.msg_end');
                          Session::flash('flash_msg', $flash_msg);
                          //$flash_msg = \Yii::$app->params['msg_success'].$msg.\Yii::$app->params['msg_end'];
                          //\Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);
                          //return $this->redirect('useremailverified');
                          return redirect('/useremailverified');
              }
				else{
					 $msg = config('api_messages.error_email_already_verified');
                     $flash_msg = config('params.msg_error').$msg.config('params.msg_end');
                     Session::flash('flash_msg', $flash_msg);
					 //$flash_msg = \Yii::$app->params['msg_error'].$msg.\Yii::$app->params['msg_end'];
					 //\Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);

					 //return $this->redirect('useremailverified');
                     return redirect('/useremailverified');
				 }
            }else{
                $msg = config('api_messages.error_email_verification_invalid_token');
                $flash_msg = config('params.msg_error').$msg.config('params.msg_end');
                Session::flash('flash_msg', $flash_msg);

                //$flash_msg = \Yii::$app->params['msg_error'].$msg.\Yii::$app->params['msg_end'];
                //\Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);

                //return $this->redirect('useremailverified');
                return redirect('/useremailverified');
            }
        }else{
            $msg = config('api_messages.error_not_permission');
            $flash_msg = config('params.msg_error').$msg.config('params.msg_end');
            Session::flash('flash_msg', $flash_msg);
            //$flash_msg = \Yii::$app->params['msg_error'].$msg.\Yii::$app->params['msg_end'];
            //\Yii::$app->getSession()->setFlash('flash_msg', $flash_msg);

            //return $this->redirect('useremailverified');
            return redirect('/useremailverified');
        }
    }
    //********************************************************************************
    //Title : View Page after User Email Verification
    //Developer:Arshad Shaikh
    //Email:arshadrockingstar@gmail.com
    //Company:By Own
    //Project:A3 Projects
    //Created By : Arshad Shaikh
    //Created Date : 11-2-2019
    //Updated Date :
    //Updated By :
    //********************************************************************************
    public function showuseremailverified()
    {
        return view('web.default.useremailverified');
    }
    //********************************************************************************
    //Title : Show rest form
    //Developer:Arshad Shaikh
    //Email:arshadrockingstar@gmail.com
    //Company:By Own
    //Project:A3 Projects
    //Created By : Arshad Shaikh
    //Created Date : 13-2-2019
    //Updated Date :
    //Updated By :
    //********************************************************************************
    public function showResetForm(Request $request, $token)
    {
      $model = User::where('forgot_password_token',$token)->where('is_deleted',0)->first();

      if($model){
        if(strtotime("now") > strtotime($model->forgot_password_token_timeout))
        {
          $message=config('params.msg_error').' Forgot password link expired !'.config('params.msg_end');
          //$request->session()->flash('message',$message);
          Session::flash('flash_msg', $message);
          return view('web.default.acknowledgement');
        }
        return view('web.default.reset',['token'=>$token]);
      }
      else {
        $message=config('params.msg_error').' Invalid Token !'.config('params.msg_end');
        //$request->session()->flash('message',$message);
        Session::flash('flash_msg', $message);
        return view('web.default.acknowledgement');
      }
    }
    //********************************************************************************
    //Title : Reset Password
    //Developer:Arshad Shaikh
    //Email:arshadrockingstar@gmail.com
    //Company:By Own
    //Project:A3 Projects
    //Created By : Arshad Shaikh
    //Created Date : 13-2-2019
    //Updated Date :
    //Updated By :
    //********************************************************************************
    public function reset(ResetPasswordRequest $request)
    {
      $model = User::where('forgot_password_token',$request->input('reset_token'))->where('is_deleted',0)->first();

      if($model){
        $model->forgot_password_token = null;
        $model->forgot_password_token_timeout = null;
        $model->password= Hash::make($request->input('password'));
        if($model->save())
        {
          $message=config('params.msg_success').'Password updated !'.config('params.msg_end');
          //$request->session()->flash('message',$message);
          Session::flash('flash_msg', $message);
          return view('web.default.acknowledgement');
        }
        else {
          $message=config('params.msg_error').' something went wrong !'.config('params.msg_end');
          //$request->session()->flash('message',$message);
          Session::flash('flash_msg', $message);
          return view('web.default.acknowledgement');
        }
      }
      else {
        $message=config('params.msg_error').' Invalid Token !'.config('params.msg_end');
        //$request->session()->flash('message',$message);
        Session::flash('flash_msg', $message);
        return view('web.default.acknowledgement');
      }
    }
    //********************************************************************************
    //Title : show terms
    //Developer:Arshad Shaikh
    //Email:arshadrockingstar@gmail.com
    //Company:By Own
    //Project:A3 Projects
    //Created By : Arshad Shaikh
    //Created Date : 16-5-2019
    //Updated Date :
    //Updated By :
    //********************************************************************************
    public function showhelp(Request $request)
    {
      $model = Cmspage::where('is_deleted',0)->where(['key'=>'help'])->first();
      return view('web.default.terms',['model'=>$model]);
    }


    //********************************************************************************
    //Title : show privacy
    //Developer:Arshad Shaikh
    //Email:arshadrockingstar@gmail.com
    //Company:By Own
    //Project:A3 Projects
    //Created By : Arshad Shaikh
    //Created Date : 16-5-2019
    //Updated Date :
    //Updated By :
    //********************************************************************************
    public function showprivacy(Request $request)
    {
      // $model = Cmspage::where('is_deleted',0)->where(['key'=>'privacy'])->first();
      // return view('web.default.terms',['model'=>$model]);
      $meta_description = config('params.home_page_meta_description');
      $meta_keyword = config('params.home_page_meta_keyword');
      $data = config('params.privacy');
      return view('web.default.terms',['data'=>$data,
      'meta_description'=>$meta_description,
      'meta_keyword'=>$meta_keyword,
      'title'=>'Privacy Policy'
          ]);
    }
    public function showdisclaimer(Request $request)
    {
      // $model = Cmspage::where('is_deleted',0)->where(['key'=>'privacy'])->first();
      // return view('web.default.terms',['model'=>$model]);
      $meta_description = config('params.home_page_meta_description');
      $meta_keyword = config('params.home_page_meta_keyword');
      $data = config('params.disclaimer');
      return view('web.default.terms',['data'=>$data,
      'meta_description'=>$meta_description,
      'meta_keyword'=>$meta_keyword,
      'title'=>'Disclaimer'
          ]);
    }
    public function showcontactus(Request $request)
    {
      // $model = Cmspage::where('is_deleted',0)->where(['key'=>'privacy'])->first();
      // return view('web.default.terms',['model'=>$model]);
      $meta_description = config('params.home_page_meta_description');
      $meta_keyword = config('params.home_page_meta_keyword');
      $data = config('params.contactus');
      return view('web.default.contact',['data'=>$data,
      'meta_description'=>$meta_description,
      'meta_keyword'=>$meta_keyword,
      'title'=>'Contact Us'
          ]);
    }
    
    public function showaward(Request $request)
    {
      // $model = Cmspage::where('is_deleted',0)->where(['key'=>'privacy'])->first();
      // return view('web.default.terms',['model'=>$model]);
      $meta_description = config('params.home_page_meta_description');
      $meta_keyword = config('params.home_page_meta_keyword');
      
      return view('web.default.awards',[
      'meta_description'=>$meta_description,
      'meta_keyword'=>$meta_keyword,
      'title'=>'Awards'
          ]);
    }
    public function showrecognition(Request $request)
    {
      // $model = Cmspage::where('is_deleted',0)->where(['key'=>'privacy'])->first();
      // return view('web.default.terms',['model'=>$model]);
      $meta_description = config('params.home_page_meta_description');
      $meta_keyword = config('params.home_page_meta_keyword');
      
      return view('web.default.recognition',[
      'meta_description'=>$meta_description,
      'meta_keyword'=>$meta_keyword,
      'title'=>'Features & Recognitions'
          ]);
    }
    
    public function showterm(Request $request)
    {
      $model = Cmspage::where('is_deleted',0)->where(['key'=>'term'])->first();
      return view('web.default.terms',['model'=>$model]);
    }

    //********************************************************************************
    //Title : show about
    //Developer:Arshad Shaikh
    //Email:arshadrockingstar@gmail.com
    //Company:By Own
    //Project:A3 Projects
    //Created By : Arshad Shaikh
    //Created Date : 16-5-2019
    //Updated Date :
    //Updated By :
    //********************************************************************************
    public function showabout(Request $request)
    {
      // $model = Cmspage::where('is_deleted',0)->where(['key'=>'about'])->first();
      $meta_description = config('params.home_page_meta_description');
      $meta_keyword = config('params.home_page_meta_keyword');
      $data = config('params.about');
      return view('web.default.about',['data'=>$data,
      'meta_description'=>$meta_description,
      'meta_keyword'=>$meta_keyword,
      'title'=>'About'
      ]);
    }
    public function bloglist(Request $request)
    {
      $model = Blog::where('is_active',1)->where('is_deleted',0);
      $model->orderBy('id','DESC');
      $data = $model->paginate(9);

      $meta_description = '';
      $meta_keyword = '';
      $page_title='The A3 Blog';
      return view('web.default.bloglist',['data'=>$data,
      'meta_description'=>$meta_description,
      'meta_keyword'=>$meta_keyword,
      'title'=>$page_title,
          ]);
    }
    
    public function showproject(Request $request,$slug)
    {
      $model = Project::where('is_active',1)->where('is_deleted',0)->where(['route_name'=>$slug])->first();
      if(!$model)
      {
        // return response(['error' => true, 'error-msg' => 'Not found'], 404);
        // $data['title'] = '404';
        // $data['name'] = 'Page not found';
        
        $response['data'] = [];
        $response['success'] = 0;
        $response['error'][] = 'aaa';
        return view('errors.error');
      }
      //get blog author detail
      // $blogAuther = Blogauthor::where('is_active',1)->where('is_deleted',0)->where(['id'=>$model->author_id])->first();
      
      
      $meta_description = $model->meta_description;
      $meta_keyword = $model->meta_keyword;
      $data = config('params.about');
      // $model->read_count+=1;
      // $model->save();
      return view('web.default.project',['data'=>$data,
      'meta_description'=>$meta_description,
      'meta_keyword'=>$meta_keyword,
      'title'=>$model->title,
      'model'=>$model,
      // 'blogAuther'=>$blogAuther,
          ]);
    }
    
    //********************************************************************************
    //Title : show about
    //Developer:Arshad Shaikh
    //Email:arshadrockingstar@gmail.com
    //Company:By Own
    //Project:A3 Projects
    //Created By : Arshad Shaikh
    //Created Date : 16-5-2019
    //Updated Date :
    //Updated By :
    //********************************************************************************
    public function showtestimonial(Request $request)
    {
      // $model = Cmspage::where('is_deleted',0)->where(['key'=>'about'])->first();
      $meta_description = config('params.home_page_meta_description');
      $meta_keyword = config('params.home_page_meta_keyword');
      $testimonials = CommonFunction::getGetAllTestimonials();
      // dd($testimonials[0]->embed_url );
      return view('web.default.testimonial',[
      'meta_description'=>$meta_description,
      'meta_keyword'=>$meta_keyword,
      'testimonials'=>$testimonials,
      'title'=>'Testimonials'
      ]);
    }
    
    //********************************************************************************
    //Title : show about
    //Developer:Arshad Shaikh
    //Email:arshadrockingstar@gmail.com
    //Company:By Own
    //Project:A3 Projects
    //Created By : Arshad Shaikh
    //Created Date : 16-5-2019
    //Updated Date :
    //Updated By :
    //********************************************************************************
    public function showcasestudy(Request $request)
    {
      // $model = Cmspage::where('is_deleted',0)->where(['key'=>'about'])->first();
      $meta_description = config('params.home_page_meta_description');
      $meta_keyword = config('params.home_page_meta_keyword');
      $casestudy = CommonFunction::getGetAllCasestudy();
      // dd($casestudy[0]->embed_url );
      return view('web.default.casestudy',[
      'meta_description'=>$meta_description,
      'meta_keyword'=>$meta_keyword,
      'casestudy'=>$casestudy,
      'title'=>'Case-study'
      ]);
    }
    
    public function showparticularcasestudy(Request $request,$slug)
    {
      $model = Casestudy::where('is_active',1)->where('is_deleted',0)->where(['route_name'=>$slug])->first();
      if(!$model)
      {
        // return response(['error' => true, 'error-msg' => 'Not found'], 404);
        // $data['title'] = '404';
        // $data['name'] = 'Page not found';
        
        $response['data'] = [];
        $response['success'] = 0;
        $response['error'][] = 'aaa';
        return view('errors.error');
      }
      //get blog author detail
      // $blogAuther = Blogauthor::where('is_active',1)->where('is_deleted',0)->where(['id'=>$model->author_id])->first();
      
      
      $meta_description = $model->meta_description;
      $meta_keyword = $model->meta_keyword;
      $data = config('params.about');
      // $model->read_count+=1;
      // $model->save();
      return view('web.default.particularcasestudy',['data'=>$data,
      'meta_description'=>$meta_description,
      'meta_keyword'=>$meta_keyword,
      'title'=>$model->title,
      'model'=>$model,
      // 'blogAuther'=>$blogAuther,
          ]);
    }
}
