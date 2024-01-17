<header class="header bg-white">
    <div class="container px-lg-3">
        <nav class="navbar navbar-expand-lg navbar-light py-3 px-lg-0"><a class="navbar-brand" href="/"><span
                    class="fw-bold text-uppercase text-dark">Warko</span></a>
            <button class="navbar-toggler navbar-toggler-end" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/warung">Warung</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/maps">Maps</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        {{-- <a class="nav-link" href="/cart">
                            <i class="fas fa-dolly-flatbed me-1 text-gray"></i>
                            Cart
                            <small class="text-gray fw-normal">(2)</small>
                        </a> --}}
                        @auth
                            @php
                                $carts = \App\Models\Cart::where('user_id', Auth::user()->id)->count();
                            @endphp

                            @if ($carts > 0)
                                <a class="nav-link" href="/cart">
                                    <i class="fas fa-dolly-flatbed me-1 text-gray"></i>
                                    Cart
                                    <small class="text-gray fw-normal">({{ $carts }})</small>
                                </a>
                            @else
                                <a class="nav-link" href="/cart">
                                    <i class="fas fa-dolly-flatbed me-1 text-gray"></i>
                                    Cart
                                    <small class="text-gray fw-normal">({{ $carts }})</small>
                                </a>
                            @endif
                        @endauth
                    </li>

                    <li class="nav-item">
                        @auth
                            {{-- <a class="nav-link" href="/profile/{{ Auth::user()->id }}">Profile</a> --}}
                            <div class="dropdown">
                                <a class="dropdown-toggle nav-link" type="button" id="dropdownMenuButton1"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="/profile/{{ Auth::user()->id }}">Profile</a></li>
                                    <li><a class="dropdown-item" href="/logout">Logout</a></li>
                                </ul>
                            </div>
                        @endauth
                        @guest
                            <a class="nav-link" href="/login">
                                <i class="fas fa-user me-1 text-gray fw-normal"></i>
                                Login
                            </a>
                        @endguest
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
