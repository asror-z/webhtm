<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\cpas\CpasLand;
use zetsoft\models\cpas\CpasStream;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZViewWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\system\assets\ZColor;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;





/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Общая информация потока';
$action->icon = 'fa fa-globe';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->loader = true;
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
    require Root . '/webhtm/block/assets/App/main_arbit.php';

    $this->head();

    ?>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php


$id = $this->httpGet('id');
$this->beginBody();

echo $this->require( '\webhtm\cpas\blocks\header.php');



?>

<div id="page" class="arbit/client/viewFlow">

    <?

    echo ZSessionGrowlWidget::widget();$user_id = $this->userIdentity()->id;
    $model = CpasStream::findOne($id);



    $model->configs->nameOff = [
       'id',
      'user_id',
      'name',
      'created_at',
      'modified_at',
      'created_by',
      'modified_by',

    ];
      $model->columns();

    ZCardWidget::begin([
        'config' => [
            'title' => Az::l('Элементы потока'),
            'type' => ZCardWidget::type['dynCard'],
            'classHeadColor' => 'bg-white text-dark',
            'hasFooter' => false,
            'footerColor' => ZColor::color['green-special'] . ' text-black',
        ]
    ]);

    $items = \zetsoft\models\cpas\CpasStreamItem::find()
        ->where([
            'cpas_stream_id' => $id
        ])
        ->orderBy('id DESC')
        ->all();

    foreach ($items as $item)
    {

        $item->configs->nameOn = [
             'id',
            'cpas_land_id',
            'cpas_trans',
            'cpas_trans_form',
            'link',
            'track',
            'teaser'

        ];
        $viewbtn = '';
        if($item->cpas_land_id)
        {
        $name = CpasLand::findOne($item->cpas_land_id);
        $item->columns();
        $viewUrl = '/render/cpasite/'.$id.'/'.$item->id.'/'.$name->title.'/index.php';
        $viewbtn = ZButtonWidget::widget([
            'config' => [
                'btnStyle' => ZButtonWidget::btnStyle['btn-outline-primary'],
                'url' => $viewUrl,
                'icon' => 'fal fa-eye',
                'btnRounded' => false,
                'btn' => true,
                'target' => ZButtonWidget::target['_blank'],
                'btnSize' => ZColor::btnSize['btn-sm'],

            ]
        ]);
        }

        $viewPreland = '';
        if($item->cpas_trans)
        {
            $name = CpasLand::findOne($item->cpas_trans);
            $item->columns();
            $viewUrl = '/render/cpasite/'.$id.'/'.$item->id.'/'.$name->title.'/index.php';
            $viewPreland = ZButtonWidget::widget([
                'config' => [
                    'btnStyle' => ZButtonWidget::btnStyle['btn-outline-primary'],
                    'url' => $viewUrl,
                    'icon' => 'fas fa-binoculars',
                    'btnRounded' => false,
                    'btn' => true,
                    'target' => ZButtonWidget::target['_blank'],
                    'btnSize' => ZColor::btnSize['btn-sm'],

                ]
            ]);
        }

        $viewPreForm = '';
        if($item->cpas_trans_form)
        {
            $name = CpasLand::findOne($item->cpas_trans_form);
            $item->columns();
            $viewUrl = '/render/cpasite/'.$id.'/'.$item->id.'/'.$name->title.'/index.php';
            $viewPreForm = ZButtonWidget::widget([
                'config' => [
                    'btnStyle' => ZButtonWidget::btnStyle['btn-outline-primary'],
                    'url' => $viewUrl,
                    'icon' => 'fab fa-wpforms',
                    'btnRounded' => false,
                    'btn' => true,
                    'target' => ZButtonWidget::target['_blank'],
                    'btnSize' => ZColor::btnSize['btn-sm'],

                ]
            ]);
        }
        $downloadUrl = '/render/cpazips/'.$user_id.'/'.$item->id.'/'.$item->id.'.zip';
        $downBtn = ZButtonWidget::widget([
            'config' => [
                'btnType' => ZButtonWidget::btnType['link'],
                'btnStyle' => ZButtonWidget::btnStyle['btn-outline-primary'],
                'url' => $downloadUrl,
                'icon' => 'fas fa-download',
                'btn' => true,
                'btnRounded' => false,
                'download' => true,
                'btnSize' => ZColor::btnSize['btn-sm'],


            ]
        ]);
        $btns = '<div class="btn-group" role="group">';
        $btns .= $viewPreForm. $viewPreland. $viewbtn .$downBtn;
        $btns .= '</div>';

        echo ZViewWidget::widget([
            'model' => $item,
            'config' => [
                'theadColor' => ZColor::color['blue lighten-3'],
                'title' => $item->title,
                'headerRight' => $btns
            ]
        ]);


    }
    ZCardWidget::end();
    $urlupdate = ZUrl::to([
        '/cpas/client/updateFlow',
        'id' => $id,
    ]);
?>
    <div class="text-right">

    <?php
    $updateBtn = ZButtonWidget::widget([
        'config' => [
            'url' => $urlupdate,
            'text' => Az::l('Обновить поток'),
            'btnStyle' => ZButtonWidget::btnStyle['btn-outline-light'],
            'btn' => true,
            'class' => 'py-2 px-3',
            'btnRounded' => false,
        ]
    ]);
    ?>
    </div>

    <?php
    echo ZViewWidget::widget([
            'model' => $model,
            'config' => [
                    'title' => Az::l('Общая информация потока'),
                    'headerRight' => $updateBtn
            ]
    ]);

    ?>

</div>

<? echo $this->require( '\webhtm\cpas\blocks\footer.php'); ?>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
