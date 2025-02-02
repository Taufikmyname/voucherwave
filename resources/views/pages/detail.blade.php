@extends('layouts.app')

@section('title')
    Voucher Wave Detail Page
@endsection

@section('content')
    <!-- Page Content-->
    <div class="max-w-4xl mx-auto p-4">
      <!-- Main Card Container -->
      <div class="bg-white rounded-xl shadow-lg overflow-hidden">
          <!-- Section 1: Breadcrumbs -->
          <div class="p-4 border-b" data-aos="fade-down" data-aos-delay="100">
              <nav class="flex" aria-label="Breadcrumb">
                  <ol class="flex items-center space-x-2 text-sm">
                      <li>
                          <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-900">Home</a>
                      </li>
                      <li class="text-gray-500">/</li>
                      <li class="text-gray-500">Product Details</li>
                  </ol>
              </nav>
          </div>
  
          <!-- Section 2: Gallery -->
          <section class="p-4 border-b">
            <div class="flex flex-col lg:flex-row gap-4">
                <!-- Main Image -->
                <div class="lg:w-2/3" data-aos="zoom-in">
                    <img id="mainPhoto" 
                         src="{{ Storage::url($product->galleries->first()->photo) }}" 
                         class="w-full h-64 object-cover rounded-lg transition-opacity duration-300"
                         alt="Main product image" />
                </div>
        
                <!-- Thumbnails -->
                <div class="lg:w-1/3 flex lg:flex-col gap-2 overflow-x-auto">
                    @foreach($product->galleries as $index => $gallery)
                    <div class="flex-shrink-0" data-aos="zoom-in" data-aos-delay="100">
                        <a href="#" onclick="changeActive({{ $index }})" class="block">
                            <img src="{{ Storage::url($gallery->photo) }}"
                                 class="w-20 h-20 object-cover rounded border-2 transition duration-150
                                        {{ $index === 0 ? 'border-blue-500' : 'border-transparent' }}" 
                                 data-index="{{ $index }}"
                                 alt="Thumbnail" />
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
  
          <!-- Section 3: Product Info -->
          <section class="p-4 border-b">
              <div class="flex flex-col lg:flex-row justify-between items-start gap-4">
                  <div>
                      <h1 class="text-2xl font-bold text-gray-900">{{ $product->name }}</h1>
                      <div class="text-xl font-semibold text-blue-600 mt-2">
                          Rp. {{ number_format($product->price) }}
                      </div>
                  </div>
                  @auth
                      @if (Auth::user()->roles == 'USER')
                      <form action="{{ route('detail-add', $product->id) }}" method="POST" 
                            class="w-full lg:w-auto">
                          @csrf
                          <button type="submit" 
                                  class="w-full lg:w-auto px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition duration-150"
                                  data-aos="zoom-in">
                              Add to Cart
                          </button>
                      </form>
                      @endif
                  @else
                      <a href="{{ route('login') }}" 
                         class="w-full lg:w-auto px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg transition duration-150"
                         data-aos="zoom-in">
                          Sign in to Add
                      </a>
                  @endauth
              </div>
          </section>
  
          <!-- Section 4: Description -->
          <section class="p-4 border-b">
              <div class="prose max-w-none">
                  <h3 class="text-lg font-semibold mb-2">Product Description</h3>
                  {!! $product->description !!}
              </div>
          </section>
  
          <!-- Section 5: Reviews -->
          <section class="p-4">
              <div class="space-y-4">
                  <h3 class="text-lg font-semibold">Product Reviews ({{ $total_review }})</h3>
                  
                  @foreach ($review as $reviews)
                      @if ($reviews->description)
                      <div class="flex gap-4 items-start" data-aos="fade-up">
                          <div class="flex-shrink-0">
                              <img src="{{ $reviews->user->photo ? Storage::url($reviews->user->photo) : '/images/icon-testimonial-2.png' }}" 
                                   class="w-12 h-12 rounded-full object-cover" alt="User avatar">
                          </div>
                          <div class="flex-grow">
                              <div class="flex items-center gap-2 mb-1">
                                  <span class="font-medium capitalize">{{ $reviews->user->name }}</span>
                                  <div class="flex text-yellow-400">
                                      @for($i = 0; $i < 5; $i++)
                                          <svg class="w-4 h-4 fill-current {{ $i < $reviews->stars ? 'text-yellow-400' : 'text-gray-300' }}" 
                                               xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                              <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                          </svg>
                                      @endfor
                                  </div>
                              </div>
                              <p class="text-gray-600">{{ $reviews->description }}</p>
                          </div>
                      </div>
                      @endif
                  @endforeach
              </div>
          </section>
      </div>
    </div>
@endsection

@push('addon-script')
<script>
  const photos = [
    @foreach($product->galleries as $gallery)
      {
        id: {{ $gallery->id }},
        url: "{{ Storage::url($gallery->photo) }}",
      },
    @endforeach
  ];

  let activePhoto = 0;

  function changeActive(id) {
    activePhoto = id;
    document.getElementById('mainPhoto').src = photos[activePhoto].url;
  }

  // Initialize AOS (if needed)
  AOS.init();
</script>
@endpush