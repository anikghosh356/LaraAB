@extends('layouts.public')



@section('content') 
<section class="blog-post-area section-margin mt-4">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="main_blog_details">
                <img class="img-fluid" src="{{ asset('img/730x390/'.$post->post_thumbnail) }}" alt="{{ $post->post_title }}">
                <h1>{{ $post->post_title }}</h1>
                <div class="user_details">
                  <div class="float-left">
                    <a href="#">{{ $post->category->category_name }}</a>
                  </div>
                  <div class="float-right mt-sm-0 mt-3">
                    <div class="media">
                      <div class="media-body">
                        <h5>{{ $post->user->name }}</h5>
                        <p>{{ $post->created_at->diffForHumans() }}</p>
                      </div>
                      <div class="d-flex">
                        <img width="42" height="42" src="{{ asset('img/'.$post->user->user_profile) }}" alt="{{ $post->user->name }}">
                      </div>
                    </div>
                  </div>
                </div>

                <article>
                  {!! $post->post_content !!}
                </article>
                
               <div class="news_d_footer flex-column flex-sm-row">
                 <!--<a href="#"><span class="align-middle mr-2"><i class="ti-heart"></i></span>Lily and 4 people like this</a>-->
                 <a class="justify-content-sm-center ml-sm-auto mt-sm-0 mt-2" href="#commentsArea"><span class="align-middle mr-2"><i class="ti-themify-favicon"></i></span>{{ $post->comments->count() }} Comments</a>
                 <div class="news_socail ml-sm-auto mt-sm-0 mt-2">
                  <!-- social -->
                 </div>
               </div>
              </div>
          

                <div class="navigation-area">
                  <div class="row">
                      
                      <div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                        @if($prevPost)
                          <div class="thumb">
                              <a href="{{ route('post',$prevPost->post_slug) }}"><img class="img-fluid" src="{{ asset('img/290x134/'.$prevPost->post_thumbnail) }}" alt="{{ $prevPost->post_title }}"></a>
                          </div>
                          <div class="arrow">
                              <a href="{{ route('post',$prevPost->post_slug) }}"><span class="lnr text-white lnr-arrow-left"></span></a>
                          </div>
                          <div class="detials">
                              <p>Prev Post</p>
                              <a href="{{ route('post',$prevPost->post_slug ) }}"><h4>{{ $prevPost->post_title }}</h4></a>
                          </div>
                          @endif
                      </div>
                      

                   
                      <div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                           @if($nextPost)
                          <div class="detials">
                              <p>Next Post</p>
                              <a href="{{ route('post',$nextPost->post_slug) }}"><h4>{{ $nextPost->post_title }}</h4></a>
                          </div>
                          <div class="arrow">
                              <a href="{{ route('post',$nextPost->post_slug) }}"><span class="lnr text-white lnr-arrow-right"></span></a>
                          </div>
                          <div class="thumb">
                              <a href="{{ route('post',$nextPost->post_slug) }}"><img class="img-fluid" src="{{ asset('img/290x134/'.$nextPost->post_thumbnail) }}" alt="{{ $nextPost->post_title }}"></a>
                          </div>
                           @endif  
                      </div>
                      								
                  </div>
                </div>
                <div class="comments-area" id="commentsArea">
                    <h4>{{ $post->comments->count() }} Comments</h4>
                   
                    @foreach($post->comments as $comment)
                    <div class="comment-list">
                        <div class="single-comment justify-content-between d-flex">
                            <div class="user justify-content-between d-flex">
                                <div class="thumb">
                                    <img style="width: 60px;max-height: 60px;" src="{{ asset('img/'.$comment->user->user_profile) }}" alt="{{ $comment->user->name }}">
                                </div>
                                <div class="desc">
                                    <h5><a href="#">{{ $comment->user->name }}</a></h5>
                                    <p class="date">{{ $comment->created_at->diffForHumans() }} </p>
                                    <p class="comment">
                                        {{ $comment->content }}
                                    </p>
                                </div>
                            </div>
                            @if(Auth::check())
                              @if($comment->user_id == Auth::user()->id)
                                <div>
                                  <a href="{{ route('dComment', $comment->id) }}" class="btn btn-danger" style="color:white; float: right;">Delete</a>
                                </div>
                              @endif
                            @endif
                        </div>
                    </div>	
                    @endforeach
                    <!--<div class="reply-btn">
                                    <a href="" class="btn-reply text-uppercase">reply</a> 
                            </div>
                    <div class="comment-list left-padding">
                        <div class="single-comment justify-content-between d-flex">
                            <div class="user justify-content-between d-flex">
                                <div class="thumb">
                                    <img src="img/blog/c2.jpg" alt="">
                                </div>
                                <div class="desc">
                                    <h5><a href="#">Elsie Cunningham</a></h5>
                                    <p class="date">December 4, 2017 at 3:12 pm </p>
                                    <p class="comment">
                                        Never say goodbye till the end comes!
                                    </p>
                                </div>
                            </div>
                            <div class="reply-btn">
                                    <a href="" class="btn-reply text-uppercase">reply</a> 
                            </div>
                        </div>
                    </div>	
                    <div class="comment-list left-padding">
                        <div class="single-comment justify-content-between d-flex">
                            <div class="user justify-content-between d-flex">
                                <div class="thumb">
                                    <img src="img/blog/c3.jpg" alt="">
                                </div>
                                <div class="desc">
                                    <h5><a href="#">Annie Stephens</a></h5>
                                    <p class="date">December 4, 2017 at 3:12 pm </p>
                                    <p class="comment">
                                        Never say goodbye till the end comes!
                                    </p>
                                </div>
                            </div>
                            <div class="reply-btn">
                                    <a href="" class="btn-reply text-uppercase">reply</a> 
                            </div>
                        </div>
                    </div>
                  -->

                    

                </div>
                @if(Auth::check())
                <div class="comment-form">
                    <h4>Leave a Comment</h4>
                    <form method="post" action="{{ route('cComment', $post->id) }}">
                      @csrf
                        <div class="form-group">
                            <textarea class="form-control mb-10" rows="5" name="comment" placeholder="Your comment"  required></textarea>
                        </div>
                        <button type="submit" class="button submit_btn">Post Comment</button>	
                    </form>
                </div>
                @else
                <div class="alert alert-primary" role="alert">
                  <a href="{{ route('login') }}">Login</a> and make a comment 
                </div>
                @endif


          </div>

@endsection
@extends('layouts.sidebar')