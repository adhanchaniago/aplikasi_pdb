<div class="container">
  <div class="row">

    <!-- Page Heading/Breadcrumbs -->
    <h4 class="mt-4 mb-3"><?= ucfirst(strip_tags($data->row()->judul)) ?>
    </h4>

    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="<?= base_url('pengumuman.jsp') ?>">Home</a>
      </li>
      <li class="breadcrumb-item active"><?= ucfirst(strip_tags($data->row()->judul)) ?></li>
    </ol>

    <div class="row">

      <!-- Post Content Column -->
      <div class="col-lg-8">
        <!-- Preview Image -->
        <img class="img-responsive" src="<?= base_url('assets/gambar/' . $data->row()->gambar) ?>" alt="" onerror="this.src = '<?= base_url('/assets/no-image.jpg') ?>;">
        <hr>
        <!-- Date/Time -->
        <p>Posted on <?= tgl_indonesia($data->row()->tanggal); ?></p>
        <hr>
        <?= $data->row()->isi ?>

      </div>

      <!-- Sidebar Widgets Column -->
      <div class="col-md-4">

        <!-- Search Widget -->
        <div class="card mb-4">
          <h5 class="card-header"><i class="fa fa-list"></i>Artikel Terkait</h5>
          <?php $no = 2;
          foreach ($artikel->result_array() as $artikel) : ?>
            <table class="table">
              <tr>
                <td><img src="<?= base_url('assets/gambar/' . $artikel['gambar']) ?>" alt="<?= ucfirst(strip_tags($artikel['judul'])) ?>" class="image-responsive" style="width: 100px;height: 100px"></td>
                <td><a href="#" style="color:#5a5a5a;" onclick="return detailArtikel('<?= $artikel['id_informasi'] ?>')"><?= $artikel['judul'] ?></a></td>
              </tr>
            </table>
          <?php $no++;
          endforeach; ?>
        </div>
      </div>
    </div>
    <!-- /.row -->
  </div>
</div>