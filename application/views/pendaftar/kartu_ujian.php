<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<link rel="stylesheet" href="<?= base_url('assets/bootstrap.min.css') ?>">
<script type="text/javascript">
    window.print()
</script>

<?php $dat = $data->row_array();
?>
<br /><br /><br />
<div class="container">
    <center>
        <img src="<?= base_url('/assets/admin/dist/img/proc.png') ?>" class="img-responsive" style="width: 100px ;height: 100px">
        <br /> <br />
        <h4>PANITIA PENERIMAAN PESERTA DIDIK BARU TAHUN AKADEMIK <?= tahun_akademik('ta_akademik') ?></h4>
        <h4><?= strip_tags(cari('nama')) ?></h4>
        <i><?= strip_tags(cari('jalan')) ?> | Telp .<?= strip_tags(cari('telp')) ?></i>
        <hr />
    </center>
    <center>
        <table class="table" style="width: 50%">
            <center>Kartu Ujian </center>
            <tr class="callout callout-success">
                <th>Mata pelajaran</th>
                <th>Waktu dan tanggal</th>
            </tr>
            <?php $no = 1;
            $jum = '';
            foreach ($data->result_array() as $dy) :
            ?>
                <tr class="callout callout-info">
                    <td><?= $no . '. ' . $dy['nama_test'] ?></td>
                    <td><?= $no . '. ' . tgl_indonesia($dy['jadwal']) ?></td>
                </tr>
            <?php $no++;
            endforeach  ?>
        </table>
    </center>
</div>