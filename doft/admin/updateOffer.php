<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\cpas\CpasOffer;
use zetsoft\models\cpas\CpasOfferItem;
use zetsoft\models\cpas\CpasLand;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZListViewWidget;
use zetsoft\widgets\inputes\ZSelect2Widget;
use zetsoft\widgets\navigat\ZBreadcrumbsWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 * @author Shahzod Gulomqodirov
 */

$action = new WebItem();

$action->title = Azl . 'Офферы';
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
    require Root . '/webhtm/block/assets/main.php';

    $this->head();

    ?>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

require Root . '/webhtm/block/navbar/mainArbit.php';


echo ZNProgressWidget::widget([]);

echo ZNProgressWidget::widget([]);


?>

<div id="page">

    <?

    echo ZSessionGrowlWidget::widget();$this->userIdentity()->user_company_id;

    ?>
    <div class="container-fluid  grey lighten-5">
        <?php
        $active = new Active();
        $active->type = Active::type['vertical'];
        $form = $this->activeBegin($active);

        $id = $this->httpGet('id');
        $model = CpasOffer::findOne($id);
        $model->columns();

        ZCardWidget::begin([
            'config' => [
                'title' => 'Изминить оффер',
                'type' => ZCardWidget::type['dynCard'],
                'classHeadColor' => 'bg-white text-dark',
            ]
        ]);
        echo ZFormBuildWidget::widget([
            'model' =>  $model,
            'form' => $form,
        ]);

        ZCardWidget::end();
        $this->activeEnd();
        $url = ZUrl::to([
            '/cpas/admin/offer',
        ]);

        if ($this->modelSave($model)) {
            return $this->urlRedirect($url);
        }

        ?>
    </div>


</div>


<?php $this->endBody() ?>

</body>

</html>

<?php $this->endPage() ?>
