 <?php
 header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
 header("Content-Disposition: attachment; filename=HASIL-KELULUSAN-PPDB.xls");
 header("Pragma: no-cache");
 header("Expires: 0"); ?>


<style type="text/css">
 table td, table th {    
    border: 1px solid #000;
    text-align: left;
    font-size: 12px;
    padding: 5px 8px 10px;
    
}
table {
    border-collapse: collapse;
    width: 100%;
    margin: 0px 0px 0px; 
}
table th {
  background: #ddd;
  text-align: center;
}    
 
.gaya{
	   border: 1px solid #000;
    text-align: left;
    font-size: 12px;
    
} 
</style>   
</style>

<div style="text-align: center;">
 <h4>REKAPITULASI PENERIAMAAN PESERTA DIDIK BARU. <?= tahun_akademik('ta_akademik') ?></h4> 
 <h4><?= strip_tags(cari('nama')) ?></h4>
 <i><?= strip_tags(cari('jalan')) ?> | Telp .<?= strip_tags(cari('telp')) ?></i> 
<hr />
  </div>
<table border="1">

<?php

$no=1; foreach($data->result_array() as $dat):
$rangking = $this->madmin->rangking($dat['id_pendaftaran']);
?>
<?php endforeach  ?>

	<tr>
    <th>No .</th>		
    <th>No Pendaftaran</th>
    <th>Nama Pendaftar</th>
    <th>Jenis Kelamin</th>
    <th>NIK</th>
    <th>Tempat lahir</th>
    <th>Tanggal lahir</th>
    <th>Tanggal Daftar</th>
    <th>Agama</th>
    <th>Keterangan</th>
    <th>Tahun Akademik</th>	
    <th>Rangking</th>
    <th>Nilai Tes</th>
    <td colspan="10">Data Nilai Seleksi</td>
</tr>
<?php $no=1; foreach($data->result() as $sql):
      $jk=($sql->jk == "L") ? "Laki-Laki" :"Perempuan"; 
      $cek=isset($sql->konfirmasi) ? $sql->konfirmasi :'';
                    if ($cek == "P") {
						$keterangan="<td style='background:#ddd;color:#fff'>Pending</td>";
					}elseif($cek =="N"){
						$keterangan="<td style='background:#000;color:#fff'>Tidak Lulus</td>";
					}elseif($cek =="Y"){
						$keterangan="<td style='background:green;color:#fff'>Lulus</td>";
					}else{
						$keterangan="<td style='background:red;color:#fff'>Belum Di Konfirmasi</td>";
				    }
					  ?>
 <tr> 
<td><?= $no ?></td>
<td><?= $sql->no_pendaftaran ?></td>
<td><?= $sql->nama_pendaftar ?></td>
<td><?= $jk ?></td>
<td><?= $sql->nik ?></td>
<td><?= $sql->tempat_lahir ?></td>
<td><?= $sql->tanggal_lahir ?></td>
<td><?= $sql->tanggal ?></td>
<td><?= $sql->agama ?></td>
<?= $keterangan ?>
<td><?= tahun_akademik('ta_akademik')?></td>
<td><?= rangking($dat['id_pendaftaran'],tahun_akademik('id_gelombang')) ?></td>
	

  <?php foreach($this->madmin->nilai_seleksi($sql->id_pendaftaran,$sql->ta_akademik)->result_array() as $dy):  ?>
   <td><?= $dy['nama_test'] ?></td><td><?= $dy['nilai_test'] ?></td>
   <?php endforeach  ?>
</tr>
<?php $no++; endforeach; ?>	
</table>