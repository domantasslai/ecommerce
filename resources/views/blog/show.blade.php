@extends('layout')

@section('title', 'Blog')

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/algolia.css') }}">
    <style media="screen">
      .carousel-item img{
        top: 0;
        left: 0;
        min-width: 100%;
        height: 550px;
        max-height: 550px;
        width: auto;
      }
    </style>
@endsection

@section('content')

    @component('components.breadcrumbs')
      <a href="/">Home</a>
      <i class="fa fa-chevron-right breadcrumb-separator"></i>
      <a href="{{ route('blog.index') }}">Blog</a>
    @endcomponent

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

    <div class="blog-section">
        <div class="container">
            <div class="blog-post">
              <h1 class="blog-show-title">{{ $post->title }}</h1>
              <img src="{{ productImage($post->image) }}" id="landing_photo" alt="blog image">
              <div class="blog-description">{!! $post->body !!}</div>
            </div>
            <div class="spacer"></div>
            @if (isset($post->images))
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
              </ol>
              <div class="carousel-inner">
                @forelse(json_decode($post->images) as $key => $slider)
                  <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
                    <img src="{{ productImage($slider) }}" class="d-block" style=""  alt="...">
                  </div>
                @empty

                @endforelse
              </div>
              <a class="carousel-control-prev" href="#myCarousel" role="button"  data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true">     </span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
            @endif
        </div> <!-- end container -->
    </div> <!-- end blog-section -->

    @include('partials.blogs-section')
@endsection

@section('extra-js')
  <!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
  <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
  <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
  <script src="{{ asset('js/algolia.js') }}"></script>
@endsection
