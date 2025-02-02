@extends('layouts.app')

@section('title')
    Voucher Wave Homepage
@endsection
  

@section('content')
    <div class="page-content page-home">

      {{-- Banner --}}
      <section class="store-carousel">
        <div class="relative w-full" data-carousel="slide">
            <!-- Carousel wrapper -->
            <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                @foreach ($banner as $banners)
                    <div class="{{ $loop->first ? '' : 'hidden' }} duration-700 ease-in-out" data-carousel-item>
                        <img src="{{ Storage::url($banners->photo) }}" 
                             alt="{{ $banners->title ?? 'Banner Image' }}" 
                             class="absolute block w-full h-full object-cover object-center -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 rounded-lg shadow-md" />
                    </div>
                @endforeach
            </div>
            <!-- Slider indicators -->
            <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3">
                @foreach ($banner as $index => $banners)
                    <button type="button" class="w-3 h-3 rounded-full bg-white/50" aria-current="{{ $loop->first ? 'true' : 'false' }}" data-carousel-slide-to="{{ $index }}"></button>
                @endforeach
            </div>
            <!-- Slider controls -->
            <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50">
                    <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                    </svg>
                    <span class="sr-only">Previous</span>
                </span>
            </button>
            <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 group-hover:bg-white/50">
                    <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="sr-only">Next</span>
                </span>
            </button>
        </div>
    </section>
    
      {{-- Category --}}
      <section class="store-categories mt-4">
        <div class="container mx-auto px-4">
            <div class="mb-4">
                <h5 class="text-xl font-semibold text-gray-900">Categories</h5>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @php $incrementCategory = 0 @endphp
                @forelse ($categories as $category)
                    <a href="{{ route('categories-detail', $category->slug) }}" 
                       class="group block text-center bg-white rounded-lg shadow-md hover:shadow-lg transition duration-300 ease-in-out"
                       data-aos="fade-up" data-aos-delay="{{ $incrementCategory += 100 }}">
                        <div class="relative">
                            <!-- Full-size image inside the card -->
                            <img src="{{ Storage::url($category->photo) }}" 
                                 alt="{{ $category->name }}" 
                                 class="w-full h-[200px] object-cover rounded-t-lg" />
                            <!-- Text content inside the card, positioned at the bottom -->
                            <p class="mt-3 text-2xl text-gray-900 font-medium group-hover:underline group-hover:underline-offset-4">
                                {{ $category->name }}
                            </p>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-5" data-aos="fade-up" data-aos-delay="100">
                        No Categories Found
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    
    


      {{-- Product --}}
      <section class="store-new-products mt-2">
        <div class="container mx-auto px-4">
            <div class="mb-4">
                <h5 class="text-xl font-semibold text-gray-900">New Products</h5>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @php $incrementProduct = 0 @endphp
                @forelse ($products as $product)
                    <a href="{{ route('detail', $product->slug) }}" class="group block"
                       data-aos="fade-up" data-aos-delay="{{ $incrementProduct+= 100 }}">
                        <img 
                            src="{{ $product->galleries->count() 
                                    ? Storage::url($product->galleries->first()->photo) 
                                    : 'https://via.placeholder.com/50' }}" 
                            alt="{{ $product->name }}" 
                            class="h-[50px] w-[50px] object-cover rounded-md shadow-sm"
                        />
                        <div class="mt-2 text-sm">
                            <h3 class="text-gray-900 font-medium group-hover:underline group-hover:underline-offset-4">
                                {{ $product->name }}
                            </h3>
                            <p class="text-gray-900 font-semibold">
                                Rp. {{ number_format($product->price) }}
                            </p>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full text-center py-5" data-aos="fade-up" data-aos-delay="100">
                        No Products Found
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    
    </div>
@endsection
