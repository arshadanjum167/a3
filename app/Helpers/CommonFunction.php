<?php
namespace App\Helpers;

use Cookie;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Blog;
use App\Models\Emailtemplate;
use App\Models\Token;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactAdmin;
use Illuminate\Support\Facades\DB;

class CommonFunction
{
  public static function rememberUser($request)
  {
    $v1 = $request->input('email');
    $v2 = $request->input('password');
    $appname=config('params.appTitle');
    $no = rand(1,9);

    for($i=1;$i<=$no;$i++){
        $v1 = base64_encode($v1);
        $v2 = base64_encode($v2);
    }

    Cookie::queue(Cookie::make($appname.'email', $v1));
    Cookie::queue(Cookie::make($appname.'password', $v2));
    Cookie::queue(Cookie::make($appname.'turns', $no));
  }

  public static function removeRememberCookie()
  {
    $appname=config('params.appTitle');
    Cookie::queue(Cookie::forget($appname.'email'));
    Cookie::queue(Cookie::forget($appname.'password'));
    Cookie::queue(Cookie::forget($appname.'turns'));
  }
  public static function getRememberUserData()
  {
    $appname=config('params.appTitle');
    $email='';
    $password='';
    $no = 0;
    // get the cookie value
    if( Cookie::has($appname.'email') && Cookie::has($appname.'password') && Cookie::has($appname.'turns') )
    {
      $email = Cookie::get($appname.'email');
      $password = Cookie::get($appname.'password');
      $no = Cookie::get($appname.'turns');
    }

    for($i=1;$i<=$no;$i++){
    	$email = base64_decode($email);
    	$password = base64_decode($password);

    }
    return ['email'=>$email ,'password' => $password ];
  }

  //for uploding image on s3
  public static function uploadImageInS3bucket($file,$imageName)
  {
        $s3 = \Storage::disk('s3');
        $s3->put($imageName, file_get_contents($file ), 'public');
        $image_name = \Storage::disk('s3')->url($imageName);
        return $image_name;
  }

  public static function uploadImageonlocal($file,$imageName)
  {
    
      $image = $file;
      $name = time().rand(1000,99999).'.'.$image->getClientOriginalExtension();
      if($imageName!='')
      {
        $name=str_replace(' ','_',$imageName);
      }
      
      
      $destinationPath = public_path('/images');
      $image->move($destinationPath, $name);
      
      $image_name=\URL::asset('/images/'.$name);
      // if(env('APP_ENV') == 'prod')
      // {
      //   $image_name=\URL::asset('/a3/public/images/'.$name);
      // }
      // $image_name=$name;
      // dd($image_name);
      return $image_name;
    
  }
  //for uploding image on s3

  public static function generatepassword()
  {
    return '123456';
  }





    //********************************************************************************
    //Title : Send mail
    //Developer:Arshad Shaikh.
    //Email: arshadrockingstar@gmail.com.
    //Company: By Own.
    //Project: Standard.
    //Created By:Arshad Shaikh .
    //Created Date : 11-02-2019.
    //Updated Date :
    //Updated By :
    //********************************************************************************
    public static function sendemail($to,$fullname,$link,$text,$password=null,$club_name=null)
    {
      try{
        $appname=config('params.appTitle');
        if($text == 'forgot_password'){
                $emailtemplates=Emailtemplate::where(['key'=>'forgot_password'])->first();
                $subject=$emailtemplates->title;
        }
        else
        {
          $emailtemplates=Emailtemplate::where(['key'=>$text])->first();
          $subject=$emailtemplates->title;
        }

        if($emailtemplates != array()){
            $content=$emailtemplates->content;

            $image=CommonFunction::getemailtemplatelogo($appname);
            if($content != ""){
                $content=str_replace('{logo}',$image,$content);
                $content=str_replace('{appname}',$appname,$content);
                $content=str_replace('{name}',$fullname,$content);
                $content=str_replace('{link}',$link,$content);
                $content=str_replace('{email}',$to,$content);
                $content=str_replace('{password}',$password,$content);
                $content=str_replace('{club_name}',$club_name,$content);
                Mail::send( ['html' => null], ['text' => null],
                    function ($message) use ($to,$appname,$subject,$content)
                    {
                        $message->to($to);
                        $message->from(config('params.adminmailemail')); //not sure why I have to add this
                        $message->setBody($content, 'text/html');
                        $message->subject($appname.' : '.$subject);
                    }
                );

            }
        }
      }
      catch(\Swift_SwiftException $e)
      {
//         $result=Yii::$app->apifunction->setResponse($e->getMessage(),false,200,400);
//         Yii::$app->mycomponent->setHeader(400);
//		 echo json_encode($result,true);die;
      }
    }
    //********************************************************************************
    //Title : Send mail
    //Developer:Arshad Shaikh.
    //Email: arshadrockingstar@gmail.com.
    //Company: By Own.
    //Project: Standard.
    //Created By:Arshad Shaikh .
    //Created Date : 11-02-2019.
    //Updated Date :
    //Updated By :
    //********************************************************************************
    public static function otpemail($to,$fullname=null,$msg=null){
      try{
        $appname=config('params.appTitle');
        $emailtemplates=Emailtemplate::where(['key'=>'otp_mail'])->first();
        $subject=$emailtemplates->title;

        if($emailtemplates != array()){
            $content=$emailtemplates->content;

            $image=CommonFunction::getemailtemplatelogo($appname);
            if($content != ""){
                $content=str_replace('{logo}',$image,$content);
                $content=str_replace('{appname}',$appname,$content);
                $content=str_replace('{name}',$fullname,$content);
                $content=str_replace('{msg}',$msg,$content);
                Mail::send( ['html' => null], ['text' => null],
                    function ($message) use ($to,$appname,$subject,$content)
                    {
                        $message->to($to);
                        $message->from(config('params.adminmailemail')); //not sure why I have to add this
                        $message->setBody($content, 'text/html');
                        $message->subject($appname.' : '.$subject);
                    }
                );

            }
        }

      }
      catch(\Swift_SwiftException $e)
      {
         $result=Yii::$app->apifunction->setResponse($e->getMessage(),false,200,400);
         Yii::$app->mycomponent->setHeader(400);
		 echo json_encode($result,true);die;
      }
    }

    //********************************************************************************
    //Title : Send mail
    //Developer:Arshad Shaikh.
    //Email: arshadrockingstar@gmail.com.
    //Company: By Own.
    //Project: Standard.
    //Created By:Arshad Shaikh .
    //Created Date : 11-02-2019.
    //Updated Date :
    //Updated By :
    //********************************************************************************
    public static function sendcontactusemail($to,$subject,$message,$username=null,$useremail=null){
      try{

        Mail::to($to)->send(new ContactAdmin($subject,$message,$username,$useremail));
      }
      catch(\Swift_SwiftException $e)
      {
         $result=Yii::$app->apifunction->setResponse($e->getMessage(),false,200,400);
         Yii::$app->mycomponent->setHeader(400);
		 echo json_encode($result,true);die;
      }
    }
    //********************************************************************************
    //Title : Get email template logo
    //Developer:Arshad Shaikh.
    //Email: arshadrockingstar@gmail.com.
    //Company: By Own.
    //Project: Standard.
    //Created By:Arshad Shaikh .
    //Created Date : 11-02-2019.
    //Updated Date :
    //Updated By :
    //********************************************************************************
    public static function getemailtemplatelogo($appname){
        $logo=asset('assets/img/logo.png');
        return '<img alt="'.$appname.'" src="'.$logo.'" style="max-width: 200px; height: 92px;" />';
    }

    //********************************************************************************
    //Title : Send OTP SMS
    //Developer:Arshad Shaikh.
    //Email: arshadrockingstar@gmail.com.
    //Company: By Own.
    //Project: Standard.
    //Created By:Arshad Shaikh .
    //Created Date : 13-02-2019.
    //Updated Date :
    //Updated By :
    //********************************************************************************
    public static function sendsms($number,$content)
    {
        if(isset($number) && $number != '' &&
        isset($content) && $content != '')
        {
            $sms= new SmsSender($number,$content);
            $sms->sendTwilioSmsReminders();
        }
    }

    //********************************************************************************
    //Title : Country Code List
    //Developer:Arshad Shaikh.
    //Email: arshadrockingstar@gmail.com.
    //Company: By Own.
    //Project: Standard.
    //Created By:Arshad Shaikh .
    //Created Date : 14-5-2019.
    //Updated Date :
    //Updated By :
    //********************************************************************************
    public static function getCountryCode()
    {
      return $country_code = array(
        '+1'=>'+1',
        '+91'=>'+91',
      );
    }
    
    

    //********************************************************************************
    //Title : Get Status
    //Developer:Arshad Shaikh.
    //Email: arshadrockingstar@gmail.com.
    //Company: By Own.
    //Project: Standard.
    //Created By:Arshad Shaikh.
    //Created Date : 20-5-2019.
    //Updated Date :
    //Updated By :
    //********************************************************************************
    public static function getStatus()
    {
       $arr=array('1'=>'Active','0'=>'Inactive');
       return $arr;
    }
    public static function getRequestStatus()
    {
       $arr=array('1'=>'Pending','2'=>'Approved','3'=>'Rejected');
       return $arr;
    }
    public static function getfStatus()
    {
       $arr=array('1'=>'Yes','0'=>'No');
       return $arr;
    }

    
    

    
    

    

    

    
    
    //********************************************************************************
    //Title : Get Category List
    //Developer:Arshad Shaikh.
    //Email: arshadrockingstar@gmail.com.
    //Company: By Own.
    //Project: Standard.
    //Created By:Arshad Shaikh .
    //Created Date : 21-5-2019.
    //Updated Date :
    //Updated By :
    //********************************************************************************
    public static function getCategoryList()
    {
      $result = array();
      $category_list = Category::where(['is_deleted'=>0,'is_active'=>1])->get()->pluck('title','id');
      if(isset($category_list) && $category_list != array())
        $result = $category_list;
      return $result;
    }

  
  //********************************************************************************
  //Title : Get User List
  //Developer: Arshad Shaikh
  //Email:arshadrockingstar@gmail.com
  //Company:By Own
  //Project: Standard
  //Created By : Arshad Shaikh
  //Created Date : 22-5-2019
  //Updated Date :
  //Updated By :
  //********************************************************************************
  public static function getUserList()
  {
    $result = array();
    $user_list = User::where(['is_active'=>1,'is_deleted'=>0,'actor'=>3])->get()->pluck('full_name','id');
    if(isset($user_list) && $user_list != array())
      $result = $user_list;
    return $result;
  }

  
  //********************************************************************************
  //Title : Delete User Token
  //Developer: Arshad Shaikh
  //Email:arshadrockingstar@gmail.com
  //Company:By Own
  //Project: Standard
  //Created By : Arshad Shaikh
  //Created Date : 23-5-2019
  //Updated Date :
  //Updated By :
  //********************************************************************************
  public static function deleteAllToken($user_ids = array())
  {
    Token::whereIn('user_id',$user_ids)->delete();
  }

  
  //********************************************************************************
  //Title : Get Dashboard Count
  //Developer: Arshad Shaikh
  //Email:arshadrockingstar@gmail.com
  //Company:By Own
  //Project: Standard
  //Created By : Arshad Shaikh
  //Created Date : 23-5-2019
  //Updated Date :
  //Updated By :
  //********************************************************************************
  public static function getDashboardCount()
  {
    $result = array();
    $result['total_blog'] = Blog::where(['is_deleted'=>0])->count();
    $result['total_blog_views'] = Blog::where(['is_deleted'=>0,'is_active'=>1])->sum('read_count');

    return $result;
  }
  
  
  public static function getmp4video()
  {
    $result=array(
      ['format'=>'mp4','size'=>'1','resolution'=>'1280x720','url'=>'videos/mp4/720/big_buck_bunny_720p_1mb.mp4'],
      ['format'=>'mp4','size'=>'2','resolution'=>'1280x720','url'=>'videos/mp4/720/big_buck_bunny_720p_2mb.mp4'],
      ['format'=>'mp4','size'=>'5','resolution'=>'1280x720','url'=>'videos/mp4/720/big_buck_bunny_720p_5mb.mp4'],
      ['format'=>'mp4','size'=>'10','resolution'=>'1280x720','url'=>'videos/mp4/720/big_buck_bunny_720p_10mb.mp4'],
      ['format'=>'mp4','size'=>'20','resolution'=>'1280x720','url'=>'videos/mp4/720/big_buck_bunny_720p_20mb.mp4']
    );
    return $result;
  }  
  
  
}
