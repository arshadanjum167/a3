<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    //
    protected $table = 'tokens';
    public $timestamps = false;

    protected $fillable = [
        'user_id','device_id','device_token','access_token'
    ];
}
