<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
    public $timestamps = false;

    protected $fillable = [
        'title','description','route_name','address'
    ];

    public $sortable = ['title','description','route_name','address', 'i_date'];

    protected $casts = [
        'is_deleted' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function media()
    {
        return $this->hasMany('App\Models\ProjectMedia','project_id')->where('is_deleted',0)->orderBy('id');
    }
    public function firstMedia()
{
    return $this->hasOne('App\Models\ProjectMedia','project_id')->where('is_deleted',0)->orderBy('id', 'asc');
}
}
