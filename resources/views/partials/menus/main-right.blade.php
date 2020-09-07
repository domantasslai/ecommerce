<ul>
    @guest

    <li class=""><a href="{{ route('register') }}">Sign Up</a></li>
    <li class=""><a href="{{ route('login') }}">Login</a></li>
    @else
      <li>
          <a class="" href="#">My Account</a>
      </li>
    <li>
        <a class="" href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a>
    </li>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    @endguest
    <li>
        <a href="{{ route('cart.index') }}">Cart
         @if (Cart::instance('default')->count() > 0)
         <span class="cart-count"><span>{{ Cart::instance('default')->count() }}</span></span>
         @endif
       </a>
     </li>
</ul>

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
