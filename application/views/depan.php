<link rel="stylesheet" href="<?= base_url('assets/Lobibox.min.css') ?>" />

<script type="text/javascript">
  $(function() {

    Lobibox.notify('info', {
      position: 'bottom right',
      title: 'SELAMAT DATANG DI - <?= strip_tags(trim(cari('nama'))) ?>',
      img: '<?= base_url('/assets/admin/dist/img/proc.png') ?>',
      size: 'large',
      msg: ''
    });

  });
</script>
<br />
<div class="col-md-12">
  <div class="col-md-6" style="background: #000d04de;
    padding: 10px 10px;
    border-left: 10px solid #c44343;
    color: #fff;
     ">
    <center>
      <img src="<?= base_url('/assets/admin/dist/img/proc.png') ?>" class="img-responsive" style="width: 100px;height: 100px">
      <br />
      <br />
      <h4><b>SISTEM INFORMASI PENERIMAAN PESERTA DIDIK BARU<br /><?= strip_tags(cari('nama')) ?></b></h4>
      <small><b><i>Jl.<?= strip_tags(cari('jalan')) ?> | Telp : <?= strip_tags(cari('telp')) ?></i></b></small>
    </center>
  </div>
  <div class="col-md-12">
    <div class="col-md-6" style="background: #000000a8;
    padding: 10px 0px 10px;
    color: #fff;
    box-shadow: 0px 0px 0px #000;">
      <div class="alert alert-info" style="border-radius: 0px;border:none;color: #df9c0e">
        <h3 class="box-title"><i class="fa fa-book"></i> TATA CARA PENDAFTARAN </h3>
      </div>
      <br />
      <div style="padding:10px;"><?= cari('cara_daftar') ?></div>
    </div>
  </div>
</div>
<script src="<?= base_url('assets/lobibox.js') ?>"></script>