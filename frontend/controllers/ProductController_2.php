<?php

//use Yii;

namespace frontend\controllers;

use yii;
use common\models\Product;
use common\models\ProductSearch;
use common\models\Category;
use common\models\RecentlyViewed;
use common\models\WishList;
use common\models\Settings;
use yii\db\Expression;
use common\models\CmsMetaTags;
use common\models\Brand;
use common\models\Fregrance;

class ProductController extends \yii\web\Controller {

    public function beforeAction($action) {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }

    /**
     * Displays a Products based on category.
     * @param category_code $id
     * @return mixed
     */
    public function actionIndex($type = null, $category = null, $keyword = null, $brand = null, $size = null, $minrange = null, $maxrange = null) {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 44;
        $brands_filters = '';
        if (isset($keyword) && $keyword != '') {
            $this->Search($keyword, $dataProvider);
        }
        if (!empty($brand)) {
            $brands_name = explode(',', $brand);
            $brands_filters = Brand::Brand_id($brands_name);
            $dataProvider->query->andWhere(['in', 'brand', $brands_filters])->orderBy(new Expression('rand()'));
            $breadcrumb = 'Brand / ' . $brand;
        }
        if (!empty($size)) {
            $size_name = explode(',', $size);
            $dataProvider->query->andWhere(['in', 'size', $size_name])->orderBy(new Expression('rand()'));
        }
        if ((!empty($type) && $type == 0) || $type != "") {
            $type_name = explode(',', $type);
            $type_filter = Brand::Gender_type($type_name);
            $dataProvider->query->andWhere(['in', 'gender_type', $type_filter])->orderBy(new Expression('rand()'));
        }
        if ((!empty($minrange) || $minrange == 0) && !empty($maxrange) || $minrange != "") {

            $min_ = number_format((float) $minrange, 2, '.', '');
            $max_ = number_format((float) $maxrange, 2, '.', '');

            $dataProvider->query->andWhere(['between', 'price', $min_, $max_]);
        }
        if (!empty($category)) {
            $this->CategorizedData($dataProvider, $category);
            $breadcrumb = $category;
        }
        $dataProvider->query->andWhere(['>', 'stock', 0]);
        $dataProvider->query->orderBy(new Expression('rand()'));
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'brands_filters' => $brands_filters,
                    'type' => $type,
                    'category' => $category,
                    'minrange' => $minrange,
                    'maxrange' => $maxrange,
                    'type' => $type,
        ]);
    }

    public function CategorizedData($dataProvider, $category) {

        if ($category == "make-up") {
            return $dataProvider->query->andWhere(['main_category' => 2]);
        } elseif ($category == "hair-mist") {
            return $dataProvider->query->andWhere(['main_category' => 3]);
        } elseif ($category == "after-shave") {
            return $dataProvider->query->andWhere(['main_category' => 4]);
        } elseif ($category == "body-cream") {
            return $dataProvider->query->andWhere(['main_category' => 5]);
        } elseif ($category == "deodrant") {
            return $dataProvider->query->andWhere(['main_category' => 6]);
        } elseif ($category == "bakhoor") {
            return $dataProvider->query->andWhere(['main_category' => 7]);
        }
    }

    public function Search($keyword, $dataProvider) {
        $dataProvider->query->andWhere(['like', 'product_name', $keyword])->orWhere(['like', 'canonical_name', $keyword]);
        /*
         * search category
         */
        $categorys = Category::find()->where(['status' => 1])->andWhere(['like', 'category', $keyword])->all();
        $category_products = array();
        if (!empty($categorys)) {
            foreach ($categorys as $value) {
                $cat_products = Product::find()->where(['status' => 1, 'category' => $value->id])->all();
                foreach ($cat_products as $cat_products) {
                    $category_products[] = $cat_products->id;
                }
            }
            $dataProvider->query->orWhere(['IN', 'id', $category_products]);
        }
        /*
         * search search tags
         */
        $search_tags = \common\models\MasterSearchTag::find()->where(['status' => 1])->andWhere((['like', 'tag_name', $keyword]))->all();
        $keyword_products = array();
        if (!empty($search_tags)) {
            foreach ($search_tags as $value) {
                $search_products = Product::find()->where(['status' => 1])->andWhere(new Expression('FIND_IN_SET(:search_tag, search_tag)'))->addParams([':search_tag' => $value->id])->all();
                foreach ($search_products as $search_productss) {
                    if (!in_array($search_productss->id, $keyword_products))
                        $keyword_products[] = $search_productss->id;
                }
            }
            $dataProvider->query->orWhere(['IN', 'id', $keyword_products]);
        }
        return $dataProvider;
    }

    public function actionCategory($id) {
        $submenu = '';
        $breadcrumb = "";
        $brands_filter = "";
        $fragrance_filter = "";
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where('category =' . $id);
        $category = Category::find()->select('id,category')->where(['status' => 1])->all();
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'category' => $category,
                    'submenu' => $submenu,
                    'breadcrumb' => $breadcrumb,
                    'brands_filter' => $brands_filter,
                    'fragrance_filter' => $fragrance_filter,
        ]);
    }

    public function actionProduct($submenu, $brand = null, $fragrance = null, $min = null, $max = null, $type = null, $size = null) {
        if (isset($submenu)) {
            $breadcrumb = $submenu;
        }
        $price = "";
        $type_ = '';
        $category = "";
        $brands_filter = "";
        $fragrance_filter = "";
        $size_list = "";
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 42;
        $size_list = Product::find()->select('size')->where(['status' => 1])->groupBy(['size'])->all();
        if (!empty($brand)) {
            $brands_name = explode(',', $brand);
            $brands_filters = Brand::Brand_id($brands_name);
//            echo '<pre>';print_r($brands_filters);exit;
            $brands_filter = $brands_filters;
//            $dataProvider->query->andWhere($brand_)->orderBy(new Expression('rand()'));
        }
        $brand_ = !empty($brand) ? ['in', 'brand', $brands_filters] : '';
        if (!empty($fragrance)) {
            $fragrance_name = explode(',', $fragrance);
            $fragrance_filter = Brand::Fragrance_id($fragrance_name);
//            $fragrance_ = ['in', 'product_type', $fragrance_filter];
//            $dataProvider->query->andWhere(['in', 'product_type', $fragrance_filter])->orderBy(new Expression('rand()'));
        }
        $fragrance_ = !empty($fragrance) ? ['in', 'product_type', $fragrance_filter] : '';
        if (!empty($submenu)) {
            $category = Category::find()->where(['status' => 1, 'category_code' => $submenu])->one();
            if ($category) {
                $submenu_ = ['category' => $category->id];
//                $dataProvider->query->andWhere(['category' => $category->id])->orderBy(new Expression('rand()'));
            } else {
                return $this->redirect('/perfumedunia');
            }
        }
        $submenu_ = !empty($submenu) ? ['category' => $category->id] : '';
        if (!empty($size)) {
            $size_name = explode(',', $size);
//            $dataProvider->query->andWhere(['in', 'size', $size_name])->orderBy(new Expression('rand()'));
        }
        $size_ = !empty($size) ? ['in', 'size', $size_name] : '';
        if ((!empty($type) && $type == 0) || $type != "") {
            $type_name = explode(',', $type);
            $type_filter = Brand::Gender_type($type_name);
            $type_ = ['in', 'gender_type', $type_filter];
//            $dataProvider->query->andWhere(['in', 'gender_type', $type_filter])->orderBy(new Expression('rand()'));
        }
        if (!empty($min) && !empty($max)) {
            $price = ['between', 'offer_price', $min, $max];
//            $dataProvider->query->andWhere(['between', 'offer_price', $min, $max]);
        }

        $brands_filter = "";
        $fragrance_filter = "";
//        if (Yii::$app->request->post()) {
////            $brands_filters = Yii::$app->request->post()['brand'];
////            $fragrance_filter = Yii::$app->request->post()['fragrance'];
//            if (isset(Yii::$app->request->post()['brand'])) {
//                $brands_filters = Yii::$app->request->post()['brand'];
//                $brands_filter = $brands_filters;
//                $dataProvider->query->andWhere(['in', 'brand', $brands_filters])->orderBy(new Expression('rand()'));
//            }
//            if (isset(Yii::$app->request->post()['fragrance'])) {
//                $fragrance_filter = Yii::$app->request->post()['fragrance'];
//                $dataProvider->query->andWhere(['in', 'product_type', $fragrance_filter])->orderBy(new Expression('rand()'));
//            }
////            where(['in', 'brand', $brands])
////            echo '<pre>';print_r($fragrance_filter);exit;
//        }
//        $dataProvider->query->andWhere($brand_, $fragrance_, $submenu_, $type_, $price)->orderBy(new Expression('rand()'));
        $dataProvider->query->andWhere($brand_)
                ->andWhere($fragrance_)
                ->andWhere($submenu_)
                ->andWhere($size_)
                ->andWhere($type_)
                ->andWhere($price)
                ->andWhere(['>', 'stock', 0])
                ->orderBy(new Expression('rand()'));


        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'category' => $category,
                    'submenu' => $submenu,
                    'breadcrumb' => $breadcrumb,
                    'brands_filter' => $brands_filter,
                    'fragrance_filter' => $fragrance_filter,
                    'size_list' => $size_list,
//                    'categories' => $categories,
//                    'catag' => $category,
//                    'main_categry' => $category->main_category,
        ]);
    }

    public function actionBodyMist($brand = null, $fragrance = null, $min = null, $max = null, $type = null, $size = null) {
        $price = "";
        $type_ = '';
        $brands_filter = "";
        $submenu = "";
        $breadcrumb = "";
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 42;
        $category = Category::find()->where(['status' => 1, 'category_code' => 'women'])->one();
        $size_list = Product::find()->select('size')->where(['status' => 1])->groupBy(['size'])->all();

        $category_ = !empty($category) ? ['category' => $category->id] : '';
        $fragrance_filter = array('3');
        if (!empty($brand)) {
            $brands_name = explode(',', $brand);
            $brands_filters = Brand::Brand_id($brands_name);
            $brands_filter = $brands_filters;
        }
        $brand_ = !empty($brand) ? ['in', 'brand', $brands_filters] : '';
        if (!empty($fragrance)) {
            $fragrance_name = explode(',', $fragrance);
            $fragrance_filter = Brand::Fragrance_id($fragrance_name);
            array_push($fragrance_filter, "3");
        }
        $fragrance_ = ['in', 'product_type', $fragrance_filter];
        if (!empty($size)) {
            $size_name = explode(',', $size);
        }
        $size_ = !empty($size) ? ['in', 'size', $size_name] : '';
        if ((!empty($type) && $type == 0) || $type != "") {
            $type_name = explode(',', $type);
            $type_filter = Brand::Gender_type($type_name);
            $type_ = ['in', 'gender_type', $type_filter];
        }
        if (!empty($min) && !empty($max)) {
            $price = ['between', 'offer_price', $min, $max];
        }
        $dataProvider->query->andWhere($brand_)
                ->andWhere($fragrance_)
                ->andWhere($category_)
                ->andWhere($size_)
                ->andWhere($type_)
                ->andWhere($price)
                ->andWhere(['>', 'stock', 0])
                ->orderBy(new Expression('rand()'));
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'category' => $category,
                    'submenu' => $submenu,
                    'breadcrumb' => $breadcrumb,
                    'brands_filter' => $brands_filter,
                    'fragrance_filter' => $fragrance_filter,
                    'size_list' => $size_list,
//                    'categories' => $categories,
//                    'catag' => $category,
//                    'main_categry' => $category->main_category,
        ]);
    }

    public function actionProduct_brand() {
        if (Yii::$app->request->isAjax) {
            $product_brands = $_POST['favorite'];
            $brands = explode(',', $product_brands);
            $products = Product::find()->where(['in', 'brand', $brands])->all();
            if ($products) {
                foreach ($products as $prdct) {
                    $product_id[] = $prdct->id;
                }
//                $this->redirect(array('filter', 'products' => $products, 'product_brands' => $product_brands));
                echo json_encode(array('msg' => 'success', 'products' => $product_id, 'product_brands' => $product_brands));
            } else {
                echo json_encode(array('msg' => 'failed'));
            }
        }
    }

    public function actionFilter($products, $product_brands) {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if ($products) {
            $dataProvider->query->andWhere(['in', 'id', $products])->orderBy(new Expression('rand()'));
        }
        $dataProvider->pagination->pageSize = 42;
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionMain_category($main_category, $brand = null, $fragrance = null, $min = null, $max = null, $type = null, $size = null) {
//        echo $main_category;exit;
        $category = "";
        $price = "";
        $type_ = '';
        $submenu = "";
        $breadcrumb = "";
        $brands_filter = "";
        $fragrance_filter = "";
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 42;
        $size_list = Product::find()->select('size')->where(['status' => 1])->groupBy(['size'])->all();
        if (!empty($main_category)) {
            $cat = $main_category == 'gifts' ? '2' : '3';
        }
        $category_ = !empty($main_category) ? ['main_category' => $cat] : '';
        if (!empty($brand)) {
            $brands_name = explode(',', $brand);
            $brands_filters = Brand::Brand_id($brands_name);
            $brands_filter = $brands_filters;
        }
        $brand_ = !empty($brand) ? ['in', 'brand', $brands_filters] : '';
        if (!empty($fragrance)) {
            $fragrance_name = explode(',', $fragrance);
            $fragrance_filter = Brand::Fragrance_id($fragrance_name);
        }
        $fragrance_ = !empty($fragrance) ? ['in', 'product_type', $fragrance_filter] : '';
        if (!empty($size)) {
            $size_name = explode(',', $size);
        }
        $size_ = !empty($size) ? ['in', 'size', $size_name] : '';
        if ((!empty($type) && $type == 0) || $type != "") {
            $type_name = explode(',', $type);
            $type_filter = Brand::Gender_type($type_name);
            $type_ = ['in', 'gender_type', $type_filter];
        }
        if (!empty($min) && !empty($max)) {
            $price = ['between', 'offer_price', $min, $max];
        }


        $dataProvider->query->andWhere($brand_)
                ->andWhere($fragrance_)
                ->andWhere($category_)
                ->andWhere($size_)
                ->andWhere($type_)
                ->andWhere($price)
                ->andWhere(['>', 'stock', 0])
                ->andWhere(['<>', 'main_category', 1])
                ->orderBy(new Expression('rand()'));

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'breadcrumb' => $main_category,
                    'category' => $category,
                    'submenu' => $submenu,
                    'breadcrumb' => $breadcrumb,
                    'brands_filter' => $brands_filter,
                    'fragrance_filter' => $fragrance_filter,
                    'size_list' => $size_list,
//                    'categories' => $categories,
//                    'catag' => $category,
//                    'main_categry' => $category->main_category,
        ]);
    }

    public function actionBrand($brand, $fragrance = null, $min = null, $max = null, $type = null, $size = null) {

        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 42;
        $category = "";
        $submenu = "";
        $price = "";
        $type_ = '';
        $breadcrumb = '';
        $size_list = Product::find()->select('size')->where(['status' => 1])->groupBy(['size'])->all();

        if (!empty($brand)) {
            $brands_name = explode(',', $brand);
            $brands_filters = Brand::Brand_id($brands_name);
            $brands_filter = $brands_filters;
//            $dataProvider->query->andWhere(['in', 'brand', $brands_filters])->orderBy(new Expression('rand()'));
        }
        $brand_ = !empty($brand) ? ['in', 'brand', $brands_filters] : '';
        if (!empty($fragrance)) {
            $fragrance_name = explode(',', $fragrance);
            $fragrance_filter = Brand::Fragrance_id($fragrance_name);
        }
        $fragrance_ = !empty($fragrance) ? ['in', 'product_type', $fragrance_filter] : '';
        if (!empty($size)) {
            $size_name = explode(',', $size);
//            $dataProvider->query->andWhere(['in', 'size', $size_name])->orderBy(new Expression('rand()'));
        }
        $size_ = !empty($size) ? ['in', 'size', $size_name] : '';
        if ((!empty($type) && $type == 0) || $type != "") {
            $type_name = explode(',', $type);
            $type_filter = Brand::Gender_type($type_name);
            $type_ = ['in', 'gender_type', $type_filter];
//            $dataProvider->query->andWhere(['in', 'gender_type', $type_filter])->orderBy(new Expression('rand()'));
        }
        if (!empty($min) && !empty($max)) {
            $price = ['between', 'offer_price', $min, $max];
//            $dataProvider->query->andWhere(['between', 'offer_price', $min, $max]);
        }


        $fragrance_filter = "";
        $dataProvider->query->andWhere($brand_)
                ->andWhere($fragrance_)
                ->andWhere($size_)
                ->andWhere($type_)
                ->andWhere($price)
                ->andWhere(['>', 'stock', 0])
                ->orderBy(new Expression('rand()'));
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'category' => $category,
                    'submenu' => $submenu,
                    'breadcrumb' => $breadcrumb,
                    'brands_filter' => $brands_filter,
                    'fragrance_filter' => $fragrance_filter,
                    'size_list' => $size_list,
        ]);
    }

    public function actionGift() {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 42;
        $gifts = \common\models\Gifts::find()->where(['status' => 1])->orderBy(['sort_order' => SORT_ASC])->all();
//        echo '<pre>';print_r($gifts);exit;
        $gift_products = array();
        foreach ($gifts as $value) {
            $gift_products[] = $value->product_id;
        }
        $dataProvider->query->andWhere(['IN', 'id', $gift_products]);
        return $this->render('gift', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'gift_products' => $gift_products,
        ]);
    }

    public function actionFragrance($fragrance) {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 42;



        if (!empty($fragrance)) {
            $fregrance = Fregrance::find()->where(['name' => $fragrance])->one();
            $dataProvider->query->andWhere(['product_type' => $fregrance->id])->orderBy(new Expression('rand()'));
        }

        return $this->render('fragrance', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a Particular Product.
     * @param prodict_id  $product
     * @return mixed
     */
    public function actionProductDetail($product) {

        if (isset(Yii::$app->user->identity->id)) {
            $user_id = Yii::$app->user->identity->id;
        } else {
            $user_id = '';
        }
        $shipping_limit = Settings::findOne('1')->value;
        $product_details = Product::find()->where(['canonical_name' => $product, 'status' => '1'])->one();
        if (!empty($product_details)) {
            $related_poduct = Product::find()->where(['brand' => $product_details->brand, 'gender_type' => $product_details->gender_type])->andwhere(['<>', 'id', $product_details->id])->all();
            $this->RecentlyViewed($product_details);
            $product_reveiws = \common\models\CustomerReviews::find()->where(['product_id' => $product_details->id, 'status' => '1'])->all();
            \Yii::$app->view->title = $product_details->meta_title;
            \Yii::$app->view->registerMetaTag(['name' => 'keywords', 'content' => $product_details->meta_keywords]);
            \Yii::$app->view->registerMetaTag(['name' => 'description', 'content' => $product_details->meta_description]);
            return $this->render('product_detail', [
                        'product_details' => $product_details,
                        'product_reveiws' => $product_reveiws,
                        'user_id' => $user_id,
                        'shipping_limit' => $shipping_limit,
                        'related_poduct' => $related_poduct,
            ]);
        } else {
            return $this->redirect(['site/error']);
        }
    }

    public function actionDetail($product) {
        die('hiiiiiiiiii');
    }

    /**
     * Save recently viewed product.
     * @param product array
     * if user logged in set user id otherwise set temporary session id
     */
    public function RecentlyViewed($product) {
        $user_id = '';
        $sessonid = '';
        if (isset(Yii::$app->user->identity->id)) {
            $user_id = Yii::$app->user->identity->id;
            $model = RecentlyViewed::find()->where(['product_id' => $product->id, 'user_id' => $user_id])->one();
        } else {
            if (!isset(Yii::$app->session['temp_user_product']) || Yii::$app->session['temp_user_product'] == '') {
                $milliseconds = round(microtime(true) * 1000);
                Yii::$app->session['temp_user_product'] = $milliseconds;
            }
            $model = RecentlyViewed::find()->where(['product_id' => $product->id, 'session_id' => Yii::$app->session['temp_user_product']])->one();
            $sessonid = Yii::$app->session['temp_user_product'];
        }
        if (empty($model)) {
            $model = new RecentlyViewed();
            $model->user_id = $user_id;
            $model->session_id = $sessonid;
            $model->product_id = $product->id;
            $model->date = date('Y-m-d');
        } else {
            $model->date = date('Y-m-d');
        }
        $model->save();
        return;
    }

    /**
     * Update recently viewed product.
     * @param tmperory session for recently viewed product
     * update session id to corresponding user user id
     */
    public function actionGetrecentproduct() {
        if (isset(Yii::$app->user->identity->id)) {
            if (isset(Yii::$app->session['temp_user_product'])) {
                $models = RecentlyViewed::find()->where(['session_id' => Yii::$app->session['temp_user_product']])->all();

                foreach ($models as $msd) {
                    $data = RecentlyViewed::find()->where(['product_id' => $msd->product_id, 'user_id' => Yii::$app->user->identity->id])->one();
                    if (empty($data)) {
                        $msd->user_id = Yii::$app->user->identity->id;
                        $msd->session_id = '';
                        $msd->save();
                    } else {
                        $data->date = $msd->date;
                        if ($data->save()) {
                            $msd->delete();
                        }
                    }
                }
                unset(Yii::$app->session['temp_user_product']);
            }
        }
    }

    /**
     * Update recently viewed product.
     * @param tmperory session for recently viewed product
     * update session id to corresponding user user id
     */
    public function actionGetwishlistproduct() {
        if (isset(Yii::$app->user->identity->id)) {
            if (isset(Yii::$app->session['temp_wish_list'])) {
                $models = WishList::find()->where(['session_id' => Yii::$app->session['temp_wish_list']])->all();

                foreach ($models as $msd) {
                    $data = WishList::find()->where(['product' => $msd->product, 'user_id' => Yii::$app->user->identity->id])->one();
                    if (empty($data)) {
                        $msd->user_id = Yii::$app->user->identity->id;
                        $msd->session_id = '';
                        $msd->save();
                    } else {
                        $data->date = $msd->date;
                        if ($data->save()) {
                            $msd->delete();
                        }
                    }
                }
                unset(Yii::$app->session['temp_wish_list']);
            }
        }
    }

    /**
     * This function will display new modal for add new customer reviews
     */
    public function actionAddReview() {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(array('site/login-signup'));
        }
        if (Yii::$app->request->isAjax) {
            $product_id = $_POST['product_id'];
            $model_review = new \common\models\CustomerReviews();
            $product_details = Product::findOne($product_id);
            $data = $this->renderPartial('add_reviews', [
                'model_review' => $model_review,
                'product_id' => $product_id,
                'product_details' => $product_details,
            ]);
            echo $data;
        }
    }

    /**
     * This function will save new customer reviews
     */
    public function actionSaveReview() {
        if (Yii::$app->request->isAjax) {

            $model_review = new \common\models\CustomerReviews();
            if ($model_review->load(Yii::$app->request->post())) {
                $model_review->user_id = Yii::$app->user->identity->id;
                $model_review->review_date = date('Y-m-d');
                $model_review->save();
                echo 1;
                exit;
            }
        }
    }

    public function actionGenderSearch() {
        if (Yii::$app->request->isAjax) {

            $gender = $_POST['gender'];

            //Yii::$app->session['gender_search'] = $gender;
            if (!empty($gender) || $gender != "") {
                echo 1;
                exit;
            } else {
                echo 0;
                exit;
            }
        }
    }

    public function actionSearch() {


        $category = '';
        $submenu = '';
        $breadcrumb = '';
        $brands_filter = '';
        $fragrance_filter = '';
        $keyword = $_GET['keyword'];
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if (isset($keyword) && $keyword != '') {
            $dataProvider->query->andWhere(['like', 'product_name', $keyword])->orWhere(['like', 'canonical_name', $keyword]);
            /*
             * search category
             */
            $category = Category::find()->where(['status' => 1])->andWhere(['like', 'category', $keyword])->all();
            $category_products = array();
            if (!empty($category)) {
                foreach ($category as $value) {
                    $cat_products = Product::find()->where(['status' => 1, 'category' => $value->id])->all();
                    foreach ($cat_products as $cat_products) {
                        $category_products[] = $cat_products->id;
                    }
                }
                $dataProvider->query->orWhere(['IN', 'id', $category_products]);
            }
            /*
             * search search tags
             */
            $search_tags = \common\models\MasterSearchTag::find()->where(['status' => 1])->andWhere((['like', 'tag_name', $keyword]))->all();
            $keyword_products = array();
            if (!empty($search_tags)) {
                foreach ($search_tags as $value) {
                    $search_products = Product::find()->where(['status' => 1])->andWhere(new Expression('FIND_IN_SET(:search_tag, search_tag)'))->addParams([':search_tag' => $value->id])->all();
                    foreach ($search_products as $search_productss) {
                        if (!in_array($search_productss->id, $keyword_products))
                            $keyword_products[] = $search_productss->id;
                    }
                }
                $dataProvider->query->orWhere(['IN', 'id', $keyword_products]);
            }
        }

        $categories = Category::find()->where(['status' => 1])->all();
        $main_categry = '';

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'categories' => $categories,
                    'main_categry' => $main_categry,
                    'category' => $category,
                    'submenu' => $submenu,
                    'breadcrumb' => $breadcrumb,
                    'brands_filter' => $brands_filter,
                    'fragrance_filter' => $fragrance_filter,
        ]);
    }

    public function actionSearchKeyword() {
        if (Yii::$app->request->isAjax) {

            $keyword = $_POST['keyword'];

            if ($keyword != '' || !empty($keyword)) {
                $search_tags = \common\models\MasterSearchTag::find()->select('tag_name')->where(['status' => 1])->andWhere((['like', 'tag_name', $keyword]))->all();
                $products = Product::find()->where(['status' => 1])->select('product_name')->andWhere((['like', 'product_name', $keyword]))->all();
                $category = Category::find()->where(['status' => 1])->select('category')->andWhere((['like', 'category', $keyword]))->all();
                $results_temp = array_merge($search_tags, $products);
                $results = array_merge($results_temp, $category);

                $values = $this->renderPartial('_product_search', ['products' => $results, 'keyword' => $keyword]);
                return $values;
            }
        }
    }

    public function actionSearchBrand() {
        if (Yii::$app->request->isAjax) {
            $keyword = $_POST['keyword'];
            $brand_list = $_POST['brand_list'];
            if ($keyword != '' || !empty($keyword)) {
                if (!empty($brand_list)) {
                    $brands = Brand::find()->select('brand')->where(['status' => 1])->andWhere((['like', 'brand', $keyword]))->andWhere(['IN', 'id', $brand_list])->all();
                } else {
                    $brands = Brand::find()->select('brand')->where(['status' => 1])->andWhere((['like', 'brand', $keyword]))->all();
                }
                $values = $this->renderPartial('_brand_search', ['brands' => $brands]);
                return $values;
            } else {
                if (!empty($brand_list)) {
                    $brands = Brand::find()->select('brand')->where(['status' => 1])->andWhere(['IN', 'id', $brand_list])->all();
                } else {
                    $brands = Brand::find()->select('brand')->where(['status' => 1])->all();
                }
                $values = $this->renderPartial('_brand_search', ['brands' => $brands]);
                return $values;
            }
        }
    }

}
