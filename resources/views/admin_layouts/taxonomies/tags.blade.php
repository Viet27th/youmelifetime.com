<?php
/**
 * Created by PhpStorm.
 * User: xuandieu
 * Date: 3/21/18
 * Time: 16:10
 */
?>
@extends('admin_layouts.admin')
@section('content')
    <div class="container-fluid">

        <div class="row bg-light-blue">
            <div class="col-12">
                <h1 class="float-left">Tags</h1>
            </div>
        </div>
        <!-- end row -->

        <tags-content></tags-content>
        <!-- end row -->

    </div>
    <!-- END container-fluid -->
@endsection
