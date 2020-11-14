@extends('layout')

@section('title', $product->name)

@section('extra-css')
    <link rel="stylesheet" href="{{ asset('css/algolia.css') }}">
@endsection

@section('content')

    @component('components.breadcrumbs')
      <a href="/">Home</a>
      <i class="fa fa-chevron-right breadcrumb-separator"></i>
      <a href="{{ route('shop.index') }}">Shop</a>
      <i class="fa fa-chevron-right breadcrumb-separator"></i>
      <span>{{ $product->name }}</span>
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
    <div class="product-section container">
    <div class="">
      <div class="product-section-image">
        {{-- <img src="{{ asset('img/products/'.$product->slug.'.jpg') }}" alt="product" class="active" id="currentImage"> --}}
        <img src="{{ productImage($product->image) }}" alt="product" class="active" id="currentImage">
      </div>
      <div class="product-section-images">

        <div class="product-section-thumbnail">
          <img src="{{ productImage($product->image) }}" alt="product">
        </div>

        @if ($product->images)
          @foreach (json_decode($product->images) as $key => $image)
            <div class="product-section-thumbnail">
              <img src="{{ productImage($image) }}" alt="product">
            </div>
          @endforeach
        @endif
      </div>
    </div>
      <div class="product-section-information">
          <h1 class="product-section-title">{{ $product->name }}</h1>
          <div class="product-section-subtitle">{{ $product->details }}</div>
          <div class="">{!! $stockLevel !!}</div>
          <div class="spacer"></div>
          <div> <span class="Stars" style="--rating: {{ $ratings }}" aria-label="Rating of this product is 2.3 out of 5."></span>  {{ $comments_count }} reviews</div>
          &nbsp;
          <div class="athenaProductPage_hr"></div>
          &nbsp;
          <div class="product-section-price">{{ $product->presentPrice() }}
            @if ($product->quantity > 0)
              <form class="" action="{{ route('cart.store') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $product->id }}">
                <input type="hidden" name="name" value="{{ $product->name }}">
                <input type="hidden" name="price" value="{{ $product->price }}">
                <button type="submit" class="button button-plain" name="button">Add to Cart</button>
              </form>
            @endif
          </div>
          &nbsp;
          <div class="athenaProductPage_hr"></div>
          &nbsp;
          <p>
              {!! $product->description !!}
          </p>

          <p>&nbsp;</p>

      </div>
    </div> <!-- end product-section -->

    <div class="container">
      <div class="comment-container">
        @comments(['model' => $product])
      </div>
    </div>
    @include('partials.might-like')

@endsection

@section('extra-js')
  <script>
    (function(){
      const currentImage = document.querySelector('#currentImage');
      const images = document.querySelectorAll('.product-section-thumbnail');

      images.forEach((element) => element.addEventListener('click', thumbnailClick));

      function thumbnailClick(e) {
        currentImage.classList.remove('active');

        currentImage.addEventListener('transitionend', () => {
          currentImage.src = this.querySelector('img').src;
          currentImage.classList.add('active');
        })

        images.forEach((element) => element.classList.remove('selected'));
        this.classList.add('selected');
      }
    })();
  </script>

  <!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
  <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
  <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
  <script src="{{ asset('js/algolia.js') }}"></script>
@endsection
