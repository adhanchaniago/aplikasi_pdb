<div style="overflow: auto;">
  <?php error_reporting(0) ?>
  <script type="text/javascript">
    $(function() {
      $('.verifikasi').click(function() {
        var ket = $('#ket').val();
        var url = $('#id_pendaftaran').val();

        $.ajax({
          url: "<?= base_url('admin/pendaftar/verfikasi') ?>",
          type: "POST",
          data: "ket=" + ket + "&url=" + url,
          chace: false,
          success: function(html) {
            window.location = '<?= base_url('admin/pendaftar') ?>';
          },
          error: function(html) {
            alert('gagal')
          },

        })
      })

    })

    function rapor_scan(id) {
      window.open("<?= base_url('assets/raport/') ?>/" + id, "Cetak Kartu Ujian", "height=650, width=1024, left=150, scrollbars=yes");
      return false;
    }

    function ijazah_scan(id) {
      window.open("<?= base_url('assets/ijazah/') ?>/" + id, "Cetak Kartu Ujian", "height=650, width=1024, left=150, scrollbars=yes");
      return false;
    }


    function kk_scan(id) {
      window.open("<?= base_url('assets/kk/') ?>/" + id, "Cetak Kartu Ujian", "height=650, width=1024, left=150, scrollbars=yes");
      return false;
    }

    function akta_scan(id) {
      window.open("<?= base_url('assets/akta/') ?>/" + id, "Cetak Kartu Ujian", "height=650, width=1024, left=150, scrollbars=yes");
      return false;
    }
  </script>


  <div class="callout callout-warning">
    Jumlah Data Peserta Pendaftar pada tahun akademik <?= tahun_akademik('ta_akademik') ?>
    <br />
    * ) pada tahun akademik diatas yang benar benar aktif adalah satu.
    <br />

    Untuk penentuan kelulusan silahkan isi dahulu hasil nilai seleksi.
  </div>

  <?= $this->session->flashdata('pesan');
  $jur = isset($_GET['jur']) ? $_GET['jur'] : '';
  ?>
  <a href="<?= site_url('admin/export/word?jur=' . $jur) ?>" class="btn btn-info" target="_blank"><i class="fa fa-list"></i>Eksport Word</a>
  <a href="<?= site_url('admin/export/xls?jur=' . $jur) ?>" class="btn btn-primary" target="_blank"><i class="fa fa-list"></i>Eksport Exel</a>

  <table class="table">
    <tr>
      <td>Filter Jurusan</td>
      <td><select class="form-control" id="id_jurusan" name="id_jurusan">

          <option value="">Semua jurusan</option>
          <?php
          $jur = isset($_GET['jur']) ? $_GET['jur'] : '';
          foreach ($this->db->get('rn_jurusan')->result_array() as $dt) : ?>
            <option value="<?= $dt['id_jurusan']  ?>" <?= ($jur == $dt['id_jurusan']) ? 'selected' : '';  ?>><?= ucfirst($dt['nama_jurusan']) ?></option>
          <?php endforeach; ?>
        </select>
      <td>
    </tr>

  </table>
  <table id="example1" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>No.</th>
        <th>No Pendaftaran</th>
        <th>Nama Pendaftar</th>
        <th>Jenis Kelamin</th>
        <th>NIK</th>
        <th>Tempat lahir</th>
        <th>Tanggal lahir</th>
        <th>Tanggal Daftar</th>
        <th>Agama</th>
        <th>Keterangan</th>
        <th>Aksi</th>
        <th>Detail</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1;
      foreach ($data->result_array() as $dat) :
        $qw = $this->db->get_where('rank', array('id_siswa' => $dat['id_pendaftaran']))->row_array();
        $jk = ($dat['jk'] == "L") ? "Laki" : "Perempuan";
        $cek = ($dat['konfirmasi']) ? $dat['konfirmasi'] : '';
        if ($cek == "P") {
          $keterangan = "<button class='btn btn-info'>Pending</button>";
        } elseif ($cek == "N") {
          $keterangan = "<button class='btn btn-danger'>Di Tolak</button>";
        } elseif ($cek == "Y") {
          $keterangan = "<button class='btn btn-success'>Di Terima</button>";
        } else {
          $keterangan = "<button class='btn btn-warning'>Belum Di Konfirmasi</button>";
        }
      ?>
        <tr>
          <td><?= $no ?></td>
          <td><?= $dat['no_pendaftaran'] ?></td>
          <td><?= $dat['nama_pendaftar'] ?></td>
          <td><?= $jk ?></td>
          <td><?= $dat['nik'] ?></td>
          <td><?= $dat['tempat_lahir'] ?></td>
          <td><?= $dat['tanggal_lahir'] ?></td>
          <td><?= $dat['tanggal'] ?></td>
          <td><?= $dat['agama'] ?></td>
          <td>

            <?= $keterangan  ?>

          </td>
          <td>
            <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#rangking<?= $no ?>">
              Isi Rangking
            </button>
            <?php if ($this->session->userdata('level') == "admin") : ?>
              <a href="<?= base_url('admin/pendaftar/delete/' . $dat['id_pendaftaran']) ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash">
                <?php else : endif; ?>
                </i></a></td>
          <td>
            <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#x-edit<?= $no ?>">
              <i class="fa fa-edit"></i>
            </button>
            <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#modal-default<?= $no ?>">
              Detail Informasi
            </button>
          </td>
        </tr>
      <?php $no++;
      endforeach; ?>
    </tbody>
    <!-- <thead>
   <tr>
    <th>No.</th>
    <th>No Pendaftaran</th>
    <th>Nama Pendaftar</th>
    <th>Jenis Kelamin</th>
    <th>NIK</th>
    <th>Tempat lahir</th>
    <th>Tanggal lahir</th>
    <th>Agama</th>
    <th>Aksi</th>
  </tr>
</thead> -->
  </table>



  <?php

  $no = 1;
  foreach ($data->result_array() as $dat) :
    $rangking = $this->madmin->rangking($dat['id_pendaftaran']);
    $hasil_rk =  ksort($rangking);



    $jk = ($dat['jk'] == "L") ? "Laki" : "Perempuan";
  ?>

    <!-- modal buat  tank -->

    <div class="modal fade" id="rangking<?= $no ?>">
      <div class="modal-dialog" style="width: 100%">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Isi hasil test</h4>
            <div style="float: right;">
              <!-- tomobol pemeriksaan data -->
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
              &nbsp;

            </div>
          </div>
          <div class="modal-body">
            <div class="container">
              <div class="row">

                <form action="<?= base_url('Hasil_test') ?>" method="POST">
                  <input type="hidden" name="id_pendaftaran" value="<?= $dat['id_pendaftaran'] ?>">
                  <table class="table">
                    <?php
                    $j = 1;
                    $total = 0;
                    $average = 0;
                    $sql_tested = $this->madmin->data_test($dat['ta_akademik']);
                    foreach ($sql_tested->result_array() as $q) :
                      $nl = $this->db->get_where('rank', array('id_test' => $q['id_test'], 'id_siswa' => $dat['id_pendaftaran']))->row_array();
                      $sql_student = $this->madmin->value_test($dat['id_pendaftaran']);
                      $total += (int) $nl['nilai_test'];

                    ?>
                      <input type="hidden" name="test_id<?= $q['id_test'] ?>" value="<?= $q['id_test'] ?>">
                      <tr>
                        <td><b><?= $q['nama_test'] ?></b></td>
                        <td><input type="number" name="v_test<?= $q['id_test'] ?>" value="<?= $nl['nilai_test'] ?>"></td>
                      </tr>

                    <?php $j++;
                    endforeach ?>
                    <tr>
                      <td>Rata - rata</td>
                      <td><?= $total / $sql_tested->num_rows()  ?></td>
                    </tr>
                    <tr>
                      <td>Total </td>
                      <td><?= $total ?></td>
                    </tr>



                    <tr>
                      <td></td>
                      <td><button type="submit" name="kirim" class="btn btn-success"><i class="fa fa-save"></i>Simpan</button>
                        <button type="reset" name="kirim" class="btn btn-warning"><i class="fa fa-save"></i>Batal</button></td>
                    </tr>
                  </table>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- end -->
    <div class="modal fade" id="modal-default<?= $no ?>">
      <div class="modal-dialog" style="width: 100%">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Detail Data Pendaftar PPDB</h4>
            <div style="float: right;">
              <!-- tomobol pemeriksaan data -->

              <a href="<?= base_url('admin/pendaftar/terima/' . $dat['id_pendaftaran']) ?>" class="btn btn-success">Terima</a>
              <a href="<?= base_url('admin/pendaftar/tolak/' . $dat['id_pendaftaran']) ?>" class="btn btn-danger">Tolak</a>
              <a href="<?= base_url('admin/pendaftar/pending/' . $dat['id_pendaftaran']) ?>" class="btn btn-info">Pending</a>

              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
              &nbsp;
              <a href="<?= base_url('admin/pendaftar/cetak/' . $dat['id_pendaftaran'] . '-Cetak-Data-Pendaftar.pdf') ?>" target="_blank" class="btn btn-success"><i class="fa fa-print"></i>Cetak Data</a>
            </div>
          </div>
          <div class="modal-body">
            <div class="container">
              <div class="row">
                <div class="col-md-6">
                  <form action="" method="POST">
                    <table class="table table">
                      <tr>
                        <td colspan="4">
                          <center> <img src="<?php
                                              $ada = file_exists('./assets/file_pendaftar/' . $dat['foto']);
                                              if (!$ada) {
                                                echo  base_url('assets/no_foto.png');
                                              } elseif ($ada) {
                                                echo base_url('assets/file_pendaftar/' . $dat['foto']);
                                              }  ?>" class="image-responsive" style="width: 150px;height: 150px" onerror="this.src = '<?= base_url('assets/no_foto.png') ?>';"></center>
                        </td>
                      </tr>
                      <tr>
                        <div class="callout callout-success"><i class="fa fa-user"></i><tt>Data Calon Siswa</tt></div>
                      </tr>
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
                        <td>NIK</td>
                        <td><?= $dat['nik'] ?></td>
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
                        <td>Desa/Kelurahan</td>
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
                        <td><?= $dat['tinggi_badan'] ?> /Cm</td>
                      </tr>
                      <tr>
                        <td>Berat Badan</td>
                        <td><?= $dat['berat_badan'] ?> /Kg</td>
                      </tr>
                      <!-- <tr><td>Nomor Telp Rumah</td><td><?= $dat['nomor_telp_rumah'] ?></td></tr> -->
                      <tr>
                        <td>No Telepon</td>
                        <td><?= $dat['no_telepon'] ?></td>
                      </tr>
                      <tr>
                        <td>Alat Transportasi</td>
                        <td><?= $dat['alat_transportasi'] ?></td>
                      </tr>
                      <tr>
                        <td>Prestasi</td>
                        <td><?= $dat['prestasi'] ?></td>
                      </tr>
                    </table>
                </div>

                <div class="col-md-6">
                  <?php
                  $CEkpdf = $this->db->get_where('rn_daftar', array(
                    'rapor_scan' => $dat['rapor_scan'],
                    'ijazah_scan' => $dat['ijazah_scan'],
                    'kk_scan' => $dat['kk_scan'], 'akta_scan' => $dat['akta_scan']
                  ));
                  if ($dat['konfirmasi'] == "") : ?>
                    <?php if ($CEkpdf->num_rows() > 0) : ?>
                      <table class="table table-striped">
                        <tr>
                          <td colspan="3">
                            <div class="alert alert-info" style="border-radius: 0px;border:none;color: #000">
                              <h4><i class="fa fa-user"></i><tt> &nbsp;&nbsp;VALIDASI BERKAS PENDAFTARAN</tt>
                            </div>*** Perhatikan <br />
                            <ol>
                              <li>File pdf verifiksai harus sesuai dengan yang di minta misalkan : raport</li>
                              <li>Scan Ijazah dan SKHUN pdf dalam satu berkas</li>
                              <li>Scan Kartu Keluarga</li>
                              <li>Scan Akta Kelahiran</li>
                            </ol>
                          </td>
                        </tr>
                        <tr>
                          <td>Scan Nilai Rapor 1 Sampai 5</td>
                          <td>
                            <button type="button" class="btn btn-success" onclick="return rapor_scan('<?= $dat['rapor_scan'] ?>')">
                              Lihat Pdf File.
                            </button></td>
                        </tr>
                        <tr>
                          <td>Scan Ijazah Dan SKHUN </td>
                          <td><button type="button" class="btn btn-info" onclick="return ijazah_scan('<?= $dat['ijazah_scan'] ?>')">
                              Lihat Pdf File.
                            </button></td>
                        </tr>
                        <tr>
                          <td>Scan Kartu Keluarga</td>
                          <td><button type="button" class="btn btn-warning" onclick="return kk_scan('<?= $dat['kk_scan'] ?>')">
                              Lihat Pdf File.
                            </button></td>
                        </tr>
                        </button></td>
                        </tr>
                        <tr>
                          <td>Scan Akta Kelahiran</td>
                          <td><button type="button" class="btn btn-warning" onclick="return akta_scan('<?= $dat['akta_scan'] ?>')">
                              Lihat Pdf File.
                            </button></td>
                        </tr>
                      </table>
                    <?php else : ?>
                      <div class="callout callout-danger">File PDF RUSAK .</div>
                    <?php endif; ?>

                  <?php else : ?>
                    <div class="callout callout-danger"><i class="fa fa-info"></i> Maaf Untuk Data Pdf Tidak Bisa Di Tampilkan Karna Calon Sudah Siswa Terverifikasi .</div>
                  <?php endif ?>

                  <table class="table table-striped">

                    <tr class="callout callout-success">
                      <td colspan="4">Data Nilai Seleksi</td>
                    </tr>
                    <?php $nilai = '';
                    $jum = '';
                    foreach ($this->madmin->nilai_seleksi($dat['id_pendaftaran'], $dat['ta_akademik'])->result_array() as $dy) :
                      $jum += $dy['nilai_test'];
                      $hasil = +$jum / count($dy['id_test']);
                    ?>
                      <tr class="callout callout-danger">
                        <td><?= $dy['nama_test'] ?></td>
                        <td><?= $dy['nilai_test'] ?></td>
                      </tr>
                    <?php endforeach  ?>

                    <tr>
                      <td>Jumlah Nilai</td>
                      <td><?= $hasil ?></td>
                    </tr>
                    <tr>
                      <td>Rata-Rata Nilai</td>
                      <td><?= rata_rata($dat['id_pendaftaran'], tahun_akademik('id_gelombang'))  ?></td>
                    </tr>
                    <tr>
                      <td>Jumlah Siswa</td>
                      <td><?= $this->madmin->jumlah_siswa(tahun_akademik('id_gelombang')) ?></td>
                    </tr>
                    <tr>
                      <td>Rangking ke </td>
                      <td><?= rangking($dat['id_pendaftaran'], tahun_akademik('id_gelombang')) ?></td>
                    </tr>

                    <tr>
                      <td colspan="3">
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
                      <td colspan="3">
                        <div class="callout callout-success"><tt>** Jika Data Orang Tua Ibu/Ayah Kosong Silahkan Isikan Data Orang Tua Pada
                            Wali .</tt></div>
                      </td>
                    </tr>
                    <tr>
                      <td>Nama Wali</td>
                      <td><?= $dat['nama_wali'] ?></td>
                    </tr>
                    <tr>
                      <td>Tahun Lahir Wali</td>
                      <td><?= $dat['tahun_lahir_wali'] ?> </td>
                    </tr>
                    <tr>
                      <td>Pekerjaan Wali</td>
                      <td><?= $dat['pekerjaan_wali'] ?></td>
                    </tr>
                    <tr>
                      <td>Pendidikan Wali</td>
                      <td><?= $dat['pendidikan_wali'] ?> </td>
                    </tr>
                    <tr>
                      <td>Penghasilan Wali</td>
                      <td>
                        <?= $dat['penghasilan_wali'] ?></td>
                    </tr>

                  </table>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="x-edit<?= $no ?>">
      <div class=" modal-dialog" style="width: 100%">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Edit Pendaftar</h4>
            <div style="float: right;">
              <!-- tomobol pemeriksaan data -->
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
              &nbsp;
              <a href="<?= base_url('admin/pendaftar/cetak/' . $dat['id_pendaftaran'] . '-Cetak-Data-Pendaftar.pdf') ?>" target=" _blank" class="btn btn-success"><i class="fa fa-print"></i>Cetak Data</a>
            </div>
          </div>
          <form action="<?= site_url('admin/pendaftar_edit/' . $dat['id_pendaftaran']) ?>" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="container">
                <div class="row">
                  <div class="col-md-6">
                    <form action="" method="POST">
                      <table class="table table">
                        <tr>
                          <td colspan="4">
                            <center> <img src="<?php
                                                $ada = file_exists('./assets/file_pendaftar/' . $dat['foto']);
                                                if (!$ada) {
                                                  echo  base_url('assets/no_foto.png');
                                                } elseif ($ada) {
                                                  echo base_url('assets/file_pendaftar/' . $dat['foto']);
                                                }  ?>" class=" image-responsive" style="width: 150px;height: 150px" onerror="this.src = '<?= base_url('assets/no_foto.png') ?>'" /></center>

                          </td>
                        </tr>
                        <tr>
                          <td>
                            <input type="file" class="form-control" name="gambar" /></b></td>
                        </tr>
                        <td>

                          </tr>
                          <tr>
                            <div class=" callout callout-success"><i class="fa fa-user"></i><tt>Data Calon Siswa</tt>
                            </div>
                          </tr>
                          <tr>
                            <td>Nomor Pendaftaran</td>
                            <td><b><input type="text" class="form-control" value="<?= $dat['no_pendaftaran'] ?>" name="no_pendaftaran" /></b></td>
                          </tr>
                          <tr>
                            <td>Nama pendaftar</td>
                            <td><input type="text" class="form-control" value="<?= $dat['nama_pendaftar'] ?>" name="nama_pendaftar" /></td>
                          </tr>
                          <tr>
                            <td>Jenis Kelamin</td>
                            <td><input type="text" class="form-control" value="<?= $jk ?>" name="jk" /></td>
                          </tr>
                          <tr>
                            <td>NIK</td>
                            <td><input type="text" class="form-control" value="<?= $dat['nik'] ?>" name="nik" /></td>
                          </tr>
                          <tr>
                            <td>Tempat lahir</td>
                            <td><input type="text" class="form-control" value="<?= $dat['tempat_lahir'] ?>" name="tempat_lahir" /></td>
                          </tr>
                          <tr>
                            <td>Tanggal lahir</td>
                            <td><input type="text" class="form-control" value="<?= $dat['tanggal_lahir'] ?>" name="tanggal_lahir" /></td>
                          </tr>
                          <tr>
                            <td>Agama</td>
                            <td><input type="text" class="form-control" value="<?= $dat['agama'] ?>" name="agama" /></td>
                          </tr>
                          <tr>
                            <td>RT</td>
                            <td><input type="text" class="form-control" value="<?= $dat['rt'] ?>" name="rt" /></td>
                          </tr>
                          <tr>
                            <td>RW</td>
                            <td><input type="text" class="form-control" value="<?= $dat['rw'] ?>" name="rw" /></td>
                          </tr>
                          <tr>
                            <td>Desa/Kelurahan</td>
                            <td><input type="text" class="form-control" value="<?= $dat['desa_kelurahan'] ?>" name="desa_kelurahan" /></td>
                          </tr>
                          <tr>
                            <td>Kecamatan</td>
                            <td><input type="text" class="form-control" value="<?= $dat['kecamatan'] ?>" name="kecamatan" /></td>
                          </tr>
                          <tr>
                            <td>Kabupaten</td>
                            <td><input type="text" class="form-control" value="<?= $dat['kabupaten'] ?>" name="kabupaten" /></td>
                          </tr>
                          <tr>
                            <td>Provinsi</td>
                            <td><input type="text" class="form-control" value="<?= $dat['provinsi'] ?>" name="provinsi" /></td>
                          </tr>
                          <tr>
                            <td>Kode Pos</td>
                            <td><input type="text" class="form-control" value="<?= $dat['kode_pos'] ?>" name="kode_pos" /></td>
                          </tr>
                          <tr>
                            <td>Tinggi Badan</td>
                            <td><input type="text" class="form-control" value="<?= $dat['tinggi_badan'] ?>" name="tinggi_badan" /> /Cm</td>
                          </tr>
                          <tr>
                            <td>Berat Badan</td>
                            <td><input type="text" class="form-control" value="<?= $dat['berat_badan'] ?>" name="berat_badan" /> /Kg</td>
                          </tr>
                          <!-- <tr><td>Nomor Telp Rumah</td><td><input type="text" class="form-control" value="<?= $dat['nomor_telp_rumah'] ?>" name="" /></td></tr> -->
                          <tr>
                            <td>No Telepon</td>
                            <td><input type="text" class="form-control" value="<?= $dat['no_telepon'] ?>" name="no_telepon" /></td>
                          </tr>
                          <tr>
                            <td>Alat Transportasi</td>
                            <td><input type="text" class="form-control" value="<?= $dat['alat_transportasi'] ?>" name="alat_transportasi" /></td>
                          </tr>
                          <tr>
                            <td>Prestasi</td>
                            <td><input type="text" class="form-control" value="<?= $dat['prestasi'] ?>" name="prestasi" /></td>
                          </tr>
                      </table>
                  </div>

                  <div class="col-md-6">
                    <?php
                    $CEkpdf = $this->db->get_where('rn_daftar', array(
                      'rapor_scan' => $dat['rapor_scan'],
                      'ijazah_scan' => $dat['ijazah_scan'],
                      'kk_scan' => $dat['kk_scan'], 'akta_scan' => $dat['akta_scan']
                    ));
                    if ($dat['konfirmasi'] == "") : ?>" name="" />
                    <?php if ($CEkpdf->num_rows() > 0) : ?>" name="" />
                    <table class="table table-striped">
                      <tr>
                        <td colspan="3">
                          <div class="alert alert-info" style="border-radius: 0px;border:none;color: #000">
                            <h4><i class="fa fa-user"></i><tt> &nbsp;&nbsp;VALIDASI BERKAS PENDAFTARAN</tt>
                          </div>*** Perhatikan <br />
                          <ol>
                            <li>File pdf verifiksai harus sesuai dengan yang di minta misalkan : raport</li>
                            <li>Scan Ijazah dan SKHUN pdf dalam satu berkas</li>
                            <li>Scan Kartu Keluarga</li>
                            <li>Scan Akta Kelahiran</li>
                          </ol>
                        </td>
                      </tr>
                      <tr>
                        <td>Scan Nilai Rapor 1 Sampai 5</td>
                        <td>
                          <button type="button" class="btn btn-success" onclick="return rapor_scan('<?= $dat['rapor_scan'] ?>" name="" />')">
                          Lihat Pdf File.
                          </button></td>
                      </tr>
                      <tr>
                        <td>Scan Ijazah Dan SKHUN </td>
                        <td><button type="button" class="btn btn-info" onclick="return ijazah_scan('<?= $dat['ijazah_scan'] ?>')">
                            Lihat Pdf File.
                          </button></td>
                      </tr>
                      <tr>
                        <td>Scan Kartu Keluarga</td>
                        <td><button type="button" class="btn btn-warning" onclick="return kk_scan('<?= $dat['kk_scan'] ?>')">
                            Lihat Pdf File.
                          </button></td>
                      </tr>
                      </button></td>
                      </tr>
                      <tr>
                        <td>Scan Akta Kelahiran</td>
                        <td><button type="button" class="btn btn-warning" onclick="return akta_scan('<?= $dat['akta_scan'] ?>')">
                            Lihat Pdf File.
                          </button></td>
                      </tr>
                    </table>
                  <?php else : ?>
                    <div class="callout callout-danger">File PDF RUSAK .</div>
                  <?php endif; ?>

                <?php else : ?>
                  <div class="callout callout-danger"><i class="fa fa-info"></i> Maaf Untuk Data Pdf Tidak Bisa Di Tampilkan Karna Calon Sudah Siswa Terverifikasi .</div>
                <?php endif ?>
                <table class="table table-striped">

                  <tr class="callout callout-success">
                    <td colspan="4">Data Nilai Seleksi</td>
                  </tr>
                  <?php $nilai = '';
                  $jum = '';
                  foreach ($this->madmin->nilai_seleksi($dat['id_pendaftaran'], $dat['ta_akademik'])->result_array() as $dy) :
                    $jum += $dy['nilai_test'];
                    $hasil = +$jum / count($dy['id_test']);
                  ?>
                    <tr class="callout callout-danger">
                      <td><input type="text" class="form-control" value="<?= $dy['nama_test'] ?>" name="nama_test" /></td>
                      <td><input type="text" class="form-control" value="<?= $dy['nilai_test'] ?>" name="nilai_test" /></td>
                    </tr>
                  <?php endforeach  ?>
                  <tr>
                    <td>Jumlah Nilai</td>
                    <td><input type="text" class="form-control" value="<?= $hasil ?>" name="" /></td>
                  </tr>
                  <tr>
                    <td>Rata-Rata Nilai</td>
                    <td><input type="text" class="form-control" value="<?= rata_rata($dat['id_pendaftaran'], tahun_akademik('id_gelombang'))  ?>" name="" /></td>
                  </tr>
                  <tr>
                    <td>Jumlah Siswa</td>
                    <td><input type="text" class="form-control" value="<?= $this->madmin->jumlah_siswa(tahun_akademik('id_gelombang')) ?>" name="" /></td>
                  </tr>
                  <tr>
                    <td>Rangking ke </td>
                    <td><input type="text" class="form-control" value="<?= rangking($dat['id_pendaftaran'], tahun_akademik('id_gelombang')) ?>" name="" /></td>
                  </tr>

                  <tr>
                    <td colspan="3">
                      <div class="callout callout-success"><tt>Data Orang Tua /Wali</tt></div>
                    </td>
                  </tr>
                  <tr>
                    <td>Nama Ayah</td>
                    <td><input type="text" class="form-control" value="<?= $dat['nama_ayah'] ?>" name="nama_ayah" /></td>
                  </tr>
                  <tr>
                    <td>Tahun Lahir Ayah</td>
                    <td><input type="text" class="form-control" value="<?= $dat['tahun_lahir_ayah'] ?>" name="tahun_lahir_ayah" /></td>
                  </tr>
                  <tr>
                    <td>Pekerjaan Ayah</td>
                    <td><input type="text" class="form-control" value="<?= $dat['pekerjaan_ayah'] ?>" name="pekerjaan_ayah" /></td>
                  </tr>
                  <tr>
                    <td>Pendidikan Ayah</td>
                    <td><input type="text" class="form-control" value="<?= $dat['pendidikan_ayah'] ?>" name="pendidikan_ayah" /></td>
                  </tr>
                  <tr>
                    <td>Penghasilan Ayah</td>
                    <td><input type="text" class="form-control" value="<?= $dat['penghasilan_ayah'] ?>" name="penghasilan_ayah" /></td>
                  </tr>
                  <tr>
                    <td>Nama Ibu</td>
                    <td><input type="text" class="form-control" value="<?= $dat['nama_ibu'] ?>" name="nama_ibu" /></td>
                  </tr>
                  <tr>
                    <td>Tahun Lahir Ibu</td>
                    <td><input type="text" class="form-control" value="<?= $dat['tahun_lahir_ibu'] ?>" name="tahun_lahir_ibu" /></td>
                  </tr>
                  <tr>
                    <td>Pekerjaan Ibu</td>
                    <td><input type="text" class="form-control" value="<?= $dat['pekerjaan_ibu'] ?>" name="pekerjaan_ibu" /></td>
                  </tr>
                  <tr>
                    <td>Pendidikan Ibu</td>
                    <td><input type="text" class="form-control" value="<?= $dat['pendidikan_ibu'] ?>" name="pendidikan_ibu" /></td>
                  </tr>
                  <tr>
                    <td>Penghasilan Ibu</td>
                    <td><input type="text" class="form-control" value="<?= $dat['penghasilan_ibu'] ?>" name="penghasilan_ibu" /></td>
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
                    <td colspan="3">
                      <div class="callout callout-success"><tt>** Jika Data Orang Tua Ibu/Ayah Kosong Silahkan Isikan Data Orang Tua Pada
                          Wali .</tt></div>
                    </td>
                  </tr>
                  <tr>
                    <td>Nama Wali</td>
                    <td><input type="text" class="form-control" value="<?= $dat['nama_wali'] ?>" name="nama_wali" /></td>
                  </tr>
                  <tr>
                    <td>Tahun Lahir Wali</td>
                    <td><input type="text" class="form-control" value="<?= $dat['tahun_lahir_wali'] ?>" name="tahun_lahir_wali" /> </td>
                  </tr>
                  <tr>
                    <td>Pekerjaan Wali</td>
                    <td><input type="text" class="form-control" value="<?= $dat['pekerjaan_wali'] ?>" name="pekerjaan_wali" /></td>
                  </tr>
                  <tr>
                    <td>Pendidikan Wali</td>
                    <td><input type="text" class="form-control" value="<?= $dat['pendidikan_wali'] ?>" name="pendidikan_wali" /> </td>
                  </tr>
                  <tr>
                    <td>Penghasilan Wali</td>
                    <td>
                      <input type="text" class="form-control" value="<?= $dat['penghasilan_wali'] ?>" name="penghasilan_wali" /></td>
                  </tr>
                </table>
                  </div>
                  <button type="submit" name="kirim" class="btn btn-primary"><i class="fa fa-edit"></i>Edit </button>
                  <button type="reset" name="kirim" class="btn btn-info"><i class="fa fa-edit"></i>Batal </button>
          </form>
        </div>
      </div>
    </div>
</div>
</div>
</div>

<?php $no++;
  endforeach; ?>
</div>

<script>
  $(function() {
    $('#id_jurusan').change(function() {
      var id = $(this).val();
      window.location.href = "<?= site_url('/admin/pendaftar?jur=') ?>" + id;
    });
  });
</script>