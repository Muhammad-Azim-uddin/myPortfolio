@extends('layouts.backend')
@section('BackendContent')
    <div class="container">
        <div class="row mt-5 ms-3">
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header">
                        <h3>Banner</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('banner.storeandupdate ', $banner->id ?? '') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" value="{{old('name') }}" id="name"
                                    placeholder="Enter Name">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="profession" class="form-label">Profession</label>
                                <input value="{{ old('profession') }}" type="text" name="profession" class="form-control"
                                    id="profession" placeholder="Enter Profession">
                                @error('profession')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Banner Image</label>
                                <input type="file" name="image" class="form-control" id="image"
                                    placeholder="Enter Banner Image">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="card">
                    <div class="row">
                        <div class="col-lg-6">
                            Name : {{ $banner->name }}
                        </div>
                        <div class="col-lg-6">profession : {{ $banner->profession }}</div>
                    </div>
                    <div style="width:300px;">
                        <img src="{{ asset('storage/banner/' . $banner->image) ?? '' }}" alt="Banner Image"
                            class="img-fluid">
                    </div>
                    <a href="{{ route('banner.storeandupdate', $banner->id) }}" class="button">Edit</a>
                </div>
            </div>
        </div>

    </div>
@endsection