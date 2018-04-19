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
                <h1 class="float-left">Post create</h1>
            </div>
        </div>
        <!-- end row -->

        <blog-create></blog-create>
        <!-- end row -->

    </div>
    <!-- END container-fluid -->
@endsection
