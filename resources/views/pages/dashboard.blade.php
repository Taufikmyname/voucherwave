@extends('layouts.dashboard')

@section('title')
    Voucher Wave Dashboard
@endsection

@section('content')
    <!-- Section Content-->
    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
      <div class="container-fluid">
        <div class="dashboard-heading">
          <h2 class=" text-xl font-bold text-gray-900 dark:text-white">Dashboard</h2>
          <p class="mb-4 text-base text-gray-900 dark:text-white">Look what you have made today!</p>
        </div>
        <div class="dashboard-content">
          <div class="row mt-3">
            <div class="col-12 mt-2">
              <h5 class="mb-3">Recent Transactions</h5>
              @foreach ($transaction_data as $transaction)
                  <a href="{{ route('dashboard-transaction-details', $transaction->id) }}" class="card card-list d-block">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-4">{{ $transaction->transaction_status ?? '' }}</div>
                    <div class="col-md-4">Rp. {{number_format ($transaction->total_cost ?? '') }}</div>
                    <div class="col-md-3">{{ $transaction->created_at ?? '' }}</div>
                    <div class="col-md-1 d-none d-md-block">
                      <img src="/images/dashboard-arrow-right.svg" alt="" />
                    </div>
                  </div>
                </div>
              </a>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection