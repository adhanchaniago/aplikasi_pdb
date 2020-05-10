<form action="" method="POST">
	<table class="table"> 
		<tr><th>Dari</th><td><input type="date" name="dari" class="form-control" required=""></td></tr>
		<tr><th>Sampai</th><td><input type="date" name="sampai" class="form-control" required=""></td></tr>

		<tr><th>Tahun Akademik (Periode) .</th><td><select name="tahun_akademik" class="form-control" required="">
			<?php foreach($this->db->get('rn_pdb')->result_array() as $data): ?>
			<option value="<?= $data['id_gelombang'] ?>"><?= $data['ta_akademik'] ?></option>
		<?php endforeach ?>
	</select></td></tr>
	<tr><td><input type="submit" name="kirim" class="btn btn-info"></td><td></td></tr>
</table>
</form>