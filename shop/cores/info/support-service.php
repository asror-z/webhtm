<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\market\ZFooterAllWidgetOrg;
use zetsoft\widgets\navigat\ZBreadcrumbsWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\page\PageBlocks;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Служба поддержки';
$action->icon = 'fa fa-industry';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;



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

<div id="page">

    <?
    require Root . '/webhtm/block/header/main.php';
    require Root . '/webhtm/block/navbar/main.php';

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">


        <?php
        ?>
                   
                <div class="container" >
                    <div class="row text-center" >
                        <div class="col-lg-12"><h1>Поддержка на наших ресурсах</h1></div>
                    </div>
                    <div class="row text-center mt-5">
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <i class="fas fa-file-alt fp-40 mt-2" style="color:  #28a745"></i>
                            <h4>
                                Документация
                            </h4>
                            <p>Получить информацию о предоставляемых услугах, действующих тарифах и акциях</p>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <i class="fas fa-comments fp-40" style="color:  #28a745"></i>
                            <h4>
                                Документация
                            </h4>
                            <p>Предоставление справочной информации по услугам Компании, консультации и рекомендации</p>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <i class="fas fa-search fp-40" style="color:  #28a745"></i>
                            <h4>
                                Документация
                            </h4>
                            <p>Предоставление информации о проводимых аварийных, технических и профилактических работах</p>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12">
                            <i class="fas fa-search fp-40" style="color:  #28a745"></i>
                            <h4>
                                Документация
                            </h4>
                            <p>Подключение/отключение услуг, отключение контент-услуг;  предоставление списка </p>
                        </div>
                    </div>
                </div>
                    <div class="container-fluid mt-5 ">
                        <div class="row text-center">
                            <div class="col-lg-12"><h1>С нами удобно</h1></div>
                        </div>
                        <div class="row text-center mt-5" >
                            <div class="col-lg-4  mt-4 col-md-12">
                                <div class="card mx-auto h-100" style="width: 25rem;border-radius: 30px; box-shadow:0 0 10px  #28a745; ">
                                    <div class="card-body">
                                        <i class="fas fa-phone-volume fp-40" style="color:  #28a745;font-size:80px;"></i>
                                        <h5 class="card-title">Поддержка на наших ресурсах</h5>


                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 mt-4 col-md-12 ">
                                <div class="card mx-auto h-100" style="width: 25rem;border-radius: 30px; box-shadow:0 0 10px #28a745;">
                                    <div class="card-body">
                                        <i class="fas fa-search  fp-40" style="color: #28a745;font-size:80px;"></i>
                                        <h5 class="card-title">Удаленное подключение специалиста к Вашему
                                            компьютеру (услуга платная)
                                        </h5>


                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 mt-4   col-md-12">
                                <div class="card mx-auto" style="width: 25rem;border-radius: 30px; box-shadow:0 0 10px  #28a745;">
                                    <div class="card-body">
                                        <i class="fas fa-file-alt fp-40" style="color:  #28a745;font-size:80px;"></i>
                                        <h5 class="card-title">Напишите свой вопрос в мессенджер или сообщество компании</h5>

                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="row text-center mt-5" >
                            <div class="col-lg-4 mt-4  col-md-12">
                                <div class="card mx-auto" style="width: 25rem;border-radius: 30px;box-shadow:0 0 10px  #28a745;">
                                    <div class="card-body">
                                        <i class="fas fa-money-bill-alt fp-40" style="color:  #28a745;font-size:80px;"></i>
                                        <h5 class="card-title">Удаленное подключение специалиста к Вашему компьютеру (услуга платная)</h5>


                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 mt-4 col-md-12 ">
                                <div class="card mx-auto" style="width: 25rem;border-radius: 30px;box-shadow:0 0 10px #28a745;">
                                    <div class="card-body">
                                        <i class="fas fa-comments fp-40" style="color:  #28a745;font-size:80px;"></i>
                                        <h5 class="card-title">Войдите на портал ESET Connect и отслеживайте статус вашего обращения</h5>


                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 mt-4  col-md-12">
                                <div class="card mx-auto" style="width: 25rem;  border-radius: 30px;box-shadow:0 0 10px  #28a745;">
                                    <div class="card-body">
                                        <i class="fas fa-balance-scale fp-40" style="color:  #28a745;font-size:80px;"></i>
                                        <h5 class="card-title">Получите бесплатную поддержку на наших ресурсах</h5>

                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>



        </div>
    </div>

<script>
    $("#list-example > a").click(function () {
        $("a").removeClass('active')
        $(this).addClass('active')
    })
</script>


<? echo ZFooterAllWidgetOrg::widget() ?>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
