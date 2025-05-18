@extends('layouts.backend')
@section('BackendContent')
    @push('css')
        <style>
            td {
                vertical-align: middle !important;
                align-items: baseline !important;
            }
        </style>
    @endpush
    <div class="container">
        <div class="row mt-5">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header">
                        <h3>Banner</h3>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ isset($editData) ? route('banner.update', $editData->id) : route('banner.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ isset($editData) ? $editData->name : old('name') }}" id="name"
                                    placeholder="Enter Name">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="profession" class="form-label">Profession</label>
                                <input value="{{ isset($editData) ? $editData->profession : old('profession') }}"
                                    type="text" name="profession" class="form-control" id="profession"
                                    placeholder="Enter Profession">
                                @error('profession')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="my-3">
                                @if (isset($editData) && $editData->image)
                                    <img src="{{ asset('storage/banner_image/' . $editData->image) }}" class="mt-2 rounded img-fluid"
                                        width="100" alt="Old Image">
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Banner Image</label>
                                <input type="file" name="image" class="form-control" id="image"
                                    placeholder="Enter Banner Image">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-{{ isset($editData) ? 'success' : 'primary' }}">
                                {{ isset($editData) ? 'Update' : 'Submit' }}</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="card ">
                    <div class="card-header">
                        <h3>Banner List</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered table-striped table-hover table-responsive my-3">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Profession</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($banners as $banner)
                                    <tr>
                                        <td>{{ $banner->name }}</td>
                                        <td>{{ $banner->profession }}</td>
                                        <td>
                                            <img src="{{ asset('storage/banner_image/' . $banner->image) }}" alt=""
                                                style="width: 80px; height: 80px; object-fit: cover; border-radius: 5px" ;>
                                        </td>
                                        <td>
                                            <div class="button-group d-flex">
                                                <a href="{{ route('banner.edit', $banner->id) }}"
                                                    class="btn btn-primary">Edit</a>
                                                <form action="{{ route('banner.delete', $banner->id) }}" method="POST"
                                                    style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>


                                            </div>
                                        </td>
                                @empty
                                        <tr>
                                            <td colspan="4" class="text-center">No Data Found</td>
                                        </tr>
                                    @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection