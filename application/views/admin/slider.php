<?php if($form == "n"): ?>
<a href="<?= base_url('admin/slider_bg/add') ?>" class="btn btn-warning"><i class="fa fa-plus"></i>Tambah Slide Tampilan.</a>
<br /><br /><br />
<?= $this->session->flashdata('pesan') ?>

<table id="example1" class="table table-bordered table-striped">
    <thead>
	<tr>
		<th>No.</th>
		<th>Gambar</th>
		<th>Tanggal Upload</th>
		<th>Operator</th>
	    <th>Aksi</th>
	</tr>
	  </thead>
	  <tbody>
	  <?php $no=1; foreach($data->result_array() as $sql):
            $nama=$this->db->get_where('rn_admin',array('id_admin'=>$sql['id_admin']));
            $nama_admin=$nama->row()->nama ? $nama->row()->nama : "No Operator Found";
	        ?>
     <tr>
     	<td><?= $no ?></td>
     	<td>
     	<button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default<?= $no ?>">Lihat Detail Gambar</button>
       </td>
       <td><?= tgl_indonesia($sql['tanggal']); ?></td>
       <td><?= strip_tags($nama_admin); ?></td>
       <td><a href="<?= base_url('admin/slider_bg/edit/'.$sql['id_slider']) ?>" class="btn btn-success"><i class="fa fa-edit"></i>Edit Data</a>
           <a href="<?= base_url('admin/slider_bg/delete/'.$sql['id_slider']) ?>" class="btn btn-info"><i class="fa fa-edit"></i>Hapus</a></td>
     </tr>
 
      <?php $no++; endforeach; ?>
	  </tbody>
	</table>
 
 <?php $no=1; foreach($data->result() as $slid):  ?>
<div class="modal modal-default fade" id="modal-default<?= $no ?>">
          <div class="modal-dialog" style="width: 100%">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title"><?= $slid->keterangan ?></h4>
              </div>
              <div class="modal-body">
                <img src="<?= base_url('assets/gambar/'.$slid->gambar) ?>" class="image-responsive" style="width: 80%;height: 400px">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-outline"></button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
 <?php $no++; endforeach; ?>

<?php elseif($form == "y"): ?>

<?= $this->session->flashdata('pesan') ?>
<form action="" method="POST" enctype="multipart/form-data">
	<table class="table table-striped">
		<tr><td>File Gambar</td><td><?php 
if ($aksi == "edit") {
 echo '<img src="'.base_url('assets/gambar/'.$gambar).'" class="img-responsive" style="width:400px;height:200px">';
}else{
 
}
?>
<br />
<input type="file" name="gambar" class="form-control" required="">
</td></tr>
<tr><td>Nama Keterangan Gambar</td><td><input type="text" name="keterangan" value="<?= $keterangan ?>" class="form-control"></td></tr>
<tr><td></td><td><input type="submit" value="<?= ucfirst($aksi) ?> Slide" name="kirim" class="btn btn-info"></td></tr>
</table>
</form>
<?php endif; ?>
