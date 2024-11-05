<?php
namespace App\Helpers;
use App\Models\User;
use App\Models\Job;
use App\Models\Usercontract;
use App\Models\Userworklocationtown;
use App\Models\Userworklocationsuburb;
use App\Models\Govtinstitute;
//use App\Models\Usercontract;

use Hash,CommonFunction;

class ApiFunction
{
    //********************************************************************************
    //Title : get User Detail On Mobile Password
    //Developer:Arshad Shaikh.
    //Email: arshadrockingstar@gmail.com.
    //Company: By Own.
    //Project: Standard.
    //Created By:Arshad Shaikh .
    //Created Date : 12-02-2019.
    //Updated Date :
    //Updated By :
    //********************************************************************************
    public static function getUserDetailOnMobilePassword($country_code,$contact_number,$password,$actor)
    {
      $result_obj =[];//blank array for the result object
          //query one for user
          try {
              $result_obj = User::where(['is_deleted'=>0,'country_code'=>$country_code,'contact_number'=>$contact_number,'actor'=>$actor])->first();
        if($result_obj)
        {
          if(!Hash::check($password,$result_obj->password)){
            return [];
          }
        }
          }
          catch(Exception $e) {
          }
      return $result_obj;
    }
    //********************************************************************************
    //Title : get User Detail On Email Password
    //Developer:Arshad Shaikh.
    //Email: arshadrockingstar@gmail.com.
    //Company: By Own.
    //Project: Standard.
    //Created By:Arshad Shaikh .
    //Created Date : 12-02-2019.
    //Updated Date :
    //Updated By :
    //********************************************************************************
    public static function getUserDetailOnEmailPassword($email,$password,$actor)
    {
      $result_obj =[];//blank array for the result object
          //query one for user
          try {
              $result_obj = User::where(['is_deleted'=>0,'email'=>$email,'actor'=>$actor])->first();
        if($result_obj)
        {
          if(!Hash::check($password,$result_obj->password)){
            return [];
          }
        }
          }
          catch(Exception $e) {
          }
      return $result_obj;
    }


  public static function apiLogin($data,$token,$is_merge="")
  {
    try {
      $result['message'] = config('params.login_success');
      $result = ApiFunction::userResponse($data);
     if(isset($is_merge) && $is_merge!=null){
			$result["user_info"]["is_merge"] = \strtolower($is_merge);
           if(\strtolower($is_merge)=='n')
           $result["user_info"]["is_merge"]=0;
           else
           $result["user_info"]["is_merge"]=1;
		}else{
			$result["user_info"]["is_merge"] = \strtolower("Y");
           $result["user_info"]["is_merge"]=1;
		}
    }
    catch(Exception $e) {
    }

    $result["token"] = $token;
    return $result;
  }
    //********************************************************************************
    //Title : user Response
    //Developer:Arshad Shaikh.
    //Email: arshadrockingstar@gmail.com.
    //Company: By Own.
    //Project: Standard.
    //Created By:Arshad Shaikh .
    //Created Date : 12-02-2019.
    //Updated Date :
    //Updated By :
    //********************************************************************************
    public static function userResponse($data)
    {
      $result['user_info']=array();
      if(isset($data) && $data!=null)
      {

            $result['user_info']['user_id']=$data->id;
            $result['user_info']['full_name']=(isset($data->full_name) && $data->full_name!=null)?$data->full_name:'';
            $result['user_info']['country_code']=(isset($data->country_code) && $data->country_code!=null)?$data->country_code:'';
            $result['user_info']['contact_number']=(isset($data->contact_number) && $data->contact_number!=null)?$data->contact_number:'';
            $result['user_info']['email']=(isset($data->email) && $data->email!=null)?$data->email:'';
            $result['user_info']['profile_image']=\URL::asset('/assets/img/no_user.png');
            if(isset($data->profile_image) && $data->profile_image!='')
            {
              $result['user_info']['profile_image']=$data->profile_image;
            }
            
            $result['user_info']['login_type']=(int)$data->login_type;
            $result['user_info']['is_email_verified']=(int)ApiFunction::checkEmailVerified($data,$data->login_type);
            $result['user_info']['actor']=(int)$data->actor;
            
            $result['user_info']['is_social']=0;
            if($data->login_type!=1)
            {
                $result['user_info']['is_social']=1;
                $result['user_info']['social_type']=0;
                if($data->google_id!='')
                $result['user_info']['social_type']=2;
                
            }
            
            
            
            
      }
      return $result;
    }
    

    public static function checkContactVerified($data){
      $type = 0;
      $verified = 0;
        switch ($type) {
          case 1:
            $verified = (isset($data->contact_verified) && $data->contact_verified!=null)?$data->contact_verified:0;
            break;
          case 2:
            $verified = (isset($data->google_verified) && $data->google_verified!=null)?$data->google_verified:0;
            break;
          case 3:
            $verified = (isset($data->facebook_verified) && $data->facebook_verified!=null)?$data->facebook_verified:0;
            break;
          case 4:
            $verified = (isset($data->twitter_verified) && $data->twitter_verified!=null)?$data->twitter_verified:0;
            break;
          case 5:
            $verified = (isset($data->instagram_verified) && $data->instagram_verified!=null)?$data->instagram_verified:0;
            break;
          default:
            $verified = (isset($data->contact_verified) && $data->contact_verified!=null)?$data->contact_verified:0;
      }

      return $verified;

    }

    public static function checkEmailVerified($data,$type=0){
    //$type = 0;
    $verified = 0;
      switch ($type) {
        case 1:
          $verified = (isset($data->is_email_verified) && $data->is_email_verified!=null)?$data->is_email_verified:0;
          break;
        case 2:
          $verified = (isset($data->is_google_verified) && $data->is_google_verified!=null)?$data->is_google_verified:0;
          break;
        //case 3:
        //  $verified = (isset($data->facebook_verified) && $data->facebook_verified!=null)?$data->facebook_verified:0;
        //  break;
        //case 4:
        //  $verified = (isset($data->twitter_verified) && $data->twitter_verified!=null)?$data->twitter_verified:0;
        //  break;
        //case 5:
        //  $verified = (isset($data->instagram_verified) && $data->instagram_verified!=null)?$data->instagram_verified:0;
        //  break;
        default:
          $verified = (isset($data->is_email_verified) && $data->is_email_verified!=null)?$data->is_email_verified:0;
    }

    return $verified;

  }


    public static function getUserDetailOnMobile($country_code,$contact_number,$actor)
    {
      $result_obj =[];//blank array for the result object
          //query one for user
          try {
              $result_obj = User::where(['is_deleted'=>0,'country_code'=>$country_code,'contact_number'=>$contact_number,'actor'=>$actor])->first();
          }
          catch(Exception $e) {
          }
      return $result_obj;
    }
    //********************************************************************************
    //Title : get User Detail from Email
    //Developer:Arshad Shaikh.
    //Email: arshadrockingstar@gmail.com.
    //Company: By Own.
    //Project: Standard.
    //Created By:Arshad Shaikh .
    //Created Date : 11-02-2019.
    //Updated Date :
    //Updated By :
    //********************************************************************************
    public static function getUserDetailOnEmail($email,$actor)
    {
      $result_obj =[];//blank array for the result object
          //query one for user
          try {
              $result_obj = User::where(['is_deleted'=>0,'email'=>$email,'actor'=>$actor])->first();
          }
          catch(Exception $e) {
          }
      return $result_obj;
    }

  public static function getUserDetailFromSocialId($social_type,$social_id,$actor=null)
  {
    $result_obj =[];//blank array for the result object
    try {
      switch ($social_type) {
    	    case 2:
        		$social_type_id = 'google_id';
        		break;
      		case 3:
        			$social_type_id = 'instagram_id';
        			break;
    	    default:
    		      $social_type_id = 'facebook_id';
    	}

      $result_obj = User::where(['is_deleted'=>0,$social_type_id =>$social_id,'actor'=>$actor])->first();
    }
    catch(Exception $e) {
    }
    return $result_obj;
  }
    public static function randomstring($id)
    {
        $random_str = time().rand(10000,99999);
        $res = md5($random_str);
        //$check = Users::find()->where([$id=>$res])->one();
        //if($check)
        //{
        //    $code = $this->randomstring($id);
        //    return $code;
        //}
        return $res;
    }
}
