<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * @var string
     */
    protected $table = 'comments';
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function blog(){
        return $this->belongsTo(Blog::class,'blog_id','id');
    }
}
