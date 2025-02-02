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

        <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
          <span class="sr-only">Open sidebar</span>
          <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
          <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
          </svg>
       </button>
       <!-- Sidebar -->
       <aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
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
        <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
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
    @stack('addon-script')
  </body>
</html>
