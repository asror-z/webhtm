<?php

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
 * @author MirbositMurodov 15.10.2020
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
    echo ZSessionGrowlWidget::widget();
    $id = $this->httpGet('id');
    $modelClassName = $this->bootFullUrl();

    $model = $modelClassName::findOne($id);

    $returns = '<div class="row">';

    $id = ZArrayHelper::getValue($model, 'id');

    $itemClass = $modelClassName;

    $itemModel = new $itemClass();
    
    ?>
    <div class="pt-3 pl-5">

        <?php

        $many = $itemModel->configs->relationMany;
        
        if (!empty($many)) {
            foreach ($many as $parametr => $relation) {

                $arr = explode("\\", $relation);
                $count = count($arr) - 1;

                $key = $relation . '[' . $parametr . ']';

                $url = ZUrl::to([
                    '/core/read/items',
                    'modelClassName' => $relation,
                    $key => $id,
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
                    'event' => [
                        'click' => <<<JS
                    function() {
                    
                        window.itemsPanel()
                        
                        var iframe = $('#jsPanel-items-dyna-iframe');
                        $('#jsPanel-items-dyna').find('.jsPanel-title').text('{$title}')
                        iframe.attr('src', '{$url}')
                        
                    }
JS,
                    ],

                ]);
            }
        }

        $returns .= '</div></div>';

        echo $returns;

        ?>

    </div>

    <?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
