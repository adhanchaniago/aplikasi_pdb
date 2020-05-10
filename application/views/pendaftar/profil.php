
 
<center>
 <img src="<?= base_url('/assets/admin/dist/img/proc.png') ?>" class="img-responsive" onerror="this.src = '<?= base_url('assets/no-image.jpg') ?>';" style="width: 100px;height: 100px">
 <br />
 <h3>PANITIA PENERIMAAN PESERTA DIDIK BARU</h3>
 <h4><tt><?= cari('nama') ?></tt></h4>
 <b><?= cari('jalan') ?></b>
<hr />
</center> 
   
       
   

<?php if($cetak ==TRUE){ ?>

<link rel="stylesheet" href="<?= base_url('assets/bootstrap.min.css') ?>">

<?php }elseif($cetak == FALSE){
}  

if($cetak ==TRUE){ ?>
<?php }elseif($cetak == FALSE){ ?>
<a href="<?= base_url('pendaftar/profil/cetak') ?>" target="_blank" class="btn btn-success"><i class="fa fa-print"></i>Cetak</a>
<hr />


<?php
} ?>
<div class="container"> 
<div class="row">
<div class="col-md-6">
<table class="table table">
<tr><td colspan="4">  <img src="<?php
                   $ada=file_exists('./assets/file_pendaftar/'.$dat[0]['foto']);
                  if(!$ada){
                    echo  base_url('assets/no_foto.png');
                  }elseif($ada){
                   echo base_url('assets/file_pendaftar/'.$dat[0]['foto']);
                   
                  }  ?>" class="image-responsive" style="width: 150px;height: 150px" onerror="this.src = '<?= base_url('assets/no-image.jpg') ?>';">
       </td></tr>

<?php
 $jk=($dat[0]['jk'] == "L") ? "Laki" :"Perempuan"; 
 ?>
<tr><td>Nomor Pendaftaran</td><td><b><?= $dat[0]['no_pendaftaran'] ?></b></td></tr>
<tr><td>Nama pendaftar</td><td><?= $dat[0]['nama_pendaftar'] ?></td></tr>
<tr><td>Jenis Kelamin</td><td><?= $jk ?></td></tr>
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

<div class="col-md-6">

<table class="table table-striped">
	<tr><td colspan="3"><div class="callout callout-success"><tt>Data Orang Tua /Wali</tt></div></td></tr>
<tr><td>Nama Ayah</td><td><?= $dat[0]['nama_ayah'] ?></td></tr>
<tr><td>Tahun Lahir Ayah</td><td><?= $dat[0]['tahun_lahir_ayah'] ?></td></tr>
<tr><td>Pekerjaan Ayah</td><td><?= $dat[0]['pekerjaan_ayah'] ?></td></tr>
<tr><td>Pendidikan Ayah</td><td><?= $dat[0]['pendidikan_ayah'] ?></td></tr>
<tr><td>Penghasilan Ayah</td><td><?= $dat[0]['penghasilan_ayah'] ?></td></tr>
<tr><td>Nama Ibu</td><td><?= $dat[0]['nama_ibu'] ?></td></tr>
<tr><td>Tahun Lahir Ibu</td><td><?= $dat[0]['tahun_lahir_ibu'] ?></td></tr>
<tr><td>Pekerjaan Ibu</td><td><?= $dat[0]['pekerjaan_ibu'] ?></td></tr>
<tr><td>Pendidikan Ibu</td><td><?= $dat[0]['pendidikan_ibu'] ?></td></tr>
<tr><td>Penghasilan Ibu</td><td><?= $dat[0]['penghasilan_ibu'] ?></td></tr>
<tr><td>Jenis Tinggal</td><td>
   <?php 
   $jenis_tinggal=isset($dat[0]['jenis_tinggal']) ? $dat[0]['jenis_tinggal'] :"";
   if($jenis_tinggal == "1"){
   	echo "Bayar Sewa / Kos";
   }elseif($jenis_tinggal == "2"){
    echo "Rumah Sendiri";
   }elseif($jenis_tinggal == "3"){
    echo "Mengontrak";
   }else{
   	echo "Maaf Data Tidak Terverifikasi";
   } 
   ?>

</td></tr>
<tr><td colspan="3"><div class="callout callout-success"><tt>** Jika Data Orang Tua Ibu/Ayah Kosong Silahkan Isikan Data Orang Tua Pada 
Wali .</tt></div></td></tr>
<tr><td>Nama Wali</td><td><?= $dat[0]['nama_wali'] ?></tr>
<tr><td>Tahun Lahir Wali</td><td><?= $dat[0]['tahun_lahir_wali'] ?></td></tr>
<tr><td>Pekerjaan Wali</td><td><?= $dat[0]['pekerjaan_wali'] ?></td></tr>
<tr><td>Pendidikan Wali</td><td><?= $dat[0]['pendidikan_wali'] ?></td></tr>
<tr><td>Penghasilan Wali</td><td><?= $dat[0]['penghasilan_wali'] ?></td></tr>

 
</table>
<?php if($dat[0]['konfirmasi'] == 'Y'): ?>
  <center>
 <div class="alert alert-success"><h4>Selamat Anda Lulus </h4></div>
</center>
<?php endif; ?>


</div>
</div>
</div>
</div>