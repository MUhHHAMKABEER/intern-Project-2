@extends('layouts.app')

@section('title', "BLOG | ADD")

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>

    <div class="heading-page header-text">
      <section class="page-heading">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="text-content">
                <h3>MK<em>.</em></h3>
                <h2>ADD BLOG</h2>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10 col-sm-12">
                <div class="card shadow-lg rounded-3">
                    <div class="card-body">
                        <!-- Centered Title -->
                        <h3 class="text-center text-primary mb-4 font-weight-bold">Create New Blog</h3>

                        @include('partial.alerts')

                        <form action="{{ route('post.create') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Title Input -->
                            <div class="mb-4">
                                <label for="title" class="form-label text-center d-block text-uppercase font-weight-bold text-muted">Title</label>
                                <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="{{ $errors->has('title') ? $errors->first('title') : 'Enter the title' }}" required />
                            </div>

                            <!-- Category Selection -->
                            <div class="mb-4">
                                <label for="category" class="form-label text-center d-block text-uppercase font-weight-bold text-muted">Category</label>
                                <select name="category" id="category" class="form-select">
                                    <option value="Lifestyle">Lifestyle</option>
                                    <option value="Technology">Technology</option>
                                    <option value="Health">Health</option>
                                    <option value="Travel">Travel</option>
                                    <option value="Food">Food</option>
                                </select>
                            </div>

                            <!-- Content Input -->
                            <div class="mb-4">
                                <label for="content" class="form-label text-center d-block text-uppercase font-weight-bold text-muted">Content</label>
                                <textarea id="content" name="content" class="form-control @error('content') is-invalid @enderror" rows="6" placeholder="Enter the content" required></textarea>
                                @error('content')
                                <div class="text-danger small mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="image" class="form-label text-center d-block text-uppercase font-weight-bold text-muted">Image</label>
                                <div class="border-2 border-dashed border-primary rounded text-center py-5 cursor-pointer hover:bg-light" style="border-width: 2px; padding: 40px;" onclick="document.getElementById('image').click();">
                                    <span class="{{ $errors->has('image') ? 'text-danger' : 'text-muted' }}" id="image-label">
                                        {{ $errors->has('image') ? $errors->first('image') : 'Click or drag to upload image' }}
                                    </span>
                                    <input type="file" name="image" id="image" class="d-none" />
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-primary w-100 py-2 font-weight-bold">
                                Upload Post
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    


@endsection


