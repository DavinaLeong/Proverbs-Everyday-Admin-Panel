<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @var $record_name
 * @var $delete_url
 */
?><div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="delete_modal_label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="delete_modal_label">Delete <?= $record_name ? $record_name . ' ' : ''; ?>Record</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-1">
                        <i class="text-danger fa fa-exclamation-triangle fa-3x"></i>
                    </div>
                    <div class="col-md-11">
                        <p>This action cannot be undone.</p>
                        <p>You still want to delete this record?</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a id="delete_record_btn" class="btn btn-danger" href="<?=$delete_url;?>"><i class="fa fa-trash fa-fw"></i> Delete</a>
                <button id="cancel_delete_btn" type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-ban fa-fw"></i> Cancel</button>
            </div>
        </div>
    </div>
</div>