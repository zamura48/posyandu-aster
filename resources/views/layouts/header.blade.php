<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-light shadow-sm">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <span class="d-none d-md-inline"> {{ auth()->user()->role }}</span>
                <span class="info-box-icon"><i class="fas fa-user"></i></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-primary">
                    <img src="{{ asset('vendor/AdminLTE-3.1.0') }}/dist/img/user2-160x160.jpg"
                        class="img-circle elevation-2" alt="User Image">

                    <p>
                        {{ auth()->user()->username }} - {{ auth()->user()->role }}
                    </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="profile/{{ auth()->user()->id }}" class="btn btn-default btn-flat">Profile</a>
                        </div>
                        <div class="col-md-6">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-default btn-flat float-right">Logout</button>
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
