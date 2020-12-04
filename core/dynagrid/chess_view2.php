<?php


use kartik\grid\DataColumn;
use rmrevin\yii\fontawesome\FA;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\TabItem;
use zetsoft\models\dyna\DynaChess;
use zetsoft\models\dyna\DynaChessItem;
use zetsoft\models\dyna\DynaConfig;
use zetsoft\models\page\PageAction;
use zetsoft\system\actives\ZActiveRecord;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZStringHelper;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZListWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\navigat\ZSmartTabWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\widgets\themes\ZTabForDynaWidget;
use function Dash\filter;
use function Dash\values;

$action = new WebItem();

$action->title = Azl . 'Страны';
$action->icon = 'fal fa-landmark';
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


    /** @var ZView $this */
    //$this->fileCss('/block/assets/ALL/all.css');

    $this->head();

    ?>

    <title></title>
</head>

<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

?>

<div id="page">

    <?

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">

        <?php

        $id = (int)$this->httpGet('id');
        $query = $this->httpGet('query');
        $modelClass = $this->httpGet('modelClass');

        if (empty($id))
            throw new Exception('Необходимый параметр не найден');

        $post = $this->httpPost();

        if ($post) {
            $this->sessionSet('chess_filter_values', ZArrayHelper::getValue($post, 'ZDynamicModel'));
            $this->urlRefresh();
        }
         

        Az::$app->cores->chess->id = $id;
        Az::$app->cores->chess->query = $query;

        $filter_val = $this->sessionGet('chess_filter_values');

        if (is_array($filter_val)) {
            Az::$app->cores->chess->filter = $filter_val;
        }
        
        Az::$app->cores->chess->run();
        $model = Az::$app->cores->chess->dynamicModel;
       
        $data = Az::$app->cores->chess->data;
       
        $filter = Az::$app->cores->chess->filterModel;
        $form = $this->ajaxBegin();

        if ($filter !== null) {
        if (is_array($filter_val)) {
            $filter->setAttributes($filter_val);
        }

            echo ZFormBuildWidget::widget([
                'model' => $filter,
                'form' => $form,
                'config' => [
                    'topBtn' => false,
                    'botBtn' => false,
                ]
            ]);


            echo ZButtonWidget::widget([
                'config' => [
                    'text' => Az::l('Филтровать'),
                    'btnRounded' => false,
                    'btnSize' => ZButtonWidget::btnSize['btn-md'],
                    'btnType' => ZButtonWidget::btnType['submit']
                ]
            ]);

            echo ZButtonWidget::widget([
                'config' => [
                    'text' => Az::l('Сбросить фильтр'),
                    'btnRounded' => false,
                    'btnSize' => ZButtonWidget::btnSize['btn-md'],
                    'btnType' => ZButtonWidget::btnType['submit']
                ],
                'event' => [
                    'click' => <<<JS
    function x() {
        $.ajax({
        type: "POST",
        url: '/core/dynagrid/chess_clear_filter.aspx',
        success:  function() {
               window.location.reload();
        },
    });
    }
JS,

                ]
            ]);

        }

       $this->ajaxEnd();


        $chess = ZButtonWidget::widget([
            'config' => [
                'hasIcon' => true,

                'title' => '',

                'target' => ZButtonWidget::target['_self'],

                'grapes' => false,

                'url' => ZUrl::to([
                    '/core/dynagrid/chess',
                    'modelClass' => $modelClass

                ]),
                'class' => 'pb-4 ml-1 rounded-0',
                'btnStyle' => ZButtonWidget::btnStyle['btn-transparent'],
                'btnRounded' => false,
                'icon' => 'fa fa-backward fa-lg' . FA::_CLIPBOARD,
            ],
        ]);

        $model->configs->dynaButtons = [
            'update' => [
                'content' => "{update}{$chess}",
                'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
            ],
        ];

        echo ZDynaWidget::widget([
            'model' => $model,
            'data' => $data,
            'type' => ZDynaWidget::type['form'],
            'rightName' => [
                'update',
                'export'
            ],
            'config' => [
                'showPageSummary' => true,
                'search'=> false,
                'columnAfter' => [
                    'false'
                ],
                'columnBefore' => [
                    'serial'
                ],
            ]
        ]);

        

    ?>

    </div>

</div>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>



