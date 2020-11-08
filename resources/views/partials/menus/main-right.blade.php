<ul>
    @guest
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" style="padding-top: 0;" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <svg style="width: 30px; height: 30px; fill: #008190;">
            <path d="M12,10.5 C13.6568542,10.5 15,9.15685425 15,7.5 C15,5.84314575 13.6568542,4.5 12,4.5 C10.3431458,4.5 9,5.84314575 9,7.5 C9,9.15685425 10.3431458,10.5 12,10.5 Z M12,12.5 C9.23857625,12.5 7,10.2614237 7,7.5 C7,4.73857625 9.23857625,2.5 12,2.5 C14.7614237,2.5 17,4.73857625 17,7.5 C17,10.2614237 14.7614237,12.5 12,12.5 Z M5,21.5 L3,21.5 C3,17.6340068 7.02943725,14.5 12,14.5 C16.9705627,14.5 21,17.6340068 21,21.5 L19,21.5 C19,18.8641562 15.9603707,16.5 12,16.5 C8.03962935,16.5 5,18.8641562 5,21.5 Z"></path>
          </svg>
          Account
          </a>
          <div class="dropdown-menu p-3">
              <a href="{{ route('login') }}">Login</a>
              <br>
              <a href="{{ route('register') }}">Register</a>
          </div>
      </li>

    @else
      <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" style="padding-top: 0;" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <svg style="width: 30px; height: 30px; fill: #008190;">
            <path d="M12,10.5 C13.6568542,10.5 15,9.15685425 15,7.5 C15,5.84314575 13.6568542,4.5 12,4.5 C10.3431458,4.5 9,5.84314575 9,7.5 C9,9.15685425 10.3431458,10.5 12,10.5 Z M12,12.5 C9.23857625,12.5 7,10.2614237 7,7.5 C7,4.73857625 9.23857625,2.5 12,2.5 C14.7614237,2.5 17,4.73857625 17,7.5 C17,10.2614237 14.7614237,12.5 12,12.5 Z M5,21.5 L3,21.5 C3,17.6340068 7.02943725,14.5 12,14.5 C16.9705627,14.5 21,17.6340068 21,21.5 L19,21.5 C19,18.8641562 15.9603707,16.5 12,16.5 C8.03962935,16.5 5,18.8641562 5,21.5 Z"></path>
          </svg>
          Account
          </a>
          <div class="dropdown-menu p-3">
              <a href="{{ route('users.edit') }}">My Account</a>
              <div class="my-2"></div>
              <a href="{{ route('orders.index') }}">My Orders</a>
              <div class="my-2"></div>
              <a class="" href="{{ route('logout') }}" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
              </a>
          </div>
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
