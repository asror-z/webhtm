<?php
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\Form;
use zetsoft\models\shop\ShopBrand;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\actions\ZEasySelectableWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\images\ZImageWidget;
use zetsoft\widgets\inputes\ZKSliderIonWidget;
use zetsoft\widgets\navigat\ZMarketDropdownWidget;
use zetsoft\widgets\phone\ZSipml5Widget;
use zetsoft\widgets\phone\ZWebphoneSipWidget;
use zetsoft\widgets\phone\ZWebrtcPhoneWidget;

/** @var ZView $this */

/**
 *
 * Action Params
 */


$action = new WebItem();

$action->title = Azl . 'testd';
$action->icon = 'fa fa-database';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;
$action->cache = false;
$action->call = null;
$action->cacheHttp = false;
$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

/**
 *
 * Start Page
 */

$this->beginPage();
?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <?php
    require Root . '/webhtm/block/metas/main.php';
    require Root . '/webhtm/block/assets/main.php';
    $this->head();
    ?>

</head>
<body class="<?= ZWidget::skin['white-skin'] ?>">
<?php
$this->beginBody();

echo ZNProgressWidget::widget([]);

?>

<?php
Az::$app->maps->map->testtwo();

          /*echo ZSipml5Widget::widget([

          ]);


          echo ZWebrtcPhoneWidget::widget([

          ]);*/
          
?>
<div class="col-12">
    <br>
    <form id="activeFormCheck" class="form-horizontal kv-form-horizontal kv-form-bs4" action="#" method="post" enctype="multipart/form-data" data-pjax="0">
        <input type="hidden" name="_csrf" value="SCFtTbfeYrdp7-jFWsl7CFWxSzE5TIivKsrKchW1HN8iUgAv-LNa7w6dsawjkzZuMeB6WWofwvtTqLAwJMFtkw==">

        <div class="form-group" style="">
            <div class="highlight-addon row field-zdynamicmodel-brand">

                <div class="col-md-12">

                    <div class="zlilo" id="zdynamicmodel-brand">
                        <div class="lilo-accordion-control active" style="display: block;">Марка</div>
                        <div class="lilo-accordion-content" style="display: block;"><div id="container-w36" class="parent-div-div MEasySelectable">
                                <ul id="easySelectable" class="easySelectable flex justify-content-around parrentbody row rmrl-container" rmrl-elemid="0">
                                    <li class="es-selectable col-md-3" data-value="1">
                                        <img src="/uploaz//ShopBrand/image/TomFord.png" class="ml-20 marketImg">
                                    </li>        <li class="es-selectable col-md-3" data-value="2">
                                        <img src="/uploaz//ShopBrand/image/bmw.jpg" class="ml-20 marketImg">
                                    </li>        <li class="es-selectable col-md-3" data-value="3">
                                        <img src="/uploaz//ShopBrand/image/huawei.jpg" class="ml-20 marketImg">
                                    </li>        <li class="es-selectable col-md-3" data-value="4" style="display: none;">
                                        <img src="/uploaz//ShopBrand/image/TommyHilfiger.png" class="ml-20 marketImg">
                                    </li>        <li class="es-selectable col-md-3" data-value="5" style="display: none;">
                                        <img src="/uploaz//ShopBrand/image/gucci.png" class="ml-20 marketImg">
                                    </li>        <li class="es-selectable col-md-3" data-value="6" style="display: none;">
                                        <img src="/uploaz//ShopBrand/image/levis.png" class="ml-20 marketImg">
                                    </li>        <li class="es-selectable col-md-3" data-value="7" style="display: none;">
                                        <img src="/uploaz//ShopBrand/image/mercedesbenz.jpg" class="ml-20 marketImg">
                                    </li>        <li class="es-selectable col-md-3" data-value="8" style="display: none;">
                                        <img src="/uploaz//ShopBrand/image/lg.png" class="ml-20 marketImg">
                                    </li>        <li class="es-selectable col-md-3" data-value="9" style="display: none;">
                                        <img src="/uploaz//ShopBrand/image/lg.jpg" class="ml-20 marketImg">
                                    </li>        <li class="es-selectable col-md-3" data-value="10" style="display: none;">
                                        <img src="/uploaz//ShopBrand/image/HP-logo-2010–2012.jpg" class="ml-20 marketImg">
                                    </li>        <li class="es-selectable col-md-3" data-value="11" style="display: none;">
                                        <img src="/uploaz//ShopBrand/image/samsung.jpg" class="ml-20 marketImg">
                                    </li>        <li class="es-selectable col-md-3" data-value="12" style="display: none;">
                                        <img src="/uploaz//ShopBrand/image/asus-6630.svg" class="ml-20 marketImg">
                                    </li>        <li class="es-selectable col-md-3" data-value="13" style="display: none;">
                                        <img src="/uploaz//ShopBrand/image/apple.jpg" class="ml-20 marketImg">
                                    </li>        <li class="es-selectable col-md-3" data-value="14" style="display: none;">
                                        <img src="/uploaz//ShopBrand/image/acer.jpg" class="ml-20 marketImg">
                                    </li>        <li class="es-selectable col-md-3" data-value="15" style="display: none;">
                                        <img src="/uploaz//ShopBrand/image/lenov.png" class="ml-20 marketImg">
                                    </li>        <li class="es-selectable col-md-3" data-value="16" style="display: none;">
                                        <img src="/uploaz//ShopBrand/image/xiaomi-Mi-red-banner-800x450.jpg" class="ml-20 marketImg">
                                    </li>        <li class="es-selectable col-md-3" data-value="17" style="display: none;">
                                        <img src="/uploaz//ShopBrand/image/xiaomi-Mi-red-banner-800x450.jpg" class="ml-20 marketImg">
                                    </li>
                                    <span class="rmrl-read-more"> <a href="#" class="button">Показать больше...</a> </span><span class="rmrl-read-less" style="display: none;"> <a href="#" class="button">Показать меньше...</a> </span></ul>
                                <input id="w36-hidden" type="hidden" name="brand" value="[]">
                            </div></div>
                    </div>


                    <div class="help-block invalid-feedback"></div>
                </div>
            </div>
        </div>




        <div class="form-group" style="">
            <div class="highlight-addon row field-zdynamicmodel-branches0">

                <div class="col-md-12">

                    <div class="zlilo" id="zdynamicmodel-branches0">
                        <div class="lilo-accordion-control active" style="display: block;">Особенности</div>
                        <div class="lilo-accordion-content" style="display: block;">
                            <div class="w-100  accordion md-accordion" id="accordion-wrap-w38" role="tablist" aria-multiselectable="true">
                                <div class="card pb-2">
                                    <div class="d-flex justify-content-between darkTheme" role="tab">


                                        <!-- item nameOn -->

                                        <a class="align-items-center w-100 collapsed" role="button" data-toggle="collapse" href="#accordion-w38" aria-expanded="false" aria-controls="accordion-w38">
                                            <div class="row align-items-center card-header p-2 w-100">
                                                <div class="col-md-10">
                                                    <div class="text-dark">
                                                        Размер
                                                    </div>
                                                </div>
                                                <div class="col-md-2 pr-0 text-right">
                                                    <i class="fas fa-angle-down green-text-color"></i>
                                                </div>

                                            </div>
                                        </a>

                                        <!-- item nameOn end -->


                                    </div>
                                    <!-- content -->

                                    <div id="accordion-w38" class="collapse pl-0 show" role="tabpanel" aria-labelledby="accordion-w38">

                                        <div class="card-body p-0 accPanelBody rmrl-container" id="accPanelBody" rmrl-elemid="1">

                                        </div>

                                    </div>

                                    <!-- end content -->
                                </div>
                                <!-- end of panel -->
                            </div>
                            <div class="w-100  accordion md-accordion" id="accordion-wrap-w40" role="tablist" aria-multiselectable="true">
                                <div class="card pb-2">
                                    <div class="d-flex justify-content-between darkTheme" role="tab">


                                        <!-- item nameOn -->

                                        <a class="align-items-center w-100 collapsed" role="button" data-toggle="collapse" href="#accordion-w40" aria-expanded="false" aria-controls="accordion-w40">
                                            <div class="row align-items-center card-header p-2 w-100">
                                                <div class="col-md-10">
                                                    <div class="text-dark">
                                                        Вес
                                                    </div>
                                                </div>
                                                <div class="col-md-2 pr-0 text-right">
                                                    <i class="fas fa-angle-down green-text-color"></i>
                                                </div>

                                            </div>
                                        </a>

                                        <!-- item nameOn end -->


                                    </div>
                                    <!-- content -->

                                    <div id="accordion-w40" class="collapse pl-0 show" role="tabpanel" aria-labelledby="accordion-w40">

                                        <div class="card-body p-0 accPanelBody rmrl-container" id="accPanelBody" rmrl-elemid="2">

                                        </div>

                                    </div>

                                    <!-- end content -->
                                </div>
                                <!-- end of panel -->
                            </div></div>
                    </div>


                    <div class="help-block invalid-feedback"></div>
                </div>
            </div>
        </div>




        <div class="form-group" style="">
            <div class="highlight-addon row field-zdynamicmodel-branches1">

                <div class="col-md-12">

                    <div class="zlilo" id="zdynamicmodel-branches1">
                        <div class="lilo-accordion-control active" style="display: block;">Тип продукта</div>
                        <div class="lilo-accordion-content" style="display: block;">
                            <div class="w-100  accordion md-accordion" id="accordion-wrap-w42" role="tablist" aria-multiselectable="true">
                                <div class="card pb-2">
                                    <div class="d-flex justify-content-between darkTheme" role="tab">


                                        <!-- item nameOn -->

                                        <a class="align-items-center w-100 collapsed" role="button" data-toggle="collapse" href="#accordion-w42" aria-expanded="false" aria-controls="accordion-w42">
                                            <div class="row align-items-center card-header p-2 w-100">
                                                <div class="col-md-10">
                                                    <div class="text-dark">
                                                        Оперативная память
                                                    </div>
                                                </div>
                                                <div class="col-md-2 pr-0 text-right">
                                                    <i class="fas fa-angle-down green-text-color"></i>
                                                </div>

                                            </div>
                                        </a>

                                        <!-- item nameOn end -->


                                    </div>
                                    <!-- content -->

                                    <div id="accordion-w42" class="collapse pl-0 show" role="tabpanel" aria-labelledby="accordion-w42">

                                        <div class="card-body p-0 accPanelBody rmrl-container" id="accPanelBody" rmrl-elemid="3">

                                        </div>

                                    </div>

                                    <!-- end content -->
                                </div>
                                <!-- end of panel -->
                            </div>
                            <div class="w-100  accordion md-accordion" id="accordion-wrap-w44" role="tablist" aria-multiselectable="true">
                                <div class="card pb-2">
                                    <div class="d-flex justify-content-between darkTheme" role="tab">


                                        <!-- item nameOn -->

                                        <a class="align-items-center w-100 collapsed" role="button" data-toggle="collapse" href="#accordion-w44" aria-expanded="false" aria-controls="accordion-w44">
                                            <div class="row align-items-center card-header p-2 w-100">
                                                <div class="col-md-10">
                                                    <div class="text-dark">
                                                        Тип экрана
                                                    </div>
                                                </div>
                                                <div class="col-md-2 pr-0 text-right">
                                                    <i class="fas fa-angle-down green-text-color"></i>
                                                </div>

                                            </div>
                                        </a>

                                        <!-- item nameOn end -->


                                    </div>
                                    <!-- content -->

                                    <div id="accordion-w44" class="collapse pl-0 show" role="tabpanel" aria-labelledby="accordion-w44">

                                        <div class="card-body p-0 accPanelBody rmrl-container" id="accPanelBody" rmrl-elemid="4">

                                        </div>

                                    </div>

                                    <!-- end content -->
                                </div>
                                <!-- end of panel -->
                            </div></div>
                    </div>


                    <div class="help-block invalid-feedback"></div>
                </div>
            </div>
        </div>




        <div class="form-group" style="">
            <div class="highlight-addon row field-zdynamicmodel-branches2">

                <div class="col-md-12">

                    <div class="zlilo" id="zdynamicmodel-branches2">
                        <div class="lilo-accordion-control active" style="display: block;">Дизайн</div>
                        <div class="lilo-accordion-content" style="display: block;">
                            <div class="w-100  accordion md-accordion" id="accordion-wrap-w46" role="tablist" aria-multiselectable="true">
                                <div class="card pb-2">
                                    <div class="d-flex justify-content-between darkTheme" role="tab">


                                        <!-- item nameOn -->

                                        <a class="align-items-center w-100 collapsed" role="button" data-toggle="collapse" href="#accordion-w46" aria-expanded="false" aria-controls="accordion-w46">
                                            <div class="row align-items-center card-header p-2 w-100">
                                                <div class="col-md-10">
                                                    <div class="text-dark">
                                                        Память
                                                    </div>
                                                </div>
                                                <div class="col-md-2 pr-0 text-right">
                                                    <i class="fas fa-angle-down green-text-color"></i>
                                                </div>

                                            </div>
                                        </a>

                                        <!-- item nameOn end -->


                                    </div>
                                    <!-- content -->

                                    <div id="accordion-w46" class="collapse pl-0 show" role="tabpanel" aria-labelledby="accordion-w46">

                                        <div class="card-body p-0 accPanelBody rmrl-container" id="accPanelBody" rmrl-elemid="5">

                                        </div>

                                    </div>

                                    <!-- end content -->
                                </div>
                                <!-- end of panel -->
                            </div>
                            <div class="w-100  accordion md-accordion" id="accordion-wrap-w48" role="tablist" aria-multiselectable="true">
                                <div class="card pb-2">
                                    <div class="d-flex justify-content-between darkTheme" role="tab">


                                        <!-- item nameOn -->

                                        <a class="align-items-center w-100 collapsed" role="button" data-toggle="collapse" href="#accordion-w48" aria-expanded="false" aria-controls="accordion-w48">
                                            <div class="row align-items-center card-header p-2 w-100">
                                                <div class="col-md-10">
                                                    <div class="text-dark">
                                                        Цвет
                                                    </div>
                                                </div>
                                                <div class="col-md-2 pr-0 text-right">
                                                    <i class="fas fa-angle-down green-text-color"></i>
                                                </div>

                                            </div>
                                        </a>

                                        <!-- item nameOn end -->


                                    </div>
                                    <!-- content -->

                                    <div id="accordion-w48" class="collapse pl-0 show" role="tabpanel" aria-labelledby="accordion-w48">

                                        <div class="card-body p-0 accPanelBody rmrl-container" id="accPanelBody" rmrl-elemid="6">

                                        </div>

                                    </div>

                                    <!-- end content -->
                                </div>
                                <!-- end of panel -->
                            </div></div>
                    </div>


                    <div class="help-block invalid-feedback"></div>
                </div>
            </div>
        </div>




        <div class="form-group" style="">
            <div class="highlight-addon row field-zdynamicmodel-hidden_input">

                <div class="col-md-12">
                    <div class="md-form m-0 " id="zdynamicmodel-hidden_input_div">

                        <input type="hidden" id="zdynamicmodel-hidden_input" class="kv-editable-input form-control " name="ZDynamicModel[hidden_input]">


                    </div>


                    <div class="help-block invalid-feedback"></div>
                </div>
            </div>
        </div>




    </form></div>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
