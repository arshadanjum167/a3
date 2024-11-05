<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Paginatable;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Marina;
use App\Models\Usersubscription;
use App\Models\Usersubscriptionhistory;
use App\Models\Useraddonsubscriptionhistory;
use App\Models\Marinadetail;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Http\Requests\Admin\User\UpdateRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Hash;
use StripeFunction;
use CommonFunction;
use Redirect;
use Session;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use Paginatable;

    public function index(Request $request)
    {
      if(Session::has('user'))
          Session::put('user',"");
      $query=User::where('is_deleted',0)->where('actor',2); //coach
      $searh_var=$request->input('search');
      $query->where(function($query1) use ($searh_var) {
      $query1->where('full_name', 'like', '%' . $searh_var . '%')
              ->orWhere('email', 'like', '%' . $searh_var . '%')
              // ->orWhere('slip_number', 'like', '%' . $searh_var . '%')
              ->orWhere(\DB::raw('CONCAT_WS(" ", `country_code`, `contact_number`)'), 'like', '%' . $searh_var . '%');
              // ->orWhereHas('marina', function($q) use ($searh_var) {
              //         $q->where('title', 'like', '%'.$searh_var.'%');
              // });
      });
      if ($request->has('full_name') && $request->input('full_name')!=null
           && $request->has('sort') && $request->input('sort')!=null) {
          $query->orderBy($request->input('full_name') ,$request->input('sort') );
      }
      else if ($request->has('email') && $request->input('email')!=null
           && $request->has('sort') && $request->input('sort')!=null) {
          $query->orderBy($request->input('email') ,$request->input('sort') );
      }
      else if ($request->has('i_date') && $request->input('i_date')!=null
           && $request->has('sort') && $request->input('sort')!=null) {
          $query->orderBy($request->input('i_date') ,$request->input('sort') );
      }
      else if ($request->has('last_login') && $request->input('last_login')!=null
           && $request->has('sort') && $request->input('sort')!=null) {
          $query->orderBy($request->input('last_login') ,$request->input('sort') );
      }
      else {
        $query->orderBy('id','DESC');
      }

      $model = $query->paginate($this->returnPageSize());
      return view('admin.user.index',['model'=>$model]);
    }

    public function player(Request $request)
    {
      if(Session::has('user'))
          Session::put('user',"");
      $query=User::where('is_deleted',0)->where('actor',3); //player
      $searh_var=$request->input('search');
      $query->where(function($query1) use ($searh_var) {
      $query1->where('full_name', 'like', '%' . $searh_var . '%')
              ->orWhere('email', 'like', '%' . $searh_var . '%')
              // ->orWhere('slip_number', 'like', '%' . $searh_var . '%')
              ->orWhere(\DB::raw('CONCAT_WS(" ", `country_code`, `contact_number`)'), 'like', '%' . $searh_var . '%');
              // ->orWhereHas('marina', function($q) use ($searh_var) {
              //         $q->where('title', 'like', '%'.$searh_var.'%');
              // });
      });
      if ($request->has('full_name') && $request->input('full_name')!=null
           && $request->has('sort') && $request->input('sort')!=null) {
          $query->orderBy($request->input('full_name') ,$request->input('sort') );
      }
      else if ($request->has('email') && $request->input('email')!=null
           && $request->has('sort') && $request->input('sort')!=null) {
          $query->orderBy($request->input('email') ,$request->input('sort') );
      }
      else if ($request->has('i_date') && $request->input('i_date')!=null
           && $request->has('sort') && $request->input('sort')!=null) {
          $query->orderBy($request->input('i_date') ,$request->input('sort') );
      }
      else if ($request->has('last_login') && $request->input('last_login')!=null
           && $request->has('sort') && $request->input('sort')!=null) {
          $query->orderBy($request->input('last_login') ,$request->input('sort') );
      }
      else {
        $query->orderBy('id','DESC');
      }

      $model = $query->paginate($this->returnPageSize());
      return view('admin.user.player',['model'=>$model]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $model= new User;
      return view('admin.user.create',['model' => $model]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request,User $model)
    {
      // dd($request->all());
      $data = $this->fillableFields($request);

      
      $marina_modal = Marinadetail::where(['id'=>$request->slip_number])->first();
      
      if($marina_modal) {
        $model->slip_number = $marina_modal->slip_number_from.' - '.$marina_modal->slip_number_to;
        $model->vassel_vue_hd_link = $marina_modal->vassel_vue_hd_link;
        $model->vassel_vue_normal_link = $marina_modal->vassel_vue_normal_link;
      }
      
      
      $model->password = Hash::make($request->input('password'));
      $model->marina_detail_id = $request->slip_number;
      $model->fill($data);
      $model->actor=2;
      $model->i_by=Auth::guard('admin')->user()->id;
      $model->u_by=Auth::guard('admin')->user()->id;
      $model->i_date = date('Y-m-d H:i:s');
      $model->u_date = date('Y-m-d H:i:s');
      $customer_id = StripeFunction::generateStripeID($request->input('email'));
      $model->customer_stripe_id = $customer_id;
      if($model->save())
      {
          $message=config('params.msg_success').'User successfully created !'.config('params.msg_end');
          $request->session()->flash('message',$message);
          return redirect()->route('admin.user.index');
      }
      else {
          $message=config('params.msg_error').'Error in save !'.config('params.msg_end');
          $request->session()->flash('message',$message);
          return redirect()->route('admin.user.index');
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id,Request $request)
    {
      $model=User::find($id);
      if(!$model)
      {
        
          
          $message=config('params.msg_error').'Coach not found !'.config('params.msg_end');
          $request->session()->flash('message',$message);
          return redirect()->route('admin.user.index');
      }
      if($model['profile_image']=='')
      {
        
        $model['profile_image']='/assets/img/no-image.png';
      }
      return view('admin.user.show',['model' => $model]);
    }

    public function playershow($id,Request $request)
    {
      $model=User::find($id);
      if(!$model)
      {
          $message=config('params.msg_error').'Player not found !'.config('params.msg_end');
          $request->session()->flash('message',$message);
          return redirect()->route('admin.user.player');
      }
      if($model['profile_image']=='')
      {
        
        $model['profile_image']='/assets/img/no-image.png';
      }
      return view('admin.user.playershow',['model' => $model]);
    }

    public function subscriptionPlanDetail($id,Request $request)
    {
      $model=User::find($id);
      if(!$model)
      {
          $message=config('params.msg_error').'User not found !'.config('params.msg_end');
          $request->session()->flash('message',$message);
          return redirect()->route('admin.user.index');
      }
      $current_subscription_plan = Usersubscription::where(['is_active'=>1,'is_deleted'=>0,'user_id'=>$id,'status'=>1])->orderBy('id','DESC')->first();
      $history_subscription_plan = Usersubscriptionhistory::where(['is_active'=>1,'is_deleted'=>0,'user_id'=>$id])->orderBy('id','DESC')->paginate($this->returnPageSize(),['*'],'p1');
      $purchase_addon_plan = Useraddonsubscriptionhistory::where(['is_active'=>1,'is_deleted'=>0,'user_id'=>$id])->orderBy('id','DESC')->paginate($this->returnPageSize(),['*'],'p2');
      return view('admin.user.subscription_plan_detail',['model' => $model,'current_subscription_plan'=>$current_subscription_plan,'history_subscription_plan'=>$history_subscription_plan,'purchase_addon_plan'=>$purchase_addon_plan]);
    }

    public function userActivity($id,Request $request)
    {
      $model=User::find($id);
      if(!$model)
      {
          $message=config('params.msg_error').'User not found !'.config('params.msg_end');
          $request->session()->flash('message',$message);
          return redirect()->route('admin.user.index');
      }
      return view('admin.user.user_activity',['model' => $model]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id,Request $request)
    {
      $model=User::find($id);
      if(!$model)
      {
          $message=config('params.msg_error').'User not found !'.config('params.msg_end');
          $request->session()->flash('message',$message);
          return redirect()->route('admin.user.index');
      }
      return view('admin.user.edit',['model' => $model]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
      // dd($request->all());
      $model=User::find($id);
      if(!$model)
      {
          $message=config('params.msg_error').'User not found !'.config('params.msg_end');
          $request->session()->flash('message',$message);
          return redirect()->route('admin.user.index');
      }
      $data = $this->fillableFields($request);
      if($request->has('password') && $request->input('password') !="");
        $model->password = Hash::make($request->input('password'));
      $model->fill($data);
      

      if($model->slip_number != $request->slip_number) {
        $marina_modal = Marinadetail::where(['id'=>$request->slip_number])->first();
        
        if($marina_modal) {
          $model->marina_detail_id = $request->slip_number;
          $model->slip_number = $marina_modal->slip_number_from.' - '.$marina_modal->slip_number_to;
          $model->vassel_vue_hd_link = $marina_modal->vassel_vue_hd_link;
          $model->vassel_vue_normal_link = $marina_modal->vassel_vue_normal_link;
        }
      }

      $model->actor=2;
      $model->i_by=Auth::guard('admin')->user()->id;
      $model->u_by=Auth::guard('admin')->user()->id;
      $model->i_date = date('Y-m-d H:i:s');
      $model->u_date = date('Y-m-d H:i:s');
      if($model->save())
      {
          $message=config('params.msg_success').'User successfully created !'.config('params.msg_end');
          $request->session()->flash('message',$message);
          if($request->session()->has('user') && $request->session()->get('user') != "")
          {
            return Redirect::to($request->session()->get('user'));
          }
          else {
              return redirect()->route('admin.user.index');
          }
      }
      else {
          $message=config('params.msg_error').'Error in save !'.config('params.msg_end');
          $request->session()->flash('message',$message);
          return redirect()->route('admin.user.index');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
      $model=User::find($id);
      $old_image=$model->image;
      if(!$model)
      {
          $message=config('params.msg_error').'User not found !'.config('params.msg_end');
          $request->session()->flash('message',$message);
          if($model->actor==2)
          {
            return redirect()->route('admin.user.index');
          }
          else
          {
            return redirect()->route('admin.user.player');
          }
      }

      if(isset($old_image) && $old_image!='')
      {
          $exists = Storage::disk('s3')->exists(basename($old_image));
          if($exists)
          {
              Storage::disk('s3')->delete(basename($old_image));
          }
      }
      $model->is_deleted = 1;
      $model->u_date = date('Y-m-d H:i:s');
      $model->u_by=Auth::guard('admin')->user()->id;
      if($model->save())
      {
          //delete all coachteam data
          $affected = DB::table('coach_team')->where('user_id', '=', $model->id)->update(array('is_deleted' => 1));
          $affected = DB::table('highlight')->where('i_by', '=', $model->id)->update(array('is_deleted' => 1));
          $user_ids[] =  $model->id;
          CommonFunction::deleteAllToken($user_ids);
          $message=config('params.msg_success').'User successfully deleted !'.config('params.msg_end');
          $request->session()->flash('message',$message);
          if($model->actor==2)
          {
            return redirect()->route('admin.user.index');
          }
          else
          {
            return redirect()->route('admin.user.player');
          }

      }
      else {
          $message=config('params.msg_error').'Error in save !'.config('params.msg_end');
          $request->session()->flash('message',$message);
          if($model->actor==2)
          {
            return redirect()->route('admin.user.index');
          }
          else
          {
            return redirect()->route('admin.user.player');
          }
      }
    }

    public function statusChange(Request $request)
    {
      $model=User::find($request->query('id'));

      if(!$model)
      {
        return response(0);
      }
      $model->is_active = $request->query('status');
      $model->u_date = date('Y-m-d H:i:s');

      if($model->save())
      {
        if($request->query('status') == 0)
        {
          $user_ids[] =  $model->id;
          CommonFunction::deleteAllToken($user_ids);
        }
        return response(1);
      }
      else {
        return response(0);
      }
    }

    private function fillableFields($request)
    {
      return $request->only(['full_name','country_code','contact_number','marina_id','email','years_at_marina']);
    }

    public function getUserGraph(Request $request)
    {
      $year = $request->query('year');
      $garsphdata = CommonFunction::getCharddataTotalUser($year);
      return json_encode($garsphdata);
    }

    public function getEarningGraph(Request $request)
    {
      $year = $request->query('year');
      $garsphdata = CommonFunction::getCharddataTotalEarning($year);
      return json_encode($garsphdata);
    }

    public function getDropdownData(Request $request)
    {
      $data = '';
      if($request->has('id') && $request->query('id') != '')
      {
        
          $marina_modal = Marinadetail::where(['marina_id'=>$request->query('id')])->get();
        
          if(isset($marina_modal) && $marina_modal != array())
          {
            if($request->query('marina_detail_id') == 0) {
              foreach ($marina_modal as $value)
              {
                $data.='<option value="'.$value->id.'">'.$value->slip_number_from.' - '.$value->slip_number_to.'</option>';
              }
            } else {
              foreach ($marina_modal as $value)
              {
                $select = "";
                if ( $request->query('marina_detail_id') == $value->id )
                {
                  $select = "selected";
                }
                $data.='<option '.$select.' value="'.$value->id.'">'.$value->slip_number_from.' - '.$value->slip_number_to.'</option>';
              }
            }
          }
        
        
        
        
      }
      
      // print_r($data);
      echo $data;
      // echo json_encode($data);
      die;
    }
}
