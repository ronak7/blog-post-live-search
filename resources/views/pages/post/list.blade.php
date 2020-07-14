<!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Blog Entries Column -->
      <div class="col-md-8">

        <h1 class="my-4">Page Heading
          <small>Secondary Text</small>
        </h1>



        {{-- @foreach ($posts as $post)
            <!-- Blog Post -->
            <div class="card mb-4">
                <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap">
                <div class="card-body">
                    <h2 class="card-title">{{$post->title}}</h2>
                    <p class="card-text">{{\Illuminate\Support\Str::limit($post->body, 100, $end='...')}}</p>

                    @foreach ($post->category as $category)
                        <a href="#" class="btn btn-primary">{{$category->name}}</a>
                    @endforeach

                </div>
                <div class="card-footer text-muted">
                    Posted on {{date('M d, Y', strtotime($post->created_at))}}
                </div>
            </div>
        @endforeach --}}
        <div id="post-list"></div>

      </div>

      <!-- Sidebar Widgets Column -->
      @include('pages.post.sidebar')

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

