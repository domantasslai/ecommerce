  @foreach($items as $menu_item)
            <a href="{{ $menu_item->link() }}"
              class="@if ('/'.Request::segment(1) == $menu_item->link())checked_nav_item @endif">

                {{ $menu_item->title }}
                @if ($menu_item->title === 'Cart')
                    @if (Cart::instance('default')->count() > 0)
                    <span class="cart-count"><span>{{ Cart::instance('default')->count() }}</span></span>
                    @endif
                @endif
            </a>
    @endforeach

{{-- <ul>
    <li><a href="{{ route('shop.index') }}">Shop</a></li>
    <li><a href="#">About</a></li>
    <li><a href="#">Blog</a></li>
    <li>
        <a href="{{ route('cart.index') }}">Cart <span class="cart-count">
            @if (Cart::instance('default')->count() > 0 )
              <span>{{ Cart::instance('default')->count() }}</span></span>
            @endif
        </a>
    </li>
</ul> --}}
