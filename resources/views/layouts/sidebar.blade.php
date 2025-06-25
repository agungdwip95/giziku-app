@can('isAdmin')

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div class="user-panel mt-3 pb-3 mb-3 brand-link d-flex">
        <div class="image">
            <img src="{{ asset('img/logo.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
           <a href="/dashboard" class="d-block ms-2" style="color: black; text-decoration: none;"><b>Giziku</b></a>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-header" style="color: black;">MENU</li>
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt" style="color: black;"></i>
                        <p style="color: black;">
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('jenis-wisata') }}" class="nav-link">
                        <i class="nav-icon fas fa-list-alt" style="color: black;"></i>
                        <p style="color: black;">
                            Data Jenis Wisata
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('wisata') }}" class="nav-link">
                        <i class="nav-icon fas fa-map-marked-alt" style="color: black;"></i>
                        <p style="color: black;">
                            Data Wisata
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('blog-articles') }}" class="nav-link">
                        <i class="nav-icon fas fa-blog" style="color: black;"></i>
                        <p style="color: black;">
                            Data Blog Articles
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('data-events') }}" class="nav-link">
                        <i class="nav-icon fas fa-calendar-alt" style="color: black;"></i>
                        <p style="color: black;">
                            Data Events
                        </p>
                    </a>
                </li>
                 <li class="nav-item">
                    <a href="{{ url('data-vehicle-rentals') }}" class="nav-link">
                        <i class="nav-icon fas fa-car" style="color: black;"></i>
                        <p style="color: black;">
                            Data Vehicle Rentals
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('data-accommodations') }}" class="nav-link">
                        <i class="nav-icon fas fa-hotel" style="color: black;"></i>
                        <p style="color: black;">
                            Data Accommodations
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('tour-packages') }}" class="nav-link">
                        <i class="nav-icon fas fa-suitcase" style="color: black;"></i>
                        <p style="color: black;">
                            Data Tour Packages
                        </p>
                    </a>
                </li>
                <!-- <li class="nav-item">
                    <a href="{{ url('data-tour-package-accommodations') }}" class="nav-link">
                        <i class="nav-icon fas fa-building" style="color: black;"></i>
                        <p style="color: black;">
                            Data Tour Package Accommodations
                        </p>
                    </a>
                </li> -->
                <li class="nav-item">
                    <a href="{{ url('reviews') }}" class="nav-link">
                        <i class="nav-icon fas fa-star" style="color: black;"></i>
                        <p style="color: black;">
                            Data Reviews
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('penginapan') }}" class="nav-link">
                        <i class="nav-icon fas fa-bed" style="color: black;"></i>
                        <p style="color: black;">
                            Data Penginapan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('user/edit') }}" class="nav-link">
                        <i class="nav-icon fas fa-user" style="color: black;"></i>
                        <p style="color: black;">
                            Edit Profile
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

@endcan