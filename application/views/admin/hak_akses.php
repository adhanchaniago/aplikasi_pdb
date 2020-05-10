<?php if($form != "y"){ ?>

<a href="<?= base_url('admin/hak_akses/add') ?>" class="btn btn-primary">Tambah Hak Akses</a>
<br /><br /><br />

<?= $this->session->flashdata('pesan') ?>
<div class="callout callout-info">Hapus Dan Edit Hak akses Tidak tersedia Versi demo </div>

<table id="example1" class="table table-bordered table-striped">
    <thead>
	<tr>
		<th>No.</th>
		<th>Username</th>
		<th>Nama</th>
		<th>Level</th>
		<th>Log Akses</th>
	    <th>Aksi</th>
	</tr>
	  </thead>
	  <tbody>
<?php $no=1; foreach($data->result_array() as $sql): ?>
<tr>
<td><?= $no ?></td>	
<td><?= $sql['username'] ?></td>
<td><?= $sql['nama']?></td>
<td><?= $sql['level']?></td>
<td><?= $sql['log']?></td>
<td>
   <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal<?= $no ?>">
                <i class="fa fa-eye"></i>Detail
              </button>
</tr>
</tbody>
<?php $no++; endforeach; ?>

	</table>
 
 <?php $no=1; foreach($data->result_array() as $data):
  
  ?>
<div class="modal fade" id="myModal<?= $no ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" style="width: 80%">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h3 class="modal-title" id="myModalLabel"><div class="callout callout-info"><i class="fa fa-database"></i>  Detail Data Pegawai Dan Hak Akses</div></h3>
                        <br />
                        
                    </div>
                    <div class="modal-body">

 
<table class="table table-striped">
        <tr><td>Username</td><td><?= $data['username'] ?></td></tr>
        <tr><td>Nama</td><td><?= $data['nama'] ?></td></tr>
        <tr><td>Foto</td><td>
<img src="<?= base_url('/assets/foto_admin/'.$data['foto']) ?>" class="img-responsive" style="width: 100px;height: 150px">
            </td></tr>
	<tr><td>Level Akses</td><td><?= $data['level'] ?></td></tr>

</table>
    </div>
                 <div class="modal-footer">
                 	 <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><i class="fa fa-share"></i>Tutup Dialog </button>
                 </div>
             </div>
         </div>
     </div>

 <?php $no++; endforeach; ?>

<?php }elseif($form =="y"){ 
echo $this->session->flashdata('pesan');

buka_form();
buat_text_box('Username','','username',$username);
buat_text_box('Nama','','nama',$nama);
buat_text_box('Password','password','password','');

if ($this->uri->segment(3)) {
    echo "<img src='".base_url('/assets/file/'.$gambar)."' class='image-responsive' style='width:120px; height:120px'>";
}
?>

<tr><th>Email</th><td><input type="email" name="email" placeholder="emaill .. " class="form-control" required></td></tr>
<tr><th>Level Hak Akses </th><td><select name="level" class="form-control" required>
    <option value="operator">Operator PMB</option>
    <option value="admin">Administrator</option></select></td></tr>

<?php
buat_text_box('Foto','file','foto','');
tutup_form($aksi);

}    ?>


