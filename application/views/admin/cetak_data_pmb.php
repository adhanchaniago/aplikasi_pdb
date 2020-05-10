<style>
  .cstable td {
    border: 0.6px solid black;
    text-align: left
  }

  .cstable th {
    border: 0.1px solid black;
  }

  .cstable {
    border-collapse: collapse;
    width: 100%;
  }
</style>


<?php $dat = $data->row_array();
?>
<table>
  <tr>
    <td>
      <img src="<?= base_url('/assets/admin/dist/img/proc.png') ?>" class="img-responsive" style="width: 100px ;height: 100px">
    </td>
    <td>
      <h4>PANITIA PENERIMAAN PESERTA DIDIK BARU TAHUN AKADEMIK <?= tahun_akademik('ta_akademik') ?></h4>
      <h4><?= strip_tags(cari('nama')) ?></h4>
      <i><?= strip_tags(cari('jalan')) ?> | Telp .<?= strip_tags(cari('telp')) ?></i>
      <hr />
    </td>
  </tr>
</table>
<br />
<?php
$jk = ($dat['jk'] == "L") ? "Laki" : "Perempuan";
$cek = isset($dat['konfirmasi']) ? $dat['konfirmasi'] : '';
if ($cek == "P") {
  $keterangan = "<button class='btn btn-info'>Pending</button>";
} elseif ($cek == "N") {
  $keterangan = "<button class='btn btn-danger'>Tidak Lulus</button>";
} elseif ($cek == "Y") {
  $keterangan = "<button class='btn btn-success'>Lulus</button>";
} else {
  $keterangan = "<p>Belum Di Konfirmasi Silahkan Menunggu Hasil Keputusan Dari Panitia Penerimaan siswa baru " . cari('nama') . ' <br />Selama 1x24 Jam , Atau Silahkan Cek pada link berikut <a href="' . base_url('cek-lulus.jsp') . '">cek pendaftaran</a>, apabila no pendaftaran anda telah di konfirmasi ,<br /> apabila username anda dan password tanggal dan tahun lahir yang di daftar kan sebelumnya dengan format yyyy-mm-dd<p>';
}
?>
<br />
<br />
<br />
<center>
  <?= $keterangan ?>
</center>
<br />
<hr />

<table class="cstable" width="50%">
  <tr>
    <td>Nomor Pendaftaran</td>
    <td><b><?= $dat['no_pendaftaran'] ?></b></td>
  </tr>
  <tr>
    <td>Nama pendaftar</td>
    <td><?= $dat['nama_pendaftar'] ?></td>
  </tr>
  <tr>
    <td>Jenis Kelamin</td>
    <td><?= $jk ?></td>
  </tr>

  <tr>
    <td>Tempat lahir</td>
    <td><?= $dat['tempat_lahir'] ?></td>
  </tr>
  <tr>
    <td>Tanggal lahir</td>
    <td><?= $dat['tanggal_lahir'] ?></td>
  </tr>
  <tr>
    <td>Agama</td>
    <td><?= $dat['agama'] ?></td>
  </tr>
  <tr>
    <td>RT</td>
    <td><?= $dat['rt'] ?></td>
  </tr>
  <tr>
    <td>RW</td>
    <td><?= $dat['rw'] ?></td>
  </tr>
  <tr>
    <td>Desa Kelurahan</td>
    <td><?= $dat['desa_kelurahan'] ?></td>
  </tr>
  <tr>
    <td>Kecamatan</td>
    <td><?= $dat['kecamatan'] ?></td>
  </tr>
  <tr>
    <td>Kabupaten</td>
    <td><?= $dat['kabupaten'] ?></td>
  </tr>
  <tr>
    <td>Provinsi</td>
    <td><?= $dat['provinsi'] ?></td>
  </tr>
  <tr>
    <td>Kode Pos</td>
    <td><?= $dat['kode_pos'] ?></td>
  </tr>
  <tr>
    <td>Tinggi Badan</td>
    <td><?= $dat['tinggi_badan'] ?></td>
  </tr>
  <tr>
    <td>Berat Badan</td>
    <td><?= $dat['berat_badan'] ?></td>
  </tr>
  <tr>
    <td>No Telepon</td>
    <td><?= $dat['no_telepon'] ?></td>
  </tr>
  <tr>
    <td>Kendaraan Transportasi</td>
    <td><?= $dat['alat_transportasi'] ?></td>
  </tr>
  <tr>
    <td>Prestasi</td>
    <td><?= $dat['prestasi'] ?></td>
  </tr>
  <tr>
    <td colspan="2">
      <center><tt><br />Data Nilai Raport sekolah</tt>
      </center>
    </td>
  </tr>
  <?php $no = 1;
  foreach ($data->result() as $nil) : ?>
    <tr>
      <td><b><?= $no . '.' .
                ucfirst($nil->mapel_uji) ?></b></td>
      <td>
        <?= ucfirst(strtolower($nil->mapel_uji)) . '/' . $nil->nilai ?>
      </td>
    </tr>
  <?php $no++;
  endforeach; ?>
</table>

<table class="cstable">
  <tr>
    <td colspan="2">
      <div class="callout callout-success"><tt>Data Orang Tua /Wali</tt></div>
    </td>
  </tr>
  <tr>
    <td>Nama Ayah</td>
    <td><?= $dat['nama_ayah'] ?></td>
  </tr>
  <tr>
    <td>Tahun Lahir Ayah</td>
    <td><?= $dat['tahun_lahir_ayah'] ?></td>
  </tr>
  <tr>
    <td>Pekerjaan Ayah</td>
    <td><?= $dat['pekerjaan_ayah'] ?></td>
  </tr>
  <tr>
    <td>Pendidikan Ayah</td>
    <td><?= $dat['pendidikan_ayah'] ?></td>
  </tr>
  <tr>
    <td>Penghasilan Ayah</td>
    <td><?= $dat['penghasilan_ayah'] ?></td>
  </tr>
  <tr>
    <td>Nama Ibu</td>
    <td><?= $dat['nama_ibu'] ?></td>
  </tr>
  <tr>
    <td>Tahun Lahir Ibu</td>
    <td><?= $dat['tahun_lahir_ibu'] ?></td>
  </tr>
  <tr>
    <td>Pekerjaan Ibu</td>
    <td><?= $dat['pekerjaan_ibu'] ?></td>
  </tr>
  <tr>
    <td>Pendidikan Ibu</td>
    <td><?= $dat['pendidikan_ibu'] ?></td>
  </tr>
  <tr>
    <td>Penghasilan Ibu</td>
    <td><?= $dat['penghasilan_ibu'] ?></td>
  </tr>
  <tr>
    <td>Jenis Tinggal</td>
    <td>
      <?php
      $jenis_tinggal = isset($dat['jenis_tinggal']) ? $dat['jenis_tinggal'] : "";
      if ($jenis_tinggal == "1") {
        echo "Bayar Sewa / Kos";
      } elseif ($jenis_tinggal == "2") {
        echo "Rumah Sendiri";
      } elseif ($jenis_tinggal == "3") {
        echo "Mengontrak";
      } else {
        echo "Maaf Data Tidak Terverifikasi";
      }
      ?>

    </td>
  </tr>
  <tr>
    <td colspan="2">
      <div class="callout callout-success">** Jika Data Orang Tua Ibu/Ayah Kosong Silahkan Isikan Data Orang Tua Pada
        Wali .</div>
    </td>
  </tr>
  <tr>
    <td>Nama Wali</td>
    <td><?= $dat['nama_wali'] ?></td>
  </tr>
  <tr>
    <td>Tahun Lahir Wali</td>
    <td><?= $dat['tahun_lahir_wali'] ?></td>
  </tr>
  <tr>
    <td>Pekerjaan Wali</td>
    <td><?= $dat['pekerjaan_wali'] ?></td>
  </tr>
  <tr>
    <td>Pendidikan Wali</td>
    <td><?= $dat['pendidikan_wali'] ?></td>
  </tr>
  <tr>
    <td>Penghasilan Wali</td>
    <td><?= $dat['penghasilan_wali'] ?></td>
  </tr>


</table>



* ) <br /> Jika data sudah di konfirmasi panitia atau sama dengan lulus silahkan login menggukan no pendaftaran dan password tanggal lahir dengan format tahun-bulan-tanggal unuk login cetak kartu ujian