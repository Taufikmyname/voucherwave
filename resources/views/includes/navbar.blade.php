
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
      </div>
    </div>

  </div>
</nav>