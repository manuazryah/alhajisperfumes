<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\User;
use common\models\ForgotPasswordTokens;
use frontend\models\SignupForm;
use frontend\models\LoginForm;
use common\models\Slider;
use common\models\Subscribe;
use common\models\ContactUs;
use common\models\Principals;
use common\models\About;
use common\models\ContactPage;
use common\models\CmsMetaTags;
use common\models\ProductListing;

/**
 * Site controller
 */
class SiteController extends Controller {

    /**
     * @inheritdoc
     */
//    public password;

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup', 'login-signup', 'product-detail', 'our-products', 'verification', 'send-response-mail', 'subscribe'],
                'rules' => [
                    [
                        'actions' => ['signup', 'login-signup', 'product-detail', 'our-products', 'verification', 'send-response-mail', 'subscribe'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'signup', 'login-signup', 'product-detail', 'our-products', 'verification', 'send-response-mail', 'subscribe'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex() {
        $about = About::find()->where(['id' => 1])->one();
        $sliders = Slider::find()->where(['status' => 1])->all();
        $our_latest_products = ProductListing::findOne(1);
        $our_featured_products = ProductListing::findOne(2);
        $brands = \common\models\Brand::find()->where(['show_menu' => 1])->orderBy(['id' => SORT_DESC])->all();
        $fav_brands = \common\models\Brand::find()->where(['favourite_brand' => 1])->orderBy(['id' => SORT_DESC])->all();
        $branches = \common\models\Branches::find()->where(['status' => 1])->orderBy(['id' => SORT_DESC])->all();
        $home_datas = \common\models\HomeManagement::find()->orderBy(['sort_order' => SORT_ASC])->all();
        $meta_tags = CmsMetaTags::find()->where(['id' => 1])->one();
        \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $meta_tags->meta_keyword]);
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $meta_tags->meta_description]);
        return $this->render('index', [
                    'sliders' => $sliders,
                    'our_latest_products' => $our_latest_products,
                    'our_featured_products' => $our_featured_products,
                    'brands' => $brands,
                    'fav_brands' => $fav_brands,
                    'branches' => $branches,
                    'home_datas' => $home_datas,
                    'meta_title' => $meta_tags->meta_title,
                    'about' => $about,
        ]);
    }

    /**
     * Displays About Page.
     *
     * @return mixed
     */
    public function actionAbout() {

        $about = About::find()->where(['id' => 1])->one();
        $testimonials = \common\models\Testimonials::find()->all();
        $meta_tags = CmsMetaTags::find()->where(['id' => 1])->one();
        $branches = \common\models\Branches::find()->where(['status' => 1])->orderBy(['id' => SORT_DESC])->all();
        \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $meta_tags->meta_keyword]);
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $meta_tags->meta_description]);
        return $this->render('about', [
                    'about' => $about,
                    'meta_title' => $meta_tags->meta_title,
                    'branches' => $branches,
                    'testimonials' => $testimonials,
        ]);
    }

    /**
     * Displays Store Locator Page .
     *
     * @return mixed
     */
    public function actionStoreLocator() {
        $meta_tags = CmsMetaTags::find()->where(['id' => 4])->one();
        \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $meta_tags->meta_keyword]);
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $meta_tags->meta_description]);
        return $this->render('store-locator', [
                    'meta_title' => $meta_tags->meta_title,
        ]);
    }

    /**
     * Displays Contact Page.
     *
     * @return mixed
     */
    public function actionContact() {
        $status = '';
        $model = new ContactUs();
        $contact = ContactPage::findOne(1);
        $meta_tags = CmsMetaTags::find()->where(['id' => 7])->one();
        $branches = \common\models\Branches::find()->where(['status' => 1])->orderBy(['sort_order' => SORT_ASC])->all();
        \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $meta_tags->meta_keyword]);
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $meta_tags->meta_description]);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save(FALSE)) {
                $status = 1;
                Yii::$app->getSession()->setFlash('success', 'Enquiry submitted successfully');
                //$this->sendContactMail($model);
            }
        }
        return $this->render('contact', [
                    'contact' => $contact,
                    'model' => $model,
                    'status' => $status,
                    'meta_title' => $meta_tags->meta_title,
                    'branches' => $branches,
        ]);
    }

    /**
     * Displays Login Page.
     *
     * @return mixed
     */
    public function actionLoginSignup($go = NULL) {
        if (!Yii::$app->user->isGuest) {
            $this->redirect(['/site/index']);
        }
        $model_login = new LoginForm();
        $model = new SignupForm();
        $meta_tags = CmsMetaTags::find()->where(['id' => 16])->one();
        \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $meta_tags->meta_keyword]);
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $meta_tags->meta_description]);
        return $this->render('login-signup', [
                    'model_login' => $model_login,
                    'model' => $model,
                    'meta_title' => $meta_tags->meta_title,
                    'go' => $go,
        ]);
    }

    public function actionLogin($go = null) {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        Yii::$app->session['log-return'] = '';
        $model_login = new LoginForm();
        $model = new SignupForm();
        $meta_tags = CmsMetaTags::find()->where(['id' => 16])->one();
        \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $meta_tags->meta_keyword]);
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $meta_tags->meta_description]);
        if ($model_login->load(Yii::$app->request->post()) && $model_login->login()) {
            $user = User::findOne(Yii::$app->user->identity->id);
            Yii::$app->session['log-return'] = '';
            if (empty($go)) {
                return $this->redirect(Yii::$app->request->referrer);
            }
            return $this->redirect($go);
        } else {
            Yii::$app->session['log-return'] = 1;
            return $this->render('login-signup', [
                        'model_login' => $model_login,
                        'model' => $model,
                        'meta_title' => $meta_tags->meta_title,
                        'go' => $go,
            ]);
        }
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup($go = NULL) {
        $model = new SignupForm();
        $meta_tags = CmsMetaTags::find()->where(['id' => 13])->one();
        \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $meta_tags->meta_keyword]);
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $meta_tags->meta_description]);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($user = $model->signup()) {

                //$this->sendResponseMail($model);
                if (Yii::$app->getUser()->login($user)) {
                    $this->Emailregister($user);
                    $this->Emailverification($user);
                    if ($go) {
                        return $this->redirect($go);
                    } else {
                        return $this->goHome();
                    }
                }
            }
        }

        return $this->render('signup', [
                    'model' => $model,
                    'meta_title' => $meta_tags->meta_title,
        ]);
    }

    /**
     * After successful registration send message to the user
     *
     * @return mixed
     */
    public function Emailregister($user) {
        $message = Yii::$app->mailer->compose('new_registration', ['user' => $user])
                ->setFrom('noreply@alhajisperfumes.ae')
                ->setTo(Yii::$app->params['adminEmail'])
                ->setSubject('New User Registration');
        $message->send();
    }

    /**
     * After successful registration send email verification link to the user
     *
     * @return mixed
     */
    public function Emailverification($user) {

        $userid = yii::$app->EncryptDecrypt->Encrypt('encrypt', $user->id);
        $message = Yii::$app->mailer->compose('email_varification', ['model' => $user, 'val' => $userid]) // a view rendering result becomes the message body here
                ->setFrom('no-reply@alhajisperfumes.ae')
                ->setTo(Yii::$app->user->identity->email)
                ->setSubject('Email Varification');
        $message->send();
        return TRUE;
    }

    /**
     * Email Verification for new user
     *
     * @return mixed
     */
    public function actionVerification($verify) {
        $data = base64_decode($verify);
        $values = explode('_', $data);

        $model = User::find()->where(['id' => $values[0]])->one();

        if (!empty($model)) {
            $model->email_verification = 1;
            $model->save();
            return $this->redirect(array('site/login'));
        } else {
            return $this->redirect(array('site/index'));
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout() {
        Yii::$app->user->logout();
        Yii::$app->session['orderid'] = '';
        return $this->goHome();
    }

    public function actionTermsCondition() {
        $model = Principals::findOne(1);
        $meta_tags = CmsMetaTags::find()->where(['id' => 9])->one();
        \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $meta_tags->meta_keyword]);
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $meta_tags->meta_description]);
        return $this->render('terms_condition', [
                    'model' => $model,
                    'meta_title' => $meta_tags->meta_title,
        ]);
    }

    public function actionPrivacyPolicy() {
        $model = Principals::findOne(1);
        $meta_tags = CmsMetaTags::find()->where(['id' => 11])->one();
        \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $meta_tags->meta_keyword]);
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $meta_tags->meta_description]);
        return $this->render('privacy_policy', [
                    'model' => $model,
                    'meta_title' => $meta_tags->meta_title,
        ]);
    }

    public function actionDeliveryInformation() {
        $model = Principals::findOne(1);
        $meta_tags = CmsMetaTags::find()->where(['id' => 12])->one();
        \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $meta_tags->meta_keyword]);
        \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $meta_tags->meta_description]);
        return $this->render('delivery_information', [
                    'model' => $model,
                    'meta_title' => $meta_tags->meta_title,
        ]);
    }

    public function actionSubscribe() {
        $email = $_POST['subscribe-mail'];
        $model = new Subscribe();
        $model->email = $email;
        $model->date = date('Y-m-d');
        if ($model->save()) {
            $message = Yii::$app->mailer->compose('newsletter', ['model' => $model])
                    ->setFrom('noreply@alhajisperfumes.ae')
                    ->setTo($model->email)
                    ->setSubject('Email Subscription');
            $message->send();
        }
    }

    public function actionForgot() {
        $model = new User();
        if ($model->load(Yii::$app->request->post())) {
            $check_exists = User::find()->where(['email' => $model->email])->one();
            if (!empty($check_exists)) {
                $token_value = $this->tokenGenerator();
                $token = $check_exists->id . '_' . $token_value;
                $val = yii::$app->EncryptDecrypt->Encrypt('encrypt', $token);
                $token_model = new ForgotPasswordTokens();
                $token_model->user_id = $check_exists->id;
                $token_model->token = $token_value;
                $token_model->save();
                $this->sendMail($val, $check_exists);
                Yii::$app->getSession()->setFlash('success', 'A verification email has been sent to ' . $check_exists->email . ', please check the spam box if you can not find the mail in your inbox. ');
            } else {
                Yii::$app->getSession()->setFlash('error', 'Invalid Email');
            }
        } return $this->render('forgot-password', [
                    'model' => $model,
        ]);
    }

    public function tokenGenerator() {

        $length = rand(1, 1000);
        $chars = array_merge(range(0, 9));
        shuffle($chars);
        $token = implode(array_slice($chars, 0, $length));
        return $token;
    }

    public function sendMail($val, $model) {

        $message = Yii::$app->mailer->compose('forgot_mail', ['model' => $model, 'val' => $val]) // a view rendering result becomes the message body here
                ->setFrom('no-reply@alhajisperfumes.ae')
                ->setTo($model->email)
                ->setSubject('Reset Password');
        $message->send();
        return TRUE;
    }

    public function actionNewPassword($token) {
        $data = yii::$app->EncryptDecrypt->Encrypt('decrypt', $token);
        $values = explode('_', $data);
        $token_exist = ForgotPasswordTokens::find()->where("user_id = " . $values[0] . " AND token = " . $values[1])->one();
        if (!empty($token_exist)) {
            $model = User::find()->where("id = " . $token_exist->user_id)->one();
            $model_form = new \frontend\models\ForgotPassword();
            if ($model_form->load(Yii::$app->request->post()) && $model_form->validate()) {
                $model->password_hash = Yii::$app->security->generatePasswordHash($model_form->confirm_password);
                $model->update();
                $token_exist->delete();
                Yii::$app->getSession()->setFlash('success', 'Password changed successfully. Please login!');
                return $this->redirect(['login-signup']);
            }
            return $this->render('new-password', [
                        'model' => $model,
                        'model_form' => $model_form
            ]);
        } else {
//			Yii::$app->getSession()->setFlash('error', 'Password Token not Found');
            $this->redirect('error');
        }
    }

    public function actionSubscribeMail() {
        if (Yii::$app->request->isAjax) {
            $email = $_POST['email'];
            if (!empty($email)) {
                $model = new \common\models\Subscribe();
                $model->email = $email;
                $model->date = date('Y-m-d');
                $exist = \common\models\Subscribe::find()->where(['email' => $email])->one();
                if (empty($exist)) {
                    if ($model->save()) {
                        $subject = 'Newsletter Subscription Enquiry From AL HAJIA';
                        $to = "info@alhajisperfumes.ae";
                        $message = $this->renderPartial('subscribe-mail', ['email' => $email,]);
                        $headers = "MIME-Version: 1.0" . "\r\n";
                        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        $headers .= 'From: <noreply@alhajisperfumes.ae>' . "\r\n";
                        mail($to, $subject, $message, $headers);
                        echo 1;
                        exit;
                    }
                } else {
                    echo 0;
                    exit;
                }
            }
        }
    }

    public function actionBranches() {
        $branches = \common\models\Branches::find()->where(['status' => 1])->orderBy(['id' => SORT_DESC])->all();
        return $this->render('branches', ['branches' => $branches]);
    }

}
