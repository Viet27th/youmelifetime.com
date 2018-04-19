<?php
/**
 * Created by PhpStorm.
 * User: xuandieu
 * Date: 4/9/18
 * Time: 10:36
 */

namespace App\Http\Controllers\user_controller;


use App\Blog;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index ($taxonomy_slug, $post_slug) {
        $post_info = Blog::with(['user','taxonomies'])->where('slug',$post_slug)->first();
//        dd($post_info);
        return view('user_layouts.post',compact('post_info'));
    }
}