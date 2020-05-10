<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
  <meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no">
  <meta name="description" content="<?= cari('description') ?>">
  <meta name="author" content="<?= cari('description') ?>">
  <title><?= strip_tags($judul) ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?= base_url('assets/admin') ?>/bootstrap/css/bootstrap.min.css">
  <script src="<?= base_url() ?>assets/ckeditor/styles.js"></script>
  <link rel="shortcut icon" href="<?= base_url('assets/bg.png') ?>" type="image/x-icon" />
  <link rel="stylesheet" href="<?= base_url('assets/admin/bootstrap/font-awesome/css/font-awesome.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/admin') ?>/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/admin') ?>/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css" />
  <link rel="stylesheet" href="<?= base_url('assets/admin') ?>/dist/css/skins/_all-skins.min.css">
  <script src="<?= base_url('assets/admin/bootstrap/js/') ?>/jquery-1.11.2.min.js"></script>
  <link rel="stylesheet" href="<?= base_url('assets/admin/dist') ?>/css/datepicker.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <script src="<?= base_url('assets/admin/dist/js/') ?>/sweetalert.js"></script>
</head>

<style>
  @media (min-width: 768px) {
    .navbar-nav {
      float: left;
      margin: 0;
      margin-left: 400px;
    }
  }
</style>

<body class="skin-blue layout-top-nav">
  <script type="text/javascript">
    $(function() {
      $('#login_akses').click(function() {
        $("#modal_login").modal('show');
      });
    });
  </script>

  <script type="text/javascript">
    $(function() {
      $('.notifikasi').hide();
      $('#login').submit(function() {
        $('.notifikasi').hide();
        if ($('input[name=username]').val() == "") {
          swal({
            title: "Kesalahan",
            text: "Username Tidak Boleh Kosong",
            icon: "error",
            button: "OK",
          });
        } else if ($('input[name=password]').val() == "") {
          swal({
            title: "Kesalahan",
            text: "Password Tidak Boleh Kosong",
            icon: "error",
            button: "OK",
          });
        } else {
          $.ajax({
            type: "POST",
            url: "<?= base_url('home/login') ?>",
            data: $(this).serialize(),
            success: function(data) {
              if (data == 'admin') {
                swal("Good job!", "You clicked the button!", "success");
                window.location = "<?= base_url('admin/?gos=Berhasil') ?>";
              } else if (data == "siswa") {
                swal("Good job!", "You clicked the button!", "success");
                window.location = "<?= base_url('pendaftar/?gos=Berhasil') ?>";
              } else {
                swal({
                  title: "Kesalahan",
                  text: 'Username Dan Password Salah',
                  icon: "error",
                  button: "OK ",
                });
              }
            },
            error: function(data) {
              alert('Silahkan Refresh Kembali Browser Anda : )');
            }
          });

        }
        return false;
      });

    });
  </script>

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="../../index2.html" class="navbar-brand"><b><?= cari('nama') ?></b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="nav-item active">
              <a class="nav-link" href="<?= base_url('') ?>">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('pendaftaran.jsp') ?>">Pendaftaran</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('cek-lulus.jsp') ?>">Cek Kelulusan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= base_url('pengumuman.jsp') ?>">Informasi</a>
            </li>
            <li class="nav-item">
              <?php if ($this->session->userdata('id_admin')) : ?>
                <a class="nav-link" href="<?= site_url('admin') ?>">Dashboard : <?= $this->session->userdata('username') ?></a>
              <?php else : ?>
                <a class="nav-link" href="#" id="login_akses">Login</a>
              <?php endif; ?>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
  <?php $this->load->view($content) ?>
  <!-- Footer -->
  <div class="modal fade" id="modal_login" tabindex="-1" role="dialog" aria-labelledby="modal_loginLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 50%">
      <div class="modal-content">
        <div class="modal-header">
          <div class="modal-header"><b>Login </b></div>
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

        </div>
        <div class="modal-body">

          <form id="login" class="form-horizontal">
            <div class="box-body">
              <div class="form-group has-feedback">
                <div class="col-sm-12">
                  <input type="text" name="username" class="form-control" id="inputEmail3" placeholder="Username ...">
                  <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
              </div>
              <div class="form-group has-feedback">
                <div class="col-sm-12">
                  <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password ...">
                  <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
              </div>
              <br />
              <div class="form-group">
                <div class="col-sm-12">
                  <button name="login" class="btn btn-primary btn-block btn-flat"> <span class="glyphicon glyphicon-user"></span>Login</button>

                </div>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript -->
  <script src="<?= base_url('assets/jquery-1.10.2.js') ?>"></script>
  <script src="<?= base_url('assets/jquery.backstretch.min.js') ?>"></script>

  <?php
  $array = array();
  foreach ($this->db->get('rn_slider')->result_array() as $data) {
    $array[] = '\'' . base_url('assets/gambar/' . $data['gambar']) . '\'';
  }

  $data = implode(',', $array);
  ?>
  <script type="text/javascript">
    $.backstretch(
      [
        <?= $data ?>
      ], {
        duration: 1200,
        fade: 600
      });
  </script>
  <script src="<?= base_url('assets/admin/dist') ?>/js/jquery.min.js"></script>
  <script src="<?= base_url('assets/admin/dist') ?>/js/bootstrap-datepicker.min.js">
  </script>
  <script src="<?= base_url('assets/admin/dist') ?>/js/bootstrap.min.js"></script>
  <script src="<?= base_url('assets/admin/dist') ?>/js/adminlte.min.js"></script>
</body>

</html>