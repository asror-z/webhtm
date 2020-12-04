<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\place\PlaceAdress;
use zetsoft\models\ware\WareExit;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\ware\Ware;



/** @var ZView $this */


/**
 *
 * Action Params
 * @author MurodovMirbosit
 */
 
$action = new WebItem();

$action->title = Azl . 'Список складов';
$action->icon = 'fal fa-graduation-cap';
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
echo ZMmenuWidget::widget([]);
?>

<div id="page">

    <?
    require Root . '/webhtm/block/header/main.php';
    require Root . '/webhtm/block/navbar/admin.php';
    
    echo ZSessionGrowlWidget::widget();?>


        <div class="row">
            <div class="col-md-12 col-12">

                <?

                $model = new Ware();
                $place_region_id = $this->userIdentity()->place_region_id;

                $place_adress_id = PlaceAdress::find()
                    ->where([
                        'place_region_id' => $place_region_id
                    ])
                    ->all();

                $place_adress_ids = ZArrayHelper::getColumn($place_adress_id, 'id');

                $ware = Ware::find()
                    ->where([
                        'place_adress_id' => $place_adress_ids
                    ])
                    ->all();

                $ware_ids = ZArrayHelper::getColumn($ware, 'id');
                $model->configs->query = Ware::find()
                    ->where([
                        'ware_id' => $ware_ids,
                    ]);

                /** @var ZView $this */
                echo ZDynaWidget::widget([
                    'model' => $model,
                    'rightNameEx' => [
                        'system'
                    ],
                    
                ]);

                ?>

            </div>
        </div>



    <? require Root . '\webhtm\block\footer\footerAdmin.php' ?>
</div>



<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
