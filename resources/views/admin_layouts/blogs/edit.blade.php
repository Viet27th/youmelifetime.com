<?php
/**
 * Created by PhpStorm.
 * User: xuandieu
 * Date: 3/21/18
 * Time: 16:04
 */
?>
@extends('admin_layouts.admin')
@section('content')
    <div class="container-fluid">

        <div class="row bg-light-blue">
            <div class="col-12">
                <h1 class="float-left">Post edit</h1>
            </div>
        </div>
        <!-- end row -->
        <blog-edit
                :blog-id="{{$id}}"
                blog-first-data="{{json_encode($blog_info)}}"
                first-categories="{{json_encode($categories)}}"
                first-tags="{{json_encode($tags)}}"
        >
        </blog-edit>
        <!-- end row -->

    </div>
    <!-- END container-fluid -->
@endsection
