<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $judul ?></title>
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
  <style>
    .table-responsive {
      min-height: .01%;
      overflow-x: auto;
      overflow: visible;
    }
  </style>

  <script type="text/javascript">
    function keluar() {

      swal({
          title: "Anda Yakin Untuk Keluar?",
          text: "Keluar Dari Halaman Administrator Untuk Mengakhiri Session Anda ?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            swal("Sedang mengalihkan", {
              icon: "success",
            });
            window.location.href = "<?= base_url('pendaftar/keluar') ?>";

          } else {

            swal({
              title: "Anda Membatalkan Keluar Dari Halaman Administrator",
              icon: "success",
              button: "Tutup Dialog",
            });
          }
        });


    }
  </script>

</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <header class="main-header">
      <!-- Logo -->
      <a href="" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>P</b>ENDAFTAR</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Pendaftar-</b></span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <?php $Data_user = $this->db->get_where('rn_daftar', array('id_pendaftaran' => $this->session->userdata('id_pendaftaran'))); ?>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="hidden-xs"><?= ucfirst($Data_user->row()->nama_pendaftar) ?> </span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <p>
                    <?= $this->session->userdata('nama') ?>
                    <small>Login Terakhir Anda <?= $this->session->userdata('log') ?></small>
                    <img src="<?php
                              $ada = file_exists('./assets/file_pendaftar/' . $Data_user->row()->foto);
                              if (!$ada) {
                                echo  base_url('assets/no_foto.png');
                              } elseif ($ada) {
                                echo base_url('assets/file_pendaftar/' . $Data_user->row()->foto);
                              }  ?>" class="image-responsive" style="width: 100px;height: 100px" onerror="this.src = '<?= base_url('assets/no-image.jpg') ?>';">
                  </p>
                </li>
                <!-- Menu Body -->
                <li class="user-body">

                </li>
                <!-- Menu Footer-->
                <li class="user-footer">

                  <div class="pull-right">
                    <button onclick="return keluar()" class="btn btn-default btn-flat">Sign out</button>
                  </div>
                </li>
              </ul>
            </li>
            <!-- Control Sidebar Toggle Button -->
            <li>
              <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <aside class="main-sidebar">
      <section class="sidebar">

        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MAIN NAVIGATION</li>

          <li>
            <a href="<?= base_url('pendaftar') ?>">
              <i class="fa fa-home"></i>
              <span>Beranda</span>
            </a>
          </li>

          <li class="treeview">
            <a href="">
              <i class="fa fa-list-ol"></i>
              <span>Profil</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu" style="display: none;">
              <li><a href="<?= base_url('pendaftar\profil') ?>"><i class="fa fa-circle-o"></i>Profil</a></li>

            </ul>
          </li>
          <li><a href="<?= base_url('pendaftar\kartu_ujian') ?>"><i class="fa fa-circle-o"></i><span>Cetak Kartu Ujian</span></a></li>
        </ul>

      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <section class="content" style="background:  #fff;">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="callout callout-info" style="height: 50px">
                <div class="col-md-8">
                  <h4> <i class="fa fa-share"></i><?= $judul ?></h4>
                </div>
                <div class="col-md-4">
                  <marquee>SELAMAT DATANG DI HALAMAN ADMINISTRATOR <?= ucfirst($this->session->userdata('nama')) ?></marquee>
                </div>
              </div>