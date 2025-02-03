@extends('layouts.app')

@section('title')
Voucher Wave Cart Page
@endsection

@section('content')
    <!-- Page Content-->
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg">
      <!-- Breadcrumbs Section -->
      <section class="mb-6">
        <nav class="text-sm">
          <ol class="flex space-x-2">
            <li class="text-gray-500">Cart</li>
          </ol>
        </nav>
      </section>
    
      <!-- Cart Items Section -->
      <section>
        <form id="form" name="form" enctype="multipart/form-data" method="POST">
          @csrf
          @php $totalCost = 0 @endphp
          @foreach ($carts as $cart)
            <div class="mb-6">
              <div class="overflow-x-auto">
                <table class="w-full table-auto">
                  <thead>
                    <tr class="bg-gray-100">
                      <th class="px-4 py-2 text-left">Image</th>
                      <th class="px-4 py-2 text-left">Name</th>
                      <th class="px-4 py-2 text-left">Price</th>
                      <th class="px-4 py-2 text-left">Menu</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="px-4 py-2">
                        @if ($cart->product->galleries)
                          <img src="{{ Storage::url($cart->product->galleries->first()->photo) }}" alt="{{ $cart->product->name }}" class="w-16 h-16 object-cover rounded-lg"/>
                        @endif
                      </td>
                      <td class="px-4 py-2">
                        <div class="font-medium">{{ $cart->product->name }}</div>
                      </td>
                      <td class="px-4 py-2">
                        <div class="font-medium">Rp. {{ number_format($cart->product->price) }}</div>
                        <div class="text-sm text-gray-500">IDR</div>
                      </td>
                      <td class="px-4 py-2">
                        <button onclick="removeCart(this)" data-idcart="{{ $cart->id }}" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">Remove</button>
                      </td>
                    </tr>
                    @php
                      $totalCost += $cart->product->price
                    @endphp
                  </tbody>
                </table>
              </div>
            </div>
    
            <!-- Shipping Details Section -->
            <div class="row" data-aos="fade-up" data-aos-delay="150">
              <div class="col-12">  
              </div>
              <div class="col-12">
                <h2 class="text-xl font-semibold mb-4">Shipping Details</h2>
              </div>
            </div>
            
            <input type="hidden" name="total_cost" value="{{ $totalCost }}">
              <div class="mb-6">
                <h2 class="text-xl font-semibold mb-4">Shipping Details</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                  <div>
                    <label for="nickname" class="block text-sm font-medium text-gray-700">Nickname</label>
                    <input type="text" id="nickname" name="nickname[]" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"/>
                  </div>
                  <div>
                    <label for="game_id" class="block text-sm font-medium text-gray-700">ID Game</label>
                    <input type="text" id="game_id" name="game_id[]" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"/>
                  </div>
                  <div>
                    <label for="server_id" class="block text-sm font-medium text-gray-700">Server Game</label>
                    <input type="text" id="server_id" name="server_id[]" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"/>
                  </div>
                </div>
                <div class="mt-4">
                  <label for="phone_number" class="block text-sm font-medium text-gray-700">Nomor HP</label>
                  <input type="text" id="phone_number" name="phone_number" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"/>
                </div>
              </div>
          @endforeach
    
          <!-- Payment Information Section -->
          <div class="mt-8">
            @if ($totalCost != 0)
              <h2 class="text-xl font-semibold mb-4">Payment Information</h2>
              <div class="flex justify-between items-center">
                <div>
                  <div class="text-2xl font-semibold text-green-600">Rp. {{ number_format($totalCost ?? 0) }}</div>
                  <div class="text-sm text-gray-500">Total</div>
                </div>
                <button onclick="checkout()" type="button" class="px-6 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">Checkout Now</button>
              </div>
            @else
              <div class="text-center py-6 text-gray-500">
                No Items Found
              </div>
            @endif
          </div>
        </form>
      </section>
    </div>
@endsection

@push('addon-script')
    <script>

    const form=document.getElementById("form");
    function removeCart(cartId) {
      let id = cartId.getAttribute("data-idcart");
      form.action=`/cart/${id}`;
      form.submit();
    }
    
      
      function checkout() {
        var gameId = document.getElementsByName("game_id[]");
        var nickname = document.getElementsByName("nickname[]");
        var serverId = document.getElementsByName("server_id[]");
        var phoneNumber = document.getElementsByName("phone_number");

        for (var i = 0; i < nickname.length; i++) {
        if (
          nickname[i].value == "" ||
          nickname[i].value == null ||
          nickname[i].value == undefined
        ) {
          alert("Please fill in the nickname field");
          return false;
        }
      }

      for (var i = 0; i < gameId.length; i++) {
        if (
          gameId[i].value == "" ||
          gameId[i].value == null ||
          gameId[i].value == undefined
        ) {
          alert("Please fill in the id game field");
          return false;
        }
      }

      for (var i = 0; i < serverId.length; i++) {
        if (
          serverId[i].value == "" ||
          serverId[i].value == null ||
          serverId[i].value == undefined
        ) {
          alert("Please fill in the server game field");
          return false;
        }
      }

        for (var i = 0; i < phoneNumber.length; i++) {
        if (
          phoneNumber[i].value == "" ||
          phoneNumber[i].value == null ||
          phoneNumber[i].value == undefined
        ) {
          alert("Please fill in the mobile field");
          return false;
        }
      }
        
      form.action="{{ route('checkout') }}";
      form.submit();
    }


  </script>
@endpush