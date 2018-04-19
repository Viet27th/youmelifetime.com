<?php
/**
 * Created by PhpStorm.
 * User: xuandieu
 * Date: 4/9/18
 * Time: 10:36
 */

namespace App\Http\Controllers\user_controller;


use App\Http\Controllers\Controller;
use App\Taxonomy;

class TaxonomyController extends Controller
{
    public function index($taxonomy_slug) {
        $posts = Taxonomy::with('blogs')->where('slug',$taxonomy_slug)->orderBy('id','desc')->first();

        return view('user_layouts.taxonomy',compact('posts','taxonomy_slug'));
    }
}