<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>@yield('title')</title>

    @stack('prepend-style')
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
        <link href="/style/main.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.25/datatables.min.css"/>
    @stack('addon-style')
    @vite(['resources/css/app.css','resources/js/app.js'])
  </head>

  <body>
    <div class="page-dashboard">
      <div class="d-flex" id="wrapper" data-aos="fade-right">
        <!-- Sidebar -->
        <aside id="separator-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
          <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
            <a href="{{ route('home') }}" class="grid h-10 w-32 place-content-center rounded-lg bg-gray-100 text-base text-gray-600 ">
              Voucher Wave
            </a>
            <ul class="space-y-2 font-medium">
                <li>
                  <a href="{{ route('admin-dashboard') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ (request()->is('admin/dashboard')) ? 'bg-sky-400 text-dark' : '' }}">
                      <span class="ms-3">Dashboard</span>
                  </a>
                </li>
                <li class="">
                  <a href="{{ route('product.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ (request()->is('admin/product')) ? 'bg-sky-400 text-dark' : '' }}">
                      <span class="flex-1 ms-3 whitespace-nowrap">Product</span>
                  </a>
                </li>
                <li class="">
                  <a href="{{ route('product-gallery.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ (request()->is('admin/product-gallery*')) ? 'bg-sky-400 text-dark' : '' }}">
                      <span class="flex-1 ms-3 whitespace-nowrap">Galleries</span>
                  </a>
                </li>
                <li class="">
                  <a href="{{ route('category.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ (request()->is('admin/category*')) ? 'bg-sky-400 text-dark' : '' }}">
                      <span class="flex-1 ms-3 whitespace-nowrap">Categories</span>
                  </a>
                </li>
                <li class="">
                  <a href="{{ route('banner.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ (request()->is('admin/banner*')) ? 'bg-sky-400 text-dark' : '' }}">
                      <span class="flex-1 ms-3 whitespace-nowrap ">Banner</span>
                    </a>
                </li>
                <li class="">
                  <a href="{{ route('transaction.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ (request()->is('admin/transaction*','admin/transaction/details*')) ? 'bg-sky-400 text-dark' : '' }}">
                      <span class="flex-1 ms-3 whitespace-nowrap ">Transaction</span>
                    </a>
                </li>
                <li class="">
                  <a href="{{ route('user.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group {{ (request()->is('admin/user*')) ? 'bg-sky-400 text-dark' : '' }}">
                      <span class="flex-1 ms-3 whitespace-nowrap ">User</span>
                    </a>
                </li>
                <li>
                  <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="size-5 opacity-75"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                    />
                  </svg>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                      </form>
                      <span class="flex-1 ms-3 whitespace-nowrap">Logout</span>
                  </a>
                </li>
            </ul>
          </div>
        </aside>

        <!-- Page Content-->
        <div id="page-content-wrapper">
          {{-- Content --}}
          @yield('content')

        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    @stack('prepend-script')
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.25/datatables.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
    <script>
      $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
      });
    </script>
    @stack('addon-script')
  </body>
</html>
