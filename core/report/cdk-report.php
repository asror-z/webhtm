<?php

/**
 * @author NurbekMakhmudov &&  Xolmat Ravshanov
 */

use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\ALLApp;
use zetsoft\dbitem\data\Config;
use zetsoft\dbitem\data\Form;
use zetsoft\former\reports\ReportCdk;
use zetsoft\former\reports\ReportsCdkForm;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZPeriodPickerCallWidget;
use zetsoft\widgets\inputes\ZPeriodPickerWidgetX;
use zetsoft\widgets\navigat\ZButtonWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'СКД Ежедневный отчёт';
$action->icon = 'fa fa-pie-chart';
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

$this->beginBody();
?>


<div id="page">

    <?
    
    $data = Az::$app->market->reportCdk->fillForm();
    
    $post = $this->httpPost('ZDynamicModel');
    
    $dateBegin = null;
    $dateEnd = null;

    if (!empty($post)) {
    
        $setSession = [];

        $dateBegin = ZArrayHelper::getValue($post['period'], 0);
        $dateEnd = ZArrayHelper::getValue($post['period'], 1);;


        $dateBegin = strtotime($dateBegin);
        $dateEnd = strtotime($dateEnd);

        $dateBegin = date('Y-m-d H:i:s', $dateBegin);
        $dateEnd = date('Y-m-d H:i:s', $dateEnd);

        $setSession[] = $dateBegin;
        $setSession[] = $dateEnd;

        if (!empty($dateBegin) && !empty($dateEnd)) {

            $this->sessionSet('cdk-report', $setSession);
            $data = Az::$app->market->reportCdk->fillForm($dateBegin, $dateEnd);
            $this->urlRefresh();

        }
    }

    $session = $this->sessionGet('cdk-report');

    if ($session)
        $data = Az::$app->market->reportCdk->fillForm($session[0], $session[1]);

    $model = new ReportsCdkForm();

    $model->columns();
    
    $app = new ALLApp();

    $config = new Config();
    $config->hasLabel = false;

    $column = new Form();
    $column->title = '';

    $column->widget = ZPeriodPickerCallWidget::class;
    $column->options = [
        'config' => [
            'valueStart' => 'start',
            'valueEnd' => 'end',
            'formatDateTime' => 'YYYY-MM-DD HH:mm:ss',
            'timepicker' => true,
        ],
        'value' => $session ?? null
    ];

    $app->configs = $config;
    $app->columns['period'] = $column;

    $model_d = Az::$app->forms->former->model($app);

    ?>

    <div class="col-sm-12  mt-3">
        <?php
        $form = $this->ajaxBegin();
        ?>

        <div class="row">
            <div class="col-12 d-flex">

                <?php

                $formBtn = ZFormWidget::widget([
                    'model' => $model_d,
                    'form' => $form,
                    'config' => [
                        'topBtn' => false,
                        'botBtn' => false,
                    ],
                ]); ?>

                <div class="col-6 d-grid">
                    <?php
                    $filterBtn = ZButtonWidget::widget([
                        'config' => [
                            'text' => Az::l('Филтровать'),
                            'btnType' => ZButtonWidget::btnType['submit'],
                            'btnRounded' => false,
                            'btnStyle' => 'text-success border border-success sm ml-2 h-50 mt-4',
                            'class' => 'p-1 pl-3 pr-3',
                        ]
                    ]);
                    ?>
                </div>

                <div class="col-6 d-grid ">
                    <?php
                    $clearFilterBtn = ZButtonWidget::widget([
                        'config' => [
                            'text' => Az::l('Очистить фильтр'),
                            'btnType' => ZButtonWidget::btnType['button'],
                            'btnRounded' => false,
                            'btnStyle' => 'text-success border border-success sm ml-2 h-50 mt-4',
                            'class' => 'p-1 pl-3 pr-3',
                        ],
                        'event' => [
                            'click' => <<<JS
                                                $.ajax({
                                                    type: 'POST',
                                                    url: '/core/product/cdk_clear_filter.aspx',
                                                    success: function (response) {
                                                        location.reload(); 
                                                    },
                                                });
JS
                        ],
                    ]);
                    ?>
                </div>

            </div>
        </div>

        <?
        echo ZDynaWidget::widget([
            'model' => $model,
            'data' => $data,
            'rightNameEx' => [
                'system',
                'add-clone-delete'
            ],
            'type' => ZDynaWidget::type['form'],
            'leftBtn' => [
                'update' => [
                    'content' => "{$formBtn}{$filterBtn}{$clearFilterBtn}",
                    'options' => [
                        'class' => 'btn-group p-1 mr-2 {btnSize} {iconSize}',
                    ]
                ],
            ],
            'config' => [
                'title' => 'СКД Ежедневный отчёт',
                'type' => 'form',

                'hasToolbar' => true,
                'editableLink' => true,
                'search' => false,
                'copy' => false,
                'columnBefore' => [
                    'false'
                ],
                'isCard' => true,
                'columnAfter' => ['asd'],
                'theme' => 'success',
                'bordered' => false,
                'striped' => false,
            ]
        ]);
        ?>

        <?php
            $this->ajaxEnd();
        ?>
    </div>

    <style>
        .period_picker_input {
            /*margin-top: 10px !important;*/
        }
    </style>

    <? require Root . '\webhtm\block\footer\footerAdmin.php' ?>
</div>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>


