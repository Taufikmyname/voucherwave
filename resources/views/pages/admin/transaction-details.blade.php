@extends('layouts.admin')

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
              <p class="text-gray-600 dark:text-gray-300">Transactions Details</p>
          </div>
  
          <!-- Transaction Information Table -->
          <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-lg">
              <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                  <thead class="bg-gray-50 dark:bg-gray-700">
                      <tr>
                          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-300">Customer Name</th>
                          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-300">Date of Transaction</th>
                          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-300">Payment Status</th>
                          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-300">Mobile</th>
                          <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-300">Total Amount</th>
                      </tr>
                  </thead>
                  <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                      <tr>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-white">{{ $transactions->user->name }}</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $transactions->created_at->format('M d, Y H:i') }}</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $transactions->transaction_status }}</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">{{ $transactions->user->phone_number }}</td>
                          <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-300">Rp. {{ number_format($transactions->total_cost) }}</td>
                      </tr>
                  </tbody>
              </table>
          </div>
  
          <!-- Shipping Information -->
          <div class="mt-6">
              <h5 class="mb-4">Shipping Information</h5>
              <form method="POST" action="{{ route('admin-transaction-details-update', $transactions->id) }}" enctype="multipart/form-data>
                  @csrf
                  @foreach ($transactionDetail as $transaction)
                  <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-lg mb-4">
                      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-6">
                          <div class="col-12 col-md-2">
                              <img src="{{ Storage::url($transaction->product->galleries->first()->photo ?? '') }}" class="w-100 mb-3" alt="" />
                          </div>
                          <div class="col-12 col-md-2">
                              <div class="product-title">Product Name</div>
                              <div class="product-subtitle">{{ $transaction->product->name }}</div>
                          </div>
                          <div class="col-12 col-md-2">
                              <div class="product-title">Nickname</div>
                              <div class="product-subtitle">{{ $transaction->nickname }}</div>
                          </div>
                          <div class="col-12 col-md-2">
                              <div class="product-title">ID Game</div>
                              <div class="product-subtitle">{{ $transaction->game_id }}</div>
                          </div>
                          <div class="col-12 col-md-2">
                              <div class="product-title">Server Game</div>
                              <div class="product-subtitle">{{ $transaction->server_id }}</div>
                          </div>
                          <div class="col-12 col-md-2">
                              <input type="hidden" name="id_transaksi" value="{{ $transactions->id }}">
                              <div class="product-title">Shipping Status</div>
                              <select name="shipping_status" id="status" class="form-control">
                                  @if ($transactions->transaction_status == 'PAID')
                                      <option selected disabled value="{{ $transaction->shipping_status }}">{{ $transaction->shipping_status }}</option>
                                  @else
                                      <option selected disabled value="PENDING">PENDING</option>
                                      <option value="SUCCESS">SUCCESS</option>
                                  @endif
                              </select>
                          </div>
                      </div>
                  </div>
                  @endforeach
                  @if($transactions->transaction_status == 'PAID')
                  <div class="text-right">
                      <button type="submit" class="btn btn-success">Save</button>
                  </div>
                  @endif
              </form>
          </div>
      </div>
      @endforeach
  </div>
@endsection