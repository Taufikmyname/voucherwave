<nav class="fixed top-0 w-full bg-white shadow-sm z-50 border-b">
  <div class="container mx-auto px-4">
      <div class="flex justify-between items-center h-16">
          <!-- Left-aligned logo and text -->
          <a href="{{ route('home') }}" class="flex items-center space-x-4">
              <img 
                  class="w-12 h-12 rounded-full object-cover" 
                  src="{{ asset('images/VoucherWaveLogo.png') }}" 
                  alt="Voucher Wave Logo"
              >
              <span class="text-xl font-semibold text-gray-800">Voucher Wave</span>
          </a>

          <!-- Desktop Navigation -->
          <div class="hidden md:flex space-x-8">
              <a 
                  href="{{ route('home') }}" 
                  class="text-gray-600 hover:text-blue-600 transition-colors duration-200"
              >
                  Home
              </a>
              <a 
                  href="{{ route('categories') }}" 
                  class="text-gray-600 hover:text-blue-600 transition-colors duration-200"
              >
                  Categories
              </a>
          </div>

          <!-- Mobile Menu Button -->
          <div class="md:hidden">
              <label for="menu-toggle" class="cursor-pointer">
                  <svg 
                      class="w-6 h-6 text-gray-600" 
                      fill="none" 
                      stroke-linecap="round" 
                      stroke-linejoin="round" 
                      stroke-width="2" 
                      viewBox="0 0 24 24" 
                      stroke="currentColor"
                  >
                      <path d="M4 6h16M4 12h16M4 18h16"></path>
                  </svg>
              </label>
              <input type="checkbox" class="hidden" id="menu-toggle">
          </div>
      </div>

      <!-- Mobile Menu -->
      <div class="hidden md:hidden peer-checked/menu-toggle:block">
          <div class="pt-2 pb-3 space-y-1">
              <a 
                  href="{{ route('home') }}" 
                  class="block px-3 py-2 text-gray-600 hover:bg-gray-100"
              >
                  Home
              </a>
              <a 
                  href="{{ route('categories') }}" 
                  class="block px-3 py-2 text-gray-600 hover:bg-gray-100"
              >
                  Categories
              </a>
          </div>
      </div>
  </div>
</nav>