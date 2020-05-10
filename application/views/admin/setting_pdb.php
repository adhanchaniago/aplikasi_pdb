
<?php if($action == 'form'): ?> 
	<form action="" method="POST">
		<table class="table table-striped">
			<tr><th>Aksi Aktivasi</th><td>
				<select class="form-control" name="keterangan">
					<option value="Y">Aktifkan </option>
					<option value="N">Non Aktifkan</option>
				</select></td></tr>

				<tr><th>Tanngal Mulai</th><td>
					<input type="date" name="t_mulai" class="form-control" value="<?= $t_mulai ?>"></td></tr>
					<tr><th>Tanggal selesai</th><td>
						<input type="date" name="t_selesai" class="form-control" value="<?= $t_selesai ?>"></td></tr>
 						<tr><th>Kuota Pendaftar</th><td><input type="text" name="kuota" class="form-control" placeholder="kuota pendaftar..." value="<?= $kuota ?>"></td></tr> 

 						<tr><th>Tahun Gelombang</th><td><input type="text" name="ta_akademik" class="form-control" placeholder="Tahun gelombang..." value="<?= $ta_akademik ?>"></td></tr> 

						<tr><td></td><td><button class="btn btn-primary" name="kirim"><i class="fa fa-save"></i>&nbsp;Simpan</button></td></tr>
					</table>
				</form> 
				<?php elseif($action =='view'):  ?> 
				<tt> . Hanya boleh ada 1 gelombang yang aktif</tt>
  <br /><br /> 
  <?= $this->session->flashdata('pesan'); ?>
    <a href="<?= base_url('admin/setting_app/add') ?>" class="btn btn-success"><i class="fa fa-plus"></i>Tambah </a>
				<hr />
				<table class="table table-striped" id='example1'>
					<thead> 
						<tr>
							<th>#</th>
							<th>Keterangan</th>
							<th>Tahun akademik</th>
							<th>Tgl Mulai PSB</th>
							<th>Tgl Akhir PSB</th>
							<th>Action</th>
						</tr>
						<tbody>
							<?php $no=1; foreach($this->db->get('rn_pdb')->result_array() as $tahun): ?>
							<tr><td><?= $no ?></td>
								<td><?= $ket=($tahun['keterangan'] == 'Y') ?  '<a href="" class="btn btn-primary"><i class="fa fa-check"></i>Aktif</a>' : '<a href="" class="btn btn-danger">Non Aktif</a>' ?></td>
								<td><?= $tahun['ta_akademik'] ?></td>
								<td><?= $tahun['tgl_mulai'] ?></td>
								<td><?= $tahun['tgl_selesai'] ?></td> 
								<td><a href="<?= base_url('admin/setting_app/edit/'.$tahun['id_gelombang']) ?>" class="btn btn-info">Edit</a>  
									<a href="<?= base_url('admin/setting_app/delete/'.$tahun['id_gelombang']) ?>" class="btn btn-danger">Hapus</a></td></tr>
									<?php $no++; endforeach ?>
								</tbody>
							</thead>

						</table>

					<?php endif; ?>

