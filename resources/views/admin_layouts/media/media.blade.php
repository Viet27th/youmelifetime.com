<?php
/**
 * Created by PhpStorm.
 * User: xuandieu
 * Date: 3/21/18
 * Time: 00:03
 */
?>
@extends('admin_layouts.admin')
@section('content')
    <div class="container-fluid">

        <div class="row bg-light-blue">
            <div class="col-12">
                <h1 class="float-left">Media</h1>
            </div>
        </div>
        <!-- end row -->

        <div class="row">

            <div class="col-12">
                <div class="card mb-3 mt-4">
                    <div class="card-header">
                        <h3><i class="fa fa-file"></i> Image</h3>
                        Files upload
                    </div>

                    <div class="card-body">
                        <media-content></media-content>
                    </div>
                </div><!-- end card-->
            </div>


        </div>
        <!-- end row -->

    </div>
    <!-- END container-fluid -->
@endsection
