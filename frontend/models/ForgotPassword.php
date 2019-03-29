<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Login form
 */
class ForgotPassword extends Model {

    public $new_password;
    public $confirm_password;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
                [['new_password', 'confirm_password'], 'required'],
                ['confirm_password', 'compare', 'compareAttribute' => 'new_password', 'message' => "Passwords don't match"],
        ];
    }

}
