<nav class="navbar navbar-nav">
    <div class="container-fluid d-inline-flex justify-content-between px-3">
        <a class="d-flex navbar-brand" href="{{ route('home') }}">
            <img class="me-3 rounded" src="{{ asset('assets/images/bookalemun_logo.png') }}" alt="Site Logo"
                class="d-inline-block align-top">
            <h2 class="align-self-center site-name">Bookalemun</h2>
        </a>

        <div id="search-bar" style="width: 40rem">
            <form class="d-flex search-form" method="GET" action="{{ route('search') }}">
                <input class="form-control me-1" type="search" name="query"
                    placeholder="Aranadığınız kitabın ismini girin" aria-label="Search" required>
                <button class="btn btn-danger" type="submit">ARA</button>
            </form>
        </div>

        <div class="navbar mt-3 mx-auto">

            @auth
                <a href="{{ route('profile') }}">
                    <i class="fa-solid fa-user fa-2x me-5"></i>
                </a>
                <a href="{{ route('logout') }}">
                    <i class="fa-solid fa-right-from-bracket fa-2x"></i>
                </a>
            @endauth

            @guest
                <a href="{{ route('loginView') }}">
                    <i class="fa-solid fa-right-to-bracket fa-2x"></i>
                </a>
            @endguest

        </div>

    </div>

    <div class="navbar navbar-brand container-fluid d-flex mt-3 px-4 py-4">

        <div class="social-media d-flex justify-content-between mb-4 px-5 mx-auto">
            <a href="#">
                <i class="fa-brands fa-square-instagram fa-2x me-5"></i>
            </a>
            <a href="#">
                <i class="fa-brands fa-twitter fa-2x me-5"></i>
            </a>
            <a href="#">
                <i class="fa-brands fa-facebook fa-2x me-5"></i>
            </a>
        </div>


        <div class="nav justify-content-end mx-auto">
            <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}"
                href="{{ route('home') }}">Anasayfa</a>
            <a class="nav-link {{ Route::currentRouteName() == 'about' ? 'active' : '' }}"
                href="{{ route('about') }}">Hakkımızda</a>
            <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Kategoriler
                </a>

                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink">
                    @foreach ($categories as $category)
                        <li class="list-group-item text-center">
                            <a style="text-decoration: none;color:brown;"
                                href="{{ route('categories.show', $category->id) }}">{{ $category->category_name }}</a>
                        </li>
                    @endforeach
                </div>
            </div>
            <a class="nav-link {{ Route::currentRouteName() == 'contact' ? 'active' : '' }}"
                href="{{ route('contact') }}">İletişim</a>
        </div>

    </div>
</nav>
