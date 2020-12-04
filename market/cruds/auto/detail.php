<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDetailWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\auto\Auto;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Детали Транспортные средства';
$action->icon = 'fa fa-car';
$action->type = WebItem::type['html'];
$action->csrf = true;

if ($this->httpGet('spa'))
    $action->debug = false;






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
if (!$this->httpGet('spa'))
    echo ZMmenuWidget::widget();
?>

<div id="page">

    <?

    if (!$this->httpGet('spa'))
        require Root . '/webhtm/block/navbar/admin.php';

  //  echo ZSessionGrowlWidget::widget();



    ?>

    <div id="content" class="content-footer p-3">


        <div class="row">
            <div class="col-md-12">

                <?


                $id = $this->httpGet('id');
                $model = Auto::findOne($id);

                if ($this->modelSave($model)) {
                    $this->paramSet(paramIframe, true);
                    $this->urlRedirect([
                        'index',
                        'sort' => '-id'
                    ]);

          //          $this->urlRedirect('index.aspx?dd=ad');
                }

                echo ZDetailWidget::widget([
                    'model' => $model,
                ]);

                ?>

            </div>
        </div>


    </div>
    <?/*= $this->require( '/webhtm\block\footer\mplace\footerAll.php') */?>
</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
