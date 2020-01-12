@extends('layouts.public')



@section('content') 
<section class="blog-post-area section-margin mt-4">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="main_blog_details">
                
                <div class="user_details">
                  <div class="float-left">
                    <h1>{{ $page->page_name }}</h1>
                  </div>
                  <div class="float-right mt-sm-0 mt-3">
                    <div class="media">
                      <div class="media-body">
                        <h5>{{ $page->user->name }}</h5>
                        <p>{{ $page->created_at->diffForHumans() }}</p>
                      </div>
                      <div class="d-flex">
                        <img width="42" height="42" src="{{ asset('img/'.$page->user->user_profile) }}" alt="$page->user->name">
                      </div>
                    </div>
                  </div>
                </div>

                <article>
                  {!! $page->page_content !!}
                </article>
                


          </div>
        </div>

@endsection
@extends('layouts.sidebar')