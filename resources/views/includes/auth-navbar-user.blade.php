<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('images/logo.png') }}" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Program</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Mentor</a>
                </li>
            </ul>
            @auth
                <div class="d-flex user-logged nav-item dropdown no-arrow">
                    <a href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        Halo, {{ auth()->user()->name }} !
                        <img src="{{ auth()->user()->userProfile->fileUrl ?? asset('images/user_photo.png') }}" class="user-photo rounded-circle" alt="">
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="right: 0, left: auto;">
                        <li>
                            <a href="{{ route('user.change-profile') }}" class="dropdown-item">Change Profile</a>
                        </li>
                        <li>
                            <a href="{{ route('user.change-password') }}" class="dropdown-item">Change Password</a>
                        </li>
                        <li>
                            <a href="#" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit()">Sign Out</a>
                            <form action="{{ route('logout') }}" id="logout-form" method="POST" style="display: none">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
                        </li>
                    </ul>
                </div>
            @endauth
        </div>
    </div>
</nav>