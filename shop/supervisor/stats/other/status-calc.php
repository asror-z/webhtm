<?php
 /*Bosya*/
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\calls\CallsStatus;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;

/** @var ZView $this */

/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Заказы';
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
echo ZMMenuWidget::widget([
    //'data' => $this->cores->menus->create('mmenu'),
    'config' => [
        'content.img.width' => 80,
        'iconbar.top' => [
            "<a href='#/'><i class='fa fa-home'></i>cc</a>",
            "<a href='#/'><i class='fa fa-home'></i>cc</a>",
        ],
        'iconbar.bottom' => [
            "<a href='#/'><i class='fa fa-home'></i>aa</a>",
            "<a href='#/'><i class='fa fa-home'></i>cc</a>",
        ],
    ],
]);
?>

<div id="page">

    <?
    require Root . '/webhtm/block/navbar/admin.php';


    echo ZSessionGrowlWidget::widget();$users = [];
    $operators = Az::$app->market->operator->getUserByRole('agent');

    $firstSelect = null;
    if (!empty($operators)) {
        $firstSelect = $operators[0]['id'];

        foreach ($operators as $operator)
            $users[$operator['id']] = $operator['name'];

    } else {
        echo '<span class="pl-3">' . Az::l("operators are not fount") . '</span>';
    }

    ?>

    <div id="content" class="content-footer p-3">

        <script>
            var agentId = <?=$firstSelect?>;
        </script>


        <div class="row">
            <div class="col-md-4 p-3">
                <?

                //vdd($users);
                echo ZKSelect2Widget::widget([
                    'data' => $users,
                    'name' => 'selectAgent',
                    'event' => [
                        'select' => <<<JS
                                function() {
                                    window.agentId = $(this).val();
                                }
                            JS,
                    ]
                ]);
                ?>
            </div>
            <div class="col-md-4 p-3">
                <?php
                if (!empty($operators))
                    echo ZButtonWidget::widget([
                        'id' => 'w011',
                        'config' => [
                            'btnType' => 'submit',
                            'text' => Az::l('Отправить'),
                            'btnRounded' => false,
                            'btnSize' => 'btn-md mt-0',
                            'btnStyle' => ZButtonWidget::btnStyle['btn-outline-success'],
                            'name' => 'submitOrder'
                        ],


                    ]);
                ?>
            </div>
            <div class="col-md-12 col-12">

                <?

                 $model = new CallsStatus();
                 
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
        <script>
            jQuery.fn.extend({
                attrs: function (attributeName) {
                    var results = [];
                    $.each(this, function (i, item) {
                        results.push(item.getAttribute(attributeName));
                    });
                    return results;
                }
            });
            $('#w011').on("click", function (e) {

                var dynaCheckObj = $(".table-danger").attrs("data-key");
                var dynaCheckJSON = JSON.stringify(dynaCheckObj);
                var agent = $(".select2-selection__rendered").attr("title");

                $.ajax({
                    url: '/core/product/setOrderToAgent.aspx',
                    type: 'GET',
                    data: {
                        agent: agentId,
                        checkList: dynaCheckJSON,
                    }, success: function (data) {

                        console.log(data);
                        location.reload();
                    },

                });

            });
        </script>
    </div>
    <? require(Root . '/webhtm/block\footer\mplace\footerAll.php') ?>

</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
