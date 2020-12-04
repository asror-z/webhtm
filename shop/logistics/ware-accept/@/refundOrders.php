<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\ware\WareAccept;
use zetsoft\models\ware\WareReturn;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Редактирование'; /*Поступление товаров в склад*/


$action->icon = 'fal fa-film';
$action->type = WebItem::type['html'];




$this->paramSet(paramAction, $action);
?>

<div class="row">
    <div class="col-md-12">

        <?

        $ware_accept = WareAccept::findOne($ware_accept_id);

        $model = new WareReturn();
        $model->configs->nameOn = [
            'id',
            'name',
            'total_price'
        ];
        $dc = $ware_accept->dc_returns_group;
        if (empty($dc)) $dc = null;
        $model->configs->query = WareReturn::find()
            ->orderBy([
                'created_at' => SORT_DESC
            ])
            ->where([
                'id' => $dc
            ]);

        $model->configs->readonly = true;
        $model->columns();

        echo ZDynaWidget::widget([
            'model' => $model,
            'rightBtn' => [
                'add-tabular-clone-delete' => [
                    'content' => '{delete}{choose}',
                    'options' => [
                        'class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}'
                    ]
                ],
            ],
            'rightName' => [
                'add-tabular-clone-delete'
            ],
            'leftNameEx' => [
                'barcode'
            ],
            'config' => [
                'spaWidth' => [
                    'choose' => '1000px'
                ],
                'spaHeight' => [
                    'choose' => '750px'
                ],
                'chooseUrl' => '{fullUrl}/choose-orders.aspx?ware_accept_id=' . $ware_accept_id,
                'title' => Az::l('Группа возвраты ДС'),
                'theme' => ZDynaWidget::theme['panel-success'],
                'deleteAllUrl' => ZUrl::to([
                    'delete-orders',
                    'ware_accept_id' => $ware_accept->id,
                ]),
                'columnBefore' => [
                    'serial',
                    'id',
                    'checkbox',
                ],
                'columnAfter' => false
            ]
        ])

        ?>

    </div>
    <div class="col-md-8 col-12">

        <iframe id='return_items' class='iframe-return-items' width='100%' height='100%'
                src='/shop/logistics/ware-accept/return-items.aspx?ware_accept_id=<?= $ware_accept_id ?>'>
        </iframe>
    </div>
</div>

