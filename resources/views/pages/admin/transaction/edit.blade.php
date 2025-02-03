@extends('layouts.admin')

@section('title')
    Transaction
@endsection

@section('content')
    <!-- Section Content-->
    <div class="py-8 px-4 mx-auto max-w-7xl">
        <div class="space-y-6 mb-8">
            <!-- Transaction Header -->
            <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Edit Transaction</h2>
                <p class="text-gray-600 dark:text-gray-300">Modify the transaction details below</p>
            </div>
    
            <!-- Error Message -->
            @if($errors->any())
            <div class="alert alert-danger mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
    
            <!-- Transaction Edit Form -->
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-lg">
                <form action="{{ route('transaction.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="p-6">
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Transaction Status</label>
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
                        <div class="mb-4">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total Price</label>
                            <input type="number" name="total_cost" class="form-control" value="{{ $item->total_cost }}" disabled>
                        </div>
                        @if ($item->transaction_status == 'PENDING')
                        <div class="text-right">
                            <button type="submit" class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                                Save Now
                            </button>
                        </div>
                        @endif
                    </div>
                </form>
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