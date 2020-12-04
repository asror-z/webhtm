<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\ware\WareAccept;
use zetsoft\models\ware\WareReturn;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\navigat\ZButtonWidget;

/** @var ZView $this */

/**
 *
 * Action Params
 */
$button = ZButtonWidget::widget([
    'config' => [
        'btnRounded' => false,
        'hasIcon' => true,
        'icon' => 'fa fa-plus',
        'url' => ZUrl::to([
            '/shop/admin/ware-return/index'
        ]),
        'class' => 'text-muted',
        'pjax' => false,
        'target' => ZButtonWidget::target['_blank'],
    ]
]);
$action = new WebItem();
$action->title = Azl . 'Редактирование'; /*Поступление товаров в склад*/


$action->icon = 'fal fa-film';
$action->type = WebItem::type['html'];




$this->paramSet(paramAction, $action);
?>

<div class="row my-5">
    <div class="col-md-4 col-12">

        <?php
        $ware_accept_id = $this->httpGet('ware_accept_id');
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

        $ware_accept_id = $this->httpGet('ware_accept_id');

        $wareAccept = WareAccept::findOne($ware_accept_id);

        $model->columns();

        $btns = [
            'add-tabular-clone-delete' => [
                'content' => '{delete}{choose}',
                'options' => [
                    'class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}'
                ]
            ],
            'update' => [
                'content' => '',
                'options' => ['class' => 'btn-group p-1 mr-0 {btnSize} {iconSize}']
            ],

        ];

        if ($ware_accept->status === WareAccept::status['accept'])
            $btns = [];

        echo ZDynaWidget::widget([
            'model' => $model,
            'rightBtn' => $btns,
            'rightName' => [
                'add-tabular-clone-delete',
                'update'
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
                'title' => Az::l('Возвраты ДС'),
                'deleteAllUrl' => '/shop/admin/ware-accept/delete-orders.aspx?ware_accept_id=' . $ware_accept_id,
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
                src='/shop/admin/ware-accept/return-items.aspx?ware_accept_id=<?= $ware_accept_id ?>'>
        </iframe>
    </div>
</div>

