<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Covid19 Detection</title>
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
  <meta name="csrf-token" content="{{ csrf_token() }}">
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
          <img src="assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="{{ Session::get('nama') }}">
        </div>
        <div class="info">
          <a class="d-block">{{ Session::get('nama') }}</a>
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
          @if(Session::get('jabatan') === 'sekretaris')
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
              <a href="/pasien-covid" class="nav-link">
                <i class="nav-icon fas fa-head-side-cough"></i>
                <p>Pasien</p>
              </a>
            </li>
          @endif
          <li class="nav-item">
            <a href="/reports" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Reports</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('signout') }}" class="btn btn-block btn-outline-danger btn-flat">Keluar</a>
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
            <h1>Warga</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
              <li class="breadcrumb-item active">Warga</li>
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
                @if(Session::has('invalid_id'))
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Invalid No. Kartu Keluarga</strong> {{ Session::get('invalid_id') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                @endif
                <a href="/warga/tambah-warga" class="btn btn-block btn-outline-primary btn-flat">Tambah Warga</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No. Kartu Keluarga</th>
                    <th>NIK Kepala Keluarga</th>
                    <th>Status Tempat Tinggal</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($kartuKeluarga as $row)
                      <tr>
                        <td>{{ $row->id_kk }}</td>
                        <td>{{ $row->nik_kepala_keluarga }}</td>
                        <td>{{ $row->status_tempat_tinggal }}</td>
                        <td>
                          <a class="btn btn-block btn-outline-secondary btn-flat" href="/warga/kartu-keluarga/{{ $row->id_kk }}">Lihat</a>
                          <a data-id_kk="{{ $row->id_kk }}" data-status_tempat_tinggal="{{ $row->status_tempat_tinggal }}" class="editStatusTempatTinggal btn btn-block btn-outline-info btn-flat">Ubah Status</a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>No. Kartu Keluarga</th>
                      <th>NIK Kepala Keluarga</th>
                      <th>Status Tempat Tinggal</th>
                      <th>Aksi</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="modal fade" id="update-statusTempatTinggal">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Ubah Status Tempat Tinggal</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form role="form">
                      <div class="modal-body">
                        <div class="card-body">
                          <input type="hidden" name="ubahIdKK" id="ubahIdKK">
                          <div class="form-group">
                            <label for="nama">Status Tempat Tinggal</label>
                            <input type="text" class="form-control" id="ubahStatusTempatTinggal" placeholder="Status Tempat Tinggal">
                          </div>
                        </div>
                        <!-- /.card-body -->
                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="btn-ubah-status">Simpan</button>
                      </div>
                    </form>
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
<script>
  function csrfProtection() {
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  }
  $(document).ready(function() {
    $('.editStatusTempatTinggal').on('click', function() {
      // Dari Data Table
      const idKK = $(this).data('id_kk')
      const statusTempatTinggal = $(this).data('status_tempat_tinggal')

      // Ke Modal
      $('#ubahStatusTempatTinggal').val(statusTempatTinggal)
      $('#ubahIdKK').val(idKK)
      const editModal = $('#update-statusTempatTinggal')
      editModal.modal('show')
    })

    $('#btn-ubah-status').on('click', function(e) {
        e.preventDefault()

        const idKK = $('#ubahIdKK').val()
        const statusTempatTinggal = $('#ubahStatusTempatTinggal').val()

        try {
          if (!idKK || typeof idKK !== 'string') alert('No. Kartu Keluarga harus tidak boleh string kosong')
          if (!statusTempatTinggal || typeof statusTempatTinggal !== 'string') alert('Status Tempat Tinggal harus tidak boleh string kosong')

          csrfProtection()
          $.ajax({
            url: `/warga/${idKK}/status-tempat-tinggal`,
            type: 'PUT',
            dataType: 'json',
            async: true,
            data: { status_tempat_tinggal: statusTempatTinggal },
            error: function (err) {
              console.error(err)
              alert(err)
              return
            },
            success: function (response) {
              console.log(response)
              if (response.status === 200) {
                alert(response.message)
                const editModal = $('#update-statusTempatTinggal')
                editModal.modal('hide')
                location.reload()
              } else alert(response.message)
              return
            }
          })
        } catch (err) {
          console.error(err)
          alert(err)
          return
        }
      })
  })
</script>
</body>
</html>
