<header>
  <div class="top-nav container">
    <div class="top-nav-left">
        <div class="logo"><a href="/"><img src="{{ asset('img/logo_dk_transperant.png') }}" alt=""></a></div>
    </div>
    <div class="top-nav-right">
        @if (! (request()->is('checkout') || request()->is('guest-checkout')))
          @include('partials.menus.main-right')
        @endif
    </div>
  </div> <!-- end top-nav -->
  <div class="nav-background">
    <div class="botom-nav container">
      @foreach ($categories as $key => $category)
        <a href="{{ route('shop.index', ['category' => $category->slug]) }}" class="{{ setActiveCategory($category->slug) }}">{{ $category->name }}</a>
      @endforeach
      {{ menu('main', 'partials.menus.main') }}
    </div>
  </div>
</header>
