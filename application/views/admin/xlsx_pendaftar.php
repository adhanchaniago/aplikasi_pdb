<style>
    .cstable td {
        border: 0.6px solid black;
        text-align: center
    }

    .cstable th {
        border: 0.1px solid black;
    }

    .cstable {
        border-collapse: collapse;
        width: 100%;
    }
</style>
<center>
    <h4>PANITIA PENERIMAAN PESERTA DIDIK BARU TAHUN AKADEMIK <?= tahun_akademik('ta_akademik') ?></h4>
    <h4><?= strip_tags(cari('nama')) ?></h4>
    <i><?= strip_tags(cari('jalan')) ?> | Telp .<?= strip_tags(cari('telp')) ?></i>
    <hr />
</center>

<table class="cstable">
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
                $keterangan = "<button class='btn btn-success'>Lulus</button>";
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
                    <?= $keterangan  ?></td>
            </tr>
        <?php $no++;
        endforeach; ?>
    </tbody>
</table>