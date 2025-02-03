@extends('layouts.dashboard')

@section('title')
    Voucher Wave Dashboard
@endsection

@section('content')
    <!-- Section Content-->
    <div class="py-8 px-4 mx-auto max-w-7xl">
      <div class="space-y-6">
          <div>
              <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Dashboard</h2>
              <p class="mt-2 text-gray-600 dark:text-gray-300">Look what you have made today!</p>
          </div>
  
          <div class="mt-8">
              <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Recent Transactions</h3>
              
              <div class="overflow-x-auto rounded-lg shadow">
                  <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                      <thead class="bg-gray-50 dark:bg-gray-800">
                          <tr>
                              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Amount</th>
                              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date</th>
                              <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"></th>
                          </tr>
                      </thead>
                      <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                          @foreach ($transaction_data as $transaction)
                          <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                              <td class="px-6 py-4 whitespace-nowrap">
                                  <span class="px-2.5 py-1 rounded-full text-xs font-medium 
                                      {{ $transaction->transaction_status === 'SUCCESS' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-100' : 
                                         ($transaction->transaction_status === 'PENDING' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-100' : 
                                         'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-100') }}">
                                      {{ $transaction->transaction_status ?? '' }}
                                  </span>
                              </td>
                              <td class="px-6 py-4 whitespace-nowrap text-gray-900 dark:text-white">
                                  Rp. {{ number_format($transaction->total_cost ?? 0) }}
                              </td>
                              <td class="px-6 py-4 whitespace-nowrap text-gray-500 dark:text-gray-300">
                                  {{ $transaction->created_at->format('d M Y, H:i') }}
                              </td>
                              <td class="px-6 py-4 whitespace-nowrap text-right">
                                  <a href="{{ route('dashboard-transaction-details', $transaction->id) }}" class="text-gray-400 hover:text-gray-600 dark:hover:text-gray-300"> 
                                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                      </svg>
                                  </a>
                              </td>
                          </tr>
                          @endforeach
                      </tbody>
                  </table>
              </div>
  
              @if($transaction_data->isEmpty())
                  <div class="text-center py-8">
                      <p class="text-gray-500 dark:text-gray-400">No transactions found</p>
                  </div>
              @endif
          </div>
      </div>
  </div>
@endsection