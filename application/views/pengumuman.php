<div class="clearfix"></div>
<div class="container" style="margin-top: 40px;background: #fff; padding: 100px">

  <div class="artikel_full">
    <div id="artikel_hasil">
      <div class="row">
        <ul class="list-unstyled">
          <?php $no = 1;
          foreach ($pengumuman->result_array() as $data) :
            $admin = $this->db->get_where('rn_admin', array('id_admin' => $data['id_admin']));
            $nama = ($admin->row()->nama) ? $admin->row()->nama : 'Administrator';
          ?>
            <li class="media">
              <img class="img-responsive" src="<?= base_url('./assets/gambar/' . $data['gambar']) ?>" alt="<?= $data['judul'] ?>" onerror="this.src = '<?= base_url('/assets/no-image.jpg') ?>;" style="width: 100px;height: 100px">
              <div class="media-body">
                <h5 class="mt-0 mb-1"><a href="" onclick="return detailArtikel('<?= $data['id_informasi'] ?>')"><?= strip_tags(ucfirst($data['judul'])) ?></a></h5>
                <?= character_limiter(strip_tags($data['isi'], 100)) ?>

              </div>
              <button onclick="return detailArtikel(<?= $data['id_informasi'] ?>)" class="btn btn-success">Baca Selengkapnya</button>

            </li>
            <hr />
          <?php $no++;
          endforeach; ?>
        </ul>
      </div>
    </div>

    <div class="clearfix"></div>
    <div class="loading_tampil  btn btn-info"><i class="fa fa-share fa-spin"></i>Sedang Memuat Halaman ...</div>
    <div class="tampil_kan btn btn-success" data-posisi="4">Load More .. </div>


    <script type="text/javascript">
      var posisi;
      $(function() {
        $('.loading_tampil').hide();
        $('.tampil_kan').click(function() {
          $('.loading_tampil').show();
          posisi = parseInt($(this).attr('data-posisi'));
          $.ajax({
            url: "<?= base_url('home/tampil_artikel/') ?>/" + posisi,
            type: "GET",
            success: function(data) {
              $('#artikel_hasil').html(data);
              $('.loading_tampil').hide();
              $('.tampil_kan').attr('data-posisi', posisi + 4);
            },
            error: function(data) {
              swal({
                title: "Kesalahan",
                text: "Sql Tidak Dapat Respon Tunggu Sebentar ya ?",
                icon: "error",
                button: "OK",
              });
            }


          });

        });
      });


      function detailArtikel(id) {
        event.preventDefault();
        $.ajax({
          url: '<?= base_url('home/detail_berita/') ?>/' + id,
          type: 'GET',
          beforeSend: function() {
            swal({
              title: "Loading Complete .. ",
              icon: "success",
              button: "OK",
            });
          },
          success: function(data) {
            $('.artikel_full').html(data);
          },
          error: function(data) {
            swal({
              title: "Kesalahan",
              text: "Sql Tidak Dapat Respon Tunggu Sebentar ya ?",
              icon: "error",
              button: "OK",
            });
          }
        });


      }
    </script>
  </div>