@extends('layouts.app')

@section('title', "BLOG | EDIT")

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

<div class="container py-5">
    <div class="row justify-content-center" style="margin-top: 100px;">
        <div class="col-lg-10 col-md-12 col-sm-12">
            <div class="card shadow-lg rounded-3">
                <div class="card-body">
                    <!-- Centered Title -->
                    <h3 class="text-center text-primary mb-4 font-weight-bold">Your Blogs</h3>

                    @include('partial.alerts')

                    @if($blogs->count() > 0)
                    <div class="list-group">
                        @foreach ($blogs as $blog)
                        <div class="list-group-item p-4 mb-3 border rounded">
                            <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- Photo Display -->
                                @if($blog->image)
                                <div class="mb-3">
                                    <img src="{{ asset('template/img/blogs/' . $blog->image) }}" alt="Blog Image" class="img-fluid w-100 rounded">
                                </div>
                                @endif

                                <div class="mb-3">
                                    <label for="title_{{ $blog->id }}" class="form-label">Title</label>
                                    <input type="text" id="title_{{ $blog->id }}" name="title" class="form-control" value="{{ $blog->title }}" required>
                                </div>

                                <div class="mb-3">
                                    <label for="content_{{ $blog->id }}" class="form-label">Content</label>
                                    <textarea id="content_{{ $blog->id }}" name="content" class="form-control" rows="5" required>{{ $blog->content }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label for="photo_{{ $blog->id }}" class="form-label">Upload New Photo</label>
                                    <input type="file" id="photo_{{ $blog->id }}" name="image" class="form-control">
                                    <small class="form-text text-muted">Accepted formats: png, jpg, jpeg, webp. Max size: 2MB</small>
                                </div>

                                <div class="d-flex justify-content-end gap-2">
                                    <div>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                            </form>

                            <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this blog?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>

                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-5">
                    <p class="mb-3">You have no blogs yet.</p>
                    
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection
