<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\CountryCode;
use yii\helpers\ArrayHelper;

$this->title = 'My Account';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="top-margin"></div>
<section class="in-account-pages-section"><!--in-account-pages-section-->
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <?= \common\components\MyAccountMenuWidget::widget() ?>
            </div>
            <div class="col-lg-9">
                <div class="in-track-your-orders">
                    <div class="head-main-box">
                        <h3 class="head">Account Settings</h3>
                    </div>

                    <div class="in-account-settings">
                        <div class="settings-box">
                            <h2 class="head">Account Information</h2>
                            <ul class="list">
                                <li>Email: <span class="light">ajrency@gmail.com</span></li>
                                <li>Password: ********</li>
                            </ul>
                            <div class="edit-button"><a href="#exampleModal" class="link" data-toggle="modal">EDIT</a></div>
                            <div class="settings-edit-popup">
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                    <div class="modal-dialog modal-md" role="document">
                                        <div class="modal-content ">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Account Information</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                            </div>
                                            <form class="login-form">
                                                <div class="form-box">
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <input name="" type="text" class="form-control" placeholder="Title">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                        <input name="" type="text" class="form-control" placeholder="Title">
                                                    </div>
                                                    <input name="" type="submit" value="SEND" class="submit">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="settings-box">
                            <h2 class="head">Personal Information</h2>
                            <ul class="list">
                                <li>Name:Rency Daniel</li>
                                <li>Gender:Male</li>
                                <li>Nationality:Indian</li>
                                <li>Birthdate:1986-02-13</li>
                                <li>Country of Residence:United Arab Emirates</li>
                            </ul>
                            <div class="edit-button"><a href="#" class="link">EDIT</a></div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</section>