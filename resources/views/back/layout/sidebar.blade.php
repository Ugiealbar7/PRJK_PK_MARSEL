<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ url('dashboard') }}">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ url('projects') }}">
                    <span data-feather="file"></span>
                    Manajemen Proyek
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ url('categories') }}">
                    <span data-feather="shopping-cart"></span>
                    Categories
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#">
                    <span data-feather="users"></span>
                    Users
                </a>
            </li>
           <li class="nav-item">
    <form action="{{ route('admin.logout') }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit" class="nav-link btn btn-link active" style="text-decoration:none;">
            <span data-feather="bar-chart-2"></span>
            Logout
        </button>
    </form>
</li>

        </ul>
    </div>
</nav>
