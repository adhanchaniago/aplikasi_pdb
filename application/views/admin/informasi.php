<a href="<?= base_url('admin/informasi/add') ?>" class="btn btn-info"><i class="fa fa-plus"></i>Tambah Informasi</a>
 <hr />

<?= $this->session->flashdata('pesan') ?>
<table id="example1" class="table table-bordered table-striped">
    <thead>
	<tr>
		<th>No.</th>
		<th>Judul</th>
		<th>Gambar</th>
		<th>Admin Publis</th>
		<th>Tanggal</th>
	    <th>Aksi</th>
	</tr>
	  </thead>
	  <tbody>
<?php $no=1; foreach($info->result_array() as $data): ?>
<tr>
<td><?= $no ?></td>	
<td><?= $data['judul'] ?></td>
<td><image src="<?= base_url('./assets/gambar/'.$data['gambar']) ?>" class="image-responsive" style="width: 100px;height: 100px"></td>
<td><?= $data['nama']?></td>
<td><?= tgl_indonesia($data['tanggal']) ?></td>
<td><a href="<?= base_url('/admin/informasi/edit/'.$data['id_informasi']) ?>" class="btn btn-primary">Edit</a> &nbsp;&nbsp;
    
<?php if($this->session->userdata('level') == "admin"): ?>
    <a href="<?= base_url('admin/informasi/delete/'.$data['id_informasi']) ?>" class="btn btn-danger">Hapus</a>
<?php else: endif; ?>
</td>
</tr>
 
<?php $no++; endforeach; ?>
</tbody>
	</table>
 