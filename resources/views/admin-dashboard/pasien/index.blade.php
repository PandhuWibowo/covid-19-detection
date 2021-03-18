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
            <h1>Pasien Covid</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
              <li class="breadcrumb-item active">Pasien Covid</li>
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
                <a class="btn btn-block btn-outline-primary btn-flat" href="/pasien-covid/tambah-pasien">Tambah Pasien Covid</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No. Kartu Keluarga</th>
                    <th>NIK Kepala Keluarga</th>
                    <th>NIK</th>
                    <th>Nama Pasien</th>
                    <th>Tanggal Terinfeksi</th>
                    <th>Status Virus</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($pasien as $row)
                    <tr>
                      <td>{{ $row->id_kk }}</td>
                      <td>{{ $row->kartuKeluarga->nik_kepala_keluarga }}</td>
                      <td>{{ $row->nik }}</td>
                      <td>{{ $row->warga->nama }}</td>
                      <td>{{ $row->tgl_terinfeksi }}</td>
                      <td>{{ $row->status_virus }}</td>
                      <td>
                        <a class="editStatus btn btn-block btn-outline-secondary btn-flat" data-id_pendataan="{{ $row->id_pendataan }}" data-status_virus="{{ $row->status_virus }}" data-status_penanganan="{{ $row->status_penanganan }}">Ubah Status</a>
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>No. Kartu Keluarga</th>
                      <th>NIK Kepala Keluarga</th>
                      <th>NIK</th>
                      <th>Nama Pasien</th>
                      <th>Tanggal Terinfeksi</th>
                      <th>Status Virus</th>
                      <th>Aksi</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="modal fade" id="update-status">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Ubah Status</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form role="form">
                      <div class="modal-body">
                        <div class="card-body">
                          <input type="hidden" class="form-control" name="ubahIdPendataan" id="ubahIdPendataan">
                          <div class="form-group">
                            <label>Status</label>
                            <select class="form-control" id="ubahStatusVirus" aria-placeholder="Status">
                              <option>OTG</option>
                              <option>Bergejala</option>
                              <option>Positif</option>
                              <option>Meninggal</option>
                              <option>Negatif/Sembuh</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="ubahStatusPenanganan">Status Penanganan</label>
                            <textarea class="form-control" rows="3" placeholder="Status Penanganan" id="ubahStatusPenanganan"></textarea>
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
    $('.editStatus').on('click', function() {
      // Dari Data Table
      const idPendataan = $(this).data('id_pendataan')
      const statusVirus = $(this).data('status_virus')
      const statusPenanganan = $(this).data('status_penanganan')

      // Ke Modal
      $('#ubahIdPendataan').val(idPendataan)
      $('#ubahStatusPenanganan').val(statusPenanganan)
      $('#ubahStatusVirus').val(statusVirus)

      const editModal = $('#update-status')
      editModal.modal('show')
    })
    $('#btn-ubah-status').on('click', function(e) {
      e.preventDefault()

      const idPendataan = $('#ubahIdPendataan').val()
      const statusVirus = $('#ubahStatusVirus').val()
      const statusPenanganan = $('#ubahStatusPenanganan').val()

      try {
        csrfProtection()
        if (!idPendataan || typeof idPendataan !== 'string') {
          alert('Id Pendataan harus tidak boleh string kosong')
          return
        }
        if (!statusVirus || typeof statusVirus !== 'string') {
          alert('Status harus tidak boleh string kosong')
          return
        }
        if (!statusPenanganan || typeof statusPenanganan !== 'string') {
          alert('Status Penanganan harus tidak boleh string kosong')
          return
        }

        $.ajax({
            url: `/pasien-covid/ubah-status-covid/${idPendataan}`,
            type: 'PUT',
            dataType: 'json',
            async: true,
            data: {
              status_virus: statusVirus,
              status_penanganan: statusPenanganan
            },
            error: function (err) {
              console.error(err)
              alert(err)
              return
            },
            success: function (response) {
              console.log(response)
              if (response.status === 200) {
                alert(response.message)
                return window.location=`/pasien-covid`
              } else alert(response.message)
              return
            }
          })
      } catch (error) {
        console.error(error)
        alert(error)
        return
      }
    })
  })
</script>
</body>
</html>
