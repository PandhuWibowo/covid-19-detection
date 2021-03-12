<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Cari Alamat</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="/dashboard" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/users" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>Users</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/warga" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>Warga</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/signout">
              <button type="button" class="btn btn-block btn-outline-danger btn-flat">Sign Out</button>
            </a>
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
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Users</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <button type="button" class="btn btn-block btn-outline-primary btn-flat" data-toggle="modal" data-target="#modal-xl">Tambah User</button>
              </div>
              <div class="modal fade" id="modal-xl">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Tambah User</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form role="form">
                        <div class="card-body">
                          <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" placeholder="Nama">
                          </div>
                          <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Password">
                          </div>
                          <div class="form-group">
                            <label for="no_telp">No. Telpon</label>
                            <input type="text" class="form-control" id="no_telp" placeholder="No. Telpon">
                          </div>
                          <div class="form-group">
                            <label for="jabatan">Jabatan</label>
                            <input type="text" class="form-control" id="jabatan" placeholder="Jabatan">
                          </div>
                          <div class="form-group">
                            <label>Alamat</label>
                            <textarea class="form-control" rows="3" placeholder="Alamat"></textarea>
                          </div>
                        </div>
                        <!-- /.card-body -->
                      </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                      <button type="button" class="btn btn-primary">Simpan</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Nama</th>
                    <th>No Telpon</th>
                    <th>Jabatan</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td>John Doe</td>
                    <td>1234567890</td>
                    <td>Super Admin</td>
                    <td>
                      <button type="button" class="btn btn-block btn-outline-secondary btn-flat" data-toggle="modal" data-target="#modal-xl-edit">Ubah</button>
                      <button type="button" class="btn btn-block btn-outline-danger btn-flat" data-toggle="modal" data-target="#modal-xl-remove">Hapus</button>
                    </td>
                  </tr>
                  <tr>
                    <td>John Doe</td>
                    <td>1234567890</td>
                    <td>Super Admin</td>
                    <td>
                      <button type="button" class="btn btn-block btn-outline-secondary btn-flat">Ubah</button>
                      <button type="button" class="btn btn-block btn-outline-danger btn-flat">Hapus</button>
                    </td>
                  </tr>
                  <tr>
                    <td>John Doe</td>
                    <td>1234567890</td>
                    <td>Super Admin</td>
                    <td>
                      <button type="button" class="btn btn-block btn-outline-secondary btn-flat">Ubah</button>
                      <button type="button" class="btn btn-block btn-outline-danger btn-flat">Hapus</button>
                    </td>
                  </tr>
                  <tr>
                    <td>John Doe</td>
                    <td>1234567890</td>
                    <td>Super Admin</td>
                    <td>
                      <button type="button" class="btn btn-block btn-outline-secondary btn-flat">Ubah</button>
                      <button type="button" class="btn btn-block btn-outline-danger btn-flat">Hapus</button>
                    </td>
                  </tr>
                  <tr>
                    <td>John Doe</td>
                    <td>1234567890</td>
                    <td>Super Admin</td>
                    <td>
                      <button type="button" class="btn btn-block btn-outline-secondary btn-flat">Ubah</button>
                      <button type="button" class="btn btn-block btn-outline-danger btn-flat">Hapus</button>
                    </td>
                  </tr>
                  <tr>
                    <td>John Doe</td>
                    <td>1234567890</td>
                    <td>Super Admin</td>
                    <td>
                      <button type="button" class="btn btn-block btn-outline-secondary btn-flat">Ubah</button>
                      <button type="button" class="btn btn-block btn-outline-danger btn-flat">Hapus</button>
                    </td>
                  </tr>
                  <tr>
                    <td>John Doe</td>
                    <td>1234567890</td>
                    <td>Super Admin</td>
                    <td>
                      <button type="button" class="btn btn-block btn-outline-secondary btn-flat">Ubah</button>
                      <button type="button" class="btn btn-block btn-outline-danger btn-flat">Hapus</button>
                    </td>
                  </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Nama</th>
                      <th>No Telpon</th>
                      <th>Jabatan</th>
                      <th>Aksi</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="modal fade" id="modal-xl-edit">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Ubah User</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form role="form">
                        <div class="card-body">
                          <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" placeholder="Nama" value="John Doe">
                          </div>
                          <div class="form-group">
                            <label for="no_telp">No. Telpon</label>
                            <input type="text" class="form-control" id="no_telp" placeholder="No. Telpon" value="1234567890">
                          </div>
                          <div class="form-group">
                            <label for="jabatan">Jabatan</label>
                            <input type="text" class="form-control" id="jabatan" placeholder="Jabatan" value="Super Admin">
                          </div>
                          <div class="form-group">
                            <label>Alamat</label>
                            <textarea class="form-control" rows="3" placeholder="Alamat">Jl. Pahlawan Gang Merdeka</textarea>
                          </div>
                        </div>
                        <!-- /.card-body -->
                      </form>
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                      <button type="button" class="btn btn-primary">Simpan</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <div class="modal fade" id="modal-xl-remove">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Hapus User</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Anda yakin ingin menghapusnya?
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                      <button type="button" class="btn btn-primary">Simpan</button>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.5
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="assets/dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
