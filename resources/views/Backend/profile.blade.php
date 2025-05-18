@extends('layouts.backend')
@section('title', 'Profile')
@section('BackendContent')
    <div class="container">
        <h2 class="mb-4">Profile</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="row">

            <div class="col-lg-6 mx-auto">
                <div class="card mb-4">
                    <div class="card-body text-center row d-flex">
                        <div class="div">
                            @if($profile && $profile->image)
                                <img src="{{ asset('storage/profile_images/' . $profile->image) }}" alt="Profile Image"
                                    class="rounded-circle" style="max-width: 120px;">
                            @else
                                <img src="{{ asset('default.png') }}" alt="Default Image" class="rounded-circle" width="150">
                            @endif
                        </div>
                        <div>
                            <h4 class="mt-3">{{ $profile->name ?? 'Your Name' }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row gap-2 mx-auto ">
                <div class="col-lg-5 shadow">
                    <form action="{{ route('profile.storeOrUpdate') }}" method="POST" enctype="multipart/form-data"
                        class="card p-4">
                        @csrf
                        <div class="mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" value="{{ old('name', $profile->name ?? '') }}"
                                class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="image">Profile Image</label>
                            <input type="file" name="image" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Save Profile</button>
                    </form>
                </div>
                {{-- Social Media Links --}}
                <div class="col-lg-5">
                    @if($profile)
                        <div class="card p-4 shadow">
                            <h4>Social Media Links</h4>
                            <form action="{{ route('social.store', $profile->id) }}" method="POST"
                                class="row g-3 align-items-end">
                                @csrf
                                <div class="col-md-4">
                                    <label>Platform</label>
                                    <input type="text" name="platform" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label>URL</label>
                                    <input type="url" name="url" class="form-control" required>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-success">Add</button>
                                </div>
                            </form>
                            <ul class="list-group mt-3">
                                @foreach($profile->socialLinks as $link)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $link->platform }}: <a href="{{ $link->url }}" target="_blank">{{ $link->url }}</a>
                                        <form action="{{ route('social.delete', $link->id) }}" method="POST"
                                            onsubmit="return confirm('Delete this link?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection