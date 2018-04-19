<?php
/**
 * Created by PhpStorm.
 * User: xuandieu
 * Date: 3/21/18
 * Time: 16:08
 */
?>
@extends('admin_layouts.admin')
@section('content')
    <div class="container-fluid">

        <div class="row bg-light-blue">
            <div class="col-12">
                <h1 class="float-left">Categories</h1>
            </div>
        </div>
        <!-- end row -->
        <categories-content></categories-content>

    </div>
    <!-- END container-fluid -->
@endsection
