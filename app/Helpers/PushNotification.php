<?php
namespace App\Helpers;

use Cookie;
use Illuminate\Support\Facades\Storage;
use App\Models\Emailtemplate;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactAdmin;
use App\Models\Notification;
use App\Models\Token;

class PushNotification
{    
    //********************************************************************************
    //Title : push notification android array
    //Developer:Arshad Shaikh.
    //Email: arshadrockingstar@gmail.com.
    //Company: By Own.
    //Project: Standard.
    //Created By:Arshad Shaikh .
    //Created Date : 21-02-2019.
    //Updated Date :
    //Updated By :
    //********************************************************************************
    public static function pushnotification_android_array($deviceToken,$body)
    {
      //print_r($deviceToken); die;
        if(isset($deviceToken) && $deviceToken != null && $deviceToken != array())
        {
            $url = 'https://fcm.googleapis.com/fcm/send';
            $serverApiKey = config('params.android_server_api_key');

            $headers = array(
            'Content-Type:application/json',
            'Authorization:key=' . $serverApiKey
            );

            foreach($deviceToken as $key=>$value)
            {

              $value = array_values($value);
              //dd($value);
              //$token_block[$ij] =

              $data = array(
                'registration_ids' => $value,
                'data' => $body['data']
              );
              $ch = curl_init();
              curl_setopt($ch, CURLOPT_URL, $url);
              if ($headers)
              curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
              curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
              curl_setopt($ch, CURLOPT_POST, true);
              curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
              curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
              $response = curl_exec($ch);
              curl_close($ch);
            }
        }
    }
    //********************************************************************************
    //Title : push notification iphone array
    //Developer:Arshad Shaikh.
    //Email: arshadrockingstar@gmail.com.
    //Company: By Own.
    //Project: Standard.
    //Created By:Arshad Shaikh .
    //Created Date : 21-02-2019.
    //Updated Date :
    //Updated By :
    //********************************************************************************
    public static function pushnotification_iphone_array($deviceToken, $body)
    {
        if(isset($deviceToken) && $deviceToken != null && $deviceToken != array())
        {
            $url = 'https://fcm.googleapis.com/fcm/send';

            $serverApiKey = config('params.ios_server_api_key');

            $headers = array(
              'Content-Type:application/json',
              'Authorization:key=' . $serverApiKey
            );

            $body['data']['text'] = $body['data']['alert'];

            foreach($deviceToken as $key=>$value)
            {

                $value = array_values($value);
                //echo "<pre>";print_r($value);die;
                $data = array(
                  'registration_ids' => $value,
                  'notification' => $body['data'],
                );

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                if ($headers)
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                $response = curl_exec($ch);
                curl_close($ch);
            }
        }
    }
    //********************************************************************************
    //Title : send Purchase plan action Push Notification To User
    //Developer:Arshad Shaikh.
    //Email: arshadrockingstar@gmail.com.
    //Company: By Own.
    //Project: Standard.
    //Created By:Arshad Shaikh .
    //Created Date : 03-06-2019.
    //Updated Date :
    //Updated By :
    //********************************************************************************
    public static function sendPurchaseplanactionPushNotificationToUser($type,$id,$plan_id)
    {
        $device_token_android=$device_token_iphone=array();
        $ij=$mn=0;
        $body_a=array();
        $message=config('params.purchase_plan_notification_user_message');

        
        //$body_a['data']['type'] = $type;
        $body_a['data']['message'] = $message;
        //$body_a['data']['job_id'] = $job->id;
        //$body_a['data']['employer_id'] = $from_user->id;
        $body_a['data']['type'] = $type;


        $body_a['data']['badge'] = 1;
        $body_a['data']['sound'] = 'default';
        $body_a['data']['message'] = $message;
        $body_a['data']['alert'] = $message;
        $body_a['data']['text'] = $message;
        $body_a['data']['title'] = $message;
        $body_a['data']['plan_id'] = $plan_id;


        $notification = new Notification();
        $notification->to_type =1;
        $notification->to_id =$id;
        $notification->from_id =$id;
        $notification->message =$message;
        $notification->notification_type =$type;//1= job
        $notification->type =1;//1= plan
        $notification->type_id =$plan_id;//plan id
        $notification->i_by =$id;
        $notification->u_by =$id;
        $notification->i_date =date('Y-m-d H:i:s',time());
        $notification->u_date =date('Y-m-d H:i:s',time());
        $notification->save();


        $uDeviceDetail_data = Token::where(['user_id'=>$id])->orderby("last_login",'desc')->get();
        if(isset($uDeviceDetail_data) && $uDeviceDetail_data!=array())
        {
            foreach($uDeviceDetail_data as $uDeviceDetail)
            {
                if(isset($uDeviceDetail->device_id) && $uDeviceDetail->device_id!=null && isset($uDeviceDetail->device_type) && $uDeviceDetail->device_type!=null)
                {
                    if($uDeviceDetail->device_type=='a'|| $uDeviceDetail->device_type=='A')
                    {
                        if(isset($device_token_android[$ij]) && count($device_token_android[$ij]) == 500)
                            $ij++;
                        $device_token_android[$ij][$uDeviceDetail->id] = $uDeviceDetail->device_id;
                    }
                    if($uDeviceDetail->device_type=='i'|| $uDeviceDetail->device_type=='I')
                    {
                        if(isset($device_token_iphone[$mn]) && count($device_token_iphone[$mn]) == 500)
                            $mn++;
                        $device_token_iphone[$mn][$uDeviceDetail->id] = $uDeviceDetail->device_id;
                    }
                }
            }
        }


        if(isset($device_token_android) && $device_token_android != array())
            self::pushnotification_android_array($device_token_android,$body_a);

        if(isset($device_token_iphone) && $device_token_iphone != array())
            self::pushnotification_iphone_array($device_token_iphone,$body_a);
    }
    //********************************************************************************
    //Title : send Purchase plan action Push Notification To Admin
    //Developer:Arshad Shaikh.
    //Email: arshadrockingstar@gmail.com.
    //Company: By Own.
    //Project: Standard.
    //Created By:Arshad Shaikh .
    //Created Date : 03-06-2019.
    //Updated Date :
    //Updated By :
    //********************************************************************************
    public static function sendPurchaseplanactionPushNotificationToAdmin($from_user,$plan_id)
    {
        $device_token_android=$device_token_iphone=array();
        $ij=$mn=0;
        $body_a=array();
        
        $message=config('params.purchase_plan_notification_admin_message');
        $employer_name=(isset($from_user->full_name) && $from_user->full_name!=null)?$from_user->full_name:'';
        $message = str_replace('{user_name}',$employer_name,$message);
        
        $notification = new Notification();
        $notification->to_type =2;
        //$notification->to_id =$id;
        $notification->from_id =$from_user->id;
        $notification->message =$message;
        $notification->type =1;//1= plan
        $notification->type_id =$plan_id;//plan id
        $notification->i_by =$from_user->id;
        $notification->u_by =$from_user->id;
        $notification->i_date =date('Y-m-d H:i:s',time());
        $notification->u_date =date('Y-m-d H:i:s',time());
        $notification->save();
    }
    //********************************************************************************
    //Title : send other User Add marina Push Notification To User
    //Developer:Arshad Shaikh.
    //Email: arshadrockingstar@gmail.com.
    //Company: By Own.
    //Project: Standard.
    //Created By:Arshad Shaikh .
    //Created Date : 03-06-2019.
    //Updated Date :
    //Updated By :
    //********************************************************************************
    public static function sendotherUserAddforumPushNotificationToUser($type,$id,$from_id,$forum_id,$message)
    {
        $device_token_android=$device_token_iphone=array();
        $ij=$mn=0;
        $body_a=array();
        //$message=config('params.create_forum_notification_user_message');

        
        //$body_a['data']['type'] = $type;
        $body_a['data']['message'] = $message;
        //$body_a['data']['job_id'] = $job->id;
        //$body_a['data']['employer_id'] = $from_user->id;
        $body_a['data']['type'] = $type;


        $body_a['data']['badge'] = 1;
        $body_a['data']['sound'] = 'default';
        $body_a['data']['message'] = $message;
        $body_a['data']['alert'] = $message;
        $body_a['data']['text'] = $message;
        $body_a['data']['title'] = $message;
        $body_a['data']['forum_id'] = $forum_id;


        $notification = new Notification();
        $notification->to_type =1;
        $notification->to_id =$id;
        $notification->from_id =$from_id;
        $notification->message =$message;
        $notification->notification_type =$type;
        $notification->type =2;//2= forum
        $notification->type_id =$forum_id;//plan id
        $notification->i_by =$from_id;
        $notification->u_by =$from_id;
        $notification->i_date =date('Y-m-d H:i:s',time());
        $notification->u_date =date('Y-m-d H:i:s',time());
        $notification->save();


        $uDeviceDetail_data = Token::where(['user_id'=>$id])->orderby("last_login",'desc')->get();
        if(isset($uDeviceDetail_data) && $uDeviceDetail_data!=array())
        {
            foreach($uDeviceDetail_data as $uDeviceDetail)
            {
                if(isset($uDeviceDetail->device_id) && $uDeviceDetail->device_id!=null && isset($uDeviceDetail->device_type) && $uDeviceDetail->device_type!=null)
                {
                    if($uDeviceDetail->device_type=='a'|| $uDeviceDetail->device_type=='A')
                    {
                        if(isset($device_token_android[$ij]) && count($device_token_android[$ij]) == 500)
                            $ij++;
                        $device_token_android[$ij][$uDeviceDetail->id] = $uDeviceDetail->device_id;
                    }
                    if($uDeviceDetail->device_type=='i'|| $uDeviceDetail->device_type=='I')
                    {
                        if(isset($device_token_iphone[$mn]) && count($device_token_iphone[$mn]) == 500)
                            $mn++;
                        $device_token_iphone[$mn][$uDeviceDetail->id] = $uDeviceDetail->device_id;
                    }
                }
            }
        }


        if(isset($device_token_android) && $device_token_android != array())
            self::pushnotification_android_array($device_token_android,$body_a);

        if(isset($device_token_iphone) && $device_token_iphone != array())
            self::pushnotification_iphone_array($device_token_iphone,$body_a);
    }
    
    //********************************************************************************
    //Title : send Main User Reply forum Push Notification To User
    //Developer:Arshad Shaikh.
    //Email: arshadrockingstar@gmail.com.
    //Company: By Own.
    //Project: Standard.
    //Created By:Arshad Shaikh .
    //Created Date : 03-06-2019.
    //Updated Date :
    //Updated By :
    //********************************************************************************
    public static function sendMainUserReplyforumPushNotificationToUser($type,$id,$from_id,$forum_id,$message)
    {
        $device_token_android=$device_token_iphone=array();
        $ij=$mn=0;
        $body_a=array();
        //$message=config('params.create_forum_notification_user_message');

        
        //$body_a['data']['type'] = $type;
        $body_a['data']['message'] = $message;
        //$body_a['data']['job_id'] = $job->id;
        //$body_a['data']['employer_id'] = $from_user->id;
        $body_a['data']['type'] = $type;


        $body_a['data']['badge'] = 1;
        $body_a['data']['sound'] = 'default';
        $body_a['data']['message'] = $message;
        $body_a['data']['alert'] = $message;
        $body_a['data']['text'] = $message;
        $body_a['data']['title'] = $message;
        $body_a['data']['forum_id'] = $forum_id;


        $notification = new Notification();
        $notification->to_type =1;
        $notification->to_id =$id;
        $notification->from_id =$from_id;
        $notification->message =$message;
        $notification->notification_type =$type;
        $notification->type =2;//2= forum
        $notification->type_id =$forum_id;//plan id
        $notification->i_by =$from_id;
        $notification->u_by =$from_id;
        $notification->i_date =date('Y-m-d H:i:s',time());
        $notification->u_date =date('Y-m-d H:i:s',time());
        $notification->save();


        $uDeviceDetail_data = Token::where(['user_id'=>$id])->orderby("last_login",'desc')->get();
        if(isset($uDeviceDetail_data) && $uDeviceDetail_data!=array())
        {
            foreach($uDeviceDetail_data as $uDeviceDetail)
            {
                if(isset($uDeviceDetail->device_id) && $uDeviceDetail->device_id!=null && isset($uDeviceDetail->device_type) && $uDeviceDetail->device_type!=null)
                {
                    if($uDeviceDetail->device_type=='a'|| $uDeviceDetail->device_type=='A')
                    {
                        if(isset($device_token_android[$ij]) && count($device_token_android[$ij]) == 500)
                            $ij++;
                        $device_token_android[$ij][$uDeviceDetail->id] = $uDeviceDetail->device_id;
                    }
                    if($uDeviceDetail->device_type=='i'|| $uDeviceDetail->device_type=='I')
                    {
                        if(isset($device_token_iphone[$mn]) && count($device_token_iphone[$mn]) == 500)
                            $mn++;
                        $device_token_iphone[$mn][$uDeviceDetail->id] = $uDeviceDetail->device_id;
                    }
                }
            }
        }


        if(isset($device_token_android) && $device_token_android != array())
            self::pushnotification_android_array($device_token_android,$body_a);

        if(isset($device_token_iphone) && $device_token_iphone != array())
            self::pushnotification_iphone_array($device_token_iphone,$body_a);
    }
    
    //********************************************************************************
    //Title : send other User Delete Category Push Notification To User
    //Developer:Arshad Shaikh.
    //Email: arshadrockingstar@gmail.com.
    //Company: By Own.
    //Project: Standard.
    //Created By:Arshad Shaikh .
    //Created Date : 03-06-2019.
    //Updated Date :
    //Updated By :
    //********************************************************************************
    public static function sendotherUserDeleteCategoryPushNotificationToUser($type,$id,$from_id,$cat_id,$message)
    {
        $title='Delelet Categoty';
        $device_token_android=$device_token_iphone=array();
        $ij=$mn=0;
        $body_a=array();
        //$message=config('params.create_forum_notification_user_message');

        
        //$body_a['data']['type'] = $type;
        $body_a['data']['message'] = $message;
        //$body_a['data']['job_id'] = $job->id;
        //$body_a['data']['employer_id'] = $from_user->id;
        $body_a['data']['type'] = $type;


        $body_a['data']['badge'] = 1;
        $body_a['data']['sound'] = 'default';
        $body_a['data']['message'] = $message;
        $body_a['data']['alert'] = $message;
        $body_a['data']['text'] = $message;
        $body_a['data']['title'] = $message;
        $body_a['data']['category_id'] = $cat_id;


        $notification = new Notification();
        $notification->to_type =1;
        $notification->to_id =$id;
        $notification->from_id =$from_id;
        $notification->title =$title;
        $notification->message =$message;
        $notification->notification_type =$type;
        $notification->type =3;//3= category
        $notification->type_id =$cat_id;//plan id
        $notification->i_by =$from_id;
        $notification->u_by =$from_id;
        $notification->i_date =date('Y-m-d H:i:s',time());
        $notification->u_date =date('Y-m-d H:i:s',time());
        $notification->save();


        $uDeviceDetail_data = Token::where(['user_id'=>$id])->orderby("last_login",'desc')->get();
        if(isset($uDeviceDetail_data) && $uDeviceDetail_data!=array())
        {
            foreach($uDeviceDetail_data as $uDeviceDetail)
            {
                if(isset($uDeviceDetail->device_id) && $uDeviceDetail->device_id!=null && isset($uDeviceDetail->device_type) && $uDeviceDetail->device_type!=null)
                {
                    if($uDeviceDetail->device_type=='a'|| $uDeviceDetail->device_type=='A')
                    {
                        if(isset($device_token_android[$ij]) && count($device_token_android[$ij]) == 500)
                            $ij++;
                        $device_token_android[$ij][$uDeviceDetail->id] = $uDeviceDetail->device_id;
                    }
                    if($uDeviceDetail->device_type=='i'|| $uDeviceDetail->device_type=='I')
                    {
                        if(isset($device_token_iphone[$mn]) && count($device_token_iphone[$mn]) == 500)
                            $mn++;
                        $device_token_iphone[$mn][$uDeviceDetail->id] = $uDeviceDetail->device_id;
                    }
                }
            }
        }


        if(isset($device_token_android) && $device_token_android != array())
            self::pushnotification_android_array($device_token_android,$body_a);

        if(isset($device_token_iphone) && $device_token_iphone != array())
            self::pushnotification_iphone_array($device_token_iphone,$body_a);
    }
    
    //********************************************************************************
    //Title : send Cancel plan action Push Notification To Admin
    //Developer:Arshad Shaikh.
    //Email: arshadrockingstar@gmail.com.
    //Company: By Own.
    //Project: Standard.
    //Created By:Arshad Shaikh .
    //Created Date : 03-06-2019.
    //Updated Date :
    //Updated By :
    //********************************************************************************
    public static function sendCancelplanactionPushNotificationToAdmin($from_user,$plan_id)
    {
        $device_token_android=$device_token_iphone=array();
        $ij=$mn=0;
        $body_a=array();
        
        $message=config('params.cancel_plan_notification_admin_message');
        $employer_name=(isset($from_user->full_name) && $from_user->full_name!=null)?$from_user->full_name:'';
        $message = str_replace('{user_name}',$employer_name,$message);
        
        $notification = new Notification();
        $notification->to_type =2;
        //$notification->to_id =$id;
        $notification->from_id =$from_user->id;
        $notification->message =$message;
        $notification->type =1;//1= plan
        $notification->type_id =$plan_id;//plan id
        $notification->i_by =$from_user->id;
        $notification->u_by =$from_user->id;
        $notification->i_date =date('Y-m-d H:i:s',time());
        $notification->u_date =date('Y-m-d H:i:s',time());
        $notification->save();
    }
    
    //********************************************************************************
    //Title : send Contact admin action Push Notification To Admin
    //Developer:Arshad Shaikh.
    //Email: arshadrockingstar@gmail.com.
    //Company: By Own.
    //Project: Standard.
    //Created By:Arshad Shaikh .
    //Created Date : 03-06-2019.
    //Updated Date :
    //Updated By :
    //********************************************************************************
    public static function sendContactadminactionPushNotificationToAdmin($from_user,$query_id)
    {
        $device_token_android=$device_token_iphone=array();
        $ij=$mn=0;
        $body_a=array();
        
        $message=config('params.contact_admin_notification_admin_message');
        $employer_name=(isset($from_user->full_name) && $from_user->full_name!=null)?$from_user->full_name:'';
        $message = str_replace('{user_name}',$employer_name,$message);
        
        $notification = new Notification();
        $notification->to_type =2;
        //$notification->to_id =$id;
        $notification->from_id =$from_user->id;
        $notification->message =$message;
        $notification->type =4;//4= query
        $notification->type_id =$query_id;//plan id
        $notification->i_by =$from_user->id;
        $notification->u_by =$from_user->id;
        $notification->i_date =date('Y-m-d H:i:s',time());
        $notification->u_date =date('Y-m-d H:i:s',time());
        $notification->save();
    }
    
    //********************************************************************************
    //Title : send Add forum action Push Notification To Admin
    //Developer:Arshad Shaikh.
    //Email: arshadrockingstar@gmail.com.
    //Company: By Own.
    //Project: Standard.
    //Created By:Arshad Shaikh .
    //Created Date : 03-06-2019.
    //Updated Date :
    //Updated By :
    //********************************************************************************
    public static function sendAddforumactionPushNotificationToAdmin($from_user,$forum_id)
    {
        $device_token_android=$device_token_iphone=array();
        $ij=$mn=0;
        $body_a=array();
        
        $message=config('params.create_forum_notification_admin_message');
        $employer_name=(isset($from_user->full_name) && $from_user->full_name!=null)?$from_user->full_name:'';
        $message = str_replace('{user_name}',$employer_name,$message);
        
        $notification = new Notification();
        $notification->to_type =2;
        //$notification->to_id =$id;
        $notification->from_id =$from_user->id;
        $notification->message =$message;
        $notification->type =2;//2= Forum
        $notification->type_id =$forum_id;//forum id
        $notification->i_by =$from_user->id;
        $notification->u_by =$from_user->id;
        $notification->i_date =date('Y-m-d H:i:s',time());
        $notification->u_date =date('Y-m-d H:i:s',time());
        $notification->save();
    }
    
    //********************************************************************************
    //Title : send Expire plan action Push Notification To User
    //Developer:Arshad Shaikh.
    //Email: arshadrockingstar@gmail.com.
    //Company: By Own.
    //Project: Standard.
    //Created By:Arshad Shaikh .
    //Created Date : 03-06-2019.
    //Updated Date :
    //Updated By :
    //********************************************************************************
    public static function sendExpireplanactionPushNotificationToUser($type,$id,$plan_id,$purchase_type=1)
    {
        $device_token_android=$device_token_iphone=array();
        $ij=$mn=0;
        $body_a=array();
        $message=config('params.expire_plan_notification_user_message');
        if($purchase_type==2)
        {
            $message=config('params.expire_addon_plan_notification_user_message');
        }
        
        //$body_a['data']['type'] = $type;
        $body_a['data']['message'] = $message;
        //$body_a['data']['job_id'] = $job->id;
        //$body_a['data']['employer_id'] = $from_user->id;
        $body_a['data']['type'] = $type;


        $body_a['data']['badge'] = 1;
        $body_a['data']['sound'] = 'default';
        $body_a['data']['message'] = $message;
        $body_a['data']['alert'] = $message;
        $body_a['data']['text'] = $message;
        $body_a['data']['title'] = $message;
        $body_a['data']['plan_id'] = $plan_id;


        $notification = new Notification();
        $notification->to_type =1;
        $notification->to_id =$id;
        $notification->from_id =$id;
        $notification->message =$message;
        $notification->notification_type =$type;//1= job
        $notification->type =1;//1= plan
        $notification->type_id =$plan_id;//plan id
        $notification->i_by =$id;
        $notification->u_by =$id;
        $notification->i_date =date('Y-m-d H:i:s',time());
        $notification->u_date =date('Y-m-d H:i:s',time());
        $notification->save();


        $uDeviceDetail_data = Token::where(['user_id'=>$id])->orderby("last_login",'desc')->get();
        if(isset($uDeviceDetail_data) && $uDeviceDetail_data!=array())
        {
            foreach($uDeviceDetail_data as $uDeviceDetail)
            {
                if(isset($uDeviceDetail->device_id) && $uDeviceDetail->device_id!=null && isset($uDeviceDetail->device_type) && $uDeviceDetail->device_type!=null)
                {
                    if($uDeviceDetail->device_type=='a'|| $uDeviceDetail->device_type=='A')
                    {
                        if(isset($device_token_android[$ij]) && count($device_token_android[$ij]) == 500)
                            $ij++;
                        $device_token_android[$ij][$uDeviceDetail->id] = $uDeviceDetail->device_id;
                    }
                    if($uDeviceDetail->device_type=='i'|| $uDeviceDetail->device_type=='I')
                    {
                        if(isset($device_token_iphone[$mn]) && count($device_token_iphone[$mn]) == 500)
                            $mn++;
                        $device_token_iphone[$mn][$uDeviceDetail->id] = $uDeviceDetail->device_id;
                    }
                }
            }
        }


        if(isset($device_token_android) && $device_token_android != array())
            self::pushnotification_android_array($device_token_android,$body_a);

        if(isset($device_token_iphone) && $device_token_iphone != array())
            self::pushnotification_iphone_array($device_token_iphone,$body_a);
    }

    public static function sendMessageNotification($type,$id,$plan_id,$purchase_type=1)
    {
        $device_token_android=$device_token_iphone=array();
        $ij=$mn=0;
        $body_a=array();
        $message=config('params.expire_plan_notification_user_message');
        if($purchase_type==2)
        {
            $message=config('params.expire_addon_plan_notification_user_message');
        }
        
        //$body_a['data']['type'] = $type;
        $body_a['data']['message'] = $message;
        //$body_a['data']['job_id'] = $job->id;
        //$body_a['data']['employer_id'] = $from_user->id;
        $body_a['data']['type'] = $type;


        $body_a['data']['badge'] = 1;
        $body_a['data']['sound'] = 'default';
        $body_a['data']['message'] = $message;
        $body_a['data']['alert'] = $message;
        $body_a['data']['text'] = $message;
        $body_a['data']['title'] = $message;
        $body_a['data']['plan_id'] = $plan_id;


        // $notification = new Notification();
        // $notification->to_type =1;
        // $notification->to_id =$id;
        // $notification->from_id =$id;
        // $notification->message =$message;
        // $notification->notification_type =$type;//1= job
        // $notification->type =1;//1= plan
        // $notification->type_id =$plan_id;//plan id
        // $notification->i_by =$id;
        // $notification->u_by =$id;
        // $notification->i_date =date('Y-m-d H:i:s',time());
        // $notification->u_date =date('Y-m-d H:i:s',time());
        // $notification->save();


        $uDeviceDetail_data = Token::where(['user_id'=>$id])->orderby("last_login",'desc')->get();
        if(isset($uDeviceDetail_data) && $uDeviceDetail_data!=array())
        {
            foreach($uDeviceDetail_data as $uDeviceDetail)
            {
                if(isset($uDeviceDetail->device_id) && $uDeviceDetail->device_id!=null && isset($uDeviceDetail->device_type) && $uDeviceDetail->device_type!=null)
                {
                    if($uDeviceDetail->device_type=='a'|| $uDeviceDetail->device_type=='A')
                    {
                        if(isset($device_token_android[$ij]) && count($device_token_android[$ij]) == 500)
                            $ij++;
                        $device_token_android[$ij][$uDeviceDetail->id] = $uDeviceDetail->device_id;
                    }
                    if($uDeviceDetail->device_type=='i'|| $uDeviceDetail->device_type=='I')
                    {
                        if(isset($device_token_iphone[$mn]) && count($device_token_iphone[$mn]) == 500)
                            $mn++;
                        $device_token_iphone[$mn][$uDeviceDetail->id] = $uDeviceDetail->device_id;
                    }
                }
            }
        }


        if(isset($device_token_android) && $device_token_android != array())
            self::pushnotification_android_array($device_token_android,$body_a);

        if(isset($device_token_iphone) && $device_token_iphone != array())
            self::pushnotification_iphone_array($device_token_iphone,$body_a);
    }
}
