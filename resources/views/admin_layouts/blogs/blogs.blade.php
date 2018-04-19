<?php
/**
 * Created by PhpStorm.
 * User: xuandieu
 * Date: 3/21/18
 * Time: 16:03
 */
?>
@extends('admin_layouts.admin')
@section('content')
    <div class="container-fluid">

        <div class="row bg-light-blue">
            <div class="col-12">
                <h1 class="float-left">Posts</h1>
            </div>
        </div>
        <!-- end row -->
        {{--@if( empty($_GET['filter']) )--}}
            {{--@php $filter = ''; @endphp--}}
            {{--@else--}}
            {{--@php $filter = $_GET['filter']; @endphp--}}
        {{--@endif--}}
        <blogs-content></blogs-content>

    </div>
    <!-- END container-fluid -->
@endsection
