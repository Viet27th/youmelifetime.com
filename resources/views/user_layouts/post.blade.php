<?php
/**
 * Created by PhpStorm.
 * User: xuandieu
 * Date: 4/8/18
 * Time: 22:54
 */
?>
@extends('user_layouts.main')
@section('head')
    <!-- You can use Open Graph tags to customize link previews.
    Learn more: https://developers.facebook.com/docs/sharing/webmasters -->
    <meta property="og:url" content="{{url()->current()}}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="Your Website Title"/>
    <meta property="og:description" content="Your description"/>
    <meta property="og:image" content="{{$post_info->feature_image}}"/>
@endsection
@section('content')

    <div class="row post-page-pre-next">
        <div class="col-6">
            <a class="text-left text-gray" href="">
                <p class="mb-0 text-dark">Previous</p>
                <p class="mb-0 newer-link">Web resources that will make every designer’s day</p>
            </a>
        </div>
        <div class="col-6">
            <a class="text-right text-gray" href="">
                <p class="mb-0 text-dark">Next</p>
                <p class="mb-0 older-link">Web resources that will make every designer’s day</p>
            </a>
        </div>
    </div>
    <div>
        <h1 class="post-title pt-3 h3 font-weight-bold">{{$post_info->title}}</h1>

        <ul class="post-info clearfix list-unstyled text-gray pb-4" style="font-size: 14px;">
            <li class="float-left mr-3">
                <i class="fa fa-user mr-1"></i>
                {{$post_info->user->name}}
            </li>
            <li class="float-left mr-3">
                <i class="fa fa-calendar mr-1"></i>
                @if(!empty($post_info->option_date))
                    {{$post_info->option_date}}
                @else
                    {{$post_info->updated_at}}
                @endif
            </li>
            <li class="float-left mr-3">
                <i class="fa fa-tags mr-1"></i>
                @foreach($post_info->taxonomies as $taxonomy)
                    @if($taxonomy->taxonomy == 'tag')
                        <a href="/{{$taxonomy->slug}}" class="badge badge-secondary">{{$taxonomy->term}}</a>
                    @endif
                @endforeach
            </li>
        </ul>

        <div class="post-content pb-3">
            {!! $post_info->content !!}
        </div>

        <div class="pb-3 share-social-network">
            <div class="fb-share-button "
                 data-href="{{url()->current()}}"
                 data-layout="button_count" data-size="large" data-mobile_iframe="true">
            </div>
        </div>

        <div class="posts-related">
            <p class="mt-3">
                <i class="fa fa-hand-o-right mr-2" aria-hidden="true" style="font-size: 27px;"></i>
                <span class="text-capitalize font-weight-bold h4">You may also like </span>
            </p>

            <div class="row post-page-related">
                <div class="col-12 col-md-6">
                    <a class="thumbnail d-block" href="">
                        <img src="http://1.bp.blogspot.com/-IuBejnbCmWs/Uq2VBmfKeeI/AAAAAAAACx0/qnn3VKWfeW0/s400/shutterstock_145719323-960x500.jpg"
                             alt="">
                    </a>
                    <a class="" href="">
                        <p class="title pt-2 pl-2 text-gray">Nullam ut magna non lacus adipiscing Nullam ut magna non
                            lacus adipiscing Nullam ut magna non lacus adipiscing</p>
                    </a>
                </div>

                <div class="col-12 col-md-6">
                    <a class="thumbnail d-block" href="">
                        <img src="http://1.bp.blogspot.com/-IuBejnbCmWs/Uq2VBmfKeeI/AAAAAAAACx0/qnn3VKWfeW0/s400/shutterstock_145719323-960x500.jpg"
                             alt="">
                    </a>
                    <a class="" href="">
                        <p class="title pt-2 pl-2 text-gray">Nullam ut magna non lacus adipiscing</p>
                    </a>
                </div>

                <div class="col-12 col-md-6">
                    <a class="thumbnail d-block" href="">
                        <img src="http://1.bp.blogspot.com/-IuBejnbCmWs/Uq2VBmfKeeI/AAAAAAAACx0/qnn3VKWfeW0/s400/shutterstock_145719323-960x500.jpg"
                             alt="">
                    </a>
                    <a class="" href="">
                        <p class="title pt-2 pl-2 text-gray">Nullam ut magna non lacus adipiscing</p>
                    </a>
                </div>

                <div class="col-12 col-md-6">
                    <a class="thumbnail d-block" href="">
                        <img src="http://1.bp.blogspot.com/-IuBejnbCmWs/Uq2VBmfKeeI/AAAAAAAACx0/qnn3VKWfeW0/s400/shutterstock_145719323-960x500.jpg"
                             alt="">
                    </a>
                    <a class="" href="">
                        <p class="title pt-2 pl-2 text-gray">Nullam ut magna non lacus adipiscing</p>
                    </a>
                </div>
            </div>

        </div>

        <div class="post-comments pb-5">
            <div class="container">
                <div class="row">
                    <div class="comments col-md-9" id="comments">
                        <h3 class="mb-2">Bình luận</h3>
                        <!-- comment -->
                        <div class="comment mb-2 row">
                            <div class="comment-avatar col-md-1 col-sm-2 text-center pr-1">
                                <a href=""><img class="mx-auto rounded-circle img-fluid"
                                                src="http://demos.themes.guide/bodeo/assets/images/users/m103.jpg"
                                                alt="avatar"></a>
                            </div>
                            <div class="comment-content col-md-11 col-sm-10">
                                <h6 class="small comment-meta"><a href="#">admin</a> Today, 2:38</h6>
                                <div class="comment-body">
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                        eiusmod <a href>http://wwwwww.com</a> tempor incididunt ut
                                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                                        nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                        commodo.
                                        <br>
                                        <a href="" class="text-right small"><i class="ion-reply"></i>
                                            Reply</a>
                                    </p>
                                </div>
                            </div>

                            <!-- reply is indented -->
                            <div class="comment-reply col-md-11 offset-md-1 col-sm-10 offset-sm-2">
                                <div class="row">
                                    <div class="comment-avatar col-md-1 col-sm-2 text-center pr-1">
                                        <a href=""><img class="mx-auto rounded-circle img-fluid"
                                                        src="http://demos.themes.guide/bodeo/assets/images/users/m101.jpg"
                                                        alt="avatar"></a>
                                    </div>
                                    <div class="comment-content col-md-11 col-sm-10 col-12">
                                        <h6 class="small comment-meta"><a href="#">phildownney</a>
                                            Today, 12:31</h6>
                                        <div class="comment-body">
                                            <p>Really?? Consectetur adipisicing elit, sed do eiusmod
                                                tempor incididunt ut labore et dolore magna aliqua. Ut
                                                enim ad minim veniam, quis nostrud exercitat.
                                                <br>
                                                <a href="" class="text-right small"><i
                                                            class="ion-reply"></i> Reply</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /reply is indented -->
                        </div>
                        <!-- /comment -->
                        <!-- comment -->
                        <div class="comment mb-2 row">
                            <div class="comment-avatar col-md-1 col-sm-2 text-center pr-1">
                                <a href=""><img class="mx-auto rounded-circle img-fluid"
                                                src="http://demos.themes.guide/bodeo/assets/images/users/w102.jpg"
                                                alt="avatar"></a>
                            </div>
                            <div class="comment-content col-md-11 col-sm-10">
                                <h6 class="small comment-meta"><a href="#">maslarino</a> Yesterday, 5:03
                                    PM</h6>
                                <div class="comment-body">
                                    <p>Sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                        veniam, quis nostrud exercitation ullamco laboris nisi ut
                                        aliquip ex ea commodo.
                                        <br>
                                        <a href="" class="text-right small"><i class="ion-reply"></i>
                                            Reply</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- /comment -->
                        <p class="text-center"><a href="">Xem thêm</a></p>
                        <div class="form-group">
                            <label for="form-comment">Leave a comment</label>
                            <textarea class="form-control" id="form-comment" rows="5"
                                      style="font-size: 14px;"></textarea>
                        </div>
                        <div class="row pt-2">
                            <div class="col-12 text-right">
                                <button type="button" class="btn btn-sm btn-primary" onclick="getComments()">Comment</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function getComments() {
          {{--let a = '{!! json_encode($post_info->slug) !!}'--}}
          let b = '{!! route('getComments',['blog_slug'=>$post_info->slug]) !!}'

          $.ajax({
            url: b,
            type: "post",
            // dataType:'json',
            headers:
              {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
            success: function(result){
              console.log(result)
            },
            error: function (error) {
              console.log(error.responseJSON)
            }
          })

        }
        getComments();

    </script>
@endsection
