<?php

use phpDocumentor\Reflection\Types\Nullable;
use zetsoft\dbitem\core\WebItem;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZInflector;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoftspace\Test5;


/**
 *
 * Action Params
 * @author MurodovMirbosit 15.10.2020
 */

$action = new WebItem();

$action->title = Azl . 'Просмотр testd';
$action->icon = 'fal fa-paper-plane';
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


?>

<div id="page" class="col-md-12">
    <?
    echo ZSessionGrowlWidget::widget();

    $ids = $this->httpGet('id');

    $modelClassName = $this->httpGet('modelClassName');

    $modelClass = $this->bootFull($modelClassName);
          vdd($modelClass);
    $model = $modelClass::findOne($ids);

    $id = ZArrayHelper::getValue($model, 'id');

    $returns = '<div class="row">';

    $itemClass = $modelClass;

    $itemModel = new $itemClass();

    $multi = $itemModel->configs->relationMulti;

    if (!empty($multi)) {
        foreach ($multi as $parametr => $relation) {

            $array = explode("\\", $parametr);

            $count = count($array)-1;
            end($array);

            $key = $relation . '[' . $parametr . ']';
            if (!$key === 'id') {
                $key = $relation . '[' . $parametr . '][]';

            }

            $url = ZUrl::to([
                '/core/read/multiItems',
                'modelClassName' => $relation,
                $key => $id
            ]);

            $title = 'Поиск по ' . $parametr;
            $icon = Az::$app->utility->mains->icon();
            $returns .= ZButtonWidget::widget([
                'config' => [
                    'btnSize' => ZColor::btnSize['btn-manual'],
                    'text' => $title,
                    'url' => $url,
                    'icon' => $icon . ' mr-2 fp-20',
                    'pjax' => 0,
                    'btnRounded' => false,
                    'class' => 'ZDynaBTN d-flex align-items-center w-33 h-100 mb-2',
                    'btn' => true,
                    'target' => ZButtonWidget::target['_self'],
                    'btnStyle' => ZButtonWidget::btnStyle['none'],
                    'blank' => true,
                    'hasIcon' => true,

                ],
            ]);
        }
    }

    $returns .= '</div>';

    echo $returns;

    ?>

</div>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
