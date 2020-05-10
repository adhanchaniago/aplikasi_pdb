<?php if($form =='n'):  ?>
 

<table id="example1" class="table table-bordered table-striped">
    <thead>
	<tr>
		<th>No.</th>
		<th>Nama Pengaturan</th>
		<th>Nilai </th>
		<th>Aksi</th>
	</tr>
	</thead>
<tbody>
	<?php $no=1; foreach($data->result() as $data): ?>
 <tr>
 	<td><?= $no ?></td>
    <td><?= $data->parameter ?></td>
    <td> <?php if($data->parameter == "favicon"): ?>
    	<img src=" <?= base_url('assets/gambar/'.$data->nilai) ?>" class="image-responsive" style="width: 100px;height: 100px">
         <?php else: ?>
    	 <?= $data->nilai ?>
    	 <?php endif; ?>
    	</td>
    <td><a href="<?= base_url('admin/identitas/edit/'.$data->parameter) ?>" class="btn btn-info"><i class="fa fa-edit"></i>Edit</a>
        </td>
 </tr>
   <?php $no++; endforeach; ?>
</tbody>

</table>

<?php elseif($form == "edit"): 
?>

<?= $this->session->flashdata('pesan') ?>
<form action="" method="POST" enctype="multipart/form-data"> 
<table class="table table-striped">
		<tr><th>Parameter</th><td><input type="text" name="nama" class="form-control" value="<?= $data->row()->parameter ?>" disabled=""></td></tr>
		<tr><th>Nilai Setting</th><td> 

<?php if($id =='favicon'): ?>	
 <img src="<?= base_url('assets/gambar/'.cari('favicon')) ?>" class="image-responsive" style="width: 150px;height: 150px">

 <input type="file" name="nilai" class="form-control">

<?php elseif($id =='map_google'): ?>

	<textarea cols="100" rows="10" class="form-control" name="nilai" placeholder="Masukan Kode Map Google Anda.."><?= strip_tags($data->row()->nilai) ?></textarea>
<?php elseif($id =='telp'): ?>	
 <br /><i>**Silahkan Masukan No Telp Yang Valid</i><input type="number" name="nilai" class="form-control" placeholder="No telp...">

<?php else: ?>	
<textarea cols="100" rows="10" class="ckeditor form-control" name="nilai"><?= strip_tags($data->row()->nilai) ?></textarea>
 <?php endif; ?>


		</td></tr>

		<tr><td><button type="submit" class="btn btn-primary" name="kirim">
					<i class="glyphicon glyphicon-floppy-disk"></i> Simpan 
				</button>
				<a class="btn btn-warning" href="#">
					<i class="glyphicon glyphicon-arrow-left"></i> Batal 
				</a></td><td></td></tr>
		 
</table>
</form>

 


<?php

endif;
?>