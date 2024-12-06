<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Casestudy extends Model
{
    protected $table = 'casestudy';
    public $timestamps = false;

    protected $fillable = [
        'title','description','route_name','link',
    ];

    public $sortable = ['title','description','route_name', 'link','i_date'];

    protected $casts = [
        'is_deleted' => 'boolean',
        'is_active' => 'boolean',
    ];

    // Add an accessor for the embed URL
    
}
