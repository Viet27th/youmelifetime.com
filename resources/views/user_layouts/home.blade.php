<?php
/**
 * Created by PhpStorm.
 * User: xuandieu
 * Date: 4/1/18
 * Time: 17:14
 */
?>
@extends('user_layouts.main')
@section('content')

    {{--main content--}}
    {{--<div class="row posts-row">--}}
    {{--<div class="col-12 col-md-6">--}}
    {{--<article class="post-card">--}}
    {{--<div class="post-thumb">--}}
    {{--<a href="" class="d-block">--}}
    {{--<img src=""--}}
    {{--class="img-fluid d-block">--}}
    {{--</a>--}}
    {{--</div>--}}
    {{--<div class="post-date text-uppercase mt-2">Thursday, July 03, 2014</div>--}}
    {{--<h2 class="post-title h4 mt-3">Web resources that will make every designer’s--}}
    {{--day</h2>--}}
    {{--<div class="description">--}}
    {{--<p>--}}
    {{--Nunc tincidunt, elit non cursus euismod, lacus augue ornare metus, egestas--}}
    {{--imperdiet nulla nisl quis mauris. Suspendisse a pharetra urna. Morbi dui--}}
    {{--lectus, pharetra nec elementum eget, vulputate ut...--}}
    {{--</p>--}}
    {{--</div>--}}
    {{--</article>--}}
    {{--</div>--}}
    {{--<div class="col-12 col-md-6">--}}
    {{--<article class="post-card">--}}
    {{--<div class="post-thumb">--}}
    {{--<a href="" class="d-block">--}}
    {{--<img src=""--}}
    {{--class="img-fluid d-block">--}}
    {{--</a>--}}
    {{--</div>--}}
    {{--<div class="post-date text-uppercase mt-2">Thursday, July 03, 2014</div>--}}
    {{--<h2 class="post-title h4 mt-3">Web resources that will make every designer’s--}}
    {{--day</h2>--}}
    {{--<div class="description">--}}
    {{--<p>--}}
    {{--Nunc tincidunt, elit non cursus euismod, lacus augue ornare metus, egestas--}}
    {{--imperdiet nulla nisl quis mauris. Suspendisse a pharetra urna. Morbi dui--}}
    {{--lectus, pharetra nec elementum eget, vulputate ut...--}}
    {{--</p>--}}
    {{--</div>--}}
    {{--</article>--}}
    {{--</div>--}}
    {{--</div>--}}

    @for($i = 0; $i < sizeof($posts); )
        <div class="row posts-row">
            @for($j = $i; $j < $i + 2; $j++)
                @if(!empty($posts[$j]))
                    <div class="col-12 col-md-6">
                        <article class="post-card">
                            <div class="post-thumb">
                                <a href="/{{$posts[$j]->taxonomies->first()->slug}}/{{$posts[$j]->slug}}" class="d-block">
                                    <img src="{{$posts[$j]->feature_image}}"
                                         alt="{{$posts[$j]->feature_image_alt}}"
                                         title="{{$posts[$j]->feature_image_title}}"
                                         class="img-fluid d-block">
                                </a>
                            </div>
                            <div class="post-date text-uppercase mt-2">
                                @if(!empty($posts[$j]->option_date))
                                    {{$posts[$j]->option_date}}
                                @else
                                    {{$posts[$j]->updated_at}}
                                @endif
                            </div>
                            <a href="/{{$posts[$j]->taxonomies->first()->slug}}/{{$posts[$j]->slug}}" class="text-dark"><h2 class="post-title h4 mt-3">{{$posts[$j]->title}}</h2></a>
                            <div class="post-description">
                                {{$posts[$j]->description}}
                            </div>
                        </article>
                    </div>
                @endif
            @endfor
            @if($j == $i + 2)
                @php $i = $i + 2; @endphp
            @endif
        </div>
    @endfor

    {{--end main content--}}
@endsection