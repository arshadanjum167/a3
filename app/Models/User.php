<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    protected $table = 'users';
    public $timestamps = false;


    protected $fillable = [
        'full_name','country_code','contact_number','email'
    ];

    public $sortable = ['full_name', 'contact_number', 'email', 'i_date'];

    protected $casts = [
        'is_deleted' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function clubname()
    {
        return $this->hasOne('App\Models\Club','id','club_id')->where('is_active',1)->where('is_deleted',0);
    }
    public function teamname()
    {
        return $this->hasOne('App\Models\Team','id','team_id')->where('is_active',1)->where('is_deleted',0);
    }
    public function follower()
    {
        return $this->hasMany('App\Models\FollowUnfollow','to_id')->where('is_follow', 1)->where('is_deleted',0);
    }

    public function following()
    {
        return $this->hasMany('App\Models\FollowUnfollow','from_id')->where('is_follow', 1)->where('is_deleted',0);
    }

    public function team()
    {
        return $this->hasMany('App\Models\CoachTeam','user_id')->where('is_deleted',0);
    }
    
}
