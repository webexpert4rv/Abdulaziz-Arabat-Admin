<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;


     protected $fillable = [ 
        'blog_title',          
        'blog_image',          
        'arabic_blog_title',          
        'arabic_description',          
        'description',          
        'created_by',          
        'status'
    ];

    public function admin() {
        return $this->belongsTo(Admin::class,'created_by','id');
    }
}
