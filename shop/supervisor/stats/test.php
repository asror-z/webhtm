<?php

/**
 * Author:  Daho
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\ALLApp;
use zetsoft\dbitem\data\Form;
use zetsoft\former\calls\CallsStatsAgentForm;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZDynaWidgetFilter;
use zetsoft\widgets\inputes\ZPeriodPickerWidgetX;
use zetsoft\widgets\menus\ZMmenuWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Статистика по времени работы операторов';
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

//require Root . '/webhtm/shop/agent/manual/header.php';
//require Root . '/webhtm/shop/agent/manual/navbar.php';
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

    $data = Az::$app->calls->stats->agentWorkedTime();
    $post = $this->httpPost('ZDynamicModel');
    $dateBegin = null;
    $dateEnd = null;
    if (!empty($post)) {
        $setSessionArray = [];
        $dateBegin = $post['period'][0];
        $dateEnd = $post['period'][1];


        //vdd($beginDate);
        $beginDate = strtotime($dateBegin);
        $endDate = strtotime($dateEnd);

        $beginDate = date('d/m/Y H:i:s', $beginDate);
        $endDate = date('d/m/Y H:i:s', $endDate);

        $setSessionArray[] = $beginDate;
        $setSessionArray[] = $endDate;


        if (!empty($beginDate) && !empty($endDate)) {

            $this->sessionSet('agent_status_worked', $setSessionArray);
            $data = Az::$app->calls->stats->agentWorkedTime($beginDate, $endDate);
            $this->urlRefresh();

        }
    }

    $session = $this->sessionGet('agent_status_worked');
    if ($session) {
        $data = Az::$app->calls->stats->agentWorkedTime($session[0], $session[1]);
    }


    $model = new CallsStatsAgentForm();

    $app = new ALLApp();
    $column = new Form();
    $column->title = 'form_id';
    $column->widget = ZPeriodPickerWidgetX::class;
    $column->options = [
        'config' => [
            'valueStart' => 'start',
            'valueEnd' => 'end',
            'formatDateTime' => 'YYYY-MM-DD H:i:s',
            'timepicker' => true
        ],
        'value' => $session ?? null
    ];


    $app->columns['period'] = $column;

    $model_d = Az::$app->forms->former->model($app);
    $model_d->configs->title = 'статистика операторов';
    echo ZDynaWidgetFilter::widget([
        'model' => $model,
        'data' => $data,
        'rightNameEx' => [
            'system',
            'add-clone-delete',
        ],
        'leftNameEx' => [
            'search'
        ],
        'type' => ZDynaWidget::type['form'],
        'leftBtn' => [
            'newBtn' => [
                'content' => '<div class="d-inline-flex">' . $this->require( '/webhtm/shop/agent/manual/periodFilter.php', [
                            'model_d' => $model_d,
                        ]
                    ) . '</div>',
                'options' => [
                    'class' => '',
                ]
            ]
        ],

        

    ]);

    ?>


    <? require Root . '\webhtm\block\footer\footerAdmin.php' ?>
</div>
<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>


