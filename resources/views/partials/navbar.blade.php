<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <div class="container">
        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                {{-- <li class="nav-item">
                    <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('about') ? 'active' : '' }}" href="/about">About</a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('students*') ? 'active' : '' }}" href="/students">Data Siswa</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('categories') ? 'active' : '' }}" href="/categories">Kategori</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link {{ Request::is('graphics') ? 'active' : '' }}" href="/graphics">Grafik</a>
                </li> --}}
            </ul>


            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <form action="/logout" method="POST">
                                    @csrf

                                    <button type="submit" class="dropdown-item">
                                        Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            {{ auth()->user()->name }}
                        </a>
                        <ul class="nav-item dropdown-menu" aria-labelledby="navbarDropdown">
                            <form action="/logout" method="POST">
                                <button type="submit" class="dropdown-item">
                                    Logout
                                </button>
                            </form>
                        </ul>
                    </li> --}}
                @else
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle {{ Request::is('login') ? 'active' : '' }}"
                            href="/login">Login</a>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>
