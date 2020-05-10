<div class="callout callout-success">
  
  Silahakan tambahkan informasi anda pada textarea di bawah 

</div>

<?php if($aksi == "edit"): ?>

<div class="callout callout-info">
	 Informasi Dengan Judul : <b><?= strip_tags($judul_i) ?> Di Publikasikan Oleh <?= $id_admin ?><br />
     Pada Tanggal <?= tgl_indonesia($tanggal) ?>
	 </b>

</div>
<?php else:
      endif; ?>
<form action="" method="POST" enctype="multipart/form-data"> 
<table class="table table striped">
	<tr><th>Judul informasi</th><td><input type="text" name="judul_i" class="form-control" required="" value="<?= $judul_i ?>"></td></tr>	
	<tr><th>Isi Informasi</th><td><textarea cols="10" rows="10" class="ckeditor form-control" name="isi"><?= $isi ?></textarea></td></tr>
	<tr><th>Gambar</th><td>
<?php  
         if($aksi == "add"){
         	 
         }elseif($aksi == "edit"){
         echo '<image src="'.base_url('assets/gambar/'.$gambar).'" class="image-responsive" style="width:150px;height:150px">';

		} ?>

		<input type="file" name="gambar" class="form-control"></td></tr>
	<tr><th>Tanggal publikasi informasi</th><td><b>


		<?php  
         if($aksi == "add"){
         	echo 'Tanggal Publikasi Sekarang :'.tgl_indonesia(date("Y-m-d"));
         }elseif($aksi == "edit"){

		echo 'Anda mempublikasi informasi ini terakhir pada  :'.tgl_indonesia($tanggal);

		} ?></b></td></tr>
	<tr><td><input type="submit" name="kirim" class="btn btn-success">
	        <input type="reset"  class="btn btn-danger"></td><td></td></tr>
	<tr><td></td><td></td></tr>

</table>
</form>


<!--  id 
 judul_i 
 isi  
 id_admin  
 tanggal  
 aksi     -->