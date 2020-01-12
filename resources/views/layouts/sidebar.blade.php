@section('sidebar')
    

          <!-- Start Blog Post Siddebar -->
          <div class="col-lg-4 sidebar-widgets">
              <div class="widget-wrap">
                
                <div class="single-sidebar-widget post-category-widget">
                  <h4 class="single-sidebar-widget__title">Catgory</h4>
                  <ul class="cat-list mt-20">

                    @foreach($categories as $category)
                    <li>
                      <a href="{{ url('category/'.$category->id.'/'.$category->category_name) }}" class="d-flex justify-content-between">
                        <p>{{ $category->category_name }}</p>
                        <p>({{ $category->posts->count() }})</p>
                      </a>
                    </li>
                    @endforeach

                  </ul>
                </div>

                <div class="single-sidebar-widget popular-post-widget">
                  <h4 class="single-sidebar-widget__title">Popular Post</h4>
                  <div class="popular-post-list">

                    @foreach($topPosts as $topPost)
                    <div class="single-post-list">
                      <div class="thumb">
                        <img class="card-img rounded-0" src="{{ asset('img/290x134/'.$topPost->post_thumbnail) }}" alt="{{ $topPost->post_title }}">
                        <ul class="thumb-info">
                          <li><a href="#">{{ $topPost->user->name }}</a></li>
                          <li><a href="#">{{ $topPost->created_at->format('M d') }}</a></li>
                        </ul>
                      </div>
                      <div class="details mt-20">
                        <a href="{{ route('post',$topPost->post_slug) }}">
                          <h6>{{ $topPost->post_title }}</h6>
                        </a>
                      </div>
                    </div>
                    @endforeach
                  </div>
                </div>

                  <div class="single-sidebar-widget tag_cloud_widget">
                    <h4 class="single-sidebar-widget__title">Popular Post</h4>
                    <ul class="list">

                      @foreach($categories as $category)
                      <li>
                          <a href="{{ url('category/'.$category->id.'/'.$category->category_name) }}">{{ $category->category_name }}</a>
                      </li>
                      @endforeach

                    </ul>
                  </div>
                </div>
              </div>
            </div>
          <!-- End Blog Post Siddebar -->
        </div>
    </section>
    <!--================ End Blog Post Area =================-->

    @endsection