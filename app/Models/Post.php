<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable=['user_id','caregory_id','title','description','status'];

    //== many to many relationship==
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
    // ==============================

    public function category(){
        return $this->belongsTo(Category::class,'caregory_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    
}
