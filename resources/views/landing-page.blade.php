<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Dielektrik</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat|Roboto:300,400,700" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/algolia.css') }}">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    </head>
    <body>
        <header class="with-background">
            <div class="top-nav container">
                <div class="top-nav-left">
                    <div class="logo">
                      <a href="/"><img src="{{ asset('img/logo_dk_transperant.png') }}" alt=""></a>
                    </div>
                    {{-- {{ menu('main', 'partials.menus.main') }} --}}
                </div>
                <div class="top-nav-right">
                  @include('partials.menus.main-right')
                </div>
            </div> <!-- end top-nav -->
            <div class="nav-background">
              <div class="bottom-nav container">
                {{ menu('main', 'partials.menus.main') }}
              </div>
            </div>
            <div class="hero container">
                <div class="hero-copy">
                    <h1>Use code: $$$</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Numquam, velit.</p>

                    <div class="hero-buttons">
                        <a href="{{ route('shop.index') }}" class="button">Shop now</a>
                    </div>
                </div> <!-- end hero-copy -->

                <div class="hero-image">
                    <img src="{{ asset('img/products/CL550-removebg-preview.png') }}" alt="hero image">
                </div>
            </div> <!-- end hero -->
        </header>

        <div class="featured-section">
            <div class="container">
                <h1 class="text-center">Our products</h1>

                <p class="section-description text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit. A aliquid earum fugiat debitis nam, illum vero, maiores odio exercitationem quaerat. Impedit iure fugit veritatis cumque quo provident doloremque est itaque.</p>

                <div class="spacer"></div>
                <h2 class="text-center">Shop by category</h2>
                <div class="spacer"></div>
                <div class="row categories text-center">
                  @foreach ($categories as $key => $category)
                    <div class="category col-lg-4">
                      <a href="{{ route('shop.index', ['category' => $category->slug]) }}">
                        <img class="category_img" src="{{ Voyager::image($category->image) }}" alt="">
                        <div class="text-center category_name">
                          {{ $category->name }}
                        </div>
                        <div class="text-center mb-5">
                          {{ $category->text }}
                        </div>
                      </a>
                    </div>
                  @endforeach
                </div>
                <h2 class="text-center">Top sellers</h2>
                <div class="spacer"></div>

                <div class="products text-center">
                  @foreach ($mostBuyableProducts as $product)
                    <div class="product">
                      <a href="{{ route('shop.show', $product->slug) }}"><img src="{{ Voyager::image($product->image) }}" alt="product"></a>
                      <a href="{{ route('shop.show', $product->slug) }}"><div class="product-name">{{ $product->name }}</div></a>
                      <div class="product-price">{{ $product->presentPrice() }}</div>
                    </div>
                  @endforeach
                </div> <!-- end products -->

                <div class="spacer"></div>
                <h2 class="text-center">More products</h2>
                <div class="spacer"></div>

                <div class="products text-center">
                  @foreach ($products as $product)
                    <div class="product">
                      <a href="{{ route('shop.show', $product->slug) }}"><img src="{{ Voyager::image($product->image) }}" alt="product"></a>
                      <a href="{{ route('shop.show', $product->slug) }}"><div class="product-name">{{ $product->name }}</div></a>
                      <div class="product-price">{{ $product->presentPrice() }}</div>
                    </div>
                  @endforeach
                </div> <!-- end products -->

                <div class="text-center button-container">
                    <a href="{{ route('shop.index') }}" class="button">View more products</a>
                </div>

            </div> <!-- end container -->

        </div> <!-- end featured-section -->

        @include('partials.blogs-section')

        <footer>
            <div class="footer-content container">
                <div class="made-with">Made with <i class="fa fa-heart"></i> by Domantas Šlaičiūnas</div>
                {{ menu('footer', 'partials.menus.footer') }}
            </div> <!-- end footer-content -->
        </footer>

    </body>

    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
    <script src="{{ asset('js/algolia.js') }}"></script>
    <script type="text/javascript">
        $(document).on("click", ".navbar-right .dropdown-menu", function(e){
          e.stopPropagation();
        });
    </script>
</html>
