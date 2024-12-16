@extends('layouts.app')

@section('content')

<div class="container pt-5">
    <div class="mb-3" style="margin-top:100px">
        <h1 class="h3 d-inline align-middle">Profile</h1>
    </div>
    <div class="row">
        <div class="col-md-7 col-xl-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Profile Details</h5>
                </div>
                <div class="card-body h-100">
                    {{-- @include('partials.alerts') --}}
                    <form method="post" action="{{ route('profile.update') }}" class="mt-4">
                        @method('PATCH')
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" id="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') ?? $user->name }}" placeholder="Enter your name!">
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" id="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        value="{{ old('email') ?? $user->email }}" placeholder="Enter your email!">
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div>
                            <input type="submit" value="Update Details" class="btn btn-primary">
                        </div>
                    </form>
                </div>

                <div class="card-header">
                    <h5 class="card-title mb-0">Password</h5>
                </div>
                <div class="card-body h-100">
                    <form method="post" action="{{ route('password.update') }}" class="mt-4">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">New Password</label>
                                    <input type="password" name="password" id="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        placeholder="Enter your password!">
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        class="form-control" placeholder="Confirm your password!">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="current_password" class="form-label">Current Password</label>
                                    <input type="password" name="current_password" id="current_password"
                                        class="form-control @error('current_password') is-invalid @enderror"
                                        placeholder="Enter your current password!">
                                    @error('current_password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div>
                            <input type="submit" value="Update Password" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-5 col-xl-4">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Profile Picture</h5>
                </div>
                <div class="card-body text-center">
                    @if ($user->picture)
                        <img src="{{ asset('template/img/profile-photo/' . $user->picture) }}" alt=}}"
                            class="img-fluid rounded-circle mb-2" width="128" height="128" />
                    @else
                        <img src="https://ui-avatars.com/api/?name={{ $user->name }}" alt="Placeholder picture"
                            class="img-fluid rounded-circle mb-2" width="128" height="128" />
                    @endif

                    <div>
                        <form method="POST" action="{{ route('picture-update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label for="picture">Profile Picture</label>
                                <input type="file" name="picture" id="picture" class="form-control" />
                                @error('picture')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
