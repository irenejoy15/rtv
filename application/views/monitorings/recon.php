<?php $attributes = array('id'=>'monitoring','class'=>'form_horizontal'); ?>
<?php echo form_open_multipart('monitoring/upload_recon', $attributes);?>
<?php echo form_close();?>
<div class="row">
    <div class="col-sm-12 text-center" style="font-size:26px;">
        UPLOAD THE RECON EXCEL FILE
    </div>
</div>
<div class="row mt-2">
    <div class="col-md-6 text-right" style="font-size:23px;">
        EXCEL FILE:
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <div class="custom-file">
            <input type="file" form="monitoring" name="upload_file" accept=".xlsx, .xls, .csv" class="custom-file-input" id="exampleInputFile">
            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="input-group-append">
            <input type="submit" form="monitoring" value="UPLOAD" class="btn btn-success btn-block" data-toggle="modal" data-target="#monitoringModal">
        </div>
    </div>
</div>

<div class="modal fade" id="monitoringModal" tabindex="-1" data-keyboard="false" data-backdrop="static" role="dialog" aria-labelledby="monitoringModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-center" id="exampleModalLongTitle">PLEASE WAIT......</h5>
        
        </div>
        <div class="modal-body">
            <div class="row">
            <div class="col-sm-12">
            <img src="<?php echo base_url();?>assets/dist/img/1.gif" style="width:100%">
            </div>
            </div>
        </div>
        
        </div>
    </div>
    </div>
</div>
                         