<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $judul ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="<?= base_url('assets/admin') ?>/bootstrap/css/bootstrap.min.css">
  <link rel="shortcut icon" href="<?= base_url('assets/gambar/' . cari('favicon')) ?>" type="image/x-icon" />
  <script src="<?= base_url() ?>assets/ckeditor/ckeditor.js"></script>
  <script src="<?= base_url() ?>assets/ckeditor/styles.js"></script>
  <script src="<?= base_url('assets/admin/dist/js/') ?>/sweetalert.js"></script>
  <script type=”text/javascript”> // <![CDATA[ CKEDITOR.replace( ‘agenda’, { fullPage : true, extraPlugins : ‘docprops’, filebrowserBrowseUrl : ‘../ckeditor/kcfinder/browse.php’, height:”500″, width:”900″, }); //]]> </script> <script type="text/javascript">

    function keluar(){

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
   window.location.href = "<?= base_url('admin/keluar') ?>";

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
  <link rel="shortcut icon" href="<?= base_url('assets/bg.png') ?>" type="image/x-icon" />
  <link rel="stylesheet" href="<?= base_url('assets/admin/bootstrap/font-awesome/css/font-awesome.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('assets/admin') ?>/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/admin') ?>/plugins/datatables.net-bs/css/dataTables.bootstrap.min.css" />
  <link rel="stylesheet" href="<?= base_url('assets/admin') ?>/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/admin') ?>/dist/css/skins/bootstrap-datepicker.min.css">
  <script src="<?= base_url('assets/admin/bootstrap/js/') ?>/jquery-1.11.2.min.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <header class="main-header">
      <!-- Logo -->
      <a href="" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>DM</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>ADMINISTRATOR-</b></span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>
        <?php $Data_user = $this->db->get_where('rn_admin', array('id_admin' => $this->session->userdata('id_admin'))); ?>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li> <a href="<?= base_url('/') ?>" target="_blank">
                <i class="fa fa-eye"></i>&nbsp;Preview Site
              </a></li>

            <li class="dropdown user user-menu">

              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="hidden-xs"><?= ucfirst($this->session->userdata('nama')) ?> </span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <p>
                    <?= $this->session->userdata('nama') ?>
                    <small>Login Terakhir Anda <?= $this->session->userdata('log') ?></small>
                    <img src="<?php
                              $ada = file_exists('assets/foto_admin/' . $Data_user->row()->foto);
                              if (!$ada) {
                                echo  base_url('assets/no_foto.png');
                              } elseif ($ada) {
                                echo base_url('assets/foto_admin/' . $Data_user->row()->foto);
                              }  ?>" class="image-responsive" style="width: 100px;height: 100px">
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
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">

        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">MAIN NAVIGATION</li>

          <li>
            <a href="<?= base_url('admin') ?>">
              <i class="fa fa-home"></i>
              <span>Beranda</span>
            </a>
          </li>



          <li class="treeview">
            <a href="">
              <i class="fa fa-list-ol"></i>
              <span>Data Pendaftar</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu" style="display: none;">
              <li><a href="<?= base_url('admin\pendaftar') ?>"><i class="fa fa-circle-o"></i>Data Pendaftar</a></li>
            </ul>
          </li>


          <li class="treeview">
            <a href="">
              <i class="fa fa-cubes"></i>
              <span>Jurusan</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu" style="display: none;">
              <li><a href="<?= base_url('admin\jurusan') ?>"><i class="fa fa-circle-o"></i>Jurusan </a></li>
            </ul>
          </li>


          <?php if ($this->session->userdata('level') == "admin") : ?>

            <li class="treeview">
              <a href="">
                <i class="fa fa-cubes"></i>
                <span>Daftar Tes</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="<?= base_url('admin\rank') ?>"><i class="fa fa-circle-o"></i>Daftar Test </a></li>
              </ul>
            </li>


            <li class="treeview">
              <a href="">
                <i class="fa fa-cubes"></i>
                <span>Setting Akademik</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="<?= base_url('admin\setting_app') ?>"><i class="fa fa-circle-o"></i>Tahun Akademik </a></li>
                <li><a href="<?= base_url('tmverifikasi_rapor') ?>"><i class="fa fa-circle-o"></i>Setting Nilai Raport </a></li>
              </ul>
            </li>

          <?php else : endif;
          ?>
          <li class="treeview">
            <a href="">
              <i class="fa fa-list-ol"></i>
              <span>Grafik</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu" style="display: none;">
              <li><a href="<?= base_url('admin\grafik') ?>"><i class="fa fa-circle-o"></i>Grafik Pendaftaran.</a></li>
            </ul>
          </li>


          <li class="treeview">
            <a href="">
              <i class="fa fa-list-ol"></i>
              <span>Laporan Data Pendaftaran.</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu" style="display: none;">
              <li><a href="<?= base_url('admin\laporan_pendaftar') ?>"><i class="fa fa-circle-o"></i>Data Pendaftar</a></li>
            </ul>
          </li>



          <li class="treeview">
            <a href="">
              <i class="fa fa-list-ol"></i>
              <span>Informasi</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu" style="display: none;">
              <li><a href="<?= base_url('admin\Informasi') ?>"><i class="fa fa-circle-o"></i>Artikel</a></li>
            </ul>
          </li>

          <?php if ($this->session->userdata('level') == "admin") : ?>
            <li class="treeview">
              <a href="">
                <i class="fa fa-wrench"></i>
                <span>Setting Sistem</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="<?= base_url('admin\Identitas') ?>"><i class="fa fa-circle-o"></i>Identitas</a></li>
                <li><a href="<?= base_url('admin\slider_bg') ?>"><i class="fa fa-circle-o"></i>Slider </a></li>
              </ul>
            </li>

          <?php else : endif; ?>


          <?php if ($this->session->userdata('level') == "admin") : ?>
            <li class="treeview">
              <a href="">
                <i class="fa fa-user"></i>
                <span>Hak Akses</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="<?= base_url('admin\hak_akses') ?>"><i class="fa fa-circle-o"></i>Hak Akses</a></li>
              </ul>
            </li>
          <?php else : endif; ?>

          <li class="treeview">
            <a href="">
              <i class="fa fa-list-ol"></i>
              <span>Edit Profil</span>
              <i class="fa fa-angle-left pull-right"></i>
            </a>
            <ul class="treeview-menu" style="display: none;">
              <li><a href="<?= base_url('admin\profil') ?>"><i class="fa fa-circle-o"></i>Edit Profil</a></li>
            </ul>
          </li>


        </ul>


      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          Dashboard
          <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="<?= base_url('admin') ?>"><i class="fa fa-home"></i> Home</a></li>
          <li class="active"><?= $judul ?></li>
        </ol>
      </section>

      <section class="content" style="background:  #fff;">
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="callout callout-info" style="height: 50px">
                <div class="col-md-8">
                  <h4> <i class="fa fa-share fa-spin"></i><?= $judul ?></h4>
                </div>
              </div>