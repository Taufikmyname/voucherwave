
<nav class="bg-white dark:bg-gray-800 antialiased">
  <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0 py-4">
    <div class="flex items-center justify-between">

      <div class="flex items-center space-x-8">
        <div class="shrink-0">
          <a href="#" title="" class="">
            <img class="block w-auto h-8 dark:hidden" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/logo-full.svg" alt="">
            <img class="hidden w-auto h-8 dark:block" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/logo-full-dark.svg" alt="">
          </a>
        </div>

        <ul class="hidden lg:flex items-center justify-start gap-6 md:gap-8 py-3 sm:justify-center">
          <li>
            <a href="{{ route('home') }}" title="" class="flex text-sm font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">
              Home
            </a>
          </li>
          <li class="shrink-0">
            <a href="{{ route('categories') }}" title="" class="flex text-sm font-medium text-gray-900 hover:text-primary-700 dark:text-white dark:hover:text-primary-500">
              Categories
            </a>
          </li>
        </ul>
      </div>



      <div class="flex items-center lg:space-x-2">
        <div class="flex items-center gap-4">
          <div class="sm:flex sm:gap-4">
            @guest
            <a href="{{ route('login') }}" class="inline-block rounded-lg px-6 py-3.5 text-center font-medium text-black hover:bg-primary-800 hover:text-white">
              Login
            </a>
  
            <a href="{{ route('register') }}" class="inline-block rounded-lg px-6 py-3.5 text-center font-medium text-black hover:bg-primary-800 hover:text-white">
              Register
            </a>
            @endguest
          </div>


          {{-- @auth
          <ul class="navbar-nav d-none d-lg-flex">
            <li class="nav-item">
              <a
                href="#"
                class="nav-link"
                id="navbarDropdown"
                role="button"
                data-toggle="dropdown"
              >
                @if ($user->photo != null)
                  <img src="{{ Storage::url($user->photo) }}" class="rounded-circle mr-2 profile-picture">
                @else
                  <img src="/images/icon-testimonial-2.png" class="rounded-circle mr-2 profile-picture">
                @endif
                Hi, {{ Auth::user()->name }}
              </a>
              <div class="dropdown-menu">
                @if (Auth::user()->roles == 'ADMIN')  
                  <a href="{{ route('admin-dashboard') }}" class="inline-block rounded-lg px-6 py-3.5 text-center font-medium text-black hover:bg-primary-800 hover:text-white">Dashboard</a>
                @else
                <a href="{{ route('dashboard') }}" class="hidden sm:inline-flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-xs px-3 py-1.5 mr-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">Dashboard</a>
                <a href="{{ route('dashboard-account') }}" class="dropdown-item"
                  >Settings</a
                >
                @endif
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </div>
            </li>
            @if (Auth::user()->roles == 'USER')  
            <li class="nav-item">
              <a href="{{ route('cart') }}" class="nav-link d-inline-block mt-2">
                @php
                  $carts = \App\Models\Cart::where('users_id', Auth::user()->id)->count();
                @endphp
                @if ($carts > 0)
                  <img src="/images/icon-cart-filled.svg" alt="" />
                  <div class="card-badge">{{ $carts }}</div>
                @else
                  <img src="/images/icon-cart-empty.svg" alt="" />
                @endif
              </a>
            </li>
            @endif
          </ul>
          

          <ul class="navbar-nav d-block d-lg-none">
            <li class="nav-item">
              @if (Auth::user()->roles == 'ADMIN')  
                <a href="{{ route('admin-dashboard') }}" class="nav-link">Hi, {{ Auth::user()->name }}</a>
              @else
              <a href="{{ route('dashboard') }}" class="nav-link">
                Hi, {{ Auth::user()->name }}
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('cart') }}" class="nav-link d-inline-block">
                Cart
              </a>
            </li>
            @endif
            <li class="nav-item">
              <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">Logout</a>
            </li>
          </ul>
          @endauth
        </div>
      </div> --}}

      

        
      <button type="button" class="flex mx-3 text-sm bg-gray-800" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="dropdown">
        @auth
        <span class="py-2 px-4 bg-white text-lg hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">
          @if ($user->photo != null)
            <img src="{{ Storage::url($user->photo) }}" class="object-right w-8 h-8 rounded-full" alt="user photo">
          @else
            <img src="/images/icon-testimonial-2.png" class="object-left w-8 h-8 rounded-full" alt="user photo">
          @endif
          Hi, {{ Auth::user()->name }}
        </span>
        @endauth
      </button>


      <!-- Dropdown menu -->
      <div class="hidden z-50 my-4 w-56 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown">
        <div class="py-1 text-dark dark:text-gray-400">
          @auth
            @if (Auth::user()->roles == 'ADMIN')  
              <a href="{{ route('admin-dashboard') }}" class="block py-2 px-4 text-base hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">Dashboard</a>
            @else
            <a href="{{ route('dashboard') }}" class="block py-2 px-4 text-base hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">
              Dashboard
            </a>
              <li>
                <a href="{{ route('cart') }}" class="flex flex-row block py-2 px-4 text-base hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">
                  <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 4h1.5L9 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-8.5-3h9.25L19 7H7.312"/>
                  </svg>
                  @php
                  $carts = \App\Models\Cart::where('users_id', Auth::user()->id)->count();
                  @endphp
                  @if ($carts > 0)
                    <img src="/images/icon-cart-filled.svg" alt="" />
                    <div class="card-badge">{{ $carts }}</div>
                  @else
                    <img src="/images/icon-cart-empty.svg" alt="" />
                  @endif
                  <span class="pl-4">Carts</span>
                </a>
              </li>
              <li>
                <a href="{{ route('dashboard-account') }}" class="block  py-2 px-4 text-base hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">Account settings</a>
            </li>
            @endif
        </div>
        
        <ul class="py-1 text-gray-500 dark:text-gray-400" aria-labelledby="dropdown">
            <li>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Log out</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
            </li>
        </ul>
        @endauth
      </div>
    </div>
  </div>
</nav>
