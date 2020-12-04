<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopOrder;
use zetsoft\models\shop\ShopOrderItem;
use zetsoft\models\ware\WareAccept;
use zetsoft\models\ware\WareReturn;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZCheckButtonWidget;
use zetsoft\widgets\former\ZCheckDynaWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZGetChecksWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 * @author MurodovMirbosit
 */

$action = new WebItem();

$action->title = Azl . 'Заказы';
$action->icon = 'fal fa-line-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
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
echo ZSessionGrowlWidget::widget();


?>

<div class="p-3">

    <div class="p-2 row justify-content-end dynaCheck">

        <?

        $parentQuery = $this->httpGet('parentQuery');
        $query = $this->httpGet('chooseQuery');

        $ware_accept_id = $this->httpGet('ware_accept_id');

        $checkUrl = ZUrl::to([
            '/shop/logistics/ware-accept/choose-dc',
            'ware_accept_id' => $ware_accept_id
        ]);

        $model = new WareReturn();

        echo ZGetChecksWidget::widget([
            'model' => $model,
            
            'config' => [
                'url' => $checkUrl,
                'btnOptions' => [
                    'config' => [
                        'icon' => '',
                        'text' => Az::l('Подобрать'),
                        'hasIcon' => false,
                        'isPjax' => false,
                        'btnType' => ZButtonWidget::btnType['link'],
                        'grapes' => false,
                        'btnStyle' => ZButtonWidget::btnStyle['btn-outline-dark'],
                        'title' => Az::l('Подборка'),
                        'message' => Az::l('Вы хотите подобрать эти элементы?'),
                    ]
                ]
            ],
            'event' => [
                'ajaxSuccess' => <<<JS
                     function() {
                         window.top.location.href = "/shop/logistics/ware-accept/process.aspx?ware_accept_id=$ware_accept_id"    
                     }
JS,
            ],
            //end

        ]);

        ?>

    </div>
    <div class="row">
        <div class="col-md-12 col-12">

            <?php
            /** @var ZView $this */
            $ware_accept = WareAccept::findOne($ware_accept_id);

            $dc_group_ids = [];
            if (!empty($ware_accept->dc_returns_group)) {
                $dc_group_ids = $ware_accept->dc_returns_group;
            }
            
            $model->configs->query = WareReturn::find()
                ->where([
                    'not in', 'id', $dc_group_ids,
                ]);

            $model->configs->readonly = true;
            $model->configs->nameOn = [
                'id',
                'name',
                'total_price'
            ];

            $model->configs->dynaButtons = [
                'add-tabular-clone-delete' => [
                    'content' => '',
                    'options' => [
                        'class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}'
                        ]
                ],

            ];

            $model->columns();

            echo ZDynaWidget::widget([
                'model' => $model,
                'leftNameEx' => [
                    'barCode'
                ],
                'config' => [
                    'viewUrl' => '/shop/logistics/ware-accept/view-return.aspx?ware_return_id={id}',
                    'actionButtons' => [
                        'view',
                    ],
                    'columnBefore' => [
                        'checkbox',
                        'action'
                        ],
                    'columnAfter' => false,
                    'heighbody' => '62vh',
                ]
            ]);

            ?>

        </div>
    </div>
</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
