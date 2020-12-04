<?php


use zetsoft\models\page\PageAction;
use zetsoft\models\user\UserCompany;
use zetsoft\models\core\CoreContacts;
use zetsoft\models\place\PlaceCountry;
use zetsoft\models\user\ChatGroup;
use zetsoft\models\core\CoreInput;
use zetsoft\models\faqs\FaqsManual;
use zetsoft\models\news\News;
use zetsoft\models\user\User;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZCheckButtonWidget;
use zetsoft\widgets\former\ZCheckConfirmWidget2OLD;
use zetsoft\widgets\former\ZDynaWidget;

/** @var ZView $this */

$action->title = Azl . 'Контакты';

$action->icon = 'fa fa-cropLength';
$action->debug = true;
$action->type = WebItem::type['html'];


$model = new PlaceCountry();
/*$cloneUrl = ZUrl::to([
    'clone-all',
    'modelClassName' => $this->modelClassName
]);*/
/** @var ZView $this */
echo ZDynaWidget::widget([
    'id' => 'asd',
    'model' => $model,
    'config' => [
        'toolbar' => [
            'check' => [
                'content' => ZCheckButtonWidget::widget([
                    'config' => [
                        'url' => '/eyuf/cores/main/index.aspx',
                        'class' => 'simple-asd',
                        'message' => Az::l('Вы хотите клонировать этот элемент(ы)?'),
                        'confirm' => false
                    ]
                ]),
                'options' => ['class' => 'btn-group p-0 mr-2']
            ],
        ]
    ]
]);










