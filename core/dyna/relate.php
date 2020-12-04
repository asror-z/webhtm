<?php

use yii\web\View;
use zetsoft\dbitem\core\WebItem;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZInflector;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\system\module\Models;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaRelationWidget;
use zetsoft\widgets\former\ZViewWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZModalWidgetRavshan;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoftspace\Test5;


/**
 *
 * Action Params
 * @author Shahzod Gulomqodirov
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

echo ZNProgressWidget::widget([]);
if (!$this->httpGet('spa'))
    echo ZMmenuWidget::widget();

?>

<div id="page" class="col-md-12">
    <?
    if (!$this->httpGet('spa'))
        require Root . '/webhtm/block/navbar/admin.php';

    echo ZSessionGrowlWidget::widget();
    $id = $this->httpGet('id');
   
    $modelClassName = $this->bootFullUrl();
   
    $model = $modelClassName::findOne($id);

    $hasMany = $model->configs->hasMany;
    $hasOne = $model->configs->hasOne;
    $hasMulti = $model->configs->hasMulti;
    $isBtn = $model->configs->relationBtn;

    $returns = '<div class="row">';

    $inv = [
        'created_by',
        'modified_by',
        'delete_by',
    ];
    //start: MurodovMirbosit 12.10.2020
    $modelName = ZInflector::dash($modelClassName);
    $modelBase = bname($modelName);
    $url = "/cruds/$modelBase/index";
    //end

    foreach ($hasMany as $className => $relation) {

        if (ZArrayHelper::isIn(ZArrayHelper::getValue(array_keys($relation), 0), $inv)) {
            continue;
        }

        $relatedTable = ZArrayHelper::getValue(array_keys($relation), 0);
        $relatedColumn = ZArrayHelper::getValue(array_values($relation), 0);
         
        $table_name = ZInflector::dash($className);

        //start: MurodovMirbosit 12.10.2020
        $url = ZUrl::to([
            "/crud/$table_name/index",
            $className . '[' . $relatedTable . ']' => $model->$relatedColumn
        ]);
        //end
        
        $class = $this->bootFull($className);

        if (!class_exists($class)) {
            continue;
        }

        /** @var Models $item */

        $item = new $class();

        $title = $item->configs->title;

        $icon = Az::$app->utility->mains->icon();
        if ($relatedTable !== null) {
            $returns .= '<div class="col-md-3 ">';
            $returns .= ZButtonWidget::widget([
                'config' => [
                    'btnSize' => ZColor::btnSize['btn-manual'],
                    'text' => $title,
                    'url' => $url,
                    'icon' => $icon . ' mr-2 fp-20',
                    'pjax' => 0,
                    'btnRounded' => false,
                    'class' => 'ZDynaBTN d-flex align-items-center w-100 h-100   mb-2',
                    'btn' => true,
                    'target' => ZButtonWidget::target['_self'],
                    'btnStyle' => ZButtonWidget::btnStyle['none'],
                    'blank' => true,
                    'hasIcon' => true,

                ],
                'event' => [
                    'click' => 'function (event){e.preventDefault()}'
                ]

            ]);
            $returns .= '</div>';
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
