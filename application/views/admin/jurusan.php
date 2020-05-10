<?php if($form == 'y'): ?> 
<form action="" method="POST">  
	<table class="table table-striped">
		<tr><td>Nama Jurusan</td><td><input type="text" name="nama_jurusan" value="<?= $nama_jurusan ?>" class="form-control"></td></tr><tr><td>Kode Jurusan</td><td><input type="text" name="kode_jurusan" value="<?= $kode_jurusan ?>" class="form-control"></td></tr>
		<tr><td><input type="submit" name="kirim" value="Simpan Data" class="btn btn-success">

			<a href="<?= base_url('admin/jurusan') ?>" class="btn btn-success"><i class="fa fa-edit"></i>Kembali</a></td></tr>
	</table>
</form>

<?php elseif($form == 'n'): ?>
<a href="<?= base_url('admin/jurusan/add') ?>" class="btn btn-success"><i class="fa fa-plus"></i> Tambah</a>
<table id="example1" class="table table-bordered table-striped">
 
	<thead>
		<tr>
		<td>#</td>
		<td>Nama Jurusan</td>
		<td>Kode Jurusan</td>
		<td>Aksi</td>
	</tr>
	</thead>
 
<tbody> 
<?php $no=1; foreach($data->result_array() as $xd):  ?>
  
  <tr><td><?= $no ?></td>
  <td><?= $xd['nama_jurusan'] ?></td>
<td><?= $xd['kode_jurusan'] ?></td> 
<td><a href="<?= base_url('admin/jurusan/edit/'.$xd['id_jurusan']) ?>" class="btn btn-success"><i class="fa fa-edit"></i></a> <a href="<?= base_url('admin/jurusan/delete/'.$xd['id_jurusan']) ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a></td></tr>
</tbody>
<?php  $no++; endforeach ?>
</table>

<?php endif; ?>