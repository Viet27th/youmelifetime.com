<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'blogs';
    /**
     * All attributes that are mass assignable because $guarded attribute is empty array.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * attribute-casting
     * https://laravel.com/docs/5.2/eloquent-mutators#attribute-casting
     * Lưu vào bằng mảng, lấy ra tự động là object
     * @var array
     */
    protected $casts = [
        'data' => 'object'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function comments(){
        return $this->hasMany(Comment::class,'blog_id','id');
    }

    public function taxonomies(){
        return $this->belongsToMany(Taxonomy::class,'blog_taxonomy','blog_id','taxonomy_id');
    }
}
