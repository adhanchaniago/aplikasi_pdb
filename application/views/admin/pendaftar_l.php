<?= $this->session->flashdata('pesan') ?>
<a href="<?= base_url('admin/cetak_pendaftar/pdf/'.$dari.'/'.$sampai.'/'.$tahun_akademik) ?>" target="_blank" class="btn btn-success"><i class="fa fa-print"></i>Print Data</a>

<a href="<?= base_url('admin/cetak_pendaftar/excel/'.$dari.'/'.$sampai.'/'.$tahun_akademik)?>" class="btn btn-info"><i class="fa fa-share"></i>Export Excel</a>
<hr />
<table id="example1" class="table table-bordered table-striped">
    <thead>
	<tr>
		<th>No.</th>
		<th>No Pendaftaran</th>
		<th>Nama Pendaftar</th>
		<th>Jenis Kelamin</th>
		<th>NIK</th>
		<th>Tempat lahir</th>
		<th>Tanggal lahir</th>
		<th>Agama</th>
		<th>Keterangan</th>
		<th>Detail</th>
		</tr>
	</thead>
		<tbody>
		 <?php $no=1; foreach($data->result_array() as $dat):
                      $jk=($dat['jk'] == "L") ? "Laki" :"Perempuan";    
                      $cek=isset($dat['konfirmasi']) ? $dat['konfirmasi'] :'';
                    if ($cek == "P") {
						$keterangan="<button class='btn btn-info'>Pending</button>";
					}elseif($cek =="N"){
						$keterangan="<button class='btn btn-danger'>Tidak Lulus</button>";
					}elseif($cek =="Y"){
						$keterangan="<button class='btn btn-info'>Lulus</button>";
					}else{
						$keterangan="<button class='btn btn-danger'>Belum Di Konfirmasi</button>";
				    }
					 
		 ?>
		 <tr>
		 <td><?= $no ?></td>
		 <td><?= $dat['no_pendaftaran'] ?></td>
		 <td><?= $dat['nama_pendaftar'] ?></td>
		 <td><?= $jk ?></td>
		 <td><?= $dat['nik'] ?></td>
		 <td><?= $dat['tempat_lahir'] ?></td>
		 <td><?= $dat['tanggal_lahir'] ?></td>
		 <td><?= $dat['agama'] ?></td>
		 <td><?= $keterangan ?></td>
		 <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-default<?= $no ?>">
                Detail Informasi 
              </button></td>
		</tr>
		<?php $no++; endforeach; ?>
		</tbody>
	<thead>
	<tr>
		<th>No.</th>
		<th>No Pendaftaran</th>
		<th>Nama Pendaftar</th>
		<th>Jenis Kelamin</th>
		<th>NIK</th>
		<th>Tempat lahir</th>
		<th>Tanggal lahir</th>
		<th>Agama</th>
		<th>Aksi</th>
		</tr>
	 </thead>
</table>



<?php $no=1; foreach($data->result_array() as $dat):
      $jk=($dat['jk'] == "L") ? "Laki" :"Perempuan";    
   ?>
 <div class="modal fade" id="modal-default<?= $no ?>">
          <div class="modal-dialog" style="width: 80%">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Detail Data Pendaftar PMB</h4>
                <div style="float: right;">
			    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                <a href="<?= base_url('admin/pendaftar/cetak/'.$dat['id_pendaftaran'].'/Cetak-data-pendaftar.pdf') ?>" class="btn btn-success"><i class="fa fa-print"></i>Cetak Data</a> 
                </div>
              </div>
              <div class="modal-body">
               <div class="container">
 <div class="row">

<div class="col-md-6">
<form action="" method="POST">
	 <table class="table table">
<tr><div class="callout callout-success"><i class="fa fa-user"></i><tt>Data Calon Siswa</tt></div></tr>
<tr><td>Nomor Pendaftaran</td><td><b><?= $dat['no_pendaftaran'] ?></b></td></tr>
<tr><td>Nama pendaftar</td><td><?= $dat['nama_pendaftar'] ?></td></tr>
<tr><td>Jenis Kelamin</td><td><?= $jk ?></td></tr>
<tr><td>NIK</td><td><?= $dat['nik'] ?></td></tr>
<tr><td>Tempat lahir</td><td><?= $dat['tempat_lahir'] ?></td></tr>
<tr><td>Tanggal lahir</td><td><?= $dat['tanggal_lahir'] ?></td></tr>
<tr><td>Agama</td><td><?= $dat['agama'] ?></td></tr>
 <tr><td>RT</td><td><?= $dat['rt'] ?></td></tr>
<tr><td>RW</td><td><?= $dat['rw'] ?></td></tr>
<tr><td>Desa/Kelurahan</td><td><?= $dat['desa_kelurahan'] ?></td></tr>
<tr><td>Kecamatan</td><td><?= $dat['kecamatan'] ?></td></tr>
<tr><td>Kabupaten</td><td><?= $dat['kabupaten'] ?>></td></tr>
<tr><td>Provinsi</td><td><?= $dat['provinsi'] ?></td></tr>
<tr><td>Kode Pos</td><td><?= $dat['kode_pos'] ?></td></tr>
<tr><td>Tinggi Badan</td><td><?= $dat['tinggi_badan'] ?></td></tr>
<tr><td>Berat Badan</td><td><?= $dat['berat_badan'] ?></td></tr>
<tr><td>No Telepon</td><td><?= $dat['no_telepon'] ?></td></tr>
<tr><td>Kendaraan Transportasi</td><td><?= $dat['alat_transportasi'] ?></td></tr>
<tr><td>Prestasi</td><td><?= $dat['prestasi'] ?></td></tr>
 	 </table>
</div>

<div class="col-md-6">

<table class="table table-striped">
	<tr><td colspan="3"><div class="callout callout-success"><tt>Data Orang Tua /Wali</tt></div></td></tr>
<tr><td>Nama Ayah</td><td><?= $dat['nama_ayah'] ?></td></tr>
<tr><td>Tahun Lahir Ayah</td><td><?= $dat['tahun_lahir_ayah'] ?></td></tr>
<tr><td>Pekerjaan Ayah</td><td><?= $dat['pekerjaan_ayah'] ?></td></tr>
<tr><td>Pendidikan Ayah</td><td><?= $dat['pendidikan_ayah'] ?></td></tr>
<tr><td>Penghasilan Ayah</td><td><?= $dat['penghasilan_ayah'] ?></td></tr>
<tr><td>Nama Ibu</td><td><?= $dat['nama_ibu'] ?></td></tr>
<tr><td>Tahun Lahir Ibu</td><td><?= $dat['tahun_lahir_ibu'] ?></td></tr>
<tr><td>Pekerjaan Ibu</td><td><?= $dat['pekerjaan_ibu'] ?></td></tr>
<tr><td>Pendidikan Ibu</td><td><?= $dat['pendidikan_ibu'] ?></td></tr>
<tr><td>Penghasilan Ibu</td><td><?= $dat['penghasilan_ibu'] ?></td></tr>
<tr><td>Jenis Tinggal</td><td>
   <?php 
   $jenis_tinggal=isset($dat['jenis_tinggal']) ? $dat['jenis_tinggal'] :"";
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
<tr><td colspan="3"><div class="callout callout-success"><tt>** Data Wali</tt></div></td></tr>
<tr><td>Nama Wali</td><td><?= $dat['nama_wali'] ?></td></tr>
<tr><td>Tahun Lahir Wali</td><td><?= $dat['tahun_lahir_wali'] ?></td></tr>
<tr><td>Pekerjaan Wali</td><td><?= $dat['pekerjaan_wali'] ?></td></tr>
<tr><td>Pendidikan Wali</td><td><?= $dat['pendidikan_wali'] ?></td></tr>
<tr><td>Penghasilan Wali</td><td><?= $dat['penghasilan_wali'] ?></td></tr>
 
</table>

</div>

</form>
</div>
</div>
              </div>

            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>

 <?php $no++; endforeach; ?>
 