<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */

use rmrevin\yii\fontawesome\FA;
use yii\bootstrap\Modal;
use zetsoft\models\ALL\CoreCompany;
use zetsoft\models\ALL\CoreCountry;
use zetsoft\models\ALL\CoreRole;
use zetsoft\models\ALL\User;
use zetsoft\models\App\eyuf\Account;
use zetsoft\models\App\eyuf\EyufCompatriot;
use zetsoft\models\App\eyuf\EyufDocument;
use zetsoft\models\App\eyuf\EyufInvoice;
use zetsoft\models\App\eyuf\Program;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaArrayGridWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\dbitem\core\WebItem;

/** @var ZView $this */

$action = new WebItem();

$action->title = Azl . 'Документы';
$action->icon = 'fal fa-print';


$action->layout = true; $action->debug = false;


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();/** @var ZView $this */

/** @var EyufScholar $scholar */
$id=$this->userIdentity()->id;


$accounter = EyufInvoice::findOne([
    'id' => $id
]);


$document = new EyufInvoice();
$document->query = EyufInvoice::find()->where([]);
$document->configs->edit=false;



/** @var ZView $this */
echo ZDynaWidget::widget([
    'model' => $document,
    'config' => [
        'title' => 'Мои документы',
        'actionView' => false,
        'actionEdit' => false,
        'actionDelete' => false,
        'actionClone' => false,


        'topCreate' => false,
        'topUpdate' => false,
        'topFilter' => false,
        'topSort' => false,
        'topSetting' => false,
        'topExport' => false,
        'titleCreate' => 'Добавить документ',

        'createUrl' => '/logics/scholar/doc-add.aspx',
        'viewUrl' => '/logics/scholar/doc-show',
        'updateUrl' => '/logics/scholar/doc-update',
        'btnEdit' => function ($url, $model) {
            if ($model->status !== true)
                return ZButtonWidget::widget([
                    'config' => [
                        'title' => Az::l('Изменить'),
                        'url' => '/eyuf/logics/scholar/doc-update?id=' . $model->id,
                        'hasIcon' => false,
                        'btnRounded' => false,
                        'btn' => false,
                        'icon' => 'fa fa-' . FA::_EDIT,
                        'confirm' => 'Are you sure you want DELETE columns?'
                    ]
                ]);
        }
    ],

]);
