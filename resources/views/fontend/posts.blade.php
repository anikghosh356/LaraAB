@extends('layouts.public')



@section('content') 
<section class="blog-post-area section-margin mt-4">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="row">

              @foreach($posts as $post)

              <div class="col-md-6">
                <div class="single-recent-blog-post card-view">
                  <div class="thumb">
                    <img class="card-img rounded-0" src="{{ asset('img/350x230/'.$post->post_thumbnail ) }}" alt="{{ $post->post_title }}">
                    <ul class="thumb-info">
                      <li><a href="#"><i class="ti-user"></i>{{ $post->user->name }}</a></li>
                      <li><a href="#"><i class="ti-themify-favicon"></i>2 Comments</a></li>
                    </ul>
                  </div>
                  <div class="details mt-20">
                    <a href="{{ route('post', $post->post_slug) }}">
                      <h3>{{ $post->post_title }}</h3>
                    </a>
                    <p>{{ substr(strip_tags($post->post_content), 0, 280) }}...</p>
                    <a class="button" href="{{ route('post', $post->post_slug) }}">Read More <i class="ti-arrow-right"></i></a>
                  </div>
                </div>
              </div>

              @endforeach

            </div>

            


            <div class="row">
              <div class="col-lg-12">
                  {{ $posts }}
              </div>
            </div>
          </div>

@endsection
@extends('layouts.sidebar')