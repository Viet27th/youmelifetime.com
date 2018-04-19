<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taxonomy extends Model
{
    /**
     * @var string
     */
    protected $table = 'taxonomies';
    /**
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function blogs(){
        return $this->belongsToMany(Blog::class,'blog_taxonomy','taxonomy_id','blog_id');
    }
}
