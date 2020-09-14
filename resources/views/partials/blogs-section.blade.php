<div class="blog-section">
    <div class="container">
        <h1 class="text-center">From Our Blog</h1>

        <p class="section-description text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et sed accusantium maxime dolore cum provident itaque ea, a architecto alias quod reiciendis ex ullam id, soluta deleniti eaque neque perferendis.</p>

        <div class="blog-posts">
          @foreach ($posts as $key => $post)
            <div class="blog-post" id="blog{{$key+1}}">
              <a href="{{ route('blog.show', $post->slug) }}"><img src="{{ productImage($post->image) }}" alt="blog image"></a>
              <a href="#"><h2 class="blog-title">{{ $post->title }}</h2></a>
              <div class="blog-description">{{ $post->meta_description }}</div>
            </div>
          @endforeach
        </div> <!-- end blog-posts -->
    </div> <!-- end container -->
</div> <!-- end blog-section -->
