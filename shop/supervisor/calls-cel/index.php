<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\menus\ZMmenuWidget;
use zetsoft\widgets\values\ZDateFormatWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\models\calls\CallsCel;


/** @var ZView $this */


/**
 * @author Xolmat Ravshanov
 */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Детализация звонков';
$action->icon = 'fal fa-balance-scale';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->layout = true;
$action->layoutFile = 'admin';

if ($this->httpGet('spa'))
    $action->debug = true;



$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();
?>

    <div id="content" class="content-footer p-3">

        <div class="row">
            <div class="col-md-12 col-12">

                <?

                $model = new CallsCel();

                $model->configs->nameOff = [
                    'name',
                    'context',
                    'channame',
                    'appname',
                    'appdata',
                    'amaflags',
                    'accountcode',
                    'uniqueid',
                    'linkedid',
                    'extra',
                    'exten',
                    'cid_rdnis',
                ];

                $model->configs->readonly = true;

                $model->configs->valueWidget = [
                    'eventtime' => ZDateFormatWidget::class,
                ];

                $model->columns();


                /** @var ZView $this */
                echo ZDynaWidget::widget([

                    'model' => $model,

                    'rightNameEx' => [
                        'system',
                        'add-clone-delete'
                    ],
                    'rightBtn'=>[
                        'export' => [
                            'content' => '{jsonExcel}',/*{exportAll}{excelBosya}*/
                            'options' => ['class' => 'btn-group p-1 {btnSize} {iconSize}']
                        ],
                    ],
                    'config' => [
                    
                        'actionButtons' => [
                            /*'update',
                            'delete',*/
                            'view',
                        ],

                        'columnBefore' => [
                            'serial',
                            'sort',
                            'checkbox',
                            'action',
                        ],
                        
                        'columnAfter' => ['false'],
                        
                    ]

                ]);

                ?>

            </div>
        </div>


    </div>
