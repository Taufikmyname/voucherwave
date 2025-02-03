@extends('layouts.dashboard')

@section('title')
Voucher Wave Dashboard Transaction Detail
@endsection

@section('content')
    <!-- Section Content-->
    <div class="py-8 px-4 mx-auto max-w-7xl">
      @foreach ($transaction as $transactions)
      <div class="space-y-6 mb-8">
          <!-- Transaction Header -->
          <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
              <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Transaction #{{ $transactions->code }}</h2>
              <p class="text-gray-600 dark:text-gray-300">Detailed transaction information</p>
          </div>
  
          <!-- Customer Information Table -->
          <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-lg">
              <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                  <thead class="bg-gray-50 dark:bg-gray-700">
                      <tr>
                          <th colspan="2" class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-300 uppercase">
                              Customer Details
                          </th>
                      </tr>
                  </thead>
                  <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                      <tr>
                          <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                              Customer Name
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                              {{ $transactions->user->name }}
                          </td>
                      </tr>
                      <tr>
                          <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                              Mobile Number
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                              {{ $transactions->user->phone_number }}
                          </td>
                      </tr>
                      <tr>
                          <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                              Transaction Date
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                              {{ $transactions->created_at->format('M d, Y H:i') }}
                          </td>
                      </tr>
                      <tr>
                          <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                              Total Amount
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">
                              Rp. {{ number_format($transactions->total_cost) }}
                          </td>
                      </tr>
                      <tr>
                          <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                              Payment Status
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                              <span class="px-2.5 py-1 rounded-full text-xs font-medium 
                                  {{ $transactions->transaction_status === 'SUCCESS' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-100' : 
                                     'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-100' }}">
                                  {{ $transactions->transaction_status }}
                              </span>
                          </td>
                      </tr>
                  </tbody>
              </table>
          </div>
  
          <!-- Shipping Information -->
          <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-lg">
              <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                  <thead class="bg-gray-50 dark:bg-gray-700">
                      <tr>
                          <th colspan="4" class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-300 uppercase">
                              Shipping Details
                          </th>
                      </tr>
                  </thead>
                  <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                      @foreach ($transactionDetail as $transaction)
                      <tr>
                          <td class="px-6 py-4" colspan="4">
                              <div class="flex flex-col md:flex-row gap-6">
                                  <div class="w-full md:w-1/3">
                                      <img src="{{ Storage::url($transaction->product->galleries->first()->photo ?? '') }}" 
                                           class="w-full h-48 object-cover rounded-lg" alt="Product Image">
                                  </div>
                                  <div class="w-full md:w-2/3 grid grid-cols-1 md:grid-cols-2 gap-4">
                                      <div>
                                          <p class="text-sm font-medium text-gray-900 dark:text-white">Product Name</p>
                                          <p class="text-sm text-gray-500 dark:text-gray-300">{{ $transaction->product->name }}</p>
                                      </div>
                                      <div>
                                          <p class="text-sm font-medium text-gray-900 dark:text-white">Game ID</p>
                                          <p class="text-sm text-gray-500 dark:text-gray-300">{{ $transaction->game_id }}</p>
                                      </div>
                                      <div>
                                          <p class="text-sm font-medium text-gray-900 dark:text-white">Server</p>
                                          <p class="text-sm text-gray-500 dark:text-gray-300">{{ $transaction->server_id }}</p>
                                      </div>
                                      <div>
                                          <p class="text-sm font-medium text-gray-900 dark:text-white">Nickname</p>
                                          <p class="text-sm text-gray-500 dark:text-gray-300">{{ $transaction->nickname }}</p>
                                      </div>
                                      <div>
                                          <p class="text-sm font-medium text-gray-900 dark:text-white">Shipping Status</p>
                                          <p class="text-sm text-gray-500 dark:text-gray-300">{{ $transaction->shipping_status }}</p>
                                      </div>
                                  </div>
                              </div>
                          </td>
                      </tr>
                      @endforeach
                  </tbody>
              </table>
          </div>
  
          <!-- Actions & Reviews -->
          <form action="{{ route('dashboard-transaction-update', $transactions->id) }}" method="POST" class="space-y-6">
              @csrf
              @if ($transactions->transaction_status == "SUCCESS")
              <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                  @if ($transaction->shipping_status == "PROCESS")
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-4 items-end">
                      <div>
                          <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                              Confirm Delivery Status
                          </label>
                          <select name="shipping_status" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white">
                              <option value="{{ $transaction->shipping_status }}">{{ $transaction->shipping_status }}</option>
                              <option value="SUCCESS">SUCCESS</option>
                          </select>
                      </div>
                      <button type="submit" class="w-full md:w-auto px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors">
                          Update Status
                      </button>
                  </div>
                  @endif
  
                  <!-- Review Section -->
                  @if ($transactions->transaction_status == 'SUCCESS')
                  <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                      <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Product Review</h3>
                      <div class="space-y-4">
                          <div>
                              <textarea name="description" rows="3" 
                                  class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white"
                                  placeholder="Write your review here...">{{ $review->description ?? '' }}</textarea>
                          </div>
                          
                          <div class="flex items-center gap-2">
                              <span class="text-sm text-gray-700 dark:text-gray-300">Rating:</span>
                              <div class="flex items-center gap-1">
                                  @for ($i = 1; $i <= 5; $i++)
                                  <input type="radio" name="stars" value="{{ $i }}" id="rate-{{ $i }}" 
                                         class="peer hidden" {{ ($review->stars ?? 0) == $i ? 'checked' : '' }}>
                                  <label for="rate-{{ $i }}" class="cursor-pointer text-gray-300 peer-checked:text-yellow-400">
                                      <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                          <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                      </svg>
                                  </label>
                                  @endfor
                              </div>
                          </div>
  
                          @if (empty($review->description))
                          <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                              Submit Review
                          </button>
                          @endif
                      </div>
                  </div>
                  @endif
              </div>
              @endif
          </form>
      </div>
      @endforeach
  </div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script>
      var transactionDetails = new Vue({
        el: "#transactionDetails",
        data: {
          status: "{{ $transaction->shipping_status }}",
        },
      });
    </script>
@endpush