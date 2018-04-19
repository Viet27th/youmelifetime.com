<?php
/**
 * Created by PhpStorm.
 * User: xuandieu
 * Date: 4/18/18
 * Time: 21:04
 */

namespace App\Http\Controllers\user_controller;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class CommentController extends Controller
{
    public function getComments($blog_slug){
        return $blog_slug;
    }
}