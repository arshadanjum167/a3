<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Auth;
use Session;
use App\Models\User;
use App\Models\Blog;
use App\Models\Blogauthor;
use App\Models\Cmspage;
use App\Http\Requests\Admin\Auth\ResetPasswordRequest;
use App\Http\Requests\Admin\Iosimage\IosImageRequest;
use Hash;
use Spatie\Sitemap\SitemapGenerator;

use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;
use ZipArchive;
use File;

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

    public function onlinetimestampconvert()
    {
      $meta_description = config('params.timestamp_converter_meta_description');
      $meta_keyword = config('params.timestamp_converter_meta_keyword');
      return view('web.default.onlinetimestampconvert',[
        'meta_description'=>$meta_description,
        'meta_keyword'=>$meta_keyword,
        'title'=>'Online Timestamp Converter',
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
      return view('web.default.terms',['data'=>$data,
      'meta_description'=>$meta_description,
      'meta_keyword'=>$meta_keyword,
      'title'=>'Contact Us'
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
      return view('web.default.terms',['data'=>$data,
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
    
    public function showblog(Request $request,$slug)
    {
      $model = Blog::where('is_active',1)->where('is_deleted',0)->where(['route_name'=>$slug])->first();
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
      $blogAuther = Blogauthor::where('is_active',1)->where('is_deleted',0)->where(['id'=>$model->author_id])->first();
      
      
      $meta_description = $model->meta_description;
      $meta_keyword = $model->meta_keyword;
      $data = config('params.about');
      $model->read_count+=1;
      $model->save();
      return view('web.default.blog',['data'=>$data,
      'meta_description'=>$meta_description,
      'meta_keyword'=>$meta_keyword,
      'title'=>$model->title,
      'model'=>$model,
      'blogAuther'=>$blogAuther,
          ]);
    }




    public function fcmtestpushnotification(Request $request)
    {

      // $filename = "https://sample-videos.com/query/download.php";
      $meta_description = config('params.fcm_push_meta_description');
      $meta_keyword = config('params.fcm_push_meta_keyword');
      return view('web.default.fcmtestpushnotification',[
        'meta_description'=>$meta_description,
        'meta_keyword'=>$meta_keyword,
        'title'=>'Test FCM Push Notifications Online'
      ]);
    }
    
    public function samplemp4video(Request $request)
    {

      // $filename = "https://sample-videos.com/query/download.php";
      $meta_description = config('params.sample_mp4_video_meta_description');
      $meta_keyword = config('params.sample_mp4_video_meta_keyword');
      return view('web.default.samplemp4video',[
        'meta_description'=>$meta_description,
        'meta_keyword'=>$meta_keyword,
        'title'=>'Download Sample Videos Online & Sample Videos For Demo Purpose'
      ]);
    }
    public function sendfcmtestpushnotification(Request $request)
    {
      if($request->input('api_key'))
      {
        $url = 'https://fcm.googleapis.com/fcm/send';
        $notification= array();														
        $notification["body"] =$request->input('message');
        $notification["title"] = $request->input('message');
        $notification["message"] = $request->input('message');
        $notification["text"] = $request->input('message');
        $notification["sound"] = "default";
        $notification["type"] = 1;
        $fields = array(
            'registration_ids' => array($request->input('token')),
            'data' => $notification,
            'notification' => $notification
        );
        
        // Your Firebase Server API Key
        $headers = array('Authorization:key='.$request->input('api_key'),'Content-Type:application/json');
       // Open curl connection
        $ch = curl_init();
        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        // dd($result);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        curl_close($ch);
        
      }
      $message=config('params.msg_success').'Push Notification has been sent.'.config('params.msg_end');
      $request->session()->flash('message',$message);
      return redirect('/fcm-test-push-notification');
    }

    public function onlineimageeditor(Request $request)
    {
      $meta_description = config('params.online_image_editor_meta_description');
      $meta_keyword = config('params.online_image_editor_meta_keyword');
      return view('web.default.onlineimageeditor',[
        'meta_description'=>$meta_description,
        'meta_keyword'=>$meta_keyword,
        'title'=>'Online Image Editor'
      ]);
    }
    public function onlinejsoneditor(Request $request)
    {
      $meta_description = config('params.online_json_editor_meta_description');
      $meta_keyword = config('params.online_json_editor_meta_keyword');
      return view('web.default.onlinejsoneditor',[
        'meta_description'=>$meta_description,
        'meta_keyword'=>$meta_keyword,
        'title'=>'Online JSON Editor / JSON Viewer / JSON Beautifier'
      ]);
    }

    
    public function jquerytojavascriptconverter(Request $request)
    {
      
      $meta_description = config('params.jquery_to_javascript_converter_meta_description');
      $meta_keyword = config('params.jquery_to_javascript_converter_meta_keyword');
      return view('web.default.jquerytojavascriptconverter',[
        'meta_description'=>$meta_description,
        'meta_keyword'=>$meta_keyword,
        'title'=>'Online Jquery to Javascript Converter'
      ]);
    }
    public function submitjquerytojavascriptconverter(Request $request)
    {
      $result='';
      $jqdata = $request->get('jqdata');
      if(isset($jqdata) && $jqdata!='')
      {
        $result = \Erbilen\JqueryToJS::convert($jqdata);
      }
      
      return $result;
    }

    public function liveflighttracker(Request $request)
    {
      
      $meta_description = config('params.liveflighttracker_meta_description');
      $meta_keyword = config('params.liveflighttracker_meta_keyword');
      return view('web.default.liveflighttracker',[
        'meta_description'=>$meta_description,
        'meta_keyword'=>$meta_keyword,
        'title'=>'Live Flight Tracker'
      ]);
    }

    
    public function youtubethumbnaildownloader(Request $request)
    {
      
      $meta_description = config('params.youtubethumbnaildownloader_meta_description');
      $meta_keyword = config('params.youtubethumbnaildownloader_meta_keyword');
      return view('web.default.youtubethumbnaildownloader',[
        'meta_description'=>$meta_description,
        'meta_keyword'=>$meta_keyword,
        'title'=>'Youtube Thumbnail Downloader'
      ]);
    }

    public function speedtest(Request $request)
    {
      
      $meta_description = config('params.speedtest_meta_description');
      $meta_keyword = config('params.speedtest_meta_keyword');
      return view('web.default.speedtest',[
        'meta_description'=>$meta_description,
        'meta_keyword'=>$meta_keyword,
        'title'=>'Speed Test'
      ]);
    }

    public function jsontopojo(Request $request)
    {
      
      $meta_description = config('params.jsontopojo_meta_description');
      $meta_keyword = config('params.jsontopojo_meta_keyword');
      return view('web.default.jsontopojo',[
        'meta_description'=>$meta_description,
        'meta_keyword'=>$meta_keyword,
        'title'=>'Json To Pojo'
      ]);
    }

    
    public function jsontokotlinconverter(Request $request)
    {
      
      $meta_description = config('params.json_to_kotlin_converter_meta_description');
      $meta_keyword = config('params.json_to_kotlin_converter_meta_keyword');
      return view('web.default.jsontokotlinconverter',[
        'meta_description'=>$meta_description,
        'meta_keyword'=>$meta_keyword,
        'title'=>'Online Json to Kotlin Converter'
      ]);
    }

    public function convertaddresstolatlong(Request $request)
    {
      
      $meta_description = config('params.converter_address_to_lat_long_meta_description');
      $meta_keyword = config('params.converter_address_to_lat_long_meta_keyword');
      return view('web.default.convertaddresstolatlong',[
        'meta_description'=>$meta_description,
        'meta_keyword'=>$meta_keyword,
        'title'=>'Get Lat and Long from Address'
      ]);
    }

    
    
    function createZip($zip, $dir) {
      if (is_dir($dir)) {
          if ($dh = opendir($dir)) {
              while (($file = readdir($dh)) !== false) {
                  // If file
                  // dd($dir .$file);
                  if (is_file($dir . $file)) {
                      if ($file != '' && $file != '.' && $file != '..') {
                          $zip->addFile($dir . $file);
                          // $zip->addFile($file);
                      }
                  } else {
                      // If directory
                      if (is_dir($dir . $file)) {
                          if ($file != '' && $file != '.' && $file != '..') {
                              // Add empty directory
                              $zip->addEmptyDir($dir . $file);
                              $folder = $dir . $file . '/';
                              // Read data of the folder
                              $this->createZip($zip, $folder);
                          }
                      }
                  }
              }
              closedir($dh);
          }
      }
  }
  public function postmantoswagger(Request $request)
  {
    
    $meta_description = config('params.postmantoswagger_meta_description');
    $meta_keyword = config('params.postmantoswagger_meta_keyword');
    return view('web.default.postmantoswagger',[
      'meta_description'=>$meta_description,
      'meta_keyword'=>$meta_keyword,
      'title'=>'Postman To Swagger(OpenAPI)'
    ]);
  }
}
