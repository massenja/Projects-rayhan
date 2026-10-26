    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand" href="/profile">Prodi Sistem Informasi UNPAM</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link{{ Request::is(('/') ? 'active fw-bold' : '' )}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/profile') }}" class="nav-link{{ Request::is('/profile') ? 'active fw-bold' : '' }}">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/project') }}" class="nav-link{{ Request::is('/project') ? 'active fw-bold' : '' }}">Project</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/about') }}" class="nav-link{{ Request::is('/about') ? 'active fw-bold' : '' }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin') }}" class="nav-link{{ Request::is('/admin') ? 'active fw-bold' : '' }}">admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>