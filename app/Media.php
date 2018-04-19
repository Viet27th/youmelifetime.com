<?php
/**
 * Created by PhpStorm.
 * User: xuandieu
 * Date: 3/7/18
 * Time: 23:34
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    /**
     * @var string
     */
    protected $table = 'media';
    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
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
}