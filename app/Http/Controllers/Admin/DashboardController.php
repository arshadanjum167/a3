<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contactpackage;
use App\Models\Notification;
use App\Models\Setting;
use CommonFunction;



class DashboardController extends Controller
{
    public function index()
    {
        $count = CommonFunction::getDashboardCount();
        // $total_user_graph = CommonFunction::getCharddataTotalUser();
        // $total_earning_graph = CommonFunction::getCharddataTotalEarning();
        return view('admin.dashboard.index',['count'=>$count]);
    }

    public function contactPackDays(Request $request)
    {
        $id=$request->query('val');
        if(isset($id) && $id!=null)
        {
            $total_used=Contactpackage::where('is_deleted',0)->where('id', $id)->first()->total_used;
            return (isset($total_used) && $total_used!=''?$total_used:0);
        }
        else
        {
            return Contactpackage::where(['is_deleted' => '0'])->sum('total_used');
        }
    }
}
