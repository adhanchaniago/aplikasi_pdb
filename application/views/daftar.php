<?= strip_tags(tahun_akademik('id_gelombang')) ?>

<style type="text/css">
	.daftar_con {
		margin: 0px 40px 0px;
		background: transparent;
	}

	table,
	td>a {
		color: #000;
		font-size: 18px
	}
</style>

<br />
<section class="home" style="color: #fff">
	<center>
		<br />
		<img src="<?= base_url('/assets/admin/dist/img/proc.png') ?>" class="img-responsive" style="width: 100px;height: 100px">
		<br /><br />
		<h3><b>PANITIA PENERIMAAN PESERTA DIDIK BARU
			</b></h3>
		<h4 style="font-family: times new roman"><?= cari('nama') ?></h4>
		<i><b><?= strip_tags(cari('jalan')) ?></b> | <b>Telp .<?= strip_tags(cari('telp')) ?></b></i>
		<hr />
	</center>
</section>

<section class="content">
	<div class="box box-info">
		<?php if ($tutup == "Y") : ?>


			<div class="box-header with-border">
				<center>
					<h3 class="box-title">Form Pendaftaran</h3>
				</center>
			</div>
			<!-- /.box-header -->
			<!-- form start -->
			<form action="<?= base_url('home/pendaftaran_action') ?>" id="simpan" method="POST" enctype="multipart/form-data" class="form-horizontal">
				<div class="box-body">
					<div class="col-md-6">
						<center>
							<div class="callout callout-warning">Data Calon Siswa</div>
						</center>
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-4 control-label">Nomor Pendaftaran</label>
							<div class="col-sm-8">
								<input type="hidden" name="no_pendaftaran" value="<?= $no_pendaftaran ?>">
								<input type="text" value="<?= $no_pendaftaran ?>" class="form-control" required="" disabled=""></td>

							</div>
						</div>
						<div class="form-group">
							<label for="inputPassword3" class="col-sm-4 control-label"> <b>Nama pendaftar</b> <small><br />** Bidang Wajib</small>
							</label>
							<div class="col-sm-8">
								<input type="text" name="nama_pendaftar" class="form-control" required="">
							</div>
						</div>
						<div class="form-group">
							<label for="inputPassword3" class="col-sm-4 control-label">Jenis Kelamin</label>

							<div class="col-sm-8">
								<select name="jk" class="form-control">
									<option value="L">Laki - Laki</option>
									<option value="P">Perempuan</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label for="inputPassword3" class="col-sm-4 control-label">Tinggi Badan</label>
							<div class="col-sm-8">
								<input type="text" name="tinggi_badan" class="form-control" required="">
							</div>
						</div>
						<div class="form-group">
							<label for="inputPassword3" class="col-sm-4 control-label">Berat Badan</label>
							<div class="col-sm-8">
								<input type="text" name="berat_badan" class="form-control" required="">
							</div>
						</div>


						<div class="form-group">
							<label for="inputPassword3" class="col-sm-4 control-label">Tempat Lahir</label>
							<div class="col-sm-8">
								<input type="text" name="tempat_lahir" class="form-control" required="">
							</div>
						</div>

						<div class="form-group">
							<label for="inputPassword3" class="col-sm-4 control-label">Tanggal Lahir</label>

							<div class="col-sm-8">
								<input type="date" name="tanggal_lahir" class="form-control" required="">
							</div>
						</div>

						<div class="form-group">
							<label for="inputPassword3" class="col-sm-4 control-label">Agama</label>

							<div class="col-sm-8">
								<select name="agama" class="form-control">
									<option value="Islam">Islam</option>
									<option value="Kristen">Kristen Protestan</option>
									<option value="Kristen">Kristen Katolik</option>
									<option value="Hindu">Hindu</option>
									<option value="Budha">Budha</option>
									<option value="Konghucu">Konghucu</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label for="inputPassword3" class="col-sm-4 control-label">RT</label>

							<div class="col-sm-8">
								<input type="text" name="rt" class="form-control" required="">
							</div>
						</div>

						<div class="form-group">
							<label for="inputPassword3" class="col-sm-4 control-label">RW</label>
							<div class="col-sm-8">
								<input type="text" name="rw" class="form-control" required="">
							</div>
						</div>

						<div class="form-group">
							<label for="inputPassword3" class="col-sm-4 control-label">Desa / Kelurahan</label>
							<div class="col-sm-8">
								<input type="text" name="desa_kelurahan" class="form-control" required="">
							</div>
						</div>
						<div class="form-group">
							<label for="inputPassword3" class="col-sm-4 control-label">Kecamatan</label>
							<div class="col-sm-8">
								<input type="text" name="kecamatan" class="form-control" required="">
							</div>
						</div>
						<div class="form-group">
							<label for="inputPassword3" class="col-sm-4 control-label">Kabupaten</label>
							<div class="col-sm-8">
								<input type="text" name="kabupaten" class="form-control" required="">
							</div>
						</div>
						<div class="form-group">
							<label for="inputPassword3" class="col-sm-4 control-label">Provinsi</label>
							<div class="col-sm-8">
								<input type="text" name="provinsi" class="form-control" required="">

							</div>
						</div>
						<div class="form-group">
							<label for="inputPassword3" class="col-sm-4 control-label">Kode Pos</label>
							<div class="col-sm-8">
								<input type="text" name="kode_pos" class="form-control" required="">
							</div>
						</div>
						<div class="form-group">
							<label for="inputPassword3" class="col-sm-4 control-label">Nomor Telepon</label>
							<div class="col-sm-8">
								<input type="text" name="no_telepon" class="form-control" required="">
							</div>
						</div>
						<div class="form-group">
							<label for="inputPassword3" class="col-sm-4 control-label">Transportasi Ke Sekolah.</label>
							<div class="col-sm-8">
								<input type="text" name="alat_transportasi" class="form-control" required="">

							</div>
						</div>
						<div class="form-group">
							<label for="inputPassword3" class="col-sm-4 control-label">Prestasi </label>
							<div class="col-sm-8">
								<input type="text" name="prestasi" class="form-control" required="">
							</div>
						</div>
						<div class="form-group">
							<label for="inputPassword3" class="col-sm-4 control-label">Jurusan yang di pilih</label>
							<div class="col-sm-8">
								<select class="form-control" name="id_jurusan">
									<?php foreach ($this->db->get('rn_jurusan')->result_array() as $dt) : ?>
										<option value="<?= $dt['id_jurusan'] ?>"><?= ucfirst($dt['nama_jurusan']) ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>


						<div class="form-group">
							<label for="inputPassword3" class="col-sm-4 control-label">
								<center><tt><br />Data Nilai Raport sekolah</tt>
								</center>
							</label>
							<div class="col-sm-8">

								<?php $no = 1;
								foreach ($nilai_rapor->result() as $nil) : ?>

									<b><?= $no . '.' .
											ucfirst($nil->mapel_uji) ?></b>

									<input type="text" name="<?= str_replace(' ', '_', strtolower($nil->mapel_uji)) ?>" class="form-control">


								<?php $no++;
								endforeach; ?>
							</div>
						</div>

					</div>

					<div class="col-md-6">
						<center>
							<div class="callout callout-info">Data Orang Tua Calon Siswa</div>
						</center>
						<div class="form-group">
							<label for="inputPassword3" class="col-sm-4 control-label">Nama Ayah</label>
							<div class="col-sm-8">
								<input type="text" name="nama_ayah" class="form-control" required="">
							</div>
						</div>

						<div class="form-group">
							<label for="inputPassword3" class="col-sm-4 control-label">Tahun lahir ayah</label>
							<div class="col-sm-8">
								<input type="date" name="tahun_lahir_ayah" class="form-control" required="">
							</div>
						</div>

						<div class="form-group">
							<label for="inputPassword3" class="col-sm-4 control-label">Pekerjaan ayah</label>
							<div class="col-sm-8">
								<input type="text" name="pekerjaan_ayah" class="form-control" required="">
							</div>
						</div>

						<div class="form-group">
							<label for="inputPassword3" class="col-sm-4 control-label">Tahun Lahir Ibu</label>
							<div class="col-sm-8">
								<input type="date" name="tahun_lahir_ibu" class="form-control" required="">
							</div>
						</div>

						<div class="form-group">
							<label for="inputPassword3" class="col-sm-4 control-label">Pendidikan ayah</label>
							<div class="col-sm-8">
								<input type="text" name="pendidikan_ayah" class="form-control" required="">
							</div>
						</div>

						<div class="form-group">
							<label for="inputPassword3" class="col-sm-4 control-label">Penghasilan ayah (Dalam / Bulan )</label>
							<div class="col-sm-8">
								<input type="text" name="penghasilan_ayah" class="form-control" required="">
							</div>
						</div>


						<div class="form-group">
							<label for="inputPassword3" class="col-sm-4 control-label">Penghasilan ayah (Dalam / Bulan )</label>
							<div class="col-sm-8">
								<input type="text" name="penghasilan_ayah" class="form-control" required="">
							</div>
						</div>


						<div class="form-group">
							<label for="inputPassword3" class="col-sm-4 control-label">Nama Ibu</label>
							<div class="col-sm-8">
								<input type="text" name="nama_ibu" class="form-control" required="">
							</div>
						</div>


						<div class="form-group">
							<label for="inputPassword3" class="col-sm-4 control-label">Pekerjaan Ibu</label>
							<div class="col-sm-8">
								<input type="text" name="pekerjaan_ibu" class="form-control" required="">
							</div>
						</div>


						<div class="form-group">
							<label for="inputPassword3" class="col-sm-4 control-label">Pendidikan Ibu</label>
							<div class="col-sm-8">
								<input type="text" name="pendidikan_ibu" class="form-control" required="">
							</div>
						</div>


						<div class="form-group">
							<label for="inputPassword3" class="col-sm-4 control-label">Penghasilann ibu (dalam bulan bulan) <small>** Jika tidak ada di kosongkan saja</small> </label>
							<div class="col-sm-8">
								<input type="text" name="penghasilan_ibu" class="form-control" required="">
							</div>
						</div>



						<div class="form-group">
							<label for="inputPassword3" class="col-sm-4 control-label">Jenis Tinggal</label>
							<div class="col-sm-8">
								<input type="radio" name="jenis_tinggal" value="3">A.Mengontrak
								&nbsp;&nbsp;&nbsp;
								<input type="radio" name="jenis_tinggal" value="2">B.Rumah Sendiri
								&nbsp;&nbsp;&nbsp;
								<input type="radio" name="jenis_tinggal" value="1">C.Bayar Sewa

							</div>
						</div>

						<center>
							<div class="callout callout-warning">Data Wali</div>
						</center>

						<div class="form-group">
							<label for="inputPassword3" class="col-sm-4 control-label">Nama wali</label>
							<div class="col-sm-8">
								<input type="text" name="nama_wali" class="form-control" required="">
							</div>
						</div>
						<div class="form-group">
							<label for="inputPassword3" class="col-sm-4 control-label">Tahun Lahir Wali</label>
							<div class="col-sm-8">
								<input type="text" name="tahun_lahir_wali" class="form-control" required="">
							</div>
						</div>

						<div class="form-group">
							<label for="inputPassword3" class="col-sm-4 control-label">Pekerjaan wali</label>
							<div class="col-sm-8">
								<input type="text" name="pekerjaan_wali" class="form-control" required="">
							</div>
						</div>

						<div class="form-group">
							<label for="inputPassword3" class="col-sm-4 control-label">Pendidikan Wali</label>
							<div class="col-sm-8">
								<input type="text" name="pendidikan_wali" class="form-control" required="">
							</div>
						</div>

						<div class="form-group">
							<label for="inputPassword3" class="col-sm-4 control-label">Penghasilan Wali</label>
							<div class="col-sm-8">
								<input type="text" name="penghasilan_wali" class="form-control" required="">
							</div>
						</div>




					</div>
				</div>
				<!-- md 6 -->

				<!-- /.box-body -->
				<div class="box-footer">
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-8">
							<div class="checkbox">
								<label>
									<input type="checkbox"> Data saya sudah benar dan valid, dengan ini menyatakan mendaftar sebagai calon siswa baru <?= strip_tags(cari('nama')) ?>
								</label>
							</div>
						</div>
					</div>
					<center>
						<button type="reset" class="btn btn-default">Cancel</button>
						<button type="submit" id="simpan" class="btn btn-info"><i class="fa fa-user"></i>Daftar Siswa Baru</button>
					</center>
				</div>
				<!-- /.box-footer -->
			</form>
		<?php elseif ($tutup == "N") : ?>

			<div class="alert alert-danger">
				<h4><i class="fa fa-info"></i> MAAF PENDAFTARAN <?= strip_tags(cari('nama')); ?> TAHUN AKADEMIK <?= $sekarang ?>-
					<?= ++$sampai ?> TELAH BERAKHIR <br /><br />
					ATAU SILAHKAN DATANG LANGSUNG ALAMAT SEKOLAH DI <?= strip_tags(cari('jalan')); ?> NO. TELP : <?= strip_tags(cari('jalan')); ?><i>UNTUK INFORMASI LEBIH LANJUT</i></h4>
			</div>

		<?php endif; ?>
	</div>

</section>

<script>
	$(function() {
		$('#simpan').on('submit', function(e) {
			e.preventDefault();
			var formData = $(this).serialize();
			$.ajax({
				type: 'post',
				url: $(this).attr('action'),
				data: formData,
				mimeType: "multipart/form-data",
				dataType: "json",
				success: function(data) {
					if (data.status == 1) {
						swal('success', 'Pendaftaran berhasil harap tunggu sebentar sedang mengalihkan', 'success');
						$('#simpan').button('reset');;
						window.location.href = '<?= site_url('detail_p.jsp') ?>/' + data.no_daftar + '/' + data.md;
					} else {
						swal('kesalahan', data.msg, 'error');
					}
				},
				error: function(xhr, error, status) {
					swal('kesalahan', 'server sedang tidak bisa merespon harap tunggu beberapa saat lagi', 'error');
				}
			});
		});
	});
</script>