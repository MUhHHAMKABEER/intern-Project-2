@extends('layouts.app')

@section('title', "BLOG | DETAIL")

@section('content')
<body>
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
                            <h4>Post Details</h4>
                            <h2>Single blog post</h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <section class="blog-posts grid-system">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="all-blog-posts">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="blog-post">
                                    <div class="blog-thumb">
                                        <img src="{{ asset('template/img/blogs/' . $blog->image) }}" alt="{{ $blog->title }}">
                                    </div>
                                    <div class="down-content">
                                        <span>{{ $blog->category}}</span>
                                        <a href="post-details.html">
                                            <h4>{{ $blog->title}} </h4>
                                        </a>
                                        <ul class="post-info">
                                            <li><a href="#"> {{ strtoupper($blog->user->name ?? 'Unknown') }}</a></li>
                                            <li><a href="#">{{ $blog->created_at->format('M d, Y') }}</a></li>
                                            <li><a href="#">{{ $blog->comments_count }} Comments</a></li>
                                        </ul>
                                        <p>{{$blog->content}}</p>
                                        <div class="post-options">
                                            <div class="row">
                                                <div class="col-6">
                                                    <ul class="like">
                                                        <form id="likeForm-{{ $blog->id }}" data-blog-id="{{ $blog->id }}">
                                                            @csrf
                                                            <button type="button" class="btn btn-light p-0">
                                                                <i class="bi bi-heart fs-3 text-danger hover:text-danger like-toggle"></i>
                                                            </button>
                                                            <span id="like-count-{{ $blog->id }}" class="text-muted">
                                                                {{ $blog->likes_count }} {{ Str::plural('like', $blog->likes_count) }}
                                                            </span>
                                                        </form>



                                                    </ul>
                                                </div>
                                                <div class="col-6">
                                                    <ul class="post-share">
                                                        <li><i class="fa fa-share-alt"></i></li>
                                                        <li><a href="#">Facebook</a>,</li>
                                                        <li><a href="#"> Twitter</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="sidebar-item comments">
                                    <div class="sidebar-heading">
                                        <h2>{{ $blog->comments_count }} Comments</h2>
                                    </div>
                                    <div class="content">
                                        <ul class="list-unstyled">
                                            <div class="comments-section">
                                                @foreach($comments as $comment)
                                                    <div class="comment mb-4 p-3 border rounded" id="comment-{{ $comment->id }}">
                                                        <div class="d-flex align-items-center mb-2">
                                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->name) }}" alt="Placeholder picture" class="img-fluid rounded-circle" width="40" height="40">
                                                            <div class="ml-3">
                                                                <strong>{{ $comment->user->name }}</strong>
                                                                <span class="text-muted" style="font-size: 0.85rem;">- {{ $comment->created_at->diffForHumans() }}</span>
                                                            </div>

                                                            <!-- Delete Button -->
                                                            <form action="{{ route('comments.destroy', ['blogId' => $blog->id, 'commentId' => $comment->id]) }}" method="POST" style="display:inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this comment?')">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                        <p class="text-muted">{{ $comment->message }}</p>
                                                    </div>
                                                @endforeach
                                            </div>


                                        </ul>
                                    </div>
                                </div>
                            </div>



                            <div class="col-lg-12">
                                <div class="sidebar-item submit-comment">
                                    <div class="sidebar-heading">
                                        <h2>Your comment</h2>
                                    </div>
                                    <div class="content">
                                        <form id="commentForm" {{ route('comment.create', $blog->id) }} method="POST">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <fieldset>
                                                        <!-- Pre-fill name if the user is authenticated -->
                                                        <input name="name" type="text" id="name" placeholder="Your name" value="{{ Auth::check() ? Auth::user()->name : '' }}" required="">
                                                    </fieldset>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <fieldset>
                                                        <!-- Pre-fill email if the user is authenticated -->
                                                        <input name="email" type="text" id="email" placeholder="Your email" value="{{ Auth::check() ? Auth::user()->email : '' }}" required="">
                                                    </fieldset>
                                                </div>

                                                <div class="col-lg-12">
                                                    <fieldset>
                                                        <textarea name="message" rows="6" id="message" placeholder="Type your comment" required=""></textarea>
                                                    </fieldset>
                                                </div>
                                                <div class="col-lg-12">
                                                    <fieldset>
                                                        <button type="submit" id="form-submit" class="main-button">Submit</button>
                                                    </fieldset>
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
        </div>
    </section>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Like functionality
        $(document).on('click', '.like-toggle', function(e) {
            e.preventDefault();

            let form = $(this).closest('form');
            let blogId = form.data('blog-id');

            $.ajax({
                url: '/blogs/' + blogId + '/like'
                , method: 'POST'
                , data: {
                    _token: '{{ csrf_token() }}'
                }
                , success: function(response) {
                    $('#like-count-' + blogId).text(response.likes + ' likes');
                }
                , error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('Could not process the request. Try again.');
                }
            });
        });

        // Comment submission functionality
        $(document).ready(function() {
            $('#commentForm').submit(function(e) {
                e.preventDefault(); // Prevent the default form submission

                let form = $(this);
                let blogId = '{{ $blog->id }}';
                let name = form.find('input[name="name"]').val();
                let email = form.find('input[name="email"]').val();
                let message = form.find('textarea[name="message"]').val();

                $.ajax({
                    url: '/blogs/' + blogId + '/comment', // Ensure this matches your route
                    method: 'POST'
                    , data: {
                        _token: '{{ csrf_token() }}'
                        , name: name
                        , email: email
                        , message: message
                    }
                    , success: function(response) {
                        // Append the new comment to the comments section (you might need to adjust the selector here)
                        let newComment = `
                        <div class="border-bottom py-3">
                            <strong>${response.user}:</strong>
                            <p class="text-muted">${response.comment.message}</p>
                        </div>`;
                        form.find('textarea').val(''); // Clear the textarea
                        form.find('input[name="name"]').val(''); // Clear the name input
                        form.find('input[name="email"]').val(''); // Clear the email input
                        $('#comment-section').append(newComment); // Ensure this selector is where comments are displayed
                    }
                    , error: function(xhr, status, error) {
                        console.error('Error:', error);
                        alert('Could not post the comment. Try again.');
                    }
                });
            });
        });
    });

</script>
@endsection
