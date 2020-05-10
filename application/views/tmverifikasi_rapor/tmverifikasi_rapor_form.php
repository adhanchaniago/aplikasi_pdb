<div class='row'>
    <div class='col-md-12'>
        <div class='panel panel-info'>
            <div class='panel-heading'><?= ucfirst($judul) ?></div>
            <div class='panel-wrapper collapse in' aria-expanded='true'>
                <div class='panel-body'>
                    <form action="<?php echo $action; ?>" method="post" class='form-horizontal form-bordered'>
                        <div class='form-body'>
                            ** ) Harap Isikan data yang di butuhkan pada form.
                            <br /><br /><br /><br />
                            <div class="form-group">
                                <label for="varchar" class='control-label col-md-3'><b>Mapel Uji<?php echo form_error('mapel_uji') ?></b></label>
                                <div class='col-md-9'>
                                    <input type="text" class="form-control" name="mapel_uji" id="mapel_uji" placeholder="Mapel Uji" value="<?php echo $mapel_uji; ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="varchar" class='control-label col-md-3'><b>Kkm<?php echo form_error('kkm') ?></b></label>
                                <div class='col-md-9'>
                                    <input type="number" class="form-control" name="kkm" id="kkm" placeholder="Kkm" value="<?php echo $kkm; ?>" />
                                </div>
                            </div>

                            <input type="hidden" name="id" value="<?php echo $id; ?>" />
                            <div class='form-actions'>
                                <div class='row'>
                                    <div class='col-md-12'>
                                        <div class='row'>
                                            <div class='col-md-offset-3 col-md-9'>
                                                <button type="submit" class="btn btn-info"><i class='fa fa-check'></i><?php echo $button ?></button>
                                                <a href="<?php echo site_url('tmverifikasi_rapor') ?>" class="btn btn-default"><i class='fa fa-share'></i>Cancel</a>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>