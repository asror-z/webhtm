<?php


use rmrevin\yii\fontawesome\FA;
use zetsoft\models\FaqsType;
use zetsoft\models\App\eyuf\EyufDocument;
use zetsoft\models\App\eyuf\DocumentType;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\dbitem\core\WebItem;



$action = new WebItem();

$action->title = Azl . 'Список Категории faq';
$action->icon = 'fa fa-film';


$action->layout = true; $action->debug = false;


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


/** @var ZView $this */

/** @var EyufScholar $scholar */
$id=$this->userIdentity()->id;


$scholar = EyufScholar::findOne([
    'user_id' => $id
]);


$document = new EyufDocument();
$document->query = EyufDocument::find()->where(['eyuf_scholar_id' => $scholar->id]);
$document->configs->edit=false;



/** @var ZView $this */
echo ZDynaWidget::widget([
    'model' => $document,
    'config' => [
        'title' => Az::l('Мои документы'),
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
        'titleCreate' => Az::l('Добавить документ'),
        
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











