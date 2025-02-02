@extends('layouts.app')

@section('title')
Voucher Wave Category Page
@endsection

@section('content')
    <!-- Page Content-->
    <div class="container mx-auto p-4">
      <section class="mb-8">
          <h2 class="text-xl font-semibold mb-4">Categories</h2>
          <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
              @foreach ($categories as $category)
                  <a href="{{ route('categories-detail', $category->slug) }}" class="block rounded-lg p-4 shadow-lg shadow-indigo-100">
                      <img
                          alt="{{ $category->name }}"
                          src="{{ Storage::url($category->photo) }}"
                          class="h-40 w-full rounded-md object-cover"
                      />
                      <p class="text-center mt-2 font-medium">{{ $category->name }}</p>
                  </a>
              @endforeach
          </div>
      </section>
  
      <section>
          <h2 class="text-xl font-semibold mb-4">Products</h2>
          <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
              @foreach ($products as $product)
                  <a href="{{ route('detail', $product->slug) }}" class="block rounded-lg p-4 shadow-lg shadow-indigo-100">
                      <img
                          alt="{{ $product->name }}"
                          src="{{ $product->galleries->count() ? Storage::url($product->galleries->first()->photo) : 'https://via.placeholder.com/300' }}"
                          class="h-56 w-full rounded-md object-cover"
                      />
  
                      <div class="mt-2">
                          <dl>
                              <div>
                                  <dt class="sr-only">Price</dt>
                                  <dd class="text-sm text-gray-500">Rp. {{ number_format($product->price) }}</dd>
                              </div>
                              <div>
                                  <dt class="sr-only">Product Name</dt>
                                  <dd class="font-medium">{{ $product->name }}</dd>
                              </div>
                          </dl>
                          <div class="mt-6 flex items-center gap-8 text-xs">
                              <div class="sm:inline-flex sm:shrink-0 sm:items-center sm:gap-2">
                                  <svg class="size-4 text-indigo-700" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                  </svg>
                                  <div class="mt-1.5 sm:mt-0">
                                      <p class="text-gray-500">Category</p>
                                      <p class="font-medium">{{ $product->category->name ?? 'Uncategorized' }}</p>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </a>
              @endforeach
          </div>
      </section>
  </div>
  
@endsection