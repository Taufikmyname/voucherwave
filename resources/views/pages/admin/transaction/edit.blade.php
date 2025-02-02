@extends('layouts.admin')

@section('title')
    Transaction
@endsection

@section('content')
    <!-- Section Content-->
          <div class="section-content section-dashboard-home" data-aos="fade-up">
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class=" text-xl font-bold text-gray-900 dark:text-white">Transaction</h2>
                <p class="mb-4 text-base text-gray-900 dark:text-white">Edit Transaction</p>
              </div>
              <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('transaction.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label> class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"Transaction Status</label>
                                                <select name="transaction_status" class="form-control">
                                                    @if ($item->transaction_status == 'SUCCESS')
                                                    <option selected disabled value="{{ $item->transaction_status }}">{{ $item->transaction_status }}</option>
                                                    @else
                                                    <option selected disabled value="PENDING">PENDING</option>
                                                    <option value="PAID">PAID</option>
                                                    <option value="SUCCESS">SUCCESS</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total Price</label>
                                                <input type="number" name="total_cost" class="form-control" value="{{ $item->total_cost }}" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($item->transaction_status == 'PENDING')
                                    <div class="row">
                                        <div class="col text-right">
                                            <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                                                Save Now
                                            </button>
                                        </div>
                                    </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
@endsection

@push('addon-script')
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
    <script>
            CKEDITOR.replace( 'editor' );
    </script>
@endpush