<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blogauthor extends Model
{
    protected $table = 'blog_author';
    public $timestamps = false;

    // protected $fillable = [
    //     'title','content','route_name','read_count','read_duration','meta_description','meta_keyword'
    // ];

    // public $sortable = ['title','content','route_name','read_count','read_duration','meta_description','meta_keyword', 'i_date'];

    protected $casts = [
        'is_deleted' => 'boolean',
        'is_active' => 'boolean',
    ];
}
