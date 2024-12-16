<header class="">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('dashboard', ['id' => Auth::user()->id]) }}">
                <h2>MK<em>.</em></h2>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('dashboard') }}">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('blog.add') }}">Write</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('blogs.edit') }}">My Post</a>
                    </li>

                    <div> @if (Auth::user()->picture)
                        <img src="{{ asset('template/img/profile-photo/' . Auth::user()->picture) }}" alt="" class="img-fluid rounded-circle mb-2" width="30" height="30 " />
                        @else
                        <img src="https://ui-avatars.com/api/?name={{Auth::user()->name}}" alt="Placeholder picture" class="img-fluid rounded-circle mb-2" width="30" height="30" />
                        @endif</div>
                    <li class="nav-item dropdown mr-5">

                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a>
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">{{ __('Log Out') }}</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
