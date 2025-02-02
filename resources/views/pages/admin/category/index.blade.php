@extends('layouts.admin')

@section('title')
    Category
@endsection

@section('content')
    <!-- Section Content-->
          <div class="section-content section-dashboard-home" data-aos="fade-up">
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class=" text-xl font-bold text-gray-900 dark:text-white">Category</h2>
                <p class="mb-4 text-base text-gray-900 dark:text-white">List of Categories</p>
              </div>
              <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('category.create') }}" class="btn btn-primary mb-3">
                                + Add New Category
                                </a>
                                <div class="table-responsive">
                                    <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            <tr>
                                                <th scope="col" class="px-6 py-3">ID</th>
                                                <th scope="col" class="px-6 py-3">Name</th>
                                                <th scope="col" class="px-6 py-3">Photo</th>
                                                <th scope="col" class="px-6 py-3">Slug</th>
                                                <th scope="col" class="px-6 py-3">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
@endsection

@push('addon-script')
    <script>
        var datatable = $('#crudTable').DataTable({
            processing: true,
            serverside: true,
            ordering: true,
            ajax: {
                url: '{!! url()->current() !!}',
            },
            createdRow: function(row, data, dataIndex) {
                $(row).addClass('bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600');
            },
            language: {
                paginate: {
                    previous: '← Previous',
                    next: 'Next →'
                }
            },
            pagingType: 'simple',
            dom: '<"p-4"<"flex items-center justify-between"<"hidden sm:block"l><"flex space-x-4"f>>>t<"p-4"<"flex items-center justify-between"<"text-gray-600 dark:text-gray-400 text-sm"i><"flex space-x-2"p>>>',
            initComplete: function() {
                // Style pagination container
                $('.dataTables_paginate').addClass('inline-flex items-center space-x-2');
                $('.paginate_button').addClass('px-3 py-1.5 text-sm font-medium rounded-md transition-colors');
            },
            drawCallback: function() {
                // Update button styles
                $('.paginate_button:not(.disabled)')
                    .addClass('bg-white hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 border border-gray-300 dark:border-gray-600')
                    .removeClass('bg-gray-300');

                $('.paginate_button.current')
                    .addClass('bg-blue-600 text-white border-blue-600 hover:bg-blue-700')
                    .removeClass('bg-white dark:bg-gray-800');
            },
            columns: [
                {data: 'id', name: 'id', className: 'px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white' },
                {data: 'name', name: 'name', className: 'px-6 py-4'   },
                {data: 'photo', name: 'photo' , className: 'px-6 py-4' },
                {data: 'slug', name: 'slug' , className: 'px-6 py-4' },
                {
                    data: 'action',
                    name: 'action', 
                    className: 'px-6 py-4',
                    orderable: false,
                    searcable: false,
                    width: '15%'
                },
            ]
        })
    </script>
@endpush