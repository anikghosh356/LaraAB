@extends('layouts.public')



@section('content') 

<!--================Hero Banner start =================-->  
    <section class="mb-30px">
      <div class="container">
        <div class="hero-banner">
          <div class="hero-banner__content">
            <h3> </h3>
            <h1><?php echo ($SiteDetails != '') ? $SiteDetails->site_tagline : 'LaraAB'; ?></h1>
            <h4>{{ date('F d Y') }}</h4>
          </div>
        </div>
      </div>
    </section>
    <!--================Hero Banner end =================-->  

    <!--================ Blog slider start =================-->  
    <section>
      <div class="container">
        <div class="owl-carousel owl-theme blog-slider">
          @foreach($randomPosts as $randomPost)

            <div class="card blog__slide text-center">
              <div class="blog__slide__img">
                <img class="card-img rounded-0" src="{{ asset('img/350x230/'.$randomPost->post_thumbnail) }}" alt="{{ $randomPost->user->name }}">
              </div>
              <div class="blog__slide__content">
                <a class="blog__slide__label" href="{{ url('category/'.$randomPost->category->id.'/'.$randomPost->category->category_name) }}">{{ $randomPost->category->category_name }}</a>
                <h3><a href="{{ route('post',$randomPost->post_slug) }}">{{ $randomPost->post_title }}</a></h3>
                <p>{{ $randomPost->created_at->diffForHumans() }} </p>
              </div>
            </div>         

          @endforeach
          

        </div>
      </div>
    </section>

    <!--================ Blog slider end =================-->  

    <!--================ Start Blog Post Area =================-->
    <section class="blog-post-area section-margin mt-4">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            @foreach($latestPosts as $latestPost)

            <div class="single-recent-blog-post">
              <div class="thumb">
                <img class="img-fluid" src="{{ asset('img/730x390/'.$latestPost->post_thumbnail) }}" alt="{{ $latestPost->user->name }}">
                <ul class="thumb-info">
                  <li><a ><i class="ti-user"></i>{{ $latestPost->user->name }}</a></li>
                  <li><a ><i class="ti-notepad"></i>{{ $latestPost->created_at->format('d M Y') }}</a></li>
                  <li><a href="{{ route('post',$latestPost->post_slug).'#commentsArea' }}"><i class="ti-themify-favicon"></i>{{ $latestPost->comments->count() }} Comments</a></li>
                </ul>
              </div>
              <div class="details mt-20">
                <a href="{{ route('post',$latestPost->post_slug) }}">
                  <h3>{{ $latestPost->post_title }}</h3>
                </a>
                <p class="tag-list-inline">Tag: 
                  @foreach(explode(",",$latestPost->tags) as $tag)
                  <a href="#">{{ $tag }}</a>, 
                  @endforeach
                </p>

                <p>{{ substr(strip_tags($latestPost->post_content), 0, 280) }}...</p>
                <a class="button" href="{{ route('post',$latestPost->post_slug) }}">Read More <i class="ti-arrow-right"></i></a>
              </div>
            </div>

            @endforeach
          </div>

@endsection
@extends('layouts.sidebar')
