<!-- Main content -->
    <section class="content">
      <div class="row">

<div class="callout callout-default">
   <span style="background: green; color: #fff;padding: 10px 10px">Warna Hijau</span> = Untuk Data Grafik Lulus. <br /><br />
   <hr />
  <span style="background: #000; color: #fff;padding: 10px 10px">Warna Hitam</span>  = Untuk Data Grafik Tidak Lulus. <br /><br /><hr />
  <span style="background: #ddd; color: #000;padding: 10px 10px">Warna Abu-Abu</span>  = Untuk Data Grafik Siswa Yang Di Pending. <br /><br /><hr />
  <span style="background: red; color: #fff;padding: 10px 10px">Warna Merah</span>  = Untuk Data Grafik Siswa yang belum di konfirmasi untuk penerimaan. <br />
 

</div>


        <div class="col-md-6">
          <!-- AREA CHART -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Area Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="areaChart" style="height:250px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- DONUT CHART -->
          <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Donut Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <canvas id="pieChart" style="height:250px"></canvas>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col (LEFT) -->
        <div class="col-md-6">
          <!-- LINE CHART -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Line Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="lineChart" style="height:250px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- BAR CHART -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Bar Chart</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="chart">
                <canvas id="barChart" style="height:230px"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col (RIGHT) -->
      </div>
      <!-- /.row -->

    </section>
    <script>


<?php
 $tanggal=array();
 
 /*grafik*/
 $graflulus=array();
 $graftidaklulus=array();
 $grafpending=array();
 $grafbelumkonfirmasi=array();
 /*batas grafik*/

 foreach($all_siswa->result_array() as $semua):
 
 $lulus=$this->madmin->grafiklulus($semua['tanggal']);
 $tidaklulus=$this->madmin->grafiktidak_lulus($semua['tanggal']);
 $pending=$this->madmin->grafikpending($semua['tanggal']);
 $belumkonfirmasi=$this->madmin->grafikbelumkonfirmasi($semua['tanggal']);

 $tanggal[] = '\''.$semua['tanggal'].'\'';
 /*grafik */
 $graflulus[] = $lulus->num_rows();
 $graftidaklulus[] = $tidaklulus->num_rows();
 $grafpending[] = $pending->num_rows();
 $grafbelumkonfirmasi[] = $belumkonfirmasi->num_rows();

 endforeach;

$tanggal_h=implode(',', $tanggal);
 /*data grafik mulai */
$h_lulus=implode(',',$graflulus);
$h_tidaklulus=implode(',',$graftidaklulus);
$h_pending=implode(',',$grafpending);
$h_belumkonfirmasi=implode(',',$grafbelumkonfirmasi);

 ?>

  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------
   
    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
    // This will get the first returned node in the jQuery collection.
    var areaChart       = new Chart(areaChartCanvas)

    var areaChartData = {
      labels  : [<?= $tanggal_h ?>],

      datasets: [
        {
          label               : 'Lulus',
          fillColor           : 'green',
          strokeColor         : 'green',
          pointColor          : 'green',
          pointStrokeColor    : 'green',
          pointHighlightFill  : 'green',
          pointHighlightStroke: 'green',
          data                : [<?= $h_lulus  ?>]
        },

        {
          label               : 'Tidak Lulus',
          fillColor           : '#000',
          strokeColor         : '#000',
          pointColor          : '#000',
          pointStrokeColor    : '#000',
          pointHighlightFill  : '#000',
          pointHighlightStroke: '#000',
          data                : [<?= $h_tidaklulus  ?>]
        },
         {
          label               : 'Pending',
          fillColor           : '#ddd',
          strokeColor         : '#ddd',
          pointColor          : '#ddd',
          pointStrokeColor    : '#ddd',
          pointHighlightFill  : '#ddd',
          pointHighlightStroke: '#ddd',
          data                : [<?= $h_pending ?>]
        },
        {
          label               : 'Belum Konfirmasi',
          fillColor           : 'red',
          strokeColor         : 'red',
          pointColor          : 'red',
          pointStrokeColor    : 'red',
          pointHighlightFill  : 'red',
          pointHighlightStroke: 'red',
          data                : [<?= $h_belumkonfirmasi ?>]
        }
      ]
    }

    var areaChartOptions = {
      //Boolean - If we should show the scale at all
      showScale               : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : false,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - Whether the line is curved between points
      bezierCurve             : true,
      //Number - Tension of the bezier curve between points
      bezierCurveTension      : 0.3,
      //Boolean - Whether to show a dot for each point
      pointDot                : false,
      //Number - Radius of each point dot in pixels
      pointDotRadius          : 4,
      //Number - Pixel width of point dot stroke
      pointDotStrokeWidth     : 1,
      //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
      pointHitDetectionRadius : 20,
      //Boolean - Whether to show a stroke for datasets
      datasetStroke           : true,
      //Number - Pixel width of dataset stroke
      datasetStrokeWidth      : 2,
      //Boolean - Whether to fill the dataset with a color
      datasetFill             : true,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio     : true,
      //Boolean - whether to make the chart responsive to window resizing
      responsive              : true
    }

    //Create the line chart
    areaChart.Line(areaChartData, areaChartOptions)

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas          = $('#lineChart').get(0).getContext('2d')
    var lineChart                = new Chart(lineChartCanvas)
    var lineChartOptions         = areaChartOptions
    lineChartOptions.datasetFill = false
    lineChart.Line(areaChartData, lineChartOptions)

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
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

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
    var barChart                         = new Chart(barChartCanvas)
    var barChartData                     = areaChartData
    barChartData.datasets[1].fillColor   = '#00a65a'
    barChartData.datasets[1].strokeColor = '#00a65a'
    barChartData.datasets[1].pointColor  = '#00a65a'
    var barChartOptions                  = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero        : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - If there is a stroke on each bar
      barShowStroke           : true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth          : 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing         : 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing       : 1,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true
    }

    barChartOptions.datasetFill = false
    barChart.Bar(barChartData, barChartOptions)
  })
</script>