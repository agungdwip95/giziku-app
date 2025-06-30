@can('isAdmin')

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <div class="user-panel mt-3 pb-3 mb-3 brand-link d-flex">
       <div class="image">
            <img src="{{ asset('img/logo.png') }}" class="img-circle elevation-2" style="background-color: white;" alt="User Image">
        </div>
        <div class="info">
           <a href="/dashboard" class="d-block ms-2" style="color: white; text-decoration: none;"><b>Giziku</b></a>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-header" style="color: white;">MENU</li>
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt" style="color: white;"></i>
                        <p style="color: white;">
                            Dashboard
                        </p>
                    </a>
                </li>
                 <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-users" style="color: white;"></i>
                        <p style="color: white;">Data User</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('balita.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-baby" style="color: white;"></i>
                        <p style="color: white;">
                            Data Balita
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('pengukuran_gizi.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-ruler" style="color: white;"></i>
                        <p style="color: white;">Pengukuran Gizi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('edukasi_gizi.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-book-open" style="color: white;"></i>
                        <p style="color: white;">Edukasi Gizi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('profile/edit') }}" class="nav-link">
                        <i class="nav-icon fas fa-user" style="color: white;"></i>
                        <p style="color: white;">
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