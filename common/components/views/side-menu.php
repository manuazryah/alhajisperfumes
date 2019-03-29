<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Product;

//use yii\widgets\Pjax;
$max_value = Product::find()->select('id')->max('price');
$min_value = Product::find()->select('id')->min('offer_price');

if (empty($minrange) && empty($maxrange)) {
    $minrange = 0;
    $maxrange = 2000;
}
$useragent = $_SERVER['HTTP_USER_AGENT'];
?>

<aside  class="col-lg-3">
    <?php
    if (preg_match('/android|avantgo|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4))) {
        ?>
        <div class="product-left-categories-mobile-view">
            <div class="filter-head">
                <h2 class="head-filter">Product Filter</h2>
                <ul class="filter-list">
                    <li class="list-li">
                        <div class="head-text-button" data-toggle="modal" data-target="#exampleModalLong"><i class="icon"></i>Filter</div>
                    </li>
                    <!-- <li class="list-li">
                       <div class="head-text-button"><i class="icon icon2"></i>Target Groups</div>
                     </li>-->
                </ul>
            </div>
            <!-- Modal -->
            <div class="modal" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="button-header">
                            <button type="button" class="close-button" data-dismiss="modal" aria-label="Close"></button>
                            <a href="" id="mob-filter-apply" class="filter-apply-button">apply</a>

                        </div>
                        <div class="modal-body">
                            <div class="filter-mobile-box"><!--filter-mobile-box-->
                                <button id="button" type="button" class="filter-list-button" data-toggle="collapse" data-target="#demo">
                                    <b class="left-b">Brand</b><span class="right-span">+</span>
                                </button>

                                <div id="demo" class="collapse categories-filter" val='button'>
                                    <div class="in-product-left-categories" ><!--in-left-Categories-->

                                        <div class="other-range-box">
                                            <div class="search-box">
                                                <form >
                                                    <div class="input-group">
                                                        <input type="text" class="form-control"  placeholder="Search by Brand"  value="">
                                                        <div class="input-group-addon">
                                                            <input  type="submit" class="send" >
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="container">
                                                <div class="content pad0">
                                                    <div class="demo">
                                                        <div class="scroll">
                                                            <div class="list-type">
                                                                <ul>
                                                                    <?php
                                                                    foreach ($brand_list as $brand) {
                                                                        ?>
                                                                        <li id="brand_checkboxes_mob">

                                                                            <label class="input-style-box">
                                                                                <?php $brand_id = str_replace(' ', '_', $brand->brand); ?>
                                                                                <input class="check_brand_mob" type="checkbox"  id="<?= strtolower($brand_id) ?>-mob" name="brand[]" atr-url="<?= strtolower($brand_id) ?>"value="<?= $brand->brand ?>"/>
                                                                               <!--<input name="" type="checkbox" value="">-->
                                                                                <span class="checkmark"></span> <?= $brand->brand ?> </label>
                                                                        </li>
                                                                    <?php } ?>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><!--filter-mobile-box-->
                            <div class="filter-mobile-box"><!--filter-mobile-box-->
                                <button id="button" type="button" class="filter-list-button" data-toggle="collapse" data-target="#demo1">
                                    <b class="left-b">Targeted Group</b><span class="right-span">+</span>
                                </button>

                                <div id="demo1" class="collapse categories-filter" val='button'>
                                    <div class="in-product-left-categories" ><!--in-left-Categories-->

                                        <div class="other-range-box">

                                            <div class="container">
                                                <div class="content pad0">
                                                    <div class="demo">
                                                        <div class="scroll">
                                                            <div class="list-type">
                                                                <ul id="type_checkboxes_mob">
                                                                    <li>
                                                                        <label class="input-style-box">
                                                                            <input class="check_type" <?= ($type == men) ? 'checked' : '' ?> id="men-mob" type="checkbox" name="type[]" value="0" atr-url-mob="men"/>
                                                                            <span class="checkmark"></span> Men </label>
                                                                    </li>
                                                                    <li>
                                                                        <label class="input-style-box">
                                                                            <input class="check_type" <?= ($type == women) ? 'checked' : '' ?> id="women-mob" type="checkbox" name="type[]" value="1" atr-url-mob="women"/>
                                                                            <span class="checkmark"></span> Women </label>
                                                                    </li>
                                                                    <li>
                                                                        <label class="input-style-box">
                                                                            <input class="check_type" <?= $type == unisex ? 'checked' : '' ?> id="unisex-mob" type="checkbox" name="type[]" value="2" atr-url-mob="unisex"/>
                                                                            <span class="checkmark"></span> Unisex </label>
                                                                    </li>
                                                                    <li>
                                                                        <label class="input-style-box">
                                                                            <input class="check_type" <?= ($type == oriental) ? 'checked' : '' ?> id="oriental-mob" type="checkbox" name="type[]" value="3" atr-url-mob="oriental"/>
                                                                            <span class="checkmark"></span> Oriental </label>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="filter-mobile-box"><!--filter-mobile-box-->
                                <button id="button" type="button" class="filter-list-button" data-toggle="collapse" data-target="#demo2">
                                    <b class="left-b">Size</b><span class="right-span">+</span>
                                </button>

                                <div id="demo2" class="collapse categories-filter" val='button'>
                                    <div class="in-product-left-categories" ><!--in-left-Categories-->

                                        <div class="other-range-box">
                                            <div class="list-size-data" id="size_checkboxes_mob">

                                                <?php
                                                foreach ($size_list as $size) {
                                                    if ($size->size) {
                                                        ?>
                                                        <div class="size-data-filter" >
                                                            <label class="input-size-data">
                                                                <input class="check_size_mob" type="checkbox" name="size[]" id="<?= $size->size ?>-mob" atr-url="<?= $size->size ?>"  value="<?= $size->size ?>"/>
                                                                <span class="checkmark-size-data"><?= $size->size ?>ml</span></label>
                                                        </div>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                <div class="clear"></div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="filter-mobile-box"><!--filter-mobile-box-->
                                <button id="button" type="button" class="filter-list-button" data-toggle="collapse" data-target="#demo3">
                                    <b class="left-b">price</b><span class="right-span">+</span>
                                </button>

                                <div id="demo3" class="collapse categories-filter" val='button'>
                                    <div class="in-product-left-categories" ><!--in-left-Categories-->

                                        <div class="other-range-box">
                                            <div class="list-type">
                                                <div id="slider-container_mob"></div>
                                                <p class="slider-values">
                                                    <span class="min_value value-left" id="min_mob"></span>
                                                    <span class="max_value value-right" id="max_mob"></span>
                                                <div class="clearfix"></div>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="filter-mobile-box"><!--filter-mobile-box-->
                                <button id="button" type="button" class="filter-list-button" data-toggle="collapse" data-target="#demo4">
                                    <b class="left-b">Discount</b><span class="right-span">+</span>
                                </button>

                                <div id="demo4" class="collapse categories-filter" val='button'>
                                    <div class="in-product-left-categories" ><!--in-left-Categories-->

                                        <div class="other-range-box">
                                            <div class="list-type">
                                                <ul  id="type_discounts_mob">
                                                    <li>
                                                        <label class="input-style-box">
                                                            <input name="" type="checkbox" value="" id="70-mob" class="disc_type_mob" atr-url="70">
                                                            <span class="checkmark"></span> 70% and above </label>
                                                    </li>
                                                    <li>
                                                        <label class="input-style-box">
                                                            <input name="" type="checkbox" value="" id="60-mob" class="disc_type_mob" atr-url="60">
                                                            <span class="checkmark"></span> 60% and above </label>
                                                    </li>
                                                    <li>
                                                        <label class="input-style-box">
                                                            <input name="" type="checkbox" value=""id="50-mob" class="disc_type_mob" atr-url="50">
                                                            <span class="checkmark"></span> 50% and above </label>
                                                    </li>
                                                    <li>
                                                        <label class="input-style-box">
                                                            <input name="" type="checkbox" value=""id="40-mob" class="disc_type_mob" atr-url="40">
                                                            <span class="checkmark"></span> 40% and above </label>
                                                    </li>
                                                    <li>
                                                        <label class="input-style-box">
                                                            <input name="" type="checkbox" value=""id="30-mob" class="disc_type_mob" atr-url="30">
                                                            <span class="checkmark"></span> 30% and above </label>
                                                    </li>
                                                    <li>
                                                        <label class="input-style-box">
                                                            <input name="" type="checkbox" value="" id="20-mob" class="disc_type_mob" atr-url="20">
                                                            <span class="checkmark"></span> 20% and above </label>
                                                    </li>
                                                    <li>
                                                        <label class="input-style-box">
                                                            <input name="" type="checkbox" value=""id="10" class="disc_type" atr-url="10">
                                                            <span class="checkmark"></span> 10% and above </label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--filter-mobile-box-->


                            <div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php
    } else {
        ?>
        <div class="product-left-categories-destop-view">
            <div class="in-product-left-categories" ><!--in-left-Categories-->
                <div class="head-text-button"><i class="icon"></i>Filter By</div>
                <h2 class="head-text">Brand</h2>
                <div class="other-range-box">
                    <div class="search-box">
                        <form >
                            <div class="input-group">
                                <input type="text" class="form-control m0"  placeholder="Search by Brand"  value="">
                                <div class="input-group-addon">
                                    <input  type="submit" class="send m0" >
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="container">
                        <div class="content pad0">
                            <div class="demo">
                                <div class="scrollbar-inner">
                                    <div class="list-type">
                                        <ul>
                                            <?php
                                            foreach ($brand_list as $brand) {
                                                ?>
                                                <li id="brand_checkboxes">

                                                    <label class="input-style-box">
                                                        <?php $brand_id = str_replace(' ', '_', $brand->brand); ?>
                                                        <input class="check_brand" type="checkbox"  id="<?= $brand->brand ?>" name="brand[]" value="<?= $brand->brand ?>" />
                                                       <!--<input name="" type="checkbox" value="">-->
                                                        <span class="checkmark"></span> <?= $brand->brand ?> </label>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <h2 class="head-text">Targeted Group</h2>
                <div class="other-range-box">
                    <div class="list-type">
                        <ul id="type_checkboxes">
                            <li>
                                <label class="input-style-box">
                                    <input class="check_type" <?= $type == 'men' ? 'checked' : '' ?> id="men" type="checkbox" name="type[]" value="0" />
                                    <span class="checkmark"></span> Men </label>
                            </li>
                            <li>
                                <label class="input-style-box">
                                    <input class="check_type" <?= $type == 'women' ? 'checked' : '' ?> id="women" type="checkbox" name="type[]" value="1" />
                                    <span class="checkmark"></span> Women </label>
                            </li>
                            <li>
                                <label class="input-style-box">
                                    <input class="check_type" <?= $type == 'unisex' ? 'checked' : '' ?> id="unisex" type="checkbox" name="type[]" value="2" />
                                    <span class="checkmark"></span> Unisex </label>
                            </li>
                            <li>
                                <label class="input-style-box">
                                    <input class="check_type" <?= $type == 'oriental' ? 'checked' : '' ?> id="oriental" type="checkbox" name="type[]" value="3" />
                                    <span class="checkmark"></span> Oriental </label>
                            </li>
                        </ul>
                    </div>
                </div>

                <h2 class="head-text">Size</h2>
                <div class="other-range-box">
                    <div class="list-size-data">
                        <?php
                        foreach ($size_list as $size) {
                            if ($size->size) {
                                ?>
                                <div class="size-data-filter" id="size_checkboxes">
                                    <label class="input-size-data">
                                        <input class="check_size" type="checkbox" name="size[]" id="<?= $size->size ?>" value="<?= $size->size ?>"/>
                                        <span class="checkmark-size-data"><?= $size->size ?>ml</span></label>
                                </div>
                                <?php
                            }
                        }
                        ?>
                        <div class="clear"></div>

                    </div>
                </div>

                <h2 class="head-text">Price</h2>
                <div class="other-range-box">
                    <div class="list-type">
                        <div id="slider-container"></div>
                        <p class="slider-values">
                            <span class="min_value value-left" id="min"></span>
                            <span class="max_value value-right" id="max"></span>
                        <div class="clearfix"></div>
                        </p>
                    </div>
                </div>

                <h2 class="head-text">Discount</h2>
                <div class="other-range-box">
                    <div class="list-type">
                        <ul  id="type_discounts">
                            <li>
                                <label class="input-style-box">
                                    <input name="" type="checkbox" value="" id="70" class="disc_type">
                                    <span class="checkmark"></span> 70% and above </label>
                            </li>
                            <li>
                                <label class="input-style-box">
                                    <input name="" type="checkbox" value="" id="60" class="disc_type">
                                    <span class="checkmark"></span> 60% and above </label>
                            </li>
                            <li>
                                <label class="input-style-box">
                                    <input name="" type="checkbox" value=""id="50" class="disc_type">
                                    <span class="checkmark"></span> 50% and above </label>
                            </li>
                            <li>
                                <label class="input-style-box">
                                    <input name="" type="checkbox" value=""id="40" class="disc_type">
                                    <span class="checkmark"></span> 40% and above </label>
                            </li>
                            <li>
                                <label class="input-style-box">
                                    <input name="" type="checkbox" value=""id="30" class="disc_type">
                                    <span class="checkmark"></span> 30% and above </label>
                            </li>
                            <li>
                                <label class="input-style-box">
                                    <input name="" type="checkbox" value="" id="20" class="disc_type">
                                    <span class="checkmark"></span> 20% and above </label>
                            </li>
                            <li>
                                <label class="input-style-box">
                                    <input name="" type="checkbox" value=""id="10" class="disc_type">
                                    <span class="checkmark"></span> 10% and above </label>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <?= Html::a('Clear filter', ['/product/index'], ['id' => 'clear_filter']) ?>
        </div>
        <?php
    }
    ?>
</aside>
<script type="text/javascript">
    var path_ = window.location.href;
    jQuery(document).ready(function () {
        var brand_check = getUrlParameter('brand');
        var type_check = getUrlParameter('type');
        var size_check = getUrlParameter('size');
        var disc_check = getUrlParameter('disc');
        $('#clear_filter').click(function () {
            var brand_check = getUrlParameter('brand');
            var type_check = getUrlParameter('type');
            var size_check = getUrlParameter('size');
            var disc_check = getUrlParameter('disc');
            var new_path = window.location.href;
            if (window.location.href.indexOf("brand") !== -1) {
                var new_path = uncheckparams(brand_check, 'brand', new_path);
            }
            if (window.location.href.indexOf("type") !== -1) {
                var new_path = uncheckparams(type_check, 'type', new_path);
            }
            if (window.location.href.indexOf("size") !== -1) {
                var new_path = uncheckparams(size_check, 'size', new_path);
            }
            if (window.location.href.indexOf("disc") !== -1) {
                var new_path = uncheckparams(disc_check, 'disc', new_path);
            }
            window.location.href = new_path;
        });
        checkparams(brand_check);
        checkparams(size_check);
        checkparams(disc_check);
        checkparams(type_check);
        checkparams_mob(brand_check);
        checkparams_mob(type_check);
        checkparams_mob(size_check);
        /***************************desktop view filter starts****************************/

        var brands = [];
        var frag = [];
        var size = [];
        var type = [];
        var disc = [];
        $("input.check_brand").click(function () {
            var brands = [];
            $('#brand_checkboxes input:checked').each(function () {

                brands.push($(this).attr('id'));
            });
            var new_path = geturl('brand', path_, brands);
//            var path = path_ + '?brand=' + brands;

            $.pjax({container: '#product_view', url: new_path, timeout: '2000 #ms'});
        });
        $("input.check_frag").click(function () {
            var frag = [];
            $('#frag_checkboxes input:checked').each(function () {
                frag.push($(this).attr('id'));
            });
            var new_path = geturl('fragrance', path_, frag);
            $.pjax({container: '#product_view', url: new_path, timeout: '2000 #ms'});
        });
        $("input.check_size").click(function () {
            var size = [];
            $('#size_checkboxes input:checked').each(function () {
                size.push($(this).attr('id'));
            });
            var new_path = geturl('size', path_, size);
            $.pjax({container: '#product_view', url: new_path, timeout: '2000 #ms'});
        });
        $("input.check_type").click(function () {
            var type = [];
            $('#type_checkboxes input:checked').each(function () {
                type.push($(this).attr('id'));
            });
            var new_path = geturl('type', path_, type);
            $.pjax({container: '#product_view', url: new_path, timeout: '2000 #ms'});
        });
        $("input.disc_type").click(function () {
            var type = [];
            $('#type_discounts input:checked').each(function () {
                type.push($(this).attr('id'));
            });
            var new_path = geturl('disc', path_, type);
            $.pjax({container: '#product_view', url: new_path, timeout: '2000 #ms'});
        });
        $(function () {
            $('#slider-container').slider({
                range: true,
                min: 0,
                max: 1000,
                values: [0, 1000],
                create: function () {
                    $('#min').text('0');
                    $('#max').text('1000');
                },
                slide: function (event, ui) {
                    $('#min').text(ui.values[0]);
                    $('#max').text(ui.values[1]);
                },
                change: function (event, ui) {

                    var location = window.location.href;
                    var min_range = $('#min').text();
                    var max_range = $('#max').text();
                    var min_value = paramss('minrange');
                    var max_value = paramss('maxrange');
                    if (window.location.href.indexOf("brand") === -1 && window.location.href.indexOf("fragrance") === -1 && window.location.href.indexOf("size") === -1 && window.location.href.indexOf("type") === -1) {
                        if (window.location.href.indexOf("minrange") !== -1) {

                            var re = new RegExp('minrange=' + min_value + '&&maxrange=' + max_value);
//							var newUrl = window.location.href;
                            var location = location.replace(re, '');
                            var url = location + 'minrange' + '=' + min_range + '&&maxrange=' + max_range;
                        } else {
                            var url = location + '?minrange' + '=' + min_range + '&&maxrange=' + max_range;
                        }

                    } else if (window.location.href.indexOf("minrange") === -1) {/* in url word min range exist or not if result is -1 the word doesn't exist*/
                        var url = location + '&&minrange' + '=' + min_range + '&&maxrange=' + max_range;
                    } else {
                        if (window.location.href.indexOf("brand") === -1 && window.location.href.indexOf("fragrance") === -1 && window.location.href.indexOf("size") === -1 && window.location.href.indexOf("type") === -1) {
                            var re = new RegExp('minrange=' + min_value + '&&maxrange=' + max_value);
                            var newUrl = window.location.href;
                            var url = newUrl.replace(re, '');
                            url = url + 'minrange' + '=' + min_range + '&&maxrange=' + max_range;
                        } else {
                            var re = new RegExp('minrange=' + min_value + '&&maxrange=' + max_value);
                            var newUrl = window.location.href;
                            var url = newUrl.replace(re, 'minrange' + '=' + min_range + '&&maxrange=' + max_range);
                        }

                    }
                    $.pjax({container: '#product_view', url: url, timeout: '2000 #ms'});
                }
            })
        });
        /***************************desktop view filter ends****************************/
        /***************************mobile view filter starts****************************/

        $('#mob-filter-apply').click(function () {

            var brands_mob = [];
            var type_mob = [];
            var size_mob = [];
            var disc_mob = [];
            $('#brand_checkboxes_mob input:checked').each(function () {
                brands_mob.push($(this).attr('atr-url'));
            });
            $('#type_discounts_mob input:checked').each(function () {
                disc_mob.push($(this).attr('atr-url'));
            });
            if (typeof brands_mob !== 'undefined' && brands_mob.length > 0) {
                var new_path = geturl('brand', path_, brands_mob);
                $.pjax({container: '#product_view', url: new_path, timeout: '2000 #ms'});
            }
            if (typeof disc_mob !== 'undefined' && disc_mob.length > 0) {
                var new_path = geturl('disc', path_, disc_mob);
                $.pjax({container: '#product_view', url: new_path, timeout: '2000 #ms'});
            }


            $('#type_checkboxes_mob input:checked').each(function () {

                type_mob.push($(this).attr('atr-url-mob'));
            });
            if (typeof type_mob !== 'undefined' && type_mob.length > 0) {
                var new_path = geturl('type', path_, type_mob);
                $.pjax({container: '#product_view', url: new_path, timeout: '2000 #ms'});
            }


            $('#size_checkboxes_mob input:checked').each(function () {
                size_mob.push($(this).attr('atr-url'));
            });
            if (typeof size_mob !== 'undefined' && size_mob.length > 0) {
                var new_path = geturl('size', path_, size_mob);
                $.pjax({container: '#product_view', url: new_path, timeout: '2000 #ms'});
            }
            var min_range = $('#min_mob').text();
            var max_range = $('#max_mob').text();
            var min_value = paramss('minrange');
            var max_value = paramss('maxrange');
            if (typeof min_range !== 'undefined' && min_range.length > 0) {
                var location = window.location.href;
                if (window.location.href.indexOf("minrange") !== -1) {
                    var re = new RegExp('minrange=' + min_value + '&&maxrange=' + max_value);
                    var location = location.replace(re, '');
                    var url = location + 'minrange' + '=' + min_range + '&&maxrange=' + max_range;
                } else {
                    var url = location + '&&minrange' + '=' + min_range + '&&maxrange=' + max_range;
                }
                $.pjax({container: '#product_view', url: url, timeout: '2000 #ms'});
            }

        });
        $('#slider-container_mob').slider({

            range: true,
            min: 0,
            max: 1000,
            values: [0, 1000],
            create: function () {
//              $("#amount").val("$299 - $1099");
                $("#min_mob").text(0);
                $("#max_mob").text(1000);
            },
            slide: function (event, ui) {
                $('#min_mob').text(ui.values[0]);
                $('#max_mob').text(ui.values[1]);
            }
        });
    });
    /***************************mobile view filter ends****************************/
    function getUrlParameter(sParam) {
        var datas = [];
        var sPageURL = decodeURIComponent(window.location.search.substring(1)),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;
        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');
            if (sParameterName[0] === sParam) {
                if (sParameterName[1] !== undefined) {
                    datas.push(sParameterName[1]);
                }
            }
        }
        console.log(datas);
        return datas;
    }
    function uncheckparams(val_, param, path) {
        if (val_ && val_ != '') {
            var paramtersplit = val_.toString().split(',');
            $.each(paramtersplit, function (index, value) {
                if (document.getElementById(value)) {
                    $('#' + value).prop('checked', false);
                } else {
                }
            });
            var new_path = path.replace(val_, '');
            if (window.location.href.indexOf(param) !== -1) {
                var charc = '&&' + param + '=';
                if (window.location.href.indexOf(charc) !== -1) {
                    var new_path = new_path.replace(charc, '');
                } else if (window.location.href.indexOf('?' + param + '=') !== -1) {
                    var new_path = new_path.replace('?' + param + '=', '');
                }
            }
            return new_path;
        }

    }
    function paramss(name) {
        var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
        if (results == null) {
            return null;
        } else {
            return decodeURI(results[1]) || 0;
        }
    }


    function geturl(param, path, value) {

        if (window.location.href.indexOf("?") === -1) {
            var link = path + '?' + param + '=' + value;
        } else {
            if (window.location.href.indexOf(param) === -1) {
                var link = window.location.href + '&&' + param + '=' + value;
            } else {
                var pattern = new RegExp('\\b(' + param + '=).*?(&|#|$)');
                var link = window.location.href.replace(pattern, '$1' + value + '$2');
            }

        }
        return link;
    }
    function checkparams(val_) {
        if (val_ && val_ != '') {
            var paramtersplit = val_.toString().split(',');
            $.each(paramtersplit, function (index, value) {
                if (document.getElementById(value)) {
                    $('#' + value).prop('checked', true);
                } else {
                }
            });
        }

    }
    function checkparams_mob(val_) {
        if (val_ && val_ != '') {
            var paramtersplit = val_.toString().split(',');
            $.each(paramtersplit, function (index, value) {
                if (document.getElementById(value + '-mob')) {
                    $('#' + value + '-mob').prop('checked', true);
                } else {
                }
            });
        }

    }
</script>