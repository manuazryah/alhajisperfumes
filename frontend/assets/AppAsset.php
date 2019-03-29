<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle {

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://fonts.googleapis.com/css?family=Gilda+Display|Montserrat:100,200,300,400,500,600,700,800,900|Raleway:100,200,300,400,500,600,700,800,900',
        'https://fonts.googleapis.com/css?family=Lora:400,700',
        'https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css',
        'https://use.fontawesome.com/releases/v5.0.13/css/all.css',
        'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.css',
        'https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css',
        'css/scrollbar-style.css',
        'css/pricefilterbar.css',
        'css/pricefilter.css',
        'css/magiczoom.css',
        'css/megamenu.css',
        'css/style.css',
        'css/custome.css',
        'css/responsive.css',
    ];
    public $js = [
//        'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js',
        'https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.js',
        'js/jquery.scrollbar.js',
        'js/pricefilter.js',
        'js/pricefilterbar.js',
        'js/magiczoom.js',
        'js/custome.js',
        'js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

}
