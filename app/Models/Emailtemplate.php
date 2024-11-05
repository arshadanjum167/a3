<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Emailtemplate extends Model
{
    protected $table = 'email_templates';
    public $timestamps = false;

    protected $fillable = [
        'key','title','content',
    ];
}
