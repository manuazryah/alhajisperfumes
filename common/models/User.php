<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property integer $country
 * @property string $dob
 * @property integer $gender
 * @property string $mobile_no
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends ActiveRecord implements IdentityInterface {

	const STATUS_DELETED = 0;
	const STATUS_ACTIVE = 1;

	public $day;
	public $month;
	public $year;
	public $password;

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return '{{%user}}';
	}

	/**
	 * @inheritdoc
	 */
	public function behaviors() {
		return [
		    TimestampBehavior::className(),
		];
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['first_name', 'last_name', 'email'], 'required'],
			[['country', 'gender', 'status', 'created_at', 'updated_at', 'email_verification'], 'integer'],
			[['dob','DOC'], 'safe'],
			[['first_name', 'last_name', 'username', 'password'], 'string', 'max' => 50],
			[['mobile_no'], 'safe'],
			[['auth_key'], 'string', 'max' => 32],
			[['email'], 'unique'],
			[['created_at', 'updated_at', 'day', 'month', 'year', 'notification', 'country_code'], 'safe'],
			[['password_reset_token'], 'unique'],
//            ['status', 'default', 'value' => self::STATUS_ACTIVE],
//            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return [
		    'id' => 'ID',
		    'first_name' => 'First Name',
		    'last_name' => 'Last Name',
		    'country' => 'Country',
		    'dob' => 'Dob',
		    'gender' => 'Gender',
		    'country_code' => 'Country Code',
		    'mobile_no' => 'Mobile No',
		    'auth_key' => 'Auth Key',
		    'password_hash' => 'Password Hash',
		    'password_reset_token' => 'Password Reset Token',
		    'email' => 'Email',
		    'status' => 'Status',
		    'created_at' => 'Created At',
		    'updated_at' => 'Updated At',
		    'email_verification' => 'email verification',
		];
	}

	/**
	 * @inheritdoc
	 */
	public static function findIdentity($id) {
		return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
	}

	/**
	 * @inheritdoc
	 */
	public static function findIdentityByAccessToken($token, $type = null) {
		throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
	}

	/**
	 * Finds user by username
	 *
	 * @param string $username
	 * @return static|null
	 */
	public static function findByEmail($username) {

		return static::findOne(['email' => $username, 'status' => self::STATUS_ACTIVE]);
	}

	/**
	 * Finds user by password reset token
	 *
	 * @param string $token password reset token
	 * @return static|null
	 */
	public static function findByPasswordResetToken($token) {
		if (!static::isPasswordResetTokenValid($token)) {
			return null;
		}

		return static::findOne([
			    'password_reset_token' => $token,
			    'status' => self::STATUS_ACTIVE,
		]);
	}

	/**
	 * Finds out if password reset token is valid
	 *
	 * @param string $token password reset token
	 * @return bool
	 */
	public static function isPasswordResetTokenValid($token) {
		if (empty($token)) {
			return false;
		}

		$timestamp = (int) substr($token, strrpos($token, '_') + 1);
		$expire = Yii::$app->params['user.passwordResetTokenExpire'];
		return $timestamp + $expire >= time();
	}

	/**
	 * @inheritdoc
	 */
	public function getId() {
		return $this->getPrimaryKey();
	}

	/**
	 * @inheritdoc
	 */
	public function getAuthKey() {
		return $this->auth_key;
	}

	/**
	 * @inheritdoc
	 */
	public function validateAuthKey($authKey) {
		return $this->getAuthKey() === $authKey;
	}

	/**
	 * Validates password
	 *
	 * @param string $password password to validate
	 * @return bool if password provided is valid for current user
	 */
	public function validatePassword($password) {
		return Yii::$app->security->validatePassword($password, $this->password_hash);
	}

	/**
	 * Generates password hash from password and sets it to the model
	 *
	 * @param string $password
	 */
	public function setPassword($password) {
		$this->password_hash = Yii::$app->security->generatePasswordHash($password);
	}

	/**
	 * Generates "remember me" authentication key
	 */
	public function generateAuthKey() {
		$this->auth_key = Yii::$app->security->generateRandomString();
	}

	/**
	 * Generates new password reset token
	 */
	public function generatePasswordResetToken() {
		$this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
	}

	/**
	 * Removes password reset token
	 */
	public function removePasswordResetToken() {
		$this->password_reset_token = null;
	}

	public function getName() {
		return $this->first_name . ' ' . $this->last_name;
	}

	public function signup() {
		if (!$this->validate()) {
			return null;
		}

		$user = new User();
//        $user->username = $this->username;
		$user->first_name = $this->first_name;
		$user->last_name = $this->last_name;
		$user->gender = $this->gender;
		$user->dob = $this->dob;
		$user->email = $this->email;
		$user->country = $this->country;
		$user->mobile_no = $this->mobile_no;
		$user->setPassword($this->password);
		$user->generateAuthKey();
//if($user->save()){
//
//}else{
//    var_dump($user->getErrors());exit;
//}
		return $user->save() ? $user : null;
	}

	public static function Emailverification($user) {
		$token = $user->id . '_' . 123456;
		$val = base64_encode($token);

		$message = Yii::$app->mailer->compose('email_varification', ['model' => $user, 'val' => $val]) // a view rendering result becomes the message body here
			->setFrom('no-replay@perfumedunia.com')
			->setTo($user->email, $val)
			->setSubject('Email Verification');
		$message->send();
		return TRUE;
	}

	public static function Emailregister($user) {
		$message = Yii::$app->mailer->compose('new_registration', ['user' => $user])
			->setFrom('operations@perfumedunia.com')
			->setTo(Yii::$app->params['adminEmail'])
			->setSubject('New User Registration');
		$message->send();
	}

}