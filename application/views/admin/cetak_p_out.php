 
<style type="text/css">
 body{
 
  width: 100%;
 }
.table td, .table th {    
    border: 1px solid #000;
    text-align: left;
    font-size: 12px;
    padding: 5px 8px 10px;
    
}
.table {
    border-collapse: collapse;
    width: 100%;
    margin: 0px 0px 0px; 
}
.table th {
  background: #ddd;
  text-align: center;
}    
 
.gaya{
	   border: 1px solid #000;
    text-align: left;
    font-size: 12px;
    
} 

</style>

<?php 
$tahun=date('Y');
$hasil=$tahun.'-'.++$tahun;
$tahun_akademik=isset($data->row()->ta_akademik) ? $data->row()->ta_akademik : $hasil;  ?>
 <div class=container style="text-align: center">
<img src="<?= base_url('/assets/admin/dist/img/proc.png') ?>" style="width: 90px;height: 90px">
<h4>REKAPITULASI PENERIAMAAN PESERTA DIDIK BARU TAHUN. <?= tahun_akademik('ta_akademik') ?></h4>
 <h4><?= strip_tags(cari('nama')) ?></h4>
 <i><?= strip_tags(cari('jalan')) ?>Telp .<?= strip_tags(cari('telp')) ?></i> 
<hr />
  </div>

<br /><br /><br />
<table class="table">
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
		 
		</tr>
	</thead>
		<tbody>
		 <?php $no=1; foreach($data->result_array() as $dat):
                      $jk=($dat['jk'] == "L") ? "Laki" :"Perempuan";    
                      $cek=isset($dat['konfirmasi']) ? $dat['konfirmasi'] :'';
                    if ($cek == "P") {
						$keterangan="Pending";
					}elseif($cek =="N"){
						$keterangan=" Tidak Lulus";
					}elseif($cek =="Y"){
						$keterangan=" Lulus";
					}else{
						$keterangan="Belum Di Konfirmasi";
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
		 
		</tr>
		<?php $no++; endforeach; ?>
		</tbody>

</table>
<?php
require_once(APPPATH.'/third_party/html2pdf/html2pdf.class.php');
$content = ob_get_clean();
$html2pdf = new HTML2PDF('P','A4','en');
$html2pdf->WriteHTML($content);
$html2pdf->Output('LAPORAN PENERIMAAN SISWA BARU.pdf','D');
?>


 