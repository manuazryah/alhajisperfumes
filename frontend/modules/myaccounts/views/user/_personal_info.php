<?php

use yii\bootstrap\ActiveForm;
?>
<div class="modal-content" >
    <div class="modal-header">
        <h4 class="modal-title">Personal Information</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <div class="clearfix"></div>
    </div>
    <div class="alert alert-success alert-dismissable account-info-success" style="display: none;">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        Personal Information Updated successfully.
    </div>
    <?php
    $form = ActiveForm::begin(
                    [
                        'id' => 'update-profile',
                        'method' => 'post',
                    ]
    );
    ?>
    <div class="form-box">
        <div class="form-group">
            <label>First Name</label>
            <input type="text" class="form-control" id="change-old-password" name="User[first_name]" value="<?= $model->first_name ?>" required=""/>
        </div>

        <div class="form-group">
            <label>Last Name</label>
            <input type="text" class="form-control" id="change-old-password" name="User[last_name]" value="<?= $model->last_name ?>" />
        </div>

        <div class="form-group">
            <label>DOB</label>
            <input type="date" class="form-control" id="change-old-password" name="User[dob]" value="<?= $model->dob ?>" />
        </div>

        <div class="form-group">
            <label>Mobile Number</label>
            <input type="text" class="form-control" id="change-old-password" name="User[mobile_no]" value="<?= $model->mobile_no ?>"  required=""/>
        </div>

        <input name="" type="submit" value="SUBMIT" class="submit">
    </div>
    <?php ActiveForm::end(); ?>
</div>

