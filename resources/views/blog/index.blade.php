@extends('layout')

@section('title', 'Blog')

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/algolia.css') }}">
@endsection

@section('content')

    @component('components.breadcrumbs')
      <a href="/">Home</a>
      <i class="fa fa-chevron-right breadcrumb-separator"></i>
      <a href="{{ route('blog.index') }}">Blog</a>
    @endcomponent

    <div class="blog-section">
        <div class="container">
          <div class="container">
            @if (session()->has('success_message'))
              <div class="alert alert-success">
                {{ session()->get('success_message') }}
              </div>
            @endif

            @if(count($errors) > 0)
              <div class="alert alert-danger">
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif
          </div>
            <h1 class="text-center">From Our Blog</h1>

            {{-- <p class="section-description text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et sed accusantium maxime dolore cum provident itaque ea, a architecto alias quod reiciendis ex ullam id, soluta deleniti eaque neque perferendis.</p> --}}
            <div class="blog-header">
                <div class="">
                  <strong>Release:</strong>
                  <a href="{{ route('blog.index', ['category' => request()->category, 'sort' => 'newest']) }}">The latest</a> |
                  <a href="{{ route('blog.index', ['category' => request()->category, 'sort' => 'oldest']) }}">The oldest</a>
                </div>
            </div>
            <div class="blog-posts">
              @foreach ($posts as $key => $post)
                <div class="blog-post" id="">
                  <a href="{{ route('blog.show', $post->slug) }}"><img src="{{ productImage($post->image) }}" alt="blog image"></a>
                  <a href="#"><h2 class="blog-title">{{ $post->title }}</h2></a>
                  <div class="blog-description">{{ $post->meta_description }}</div>
                </div>
              @endforeach
            </div> <!-- end blog-posts -->
        </div> <!-- end container -->
    </div> <!-- end blog-section -->


@endsection

@section('extra-js')
  <!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
  <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
  <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
  <script src="{{ asset('js/algolia.js') }}"></script>
@endsection
