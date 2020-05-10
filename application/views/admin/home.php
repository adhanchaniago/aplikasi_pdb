<?php  
$gos=isset($_GET['gos']) ? $_GET['gos'] : '';

if ($gos == "Berhasil") {
   if ($this->session->userdata('level') == "admin") {
        echo "<div class='callout callout-info'>Selamat Datan Di Halaman Administrator Anda Login Sebagai Admin Silahkan Gunakan Modul Di Samping Untuk Menggunakan Sistem</div>";
    }elseif($this->session->userdata('level') == "operator"){
echo "<div class='callout callout-success'>Selamat Datan Di Halaman Administrator Anda Login Sebagai Operator Silahkan Gunakan Modul Di Samping Untuk Menggunakan Sistem</div>";
     } 
  
};


?>



 <div class="row">
	<br /><br />
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?= $peserta ?></h3>
              <p>Data Peserta PMB</p>
            </div>
            <div class="icon">
              <i class="fa fa-database"></i>
            </div>
            <a href="<?= base_url('admin/pendaftar') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?= $terima ?></h3>
              <p>Data Peserta Di Terima</p>
            </div>
            <div class="icon">
              <i class="fa fa-laptop"></i>
            </div>
            <a href="<?= base_url('admin/pendaftar') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?= $ditolak ?></h3>
              <p>Data Anggota Di Tolak</p>
            </div>
            <div class="icon">
              <i class="fa fa-laptop"></i>
            </div>
            <a href="<?= base_url('admin/peserta') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?= $informasi ?></h3>
              <p>Jumlah Informasi</p>
            </div>
            <div class="icon">
              <i class="fa fa-laptop"></i>
            </div>
            <a href="<?= base_url('admin/informasi') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
          </div>

 

<div class="col-md-6"> 
<div class="callout callout-warning">
<h4><i class="fa fa-user"></i> &nbsp;&nbsp;Detail Login User</h4></div>
<table class="table table-striped">
  <tr><td class="label pull-right bg-green">Nama</td><td><?= $admin->row()->nama ?></td></tr>
  <tr><td class="label pull-right bg-green">Username</td><td><?= $admin->row()->username  ?></td></tr>
  <tr><td class="label pull-right bg-green">Level Akses</td><td><?= $admin->row()->level ?></td></tr>
  <tr><td class="label pull-right bg-green">Login Akses Terakhir</td><td><?= $admin->row()->log  ?></td></tr>
</table>
</div>
<div class="col-md-6">


<table class="table table-striped">
  <div class="callout callout-success">
<h4><i class="fa fa-list"></i> &nbsp;&nbsp;Identitas Sekolah</h4></div>
  <tr><td>Nama Sekolah</td><td><?= cari('nama') ?></td></tr>
  <tr><td>Visi Dan Misi</td><td><?= cari('visi_misi') ?></td></tr>
  <tr><td>Alamat Sekolah</td><td><?= cari('jalan') ?></td></tr>

</table>

</div>
    <div class="clearfix"></div>
     <!-- BAR CHART -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title"><i class="fa fa-user"></i> Jumlah Calon Siswa Terdaftar</h3>

              <div class="box-tools pull-right">
                
              </div>
            </div>
            <div class="box-body">
              <div class="col-md-6">
              <div class="callout callout-default">
   <span style="background: green; color: #fff;padding: 10px 10px">Warna Hijau</span> = Untuk Data Grafik Lulus. <br /><br />
   <hr />
  <span style="background: #000; color: #fff;padding: 10px 10px">Warna Hitam</span>  = Untuk Data Grafik Tidak Lulus. <br /><br /><hr />
  <span style="background: #ddd; color: #000;padding: 10px 10px">Warna Abu-Abu</span>  = Untuk Data Grafik Siswa Yang Di Pending. <br /><br /><hr />
  <span style="background: red; color: #fff;padding: 10px 10px">Warna Merah</span>  = Untuk Data Grafik Siswa yang belum di konfirmasi untuk penerimaan. <br />
 

</div>
</div>
<div class="col-md-6">
              <div class="chart">
                <canvas id="pieChart" style="height:230px"></canvas>
              </div>
            </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box --> 

      <script type="text/javascript">
          $(function () {
            var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieChart       = new Chart(pieChartCanvas)
    var PieData        = 
   <?php 
    $lulus=$this->db->get_where('rn_daftar',array('konfirmasi'=>'Y'));
    $pending=$this->db->get_where('rn_daftar',array('konfirmasi'=>'P'));
    $tidaklulus=$this->db->get_where('rn_daftar',array('konfirmasi'=>'N'));
    $belumkonfirmasi=$this->db->get_where('rn_daftar',array('konfirmasi'=>''));
  



     ?>
 
    [
      {
        value    : [<?= $lulus->num_rows() ?>],
        color    : 'green',
        highlight: 'green',
        label    : 'Lulus'
      },
      {
        value    : [<?= $tidaklulus->num_rows() ?>],
        color    : '#000',
        highlight: '#000',
        label    : 'Tidak Lulus'
      },
      {
        value    : [<?= $pending->num_rows() ?>],
        color    : '#ddd',
        highlight: '#ddd',
        label    : 'Pending'
      },
      {
        value    : [<?= $belumkonfirmasi->num_rows() ?>],
        color    : 'red',
        highlight: 'red',
        label    : 'Belum Konfirmasi'
      }
     
    ]
    var pieOptions     = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke    : true,
      //String - The colour of each segment stroke
      segmentStrokeColor   : '#fff',
      //Number - The width of each segment stroke
      segmentStrokeWidth   : 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps       : 100,
      //String - Animation easing effect
      animationEasing      : 'easeOutBounce',
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate        : true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale         : false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive           : true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio  : true,
      //String - A legend template
      legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions)
})
      </script>