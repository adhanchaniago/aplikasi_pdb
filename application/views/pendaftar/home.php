<div class="box box-info">
            <div class="box-header with-border">
              <?= $this->session->flashdata('pesan') ?>
            </div>
 

<?php
  $ada=file_exists('/assets/file_pendaftar/'.$pendaftar->row()->foto);
  if(!$ada){
   echo "<div class='callout callout-danger'>Silahkan Lengkapi Forto Profile Anda Untuk Kelengkapan Data Anda.</div>";
  }elseif($ada){
    echo "<div class='callout callout-info'>Anda Telah Lulus Dalam Penerimaan Peserta Pelatihan Baru</div>";
  }
echo "<div class='callout callout-info'>Silahkan Cek Data Kelengkapan Data Anda </div>"; ?>


<div class="col-md-8">
<table class="table table-striped">
<?php
 $jk=($dat[0]['jk'] == "L") ? "Laki" :"Perempuan"; 
 ?>
<tr><td>Nomor Pendaftaran</td><td><b><?= $dat[0]['no_pendaftaran'] ?></b></td></tr>
<tr><td>Nama pendaftar</td><td><?= $dat[0]['nama_pendaftar'] ?></td></tr>
<tr><td>Jenis Kelamin</td><td><?php $kel=($dat[0]['jk'] == 'L') ? 'Laki- Laki' : 'Perempuan';
  echo $kel;
 ?></td></tr>
<tr><td>Nik</td><td><?= $dat[0]['nik'] ?></td></tr>
<tr><td>Tempat lahir</td><td><?= $dat[0]['tempat_lahir'] ?></td></tr>
<tr><td>Tanggal lahir</td><td><?= $dat[0]['tanggal_lahir'] ?></td></tr>
<tr><td>Agama</td><td><?= $dat[0]['agama'] ?></td></tr>
<tr><td>RT</td><td><?= $dat[0]['rt'] ?></td></tr>
<tr><td>RW</td><td><?= $dat[0]['rw'] ?></td></tr>
<tr><td>Desa Kelurahan</td><td><?= $dat[0]['desa_kelurahan'] ?></td></tr>
<tr><td>Kecamatan</td><td><?= $dat[0]['kecamatan'] ?></td></tr>
<tr><td>Kabupaten</td><td><?= $dat[0]['kabupaten'] ?></td></tr>
<tr><td>Provinsi</td><td><?= $dat[0]['provinsi'] ?></td></tr>
<tr><td>Kode Pos</td><td><?= $dat[0]['kode_pos'] ?></td></tr>
<tr><td>Tinggi Badan</td><td><?= $dat[0]['tinggi_badan'] ?></td></tr>
<tr><td>Berat Badan</td><td><?= $dat[0]['berat_badan'] ?></td></tr>
<tr><td>No Telepon</td><td><?= $dat[0]['no_telepon'] ?></td></tr>
<tr><td>Alat Transportasi</td><td><?= $dat[0]['alat_transportasi'] ?></td></tr>
<tr><td>Prestasi</td><td><?= $dat[0]['prestasi'] ?></td></tr>
</table>
</div>
<div class="col-md-4">
   <img src="<?php
                  $ada=file_exists('./assets/file_pendaftar/'.$dat[0]['foto']);
                  if(!$ada){
                    echo  base_url('assets/no_foto.png');
                  }elseif($ada){
                   echo base_url('assets/file_pendaftar/'.$dat[0]['foto']);
                   
                  }  ?>" class="image-responsive" style="width: 100px;height: 100px" onerror="this.src = '<?= base_url('assets/no-image.jpg') ?>';">
                 <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default">Upload Foto Profil</button>


</div>

<div class="modal fade" id="modal-default">
          <div class="modal-dialog" style="width: 80%">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title">UPLOAD FOTO PROFILE</h4>
              </div>
              <div class="modal-body">
                 <form action="<?= base_url('pendaftar/upload_foto') ?>" method="POST" enctype="multipart/form-data">
                   <table class="table table-striped">
                    <tr><td>Foto Profil</td><td><input type="file" name="foto" class="form-control"></td></tr>
                     <tr><td><input type="submit" name="kirim" class="btn btn-info" value="Update Data"></td></tr>
                   </table>

                 </form>

                </div>
              </div>
            </div>
          </div>
</div>