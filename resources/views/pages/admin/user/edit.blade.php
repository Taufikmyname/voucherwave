@extends('layouts.admin')

@section('title')
    User
@endsection

@section('content')
    <!-- Section Content-->
          <div class="section-content section-dashboard-home" data-aos="fade-up">
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class=" text-xl font-bold text-gray-900 dark:text-white">User</h2>
                <p class="mb-4 text-base text-gray-900 dark:text-white">Edit User</p>
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
                                <form action="{{ route('user.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User Name</label>
                                                <input type="text" name="name" class="form-control" required value="{{ $item->name }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User Email</label>
                                                <input type="email" name="email" class="form-control" required value="{{ $item->email }}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User Password</label>
                                                <input type="password" name="password" class="form-control">
                                                <small>Kosongkan jika tidak ingin diubah</small>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Roles</label>
                                                <select name="roles" required class="form-control">
                                                    <option value="{{ $item->roles }}" selected>not changed</option>
                                                    <option value="ADMIN">Admin</option>
                                                    <option value="USER">User</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col text-right">
                                            <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                                                Save Now
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
@endsection