<?php
/**
 * Created by PhpStorm.
 * User: xuandieu
 * Date: 4/8/18
 * Time: 21:12
 */
?>
@extends('user_layouts.main')
@section('content')
    @foreach($posts->blogs as $post)
        <article>
            <div class="row category-page-article">
                <div class="col-8 col-md-9">
                    <a href="{{$taxonomy_slug}}/{{$post->slug}}">
                        <h3 class="h5 title text-dark font-weight-bold">{{$post->title}}</h3>
                    </a>
                    <a href="{{$taxonomy_slug}}/{{$post->slug}}">
                        <p class="description mb-1 text-gray">{{$post->description}}</p>
                    </a>
                    <p class="date-submitted text-gray">
                        <i class="fa fa-calendar mr-2" aria-hidden="true"></i>
                        @if(!empty($post->option_date))
                            {{$post->option_date}}
                        @else
                            {{$post->updated_at}}
                        @endif
                    </p>
                </div>
                <div class="col-4 col-md-3 pl-0 feature-image">
                    <a class="d-block" href="{{$taxonomy_slug}}/{{$post->slug}}">
                        <img src="{{$post->feature_image}}" alt="{{$post->feature_image_alt}}" title="{{$post->feature_image_title}}">
                    </a>
                </div>
            </div>
        </article>
        @endforeach

    {{--paginate--}}
    <nav class="pt-3 pb-4">
        <ul class="pagination justify-content-center mb-0">
            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>
    </nav>
    {{--end paginate--}}
@endsection
