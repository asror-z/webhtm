<?php

use zetsoft\models\eyuf\Compatriot;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\eyuf\Document;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormBuilderWidget;
use zetsoft\widgets\themes\ZColWidget;
use zetsoft\widgets\themes\ZRowWidget;


/** @var ZView $this */
$this->init();

$this->title('Создание Документ');
$this->icon = 'fa fa-bar-chart';

$id = $this->httpGet('id');
$model = new Compatriot();

if ($this->modelSave($model))
{

    /**
     *
     * Post save Actions
     */

}
?>

<?
require 'header.php';
?>


<div class="row">
    <div class="col-md-12 col-12">

        <?

        $form = $this->activeBegin();

        ZCardWidget::begin([
            'config' => [
                'title' => 'Основная информация',
                'type' => ZCardWidget::type['dynCard'],
            ]
        ]);

        echo ZFormWidget::widget([
            'model' => $model,
            'form' => $form,

        ]);

        ZCardWidget::end();

        $this->activeEnd();

        ?>

    </div>
</div>
