<?php
/**
 * Created by PhpStorm.
 * User: xuandieu
 * Date: 3/2/18
 * Time: 09:03
 */

namespace App\Http\Controllers\admin_controller;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function blogsComments($id){
        return view('admin_layouts.comments.comments');
    }
    public function showComments(){

    }
    public function create(){

    }
    public function store(Request $request){

    }
    public function edit(){

    }
    public function update(){

    }
}