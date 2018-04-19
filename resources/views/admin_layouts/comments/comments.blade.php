<?php
/**
 * Created by PhpStorm.
 * User: xuandieu
 * Date: 4/18/18
 * Time: 10:31
 */
?>
@extends('admin_layouts.admin')
@section('content')
    <div class="container-fluid">

        <div class="row bg-light-blue">
            <div class="col-12">
                <h1 class="float-left">Comments</h1>
            </div>
        </div>
        {{----}}
        <comments-content></comments-content>
    </div>
@endsection
