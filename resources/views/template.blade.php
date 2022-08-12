<!DOCTYPE html><html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{$title}}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('plugins')}}/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist')}}/css/adminlte.min.css">
  <link rel="stylesheet" href="{{asset('plugins')}}/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('plugins')}}/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('plugins')}}/select2/css/select2.min.css">
  <link rel="stylesheet" href="{{asset('plugins')}}/select2-bootstrap4-theme/select2-bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-toggle="modal" data-target="#logout">
          <i class="nav-icon fas fa-sign-out-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link"></a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{url('dashboard')}}" class="nav-link {{$active === 'dashboard' ? 'active' : ''}}">
              <i class="fas fa-house-user nav-icon"></i>
              <p>Dashboard</p>
            </a>
          </li>
          @if (auth()->user()->role === 'admin')
            <li class="nav-item">
              <a href="{{url('karyawan')}}" class="nav-link {{$active === 'karyawan' ? 'active' : ''}}">
                <i class="fas fa-user nav-icon"></i>
                <p>Data Karyawan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('barang') }}" class="nav-link {{$active === 'barang' ? 'active' : ''}}">
                <i class="fas fa-th nav-icon"></i>
                <p>Data Barang</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ url('jasa') }}" class="nav-link {{$active === 'jasa' ? 'active' : ''}}">
                <i class="fas fa-hand-holding nav-icon"></i>
                <p>Data Jasa</p>
              </a>
            </li>
          @endif
          <li class="nav-item {{ in_array($active, ['pemasukan', 'pengeluaran']) ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ in_array($active, ['pemasukan', 'pengeluaran']) ? 'active' : '' }}">
              <i class="nav-icon fas fa-money-bill"></i>
              <p>
                Data Transaksi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('pemasukan') }}" class="nav-link {{ $active === 'pemasukan' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Pemasukan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('pengeluaran') }}" class="nav-link {{ $active === 'pengeluaran' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Pengeluaran</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{$title}}</h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    @yield('content')
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
<div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Logout</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah anda yakin akan keluar?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: #58dfa0;">Close</button>
        <form action="{{url('logout')}}" method="post">
          @csrf
          <button type="submit" class="btn btn-danger">Logout</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('plugins')}}/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins')}}/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist')}}/js/adminlte.min.js"></script>
<script src="{{asset('plugins')}}/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('plugins')}}/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('plugins')}}/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset('plugins')}}/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{asset('plugins')}}/select2/js/select2.full.min.js"></script>
<script>
  const previewImg = () => {
    const gambar      = document.querySelector('#foto');
    const imgPreview  = document.querySelector('.img-preview');
    // label.textContent = gambar.files[0].name;
    const file = new FileReader();
    file.readAsDataURL(gambar.files[0]);
    file.onload = function(e) {
      imgPreview.src = e.target.result;
    }
  }

  $(function () {
    $("#table").DataTable({"order": []});
    $('.select2bs4').select2({theme: 'bootstrap4'});
  });

  const getBarangJasa = (data, id) => {
    $.ajax({
      url : '/pemasukan/barangJasa',
      type : 'get',
      data : {tipe : data.value}, 
      success : function(result){
        let option = '<option></option>';

        result.forEach(element => {
          option += `<option value="${element.id}">${element.nama}</option>`;
        });

        $(`#${id}`).html(option);
      }
    });
  }
</script>
</body>
</html>
