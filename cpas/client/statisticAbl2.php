<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\cpas\CpasTracker;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\inputes\ZDepdropWidget;
use zetsoft\widgets\inputes\ZKDateRangePickerWidget;
use zetsoft\widgets\inputes\ZKDateTimePickerWidget;
use kartik\widgets\DateTimePicker;
use zetsoft\widgets\inputes\ZSelect2Widget;


/** @var ZView $this */


/**
 *
 * Action Params
 * @author Shahzod Gulomqodirov
 */

$action = new WebItem();

$action->title = Azl . 'Потоки';
$action->icon = 'fa fa-globe';
$action->type = WebItem::type['html'];
$action->csrf = false;
$action->debug = false;

$this->urlGetBase();

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

<body class="hold-transition sidebar-mini">

<?php
$this->beginBody();
echo $this->require( '\webhtm\cpas\blocks\header.php')
?>

<div class="container-fluid">

    <div class="row">

        <div class="col-md-12">

           <?php

            echo ZSelect2Widget::widget([
                'name' => 'a',
            ]);

            echo ZSelect2Widget::widget([
                'name' => 'b',
            ]);

            echo ZSelect2Widget::widget([
                'name' => 'c',
            ]);
           ?>
            
        </div>

    </div>

</div>


<?php
echo $this->require( '\webhtm\cpas\blocks\footer.php');
 $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
