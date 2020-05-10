 
<div class='row'>
    <div class='col-sm-12'>
      <?= $this->session->userdata('message') ?>
      <div class='white-box'>
         <h3 class='box-title m-b-0'><?= ucfirst($judul) ?></h3> 
   <div class='table-responsive'>  
        
        <table class="table">
	    <tr><td>Mapel Uji</td><td><?php echo $mapel_uji; ?></td></tr>
	    <tr><td>Kkm</td><td><?php echo $kkm; ?></td></tr>
	    <tr><td>Create At</td><td><?php echo $create_at; ?></td></tr>
	    <tr><td>User Id</td><td><?php echo $user_id; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('tmverifikasi_rapor') ?>" class="btn btn-default"><i class='fa fa-home'></i>Back To Home</a></td></tr>
	</table>
</div>
</div>
</div>
</div>