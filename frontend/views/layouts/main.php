<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
$action = Yii::$app->controller->id . '/' . Yii::$app->controller->action->id;
$params = $parameters = \yii::$app->getRequest()->getQueryParams();
$cart_count = common\components\Cartcount::Count();
$cart_total = common\components\Cartcount::Total();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex,nofollow">
        <link rel="shortcut icon" href="<?= Yii::$app->homeUrl ?>images/favicon.png">
        <?= Html::csrfMetaTags() ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
            var homeUrl = '<?= yii::$app->homeUrl; ?>';
        </script>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <body>
        <?php $this->beginBody() ?>
        <div class="header" id="myHeader">
            <div id="header-full">
                <div id="top-header" class="top-header">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4 logo-div">
                                <?= Html::a('<img src="' . yii::$app->homeUrl . 'images/logo.png" alt="Al-Hajis-Perfumes logo" class="img-fluid"/>', ['/site/index'], ['class' => 'navbar-brand']) ?>
                            </div>
                            <div class="col-xl-6 col-lg-5 col-md-5 col-sm-5 col-6 search-box-div">
                                <?= Html::beginForm(['/product/index'], 'get', ['id' => 'serach-formms', 'class' => 'search-box product-search-box']) ?>
                                <div class="form-group">
                                    <div class="input-group mx-auto">
                                        <input type="search" class="form-control py-2 border-right-0 border search-keyword" id="search-input" placeholder="Search Products" autocomplete="off" spellcheck="false" role="combobox" aria-autocomplete="list" aria-expanded="false" dir="auto" name="keyword" required value="<?php
                                        if (isset($_GET['keyword']) && $_GET['keyword'] != '') {
                                            echo $_GET['keyword'];
                                        }
                                        ?>" drop="search-key">
                                        <div class="search-keyword-dropdown search-key"></div>
                                        <span class="input-group-append">
                                            <button type="text" class="btn btn-outline-primary rounded-right" type="button">
                                                <i class="fas fa-search"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                                <?= Html::endForm() ?>
                            </div>
                            <div class="col-xl-2 col-lg-3 col-md-3 col-sm-3 col-2 pad0 login-div">
                                <div class="login">
                                    <ul>
                                        <li class="myaccount-btn" data-toggle="collapse" data-target="#myaccountpages" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                            <div class="logoin-icon">
                                                <i class="fas fa-lock"></i>
                                            </div>
                                            <?php
                                            if (!empty(Yii::$app->user->identity->first_name)) {
                                                if (strlen(Yii::$app->user->identity->first_name) >= 10) {
                                                    $name = substr(Yii::$app->user->identity->first_name, 0, 10) . '...';
                                                    $name = ucwords($name);
                                                } else {
                                                    $name = Yii::$app->user->identity->first_name;
                                                    $name = ucwords($name);
                                                }
                                            }
                                            ?>
                                            <a href="javascript:void(0)">
                                                <?php if (Yii::$app->user->isGuest) { ?>
                                                    Login
                                                    <?php
                                                } else {
                                                    echo 'Hello. ' . ucfirst($name);
                                                }
                                                ?>
                                            </a>
                                            <div class="collapse navbar-collapse" id="myaccountpages">
                                                <ul>
                                                    <?php if (!empty(Yii::$app->user->identity)) { ?>
                                                        <li>
                                                            <?= Html::a('My Orders', ['/myaccounts/my-orders/index'], ['title' => 'My Account']) ?>
                                                        </li>
                                                        <li>
                                                            <?= Html::a('Shipping Addresses', ['/myaccounts/user/user-address'], ['title' => 'My Account']) ?>
                                                        </li>
                                                        <li>
                                                            <?= Html::a('Wish Lists', ['/myaccounts/user/wish-list'], ['title' => 'My Account']) ?>
                                                        </li>
                                                        <li>
                                                            <?= Html::a('Account Settings', ['/myaccounts/user/personal-info'], ['title' => 'My Account']) ?>
                                                        </li>
                                                        <?php
                                                        echo '<li class="first">'
                                                        . Html::beginForm(['/site/logout'], 'post') . '<a>'
                                                        . Html::submitButton(
                                                                'Logout', ['style' => 'background-color: transparent;border: none;padding: 0px 0px 0px 0px;color:#fff;']
                                                        ) . '</a>'
                                                        . Html::endForm()
                                                        . '</li>';
                                                        ?>
                                                    <?php } else { ?>
                                                        <li>
                                                            <?= Html::a('Login', ['/site/login-signup'], ['title' => 'Login']) ?>
                                                        </li>
                                                        <li>
                                                            <?= Html::a('Register', ['/site/signup'], ['title' => 'Register']) ?>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="header-nav">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-11 col-lg-11 col-md-11 col-sm-11 col-11">
                                <nav class="navbar navbar-expand-lg navbar-light">
                                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                    </button>

                                    <div class="collapse navbar-collapse" id="navbarSupportedContent">

                                        <ul class="ruby-menu navbar-nav float-left">
                                            <li class="nav-item <?= $action == 'site/index' ? 'active' : '' ?>">
                                                <?= Html::a('Home<span class="sr-only">(current)</span>', ['/site/index'], ['class' => 'nav-link']) ?>
                                            </li>

                                            <li class="nav-item  ruby-menu-mega ">
                                                <?= Html::a('Fragrances', ['#'], ['class' => 'nav-link']) ?>

                                                <div class="ruby-grid ruby-grid-lined dropdown-content">
                                                    <div class="row">
                                                        <div class="col-xl-7 col-lg-12 col-md-9 col-sm-9 col-9 pr0">
                                                            <ul class="offers-drop">
                                                                <li class="<?php if (isset($params['category']) && $params['category'] == 'women') { ?> active <?php } ?>"><?= Html::a('Women', ['/product/index', 'type' => 'women'], ['class' => 'nav-link fregrance', 'id' => 'women']) ?></li>
                                                                <li class="<?php if (isset($params['category']) && $params['category'] == 'men') { ?> active <?php } ?>"><?= Html::a('Men', ['/product/index', 'type' => 'men'], ['class' => 'nav-link fregrance', 'id' => 'men']) ?></li>
                                                                <li class="<?php if (isset($params['category']) && $params['category'] == 'arabic-perfumes') { ?> active <?php } ?>"><?= Html::a('Oriental Perfumes', ['/product/index', 'category' => 'arabic-perfumes'], ['class' => 'nav-link fregrance', 'id' => 'arabic-perfumes']) ?></li>
                                                                <li class="<?php if (isset($params['category']) && $params['category'] == 'gift-sets') { ?> active <?php } ?>"><?= Html::a('Gift Set', ['/product/index', 'category' => 'gift-sets'], ['class' => 'nav-link fregrance', 'id' => 'gift-sets']) ?></li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-5 hidden-md hidden-sm hidden-xs pad0 ad-div">
                                                            <ul class="list-unstyled drop-ad pl0">
                                                                <div class="row">
                                                                    <li class="pr0 mtop0 fregranceimage fregranceimage_women">
                                                                        <a href="#"><img src="<?= Yii::$app->homeUrl ?>images/woman_perfume.jpg" class="img-fluid"/></a>
                                                                    </li>
                                                                    <li class="pr0 mtop0 fregranceimage hide fregranceimage_men">
                                                                        <a href="#"><img src="<?= Yii::$app->homeUrl ?>images/men_perfume.jpg" class="img-fluid"/></a>
                                                                    </li>
                                                                    <li class="pr0 mtop0 fregranceimage hide fregranceimage_arabic-perfumes">
                                                                        <a href="#"><img src="<?= Yii::$app->homeUrl ?>images/oriental_perfume.jpg" class="img-fluid"/></a>
                                                                    </li>
                                                                    <li class="pr0 mtop0 fregranceimage hide fregranceimage_gift-sets">
                                                                        <a href="#"><img src="<?= Yii::$app->homeUrl ?>images/gift_perfume.jpg" class="img-fluid"/></a>
                                                                    </li>
                                                                </div>
                                                                <div class="clear"></div>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>

                                            <li class="nav-item ruby-menu-mega <?php if (isset($params['category']) && $params['category'] == 'exclusive-brands') { ?> active <?php } ?>">
                                            </li>

                                            <li class="nav-item  ruby-menu-mega ">
                                                <?= Html::a('Beauty', ['#'], ['class' => 'nav-link']) ?>

                                                <div class="ruby-grid ruby-grid-lined dropdown-content">
                                                    <div class="row">
                                                        <div class="col-xl-7 col-lg-12 col-md-9 col-sm-9 col-9 pr0">
                                                            <ul class="offers-drop">
                                                                <li class=""><?= Html::a('Make Up', ['/product/index', 'category' => 'make-up'], ['class' => 'nav-link beauty', 'id' => 'make_up']) ?></li>
                                                                <li class=""><?= Html::a('Hair Mist', ['/product/index', 'category' => 'hair-mist'], ['class' => 'nav-link beauty', 'id' => 'hair_mist']) ?></li>
                                                                <li class=""><?= Html::a('After Shave', ['/product/index', 'category' => 'after-shave'], ['class' => 'nav-link beauty', 'id' => 'after_shave']) ?></li>
                                                                <li class=""><?= Html::a('Body Cream/Lotion', ['/product/index', 'category' => 'body-cream'], ['class' => 'nav-link beauty', 'id' => 'body_cream']) ?></li>
                                                                <li class=""><?= Html::a('Deodrant', ['/product/index', 'category' => 'deodrant'], ['class' => 'nav-link beauty', 'id' => 'deodrant']) ?></li>
                                                                <li class=""><?= Html::a('Bakhoor', ['/product/index', 'category' => 'bakhoor'], ['class' => 'nav-link beauty', 'id' => 'bonjour']) ?></li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-5 hidden-md hidden-sm hidden-xs pad0 ad-div">
                                                            <ul class="list-unstyled drop-ad pl0">
                                                                <div class="row">
                                                                    <li class="pr0 mtop0 beautyimage beautyimage_make_up">
                                                                        <a href="#"><img src="<?= Yii::$app->homeUrl ?>images/make_up.jpg" class="img-fluid"/></a>
                                                                    </li>
                                                                    <li class="pr0 mtop0 beautyimage hide beautyimage_hair_mist">
                                                                        <a href="#"><img src="<?= Yii::$app->homeUrl ?>images/hairmist.jpg" class="img-fluid"/></a>
                                                                    </li>
                                                                    <li class="pr0 mtop0 beautyimage hide beautyimage_after_shave">
                                                                        <a href="#"><img src="<?= Yii::$app->homeUrl ?>images/after_shave.jpg" class="img-fluid"/></a>
                                                                    </li>
                                                                    <li class="pr0 mtop0 beautyimage hide beautyimage_body_cream">
                                                                        <a href="#"><img src="<?= Yii::$app->homeUrl ?>images/body_cream.jpg" class="img-fluid"/></a>
                                                                    </li>
                                                                    <li class="pr0 mtop0 beautyimage hide beautyimage_deodrant">
                                                                        <a href="#"><img src="<?= Yii::$app->homeUrl ?>images/deoderant.jpg" class="img-fluid"/></a>
                                                                    </li>
                                                                    <li class="pr0 mtop0 beautyimage hide beautyimage_bonjour">
                                                                        <a href="#"><img src="<?= Yii::$app->homeUrl ?>images/bonjour.jpg" class="img-fluid"/></a>
                                                                    </li>
                                                                </div>
                                                                <div class="clear"></div>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class=""> <?= Html::a('Our Stores', ['/site/branches'], ['class' => 'nav-link']) ?></li>
                                            <li class=""> <?= Html::a('About', ['/site/about'], ['class' => 'nav-link']) ?></li>
                                            <li class=""> <?= Html::a('Contact Us', ['/site/contact'], ['class' => 'nav-link']) ?></li>
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                            <ul class="navbar-nav mr-auto cart fright col-xl-1 col-lg-1 col-md-1 col-sm-1 col-1">
                                <li class="button-dropdown"><a href="javascript:void(0)" class="dropdown-toggle" onclick="myFunction()"><i class="cart-bag"><span class="cart_count"><?= $cart_count ?></span></i></a>
                                    <div class="dropdown-menu shopping-cart">
                                        <div class="shopping-cart-header">
                                            <i class="fa fa-shopping-basket" aria-hidden="true"></i><span class="badge cart_count">(<?= $cart_count ?>)</span>
                                            <div class="shopping-cart-total">
                                                <span class="lighter-text">Total:</span>
                                                <span class="main-color-text cart_amount"><?= $cart_total ?></span>
                                            </div>
                                        </div>
                                        <ul class="shopping-cart-items">
                                            <?= common\components\CartDetailWidget::widget() ?>
                                        </ul>
                                        <div class="col-md-12 checkout-btn-space">
                                            <?= Html::a('View cart', ['/cart/mycart'], ['class' => 'top-checkbox-button']) ?>
                                            <?= Html::a('Check out', ['/cart/proceed'], ['class' => 'top-checkbox-button bg-dark']) ?>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
            </div>

            <div id="header-scroll" class="">
                <div class="top-header">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-4 logo-div">
                                <?= Html::a('<img src="' . yii::$app->homeUrl . 'images/logo.png" alt="Al-Hajis-Perfumes logo" class="img-fluid"/>', ['/site/index'], ['class' => 'navbar-brand']) ?>
                            </div>
                            <div class="col-xl-9 col-lg-9 col-md-8 col-sm-8 col-8">
                                <div class="row">
                                    <div class="search-box-div">
                                        <?= Html::beginForm(['/product/index'], 'get', ['id' => 'serach-formms', 'class' => 'search-box product-search-box']) ?>
                                        <div class="search-box">
                                            <div class="form-group">
                                                <div class="input-group mx-auto">
                                                    <input type="search" class="form-control py-2 border-right-0 border search-keyword" id="search-input" placeholder="Search Products" autocomplete="off" spellcheck="false" role="combobox" aria-autocomplete="list" aria-expanded="false" dir="auto" name="keyword" required value="<?php
                                                    if (isset($_GET['keyword']) && $_GET['keyword'] != '') {
                                                        echo $_GET['keyword'];
                                                    }
                                                    ?>" drop="search-key">
                                                    <div class="search-keyword-dropdown search-key"></div>
                                                    <span class="input-group-append">
                                                        <button class="btn btn-outline-primary rounded-right" type="button">
                                                            <i class="fas fa-search"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <?= Html::endForm() ?>
                                    </div>
                                    <ul class="header-scroll-ul">
                                        <li class="header-scroll-li">
                                            <div class="login">
                                                <ul>
                                                    <li class="myaccount-btn" data-toggle="collapse" data-target="#myaccountpages" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                                        <div class="logoin-icon">
                                                            <i class="fas fa-lock"></i>
                                                        </div>
                                                        <a href="javascript:void(0)">
                                                            <?php if (Yii::$app->user->isGuest) { ?>
                                                                Login
                                                                <?php
                                                            } else {
                                                                echo 'Hello. ' . ucfirst($name);
                                                            }
                                                            ?>
                                                        </a>
                                                        <div class="collapse navbar-collapse" id="myaccountpages">
                                                            <ul>
                                                                <?php if (!empty(Yii::$app->user->identity)) { ?>
                                                                    <li>
                                                                        <?= Html::a('My Orders', ['/myaccounts/my-orders/index'], ['title' => 'My Account']) ?>
                                                                    </li>
                                                                    <li>
                                                                        <?= Html::a('Shipping Addresses', ['/myaccounts/user/user-address'], ['title' => 'My Account']) ?>
                                                                    </li>
                                                                    <li>
                                                                        <?= Html::a('Wish Lists', ['/myaccounts/user/wish-list'], ['title' => 'My Account']) ?>
                                                                    </li>
                                                                    <li>
                                                                        <?= Html::a('Account Settings', ['/myaccounts/user/personal-info'], ['title' => 'My Account']) ?>
                                                                    </li>
                                                                    <?php
                                                                    echo '<li class="first">'
                                                                    . Html::beginForm(['/site/logout'], 'post') . '<a>'
                                                                    . Html::submitButton(
                                                                            'Logout', ['style' => 'background-color: transparent;border: none;padding: 0px 0px 0px 0px;color:#fff;']
                                                                    ) . '</a>'
                                                                    . Html::endForm()
                                                                    . '</li>';
                                                                    ?>
                                                                <?php } else { ?>
                                                                    <li>
                                                                        <?= Html::a('Login', ['/site/login-signup'], ['title' => 'Login']) ?>
                                                                    </li>
                                                                    <li>
                                                                        <?= Html::a('Register', ['/site/signup'], ['title' => 'Register']) ?>
                                                                    </li>
                                                                <?php } ?>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li class="active-search header-scroll-li">
                                            <i class="fa fa-search" aria-hidden="true"></i>
                                            <div class="search-box search-box1">
                                                <?= Html::beginForm(['/product/index'], 'get', ['id' => 'serach-formm', 'class' => 'product-search-box']) ?>
                                                <div class="form-group">
                                                    <div class="input-group mx-auto">
                                                        <input type="search" class="form-control py-2 border-right-0 border search-keyword" id="search-input" placeholder="Search Products" autocomplete="off" spellcheck="false" role="combobox" aria-autocomplete="list" aria-expanded="false" dir="auto" name="keyword" required value="<?php
                                                        if (isset($_GET['keyword']) && $_GET['keyword'] != '') {
                                                            echo $_GET['keyword'];
                                                        }
                                                        ?>" drop="search-key-other">
                                                        <div class="search-keyword-dropdown search-key-other"></div>
                                                        <span class="input-group-append">
                                                            <button class="btn btn-outline-primary rounded-right" type="button">
                                                                <i class="fas fa-search"></i>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <?= Html::endForm() ?>
                                        </li>
                                        <li class="cart header-scroll-li">
                                            <div class="navbar-nav cart button-dropdown">
                                                <a href="javascript:void(0)" class="dropdown-toggle" onclick="myFunction()"><i class="cart-bag"><span class="cart_count"><?= $cart_count ?></span></i></a>
                                                <div class="dropdown-menu shopping-cart">
                                                    <div class="shopping-cart-header">
                                                        <i class="fa fa-shopping-basket" aria-hidden="true"></i><span class="badge cart_count">(<?= $cart_count ?>)</span>
                                                        <div class="shopping-cart-total">
                                                            <span class="lighter-text">Total:</span>
                                                            <span class="main-color-text cart_amount"><?= $cart_total ?></span>
                                                        </div>
                                                    </div>
                                                    <ul class="shopping-cart-items">
                                                        <?= common\components\CartDetailWidget::widget() ?>
                                                    </ul>
                                                    <div class="col-md-12 checkout-btn-space">
                                                        <?= Html::a('View cart', ['/cart/mycart'], ['class' => 'top-checkbox-button']) ?>
                                                        <?= Html::a('Check out', ['/cart/proceed'], ['class' => 'top-checkbox-button bg-dark']) ?>                                       <!--<button class="green2">check out</button>-->
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="header-scroll-li">
                                            <nav class="navbar navbar-expand-lg navbar-light">
                                                                    <!--<a class="navbar-brand" href="index.php"><img src="images/logo.png" alt="Al-Hajis-Perfumes logo" class="img-responsive"/></a>-->
                                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#header-scroll-menu" aria-controls="header-scroll-menu" aria-expanded="false" aria-label="Toggle navigation">
                                                    <span class="navbar-toggler-icon"></span>
                                                </button>

                                                <div class="collapse navbar-collapse" id="header-scroll-menu">
                                                    <ul class="ruby-menu navbar-nav">
                                                        <li class="<?= $action == 'site/index' ? 'active' : '' ?>">
                                                            <?= Html::a('Home<span class="sr-only">(current)</span>', ['/site/index'], ['class' => 'nav-link']) ?>
                                                        </li>


                                                        <li class="ruby-menu-mega-blog"><a href="#">Fragrances</a>
                                                            <div class="ruby-grid ruby-grid-lined dropdown-content scroll-offer">
                                                                <div class="row">
                                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-12 pr0">
                                                                        <ul class="offers-drop">
                                                                            <li class="<?php if (isset($params['category']) && $params['category'] == 'women') { ?> active <?php } ?>"><?= Html::a('Women', ['/product/index', 'type' => 'women'], ['class' => 'nav-link fregrance', 'id' => 'women']) ?></li>
                                                                            <li class="<?php if (isset($params['category']) && $params['category'] == 'men') { ?> active <?php } ?>"><?= Html::a('Men', ['/product/index', 'type' => 'men'], ['class' => 'nav-link fregrance', 'id' => 'men']) ?></li>
                                                                            <li class="<?php if (isset($params['category']) && $params['category'] == 'arabic-perfumes') { ?> active <?php } ?>"><?= Html::a('Oriental Perfumes', ['/product/index', 'category' => 'arabic-perfumes'], ['class' => 'nav-link fregrance', 'id' => 'arabic-perfumes']) ?></li>
                                                                            <li class="<?php if (isset($params['category']) && $params['category'] == 'gift-sets') { ?> active <?php } ?>"><?= Html::a('Gift Set', ['/product/index', 'category' => 'gift-sets'], ['class' => 'nav-link fregrance', 'id' => 'gift-sets']) ?></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>


                                                        <li class="ruby-menu-mega <?php if (isset($params['category']) && $params['category'] == 'exclusive-brands') { ?> active <?php } ?>"><?= Html::a('Exclusive Brands', ['/product/index', 'category' => 'exclusive-brands'], ['class' => '']) ?>
                                                        </li>
                                                        <li class="ruby-menu-mega-blog"><a href="#">Beauty</a>
                                                            <div class="ruby-grid ruby-grid-lined dropdown-content scroll-offer">
                                                                <div class="row">
                                                                    <div class="col-xl-12 col-lg-12 col-md-12 col-12 pr0">
                                                                        <ul class="offers-drop">
                                                                            <li class=""><?= Html::a('Make Up', [''], ['class' => 'nav-link beauty', 'id' => 'make_up']) ?></li>
                                                                            <li class=""><?= Html::a('Hair Mist', [''], ['class' => 'nav-link beauty', 'id' => 'hair_mist']) ?></li>
                                                                            <li class=""><?= Html::a('After Shave', [''], ['class' => 'nav-link beauty', 'id' => 'after_shave']) ?></li>
                                                                            <li class=""><?= Html::a('Body Cream/Lotion', [''], ['class' => 'nav-link beauty', 'id' => 'body_cream']) ?></li>
                                                                            <li class=""><?= Html::a('Deodrant', [''], ['class' => 'nav-link beauty', 'id' => 'deodrant']) ?></li>
                                                                            <li class=""><?= Html::a('bakhoor', [''], ['class' => 'nav-link beauty', 'id' => 'bonjour']) ?></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class=""> <?= Html::a('Our Stores', ['/site/branches'], ['class' => 'nav-link']) ?></li>
                                                        <li class=""> <?= Html::a('About', ['/site/about'], ['class' => 'nav-link']) ?></li>
                                                        <li class=""> <?= Html::a('Contact Us', ['/site/contact'], ['class' => 'nav-link']) ?></li>
                                                    </ul>

                                                </div>
                                            </nav>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <?= $content ?>
        <footer>
            <div class="container">
                <div class="newsletter">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-5 col-sm-12 col-12">
                            <div class="icon-box">
                                <icon><img src="<?= yii::$app->homeUrl; ?>images/icons/newsletter.png" class="img-fluid"/></icon>
                                <div class="heading">
                                    <p>Sign up to</p>
                                    <h4>NEWSLETTER</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-7 col-md-7 col-sm-12 col-12">
                            <div class="form-box">
                                <form id="email-subscription">
                                    <div class="search-box">
                                        <div class="form-group" id="after-sbscribe">
                                            <div class="input-group mx-auto">
                                                <input type="email" class="form-control py-2 border-right-0 border"  placeholder="Enter your Email Address" required id="newsletter-email">
                                                <span class="input-group-append">
                                                    <button class="btn btn-outline-primary rounded-right" type="submit">
                                                        send
                                                    </button>
                                                </span>

                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="footer">
                    <div class="row">
                        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                            <img src="<?= yii::$app->homeUrl; ?>images/logo.png" class="img-fluid foot-logo"/>
                            <p class="foot-abt">Al Hajis Group of companies was established in Abu hail centre ,UAE in the year 1990.The Al Hajis group,now has grown into a conglomerate of more than 10 show rooms with various divisions, brands.</p>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12">
                            <h5 class="heading">Information</h5>
                            <ul>
                                <li>
                                    <?= Html::a('About Us', ['/site/about'], ['title' => 'About Us']) ?>
                                </li>
                                <li>
                                    <?= Html::a('Brands', ['/brand/index'], ['title' => 'Brands']) ?>
                                </li>
                                <li><?= Html::a('Delivery Information', ['/site/delivery-information'], ['title' => 'Delivery Information']) ?></li>
                                <li><?= Html::a('Privacy Policy', ['/site/privacy-policy'], ['title' => 'Delivery Information']) ?></li>
                                <li><?= Html::a('Terms & Conditions', ['/site/terms-condition'], ['title' => 'Delivery Information']) ?></li>
                                <li>
                                    <?= Html::a('Contact Us', ['/site/contact'], ['title' => 'About Us']) ?>
                                </li>
                            </ul>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12">
                            <h5 class="heading">My Account</h5>
                            <ul>
                                <li>
                                    <?= Html::a('My Orders', ['/myaccounts/my-orders/index'], ['title' => 'My Orders']) ?>
                                </li>
                                <li>
                                    <?= Html::a('Wish Lists', ['/myaccounts/user/wish-list'], ['title' => 'Wish List']) ?>
                                </li>
                                <li>
                                    <?= Html::a('Account Settings', ['/myaccounts/user/personal-info'], ['title' => 'Account Seettings']) ?>
                                </li>
                            </ul>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-12">
                            <h5 class="heading">Contact us</h5>
                            <p>Al hajis Perfumes ,Abuhail Centre GR9 Hor al Anz East ,PB No 14448 Dubai ,United Arab Emirates</p>
                            <h5 class="heading below_heading">Customer Support</h5>
                            <ul class="support">
                                <li>Dubai- <a href="tel:+971-4-2692067">+971-4-2692067</a></li>
                                <li>Sharjah- <a href="tel:+971-55-1267733">+971-55-1267733</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
            <div class="bottom-footer">
                <div class="container">
                    <p id="copyright">Copyright © <script>document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script> Al-Hajis Perfumes L.L.C .All Rights Reserved</p>
                </div>
            </div>
        </footer>

        <?php $this->endBody() ?>

    </body>
</html>
<?php $this->endPage() ?>
<script>
    $(document).ready(function () {
        $(document).on('submit', '#email-subscription', function (e) {
            e.preventDefault();

            $.ajax({
                type: "POST",
                url: '<?= Yii::$app->homeUrl; ?>site/subscribe-mail',
                data: {email: $('#newsletter-email').val()},
                success: function (data)
                {
                    if (data == 0) {
                        $('#after-sbscribe').after('<div id="email-alert" style="font-size: 12px;padding-left: 25px;color: greenyellow;position: absolute;">This Email is Already Subscribed</div>');
                    } else {
                        $('#after-sbscribe').after('<div id="email-alert" style="font-size: 12px;padding-left: 25px;color: greenyellow;position: absolute;">Your Email Subscription Send Successfully</div>');
                    }
                    $('#newsletter-email').val('');
                    $('#email-alert').delay(1000).fadeOut('slow');
                }
            });
        });
    });
</script>