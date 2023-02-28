<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        @auth
            <a class="navbar-brand" href="#">Welcome back {{ auth()->user()->username }}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('admin') ? 'active' : '' }}" aria-current="page"
                            href=" {{ Request::is('admin') ? '/admin' : '/admin' }}">Laporan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('admin/history') ? 'active' : '' }}"
                            href=" {{ Request::is('admin/history') ? '' : 'admin/history' }}">Riwayat</a>
                    </li>
                </ul>
            @else
                <a class="navbar-brand" href="#">Laporan Siswa</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" aria-current="page"
                                href=" {{ Request::is('/') ? '' : '/' }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('aspirasi') ? 'active' : '' }}"
                                href=" {{ Request::is('aspirasi') ? '' : '/aspirasi' }}">Aspirasi</a>
                        </li>
                    </ul>
                @endauth
                <div class="d-flex">
                    @auth
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#LoginModal">
                            Logout
                        </button>
                    @else
                        <button type="button" class="btn btn-primary px-4" data-bs-toggle="modal" data-bs-target="#LoginModal">
                            Login
                        </button>
                    @endauth
                </div>
            </div>
        </div>
</nav>

<!-- Modal -->
<div class="modal fade" id="LoginModal" tabindex="-1" aria-labelledby="LoginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="LoginModalLabel"></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @auth
                <form action="/logout" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="container">
                            Yakin untuk logout?
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Logout</button>
                    </div>
                </form>
            @else
                <form action="/login" method="post">
                    @csrf
                    @if (session()->has('LoginError'))
                        <div class="container mt-2 mx-auto">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                username atau password salah
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    <div class="modal-body">
                        <div class="container">
                            <div class="mb-3">
                                <label for="" class="">Username</label>
                                <input type="text" name="username" id="" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="" class="">Password</label>
                                <input type="password" name="password" id="" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            @endauth
        </div>
    </div>
</div>
