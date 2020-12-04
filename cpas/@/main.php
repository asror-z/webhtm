<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\former\chart\ChartForm;use zetsoft\former\eyuf\EyufProgramForm;
use zetsoft\models\cpas\CpasLand;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\shop\ShopBrand;
use zetsoft\widgets\market\ZFooterAllWidgetOrg;
use zetsoft\widgets\navigat\ZBreadcrumbsWidget;
use zetsoft\widgets\charts\ZChartFormWidget;



/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Создание Бренды';
$action->icon = 'fa fa-globe';
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
    require Root . '/webhtm/block/assets/App/main_arbit.php';

    $this->head();

    ?>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

require Root . '/webhtm/block/navbar/mainArbit.php';;


echo ZNProgressWidget::widget([]);

echo ZNProgressWidget::widget([]);


?>

<div id="page">

    <?
    
    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="container-fluid  grey lighten-5 p-3">

        <div>
            <h2>Главная</h2>
            <?
                /*echo ZBreadcrumbsWidget::widget();*/
            ?>
        </div>

        <div>
            <?
            ZCardWidget::begin([
                'config' => [
                    'title' => 'Статистика',
                ]
            ]);

            $day = $this->httpGet('day');
            $user_company_id = $this->httpGet('companyId');

            $forms = Az::$app->market->order->getOrderStatsByStatus($day, $user_company_id)['forms'];
            /*vdd($forms->columnsList());*/

            echo ZChartFormWidget::widget([
                'data' => $forms,
                'model' => new ChartForm(),
                'config' => [
                    'title' => Azl . ('Активные заказы за ' . $day . ' дней'),
                    'type' => ZChartFormWidget::type['lineStack'],
                    'theme' => ZChartFormWidget::theme['shine']
                ]
            ]);

            ZCardWidget::end();

            ?>
        </div>

        <div>
            <?
            ZCardWidget::begin([
                'config' => [
                    'title' => 'Статистика',
                ]
            ]);


            ZCardWidget::end();

            ?>
        </div>
            


    </div>
   <!-- --><?/*=$this->require( '\blocks\footer\cpas\footer.php')*/?>
</div>



<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
