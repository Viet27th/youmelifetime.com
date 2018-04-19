<?php
/**
 * Created by PhpStorm.
 * User: xuandieu
 * Date: 4/9/18
 * Time: 10:35
 */

namespace App\Http\Controllers\user_controller;


use App\Blog;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index() {
        $posts = Blog::with('taxonomies')->where('status','publish')->orderBy('id', 'desc')
            ->take(10)
            ->get();
        return view('user_layouts.home',compact('posts'));
    }
}