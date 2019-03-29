<?php

use yii\bootstrap\ActiveForm;
?>
<div class="modal-content" >
    <div class="modal-header">
        <h4 class="modal-title">Account Information</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <div class="clearfix"></div>
    </div>
    <div class="alert alert-success alert-dismissable account-info-success" style="display: none;">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        Account Information Updated successfully.
    </div>
    <?php
    $form = ActiveForm::begin(
                    [
                        'id' => 'change-password',
                        'method' => 'post',
                    ]
    );
    ?>
    <div class="form-box">
        <div class="form-group">
            <label>Old Password</label>
            <input type="password" class="form-control" id="change-old-password" name="old-password" placeholder="Old Password*" />
        </div>
        <div class="form-group">
            <label>New Password</label>
            <input type="password" class="form-control" id="change-new-password" name="new-password" placeholder="New Password*" />
        </div>

        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" class="form-control" id="change-confirm-password" name="confirm-password" placeholder="Confirm Password*" />
        </div>
        <input name="" type="submit" value="SUBMIT" class="submit">
    </div>
    <?php ActiveForm::end(); ?>
</div>

