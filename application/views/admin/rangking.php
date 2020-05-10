
<?php if($action == 'form'): ?> 
	<form action="" method="POST">

		<tr><th>Nama tes</th><td>
			<input type="text" name="nama_test" class="form-control" value="<?= $nama_test ?>"></td></tr>
			<tr><th>Standar ketuntasan</th><td><input type="text" name="kkm" class="form-control" placeholder="Standar ketuntasan..." value="<?= $kkm ?>"></td></tr> 
		    <tr><th>Tahun akademik</th><td><select name="t_akademik" class="form-control"><?php foreach($this->db->get('rn_pdb')->result_array() as $data): ?>
		   <option value="<?= $data['id_gelombang'] ?>"><?= $data['ta_akademik'] ?></option>
  		  <?php endforeach ?>
		    </select></td></tr> 

			<tr><td></td><td>
   <br />
				<button class="btn btn-primary" name="kirim"><i class="fa fa-save"></i>&nbsp;Simpan</button></td></tr>
		</table>
	</form> 
				<?php elseif($action =='view'):  ?> 
				 
  <br /><br />
  <?= $this->session->flashdata('pesan') ?>
				<a href="<?= base_url('admin/rank/add') ?>" class="btn btn-success"><i class="fa fa-plus"></i>Tambah </a>
				<hr />
				<table class="table table-striped" id='example1'>
					<thead> 
						<tr>
							<th>#</th>
							<th>Nama Test</th>
							<th>KKM</th>
							<th>Gelombang</th>
						 	<th>Action</th>
						</tr>
						<tbody>
							<?php $no=1; foreach($this->madmin->calonsiswa()->result_array() as $tahun): ?>
							<tr><td><?= $no ?></td>
								<td><?= $tahun['nama_test'] ?></td> 
								<td><?= $tahun['kkm'] ?></td> 
								<td><?= $tahun['ta_akademik'] ?></td> 
								<td><a href="<?= base_url('admin/rank/edit/'.$tahun['id_test']) ?>" class="btn btn-info">Edit</a>  
									<a href="<?= base_url('admin/rank/delete/'.$tahun['id_test']) ?>" class="btn btn-danger">Hapus</a></td></tr>
									<?php $no++; endforeach ?>
								</tbody>
							</thead>

						</table>

					<?php endif; ?>

