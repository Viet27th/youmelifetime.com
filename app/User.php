<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
        'feature_image','full_name',
        'phone_number','address','birthday','sex'
    ];

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
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function blogs() {
        return $this->hasMany(Blog::class,'user_id','id');
    }

    public function comments(){
        return $this->hasMany(Comment::class,'user_id','id');
    }

    public function media(){
        return $this->hasMany(Media::class,'user_id','id');
    }
}
