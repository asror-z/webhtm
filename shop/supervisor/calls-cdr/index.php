<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\calls\CallsCdr;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\values\ZDateFormatWidget;

/**
 * @author Xolmat Ravshanov
 */


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Звонки колл центра';
$action->icon = 'fal fa-comment-alt';
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

                $model = new CallsCdr();

                $model->configs->nameOff = [
                    'name',
                    'clid',
                    'dcontext',
                    'lastapp',
                    'lastdata',
                    'amaflags',
                    'accountcode',
                    'uniqueid',
                    'userfield',
                    'did',
                    'linkedid',
                    'dstchannel',
                    'sequence',

                ];

                //
                $model->configs->readonly = true;


                $model->configs->valueWidget = [
                    'calldate' => ZDateFormatWidget::class,
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
                        ]
                    ],
                    'config' => [
                        'actionButtons' => [
                         /*   'update',
                            'delete',*/
                            'view',
                        ],
                        'columnBefore' => [
                            'serial',
                            'sort',
                            'checkbox',
                            'action',
                            //'relation'

                        ],
                        'columnAfter' => ['false']
                    ]
                ]);


                ?>

            </div>
        </div>


    </div>

