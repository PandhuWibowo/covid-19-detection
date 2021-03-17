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
                <button type="button" class="btn btn-block btn-outline-primary btn-flat" data-toggle="modal" data-target="#add-user">Tambah User</button>
              </div>
              <div class="modal fade" id="add-user">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Tambah User</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form role="form">
                      <div class="modal-body">
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
                              <textarea class="form-control" rows="3" placeholder="Alamat" id="alamat"></textarea>
                            </div>
                          </div>
                          <!-- /.card-body -->

                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="btn-save">Simpan</button>
                      </div>
                    </form>
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
                  @foreach($users as $row)
                    <tr>
                      <td>{{ $row->nama }}</td>
                      <td>{{ $row->no_telp }}</td>
                      <td>{{ $row->jabatan }}</td>
                      <td>
                        <a class="editUser btn btn-block btn-outline-secondary btn-flat" data-id_user="{{ $row->id_user }}" data-nama="{{ $row->nama }}" data-no_telp="{{ $row->no_telp }}" data-jabatan="{{ $row->jabatan }}" data-alamat="{{ $row->alamat }}">Ubah</a>
                        <a class="removeUser btn btn-block btn-outline-danger btn-flat" data-id_user="{{ $row->id_user }}">Hapus</a>
                      </td>
                    </tr>
                  @endforeach
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
              <div class="modal fade" id="update-user">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Ubah User</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <form role="form">
                      <div class="modal-body">
                        <div class="card-body">
                          <input type="hidden" name="ubahIdUser" id="ubahIdUser">
                          <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="ubahNama" placeholder="Nama">
                          </div>
                          <div class="form-group">
                            <label for="no_telp">No. Telpon</label>
                            <input type="text" class="form-control" id="ubahNoTelp" placeholder="No. Telpon">
                          </div>
                          <div class="form-group">
                            <label for="jabatan">Jabatan</label>
                            <input type="text" class="form-control" id="ubahJabatan" placeholder="Jabatan">
                          </div>
                          <div class="form-group">
                            <label>Alamat</label>
                            <textarea class="form-control" rows="3" placeholder="Alamat" id="ubahAlamat"></textarea>
                          </div>
                        </div>
                        <!-- /.card-body -->
                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary" id="btn-ubah">Simpan</button>
                      </div>
                    </form>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <div class="modal fade" id="remove-user">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h4 class="modal-title">Hapus User</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <input type="hidden" name="removeIdUser" id="removeIdUser">
                      Anda yakin ingin menghapusnya?
                    </div>
                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                      <button type="submit" class="btn btn-primary" id="btn-hapus">Hapus</button>
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
<script>
  function csrfProtection() {
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
  }
  $(document).ready(function() {
    // Save new user
    $("#btn-save").on('click', function(e) {
      e.preventDefault()

      const nama = $("#nama").val()
      const noTelp = $("#no_telp").val()
      const alamat = $("#alamat").val()
      const password = $("#password").val()
      const jabatan = $("#jabatan").val()

      try {
        csrfProtection()
        if (!nama || typeof nama !== 'string') {
          alert('Nama harus tidak boleh string kosong')
          return
        }
        if (!noTelp || typeof noTelp !== 'string') {
          alert('No Telepon harus tidak boleh string kosong')
          return
        }
        if (!alamat || typeof alamat !== 'string') {
          alert('Alamat harus tidak boleh string kosong')
          return
        }
        if (!password || typeof password !== 'string') {
          alert('Password harus tidak boleh string kosong')
          return
        }
        if (!jabatan || typeof jabatan !== 'string') {
          alert('Jabatan harus tidak boleh string kosong')
          return
        }

        $.ajax({
            url: '/users',
            type: 'POST',
            dataType: 'json',
            async: true,
            data: {nama, no_telp: noTelp, alamat, password, jabatan},
            error: function (err) {
              console.error(err)
              alert(err)
              return
            },
            success: function (response) {
              console.log(response)
              if (response.status === 201) {
                alert(response.message)
                const addModal = $('#add-user')
                addModal.modal('hide')
                location.reload()
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
    // Show User to Edit Modal
    // Edit Modal
    $('.editUser').on('click', function() {
      // Dari Data Table
      const idUser = $(this).data('id_user')
      const nama = $(this).data('nama')
      const noTelp = $(this).data('no_telp')
      const jabatan = $(this).data('jabatan')
      const alamat = $(this).data('alamat')

      // Ke Modal
      $('#ubahIdUser').val(idUser)
      $('#ubahNama').val(nama)
      $('#ubahNoTelp').val(noTelp)
      $('#ubahJabatan').val(jabatan)
      $('textarea#ubahAlamat').val(alamat)
      const editModal = $('#update-user')
      editModal.modal('show')
    })

    // Edit User
    $('#btn-ubah').on('click', function(e) {
        e.preventDefault()

        const idUser = $('#ubahIdUser').val()
        const nama = $('#ubahNama').val()
        const noTelp = $('#ubahNoTelp').val()
        const jabatan = $('#ubahJabatan').val()
        const alamat = $('textarea#ubahAlamat').val()

        try {
          if (!idUser || typeof idUser !== 'string') alert('Id User harus tidak boleh string kosong')
          if (!nama || typeof nama !== 'string') alert('Nama harus tidak boleh string kosong')
          if (!noTelp || typeof noTelp !== 'string') alert('Nomor Telepon harus tidak boleh kosong')
          if (!jabatan || typeof jabatan !== 'string') alert('Jabatan harus tidak boleh string kosong')
          if (!alamat || typeof alamat !== 'string') alert('Alamat harus tidak boleh string kosong')

          csrfProtection()
          $.ajax({
            url: `/users/${idUser}`,
            type: 'PUT',
            dataType: 'json',
            async: true,
            data: {
              nama,
              no_telp: noTelp,
              jabatan,
              alamat
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
                const editModal = $('#editUser')
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

    // Show Modal for Deleted
    $('.removeUser').on('click', function() {
      const idUser = $(this).data('id_user')
      $('#removeIdUser').val(idUser)
      const deleteModal = $('#remove-user')
      deleteModal.modal('show')
    })

    // Delete User
    $('#btn-hapus').on('click', function(e) {
      e.preventDefault()

      const id = $('#removeIdUser').val()

      try {
        if (!id || typeof id !== 'string') alert('Id harus tidak boleh string kosong')

        csrfProtection()
        $.ajax({
          url: `/users/${id}`,
          type: 'DELETE',
          dataType: 'json',
          async: true,
          data: {},
          error: function (err) {
            console.error(err)
            alert(err)
            return
          },
          success: function (response) {
            console.log(response)
            if (response.status === 200) {
              alert(response.message)
              const deleteModal = $('#remove-user')
              deleteModal.modal('hide')
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
