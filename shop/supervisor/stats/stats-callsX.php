<?php

/**
 * Author:  Xolmat Ravshanov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\ALLApp;
use zetsoft\dbitem\data\Config;
use zetsoft\dbitem\data\ConfigDB;
use zetsoft\dbitem\data\Form;
use zetsoft\former\calls\CallsStatsForm;
use zetsoft\models\shop\ShopOrder;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZDynaWidgetD;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZHHiddenInputWidget;
use zetsoft\widgets\inputes\ZKDateRangePickerWidget;
use zetsoft\widgets\inputes\ZPeriodPickerWidget;
use zetsoft\widgets\inputes\ZPeriodPickerWidgetX;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\navigat\ZButtonWidget;

/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Статусы звонков';
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
if (!$this->httpGet('spa'))
    require Root . '/webhtm/block/navbar/admin.php';

if (!$this->httpGet('spa'))
    echo ZMmenuWidget::widget([
        //'data' => $this->cores->menus->create('mmenu'),
        'config' => [
            'theme' => 'white',
            'content.img.width' => 230,
            'iconbar.top' => [
                "<a href='#/'><i class='fa fa-home'></i>cc</a>",
                "<a href='#/'><i class='fa fa-home'></i>cc</a>",
            ],
            'iconbar.bottom' => [
                "<a href='#/'><i class='fa fa-home'></i>aa</a>",
                "<a href='#/'><i class='fa fa-home'></i>cc</a>",
            ],
            'all.border' => ZMmenuWidget::border['border-full'],
            'menu-effect-slide' => true,
        ],
    ]);
?>


<div id="page">

    <?
    $data = Az::$app->calls->stats->agentCallStast();
    $post = $this->httpPost('ZDynamicModel');
    $dateBegin = null;
    $dateEnd = null;
    if (!empty($post)) {
        $setSession = [];

        $dateBegin = $post['period'][0];
        $dateEnd = $post['period'][1];

        $dateBegin = strtotime($dateBegin);
        $dateEnd = strtotime($dateEnd);

        $dateBegin =  date('d/m/Y H:i:s', $dateBegin);
        $dateEnd =  date('d/m/Y H:i:s', $dateEnd);

        $setSession[] = $dateBegin;
        $setSession[] = $dateEnd;

        if (!empty($dateBegin) && !empty($dateEnd)) {

            $this->sessionSet('stat_status', $setSession);
            $data = Az::$app->calls->stats->agentCallStast($dateBegin, $dateEnd);
            $this->urlRefresh();

        }
    }

    $session = $this->sessionGet('stat_status');
    if ($session)
        $data = Az::$app->calls->stats->agentCallStast($session[0], $session[1]);


    $model = new CallsStatsForm();

    $model->columns();
    $app = new ALLApp();

    $config = new Config();
    $config->hasLabel = false;

    $column = new Form();
    $column->title = 'form_id';

    $column->widget = ZPeriodPickerWidgetX::class;
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
    <div class="col-sm-4  mt-3">
        <?php
        $form = $this->ajaxBegin();
        ?>


            <div class="row">
                <div class="col-12 d-flex">

                    <?php

                    echo ZFormWidget::widget([
                        'model' => $model_d,
                        'form' => $form,
                        'config' => [
                            'topBtn' => false,
                            'botBtn' => false,
                        ],
                    ]); ?>
                    <div class="col-6 d-grid">
                        <?php
                        echo ZButtonWidget::widget([
                            'config' => [
                                'text' => Az::l('Филтровать'),
                                'btnType' => ZButtonWidget::btnType['submit'],
                                'btnRounded' => false,
                                'btnStyle' => 'text-success border border-success',
                                'btnSize' => 'btn-ml',
                                'class' => 'p-1 pl-3 pr-3',
                            ]

                        ]);

                        ?>
                    </div>
                    <div class="col-6 d-grid">
                        <?php
                        echo ZButtonWidget::widget([
                            'config' => [
                                'text' => Az::l('Очистить фильтр'),
                                'btnType' => ZButtonWidget::btnType['button'],
                                'btnRounded' => false,
                                'btnStyle' => 'text-success border border-success',
                                'btnSize' => 'btn-ml',
                                'class' => 'p-1 pl-3 pr-3',
                            ],
                            'event' => [
                                'click' => <<<JS
                                        function() {
                                                $.ajax({
                                                    type: 'POST',
                                                    url: '/core/product/rangeClearCalls.aspx',
                                                    success: function (response) {
                                                        location.reload();
                                                    },
                                                });
                                            
                                        }
JS
                            ],
                        ]);
                        ?>
                    </div>
                </div>
            </div>





        <?php
        $this->ajaxEnd();
        ?>
    </div>

    <style>
        .period_picker_input{
            margin-top: 10px!important;
        }
    </style>


    <?
    echo ZDynaWidget::widget([
        'model' => $model,
        'data' => $data,
        'rightNameEx' => [
            'system'
        ],
        'type' => ZDynaWidget::type['form'],
        'config' => [
            'hasToolbar' => true,
        ]


    ]);

    ?>
    <? require Root . '\webhtm\block\footer\footerAdmin.php' ?>
</div>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>


