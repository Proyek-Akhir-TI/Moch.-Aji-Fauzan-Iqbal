
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Poliwangi | PRESS</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="/css/app.css">


</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
      
    </ul>
    

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" @keyup="searchit"
        v-model="search" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" @click="searchit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <div class="navbar ml-auto">
      <strong>
      {{ Auth::user()->type }}
      </strong>
    </div>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    
      @can('isUser')
      <li class="nav-item">
        <router-link to="/panduanDosen" class="nav-link">
          Panduan
        </router-link>
      </li>
      @endcan
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
          <!-- <i class="nav-icon fas fa-user orange"></i>
          {{ Auth::user()->name }} -->
          <div class="user-panel mr-3">
            <div class="image">
              <img src="./img/profile.png" class="img-circle elevation-2" alt="User Image">
            </div>
            {{ Auth::user()->name }}
          </div>
        </a>

        

        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
          <!-- <a href="#" class="dropdown-item"> 
          <p>{{ Auth::user()->type }}</p>
          </a> -->

          <router-link to="/profile" class="nav-link dropdown-item">
            <i class="nav-icon fas fa-user orange"></i> Profile
          </router-link>

          <router-link to="/password" class="nav-link dropdown-item">
            <i class="nav-icon fas fa-lock orange"></i> Password
          </router-link>

          <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
            <i class="nav-icon fas fa-power-off red"></i>
            Logout
          </a>

      </li>
      <!-- Notifications Dropdown Menu -->
      
    </ul>
    
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="./img/press.jpeg" alt="Press Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">
        Poliwangi | PRESS
      </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      
      <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="./img/profile.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">
            {{ Auth::user()->name }}
          </a>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <router-link to="/dashboard" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt blue"></i>
              <p>
                Dashboard
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </router-link>
          </li>

          
          @can('isAdmin')
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-address-book green"></i>
              <p>
                Kelola Data User
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/users" class="nav-link">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Data User</p>
                </router-link>

                <!-- <router-link to="#" class="nav-link">
                  <i class="fas fa-user-plus nav-icon"></i>
                  <p>Tambah User</p>
                </router-link> -->
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-paste purple"></i>
              <p>
                Kelola Usulan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/usulan" class="nav-link">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Info Status</p>
                </router-link>

                <router-link to="/dataUsulan" class="nav-link">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Data Usulan</p>
                </router-link>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file-alt green"></i>
              <p>
                Kelola Berkas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/panduan" class="nav-link">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Berkas Panduan</p>
                </router-link>
              </li>
            </ul>
          </li>

          <!-- <li class="nav-item">
            <router-link to="/developer" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Developer
              </p>
            </router-link>
          </li> -->
          @endcan

          @can('isUser')
          <li class="nav-item has-treeview">
          
            <a href="#" class="nav-link">
              <!-- <router-link to="/usulanDosen" class="nav-link"> -->
                  <i class="fas fa-download nav-icon yellow"></i>
                  <p>
                    Riwayat Usulan
                    <i class="right fas fa-angle-left"></i>
                  </p>
                <!-- </router-link> -->
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <router-link to="/usulanDosen" class="nav-link">
                  <i class="fas fa-book nav-icon orange"></i>
                  <p>Pengajuan</p>
                </router-link>
              </li>

              <li class="nav-item">
                <router-link to="/status" class="nav-link">
                  <i class="fas fa-book-open nav-icon indigo"></i>
                  <p>Status</p>
                </router-link>
              </li>
            </ul>
              
          </li>

          
          @endcan

          <!-- <li class="nav-item">
            <router-link to="/profile" class="nav-link">
              <i class="nav-icon fas fa-user orange"></i>
              <p>
                Profile
              </p>
            </router-link>
          </li> -->

          <li class="nav-item">
            <!-- <a href="#" class="nav-link">
              <i class="nav-icon fas fa-power-off"></i>
              <p>
                Logout
              </p>
            </a> -->
            <!-- <a class="nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                <i class="nav-icon fas fa-power-off red"></i>
                <p>
                    {{ __('Logout') }}
                </p>
            </a> -->

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>

                                    
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <router-view></router-view>
        <vue-progress-bar></vue-progress-bar>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <!-- <div class="float-right d-none d-sm-inline">
      Anything you want
    </div> -->

    <!-- To the center -->
    <div class="float text-center">
      <strong>POLIWANGI - PRESS</strong>
    </div>

    <!-- Default to the left -->
    <!-- <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved. -->
  </footer>
</div>
<!-- ./wrapper -->

@auth
<script>
    window.user = @json(auth()->user())
</script>   
@endauth

<script src="/js/app.js"></script>
</body>
</html>
