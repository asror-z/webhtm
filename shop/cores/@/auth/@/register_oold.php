<?php

use zetsoft\system\helpers\ZHTML;
use zetsoft\widgets\dialogs\ZSweetAlert2WidgetOLD;
use yii\helpers\Url;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZHInputWidget;
use zetsoft\widgets\inputes\ZHPasswordInputWidget;
use zetsoft\widgets\inputes\ZKCheckboxXWidget;
use zetsoft\widgets\inputes\ZKPasswordInputWidget;
use zetsoft\widgets\inputes\ZKSwitchInputWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\navigat\ButtonWidget;
use zetsoft\widgets\themes\ZCardWidget;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use yii\authclient\widgets\AuthChoice;
use yii\bootstrap4\Html;
use yii\web\JsExpression;

/**
 *  @var ZView $this
 */
?>



<div class="row justify-content-center">
    <div class="col-md-6 p-4" >
        <?php

        $this->title = Az::l("Регистрация в системе ") . $boot->env('appTitle');


        ZCardWidget::begin([
            'config' => [
                'title' => $this->title,
                'isHeader' => false,
                'cardTitleBool' => false,
                'footerBool' => false,
                'cardBottomBtnBool' => false,
                'mytheme' => 'reg-rad0',

            ]
        ]);

        // @TODO: add class to body div -> "login-card-body"

        $form = $this->activeBegin();
        ?>
        <div class="login-logo ">
            <a href="/" target="_blank">
                <img src="/zetimg/<?=App?>/logo.jpg" alt="ZCore.uz">
            </a>
        </div>

        <?php


        echo ZFormWidget::widget([
            'model' => $form,
            'form' => $form,
            'config' => [
                'submitBtn' => false
            ],
    
        ]);

        echo ZHTML::submitButton(Az::l('Регистрация'), ['class' => 'btn btn-primary']);

        ?>

        <div class="social-auth-links text-center mb-3"><p>- или -</p>
            <?php $authAuthChoice = AuthChoice::begin([
                'baseAuthUrl' => ['core/auth']
            ]); ?>

            <ul class="auth-clients">
                <?php foreach ($authAuthChoice->getClients() as $client): ?>
                    <li><?= $authAuthChoice->clientLink($client, '<i class="fab fa-'.$client->getName().' fa-2x  text-primary"></i>', [
                            'class' => $client->getName(),
                        ]) ?></li>
                <?php endforeach; ?>
            </ul>

            <?php AuthChoice::end(); ?>
        </div>

        <p class="mb-1">
            <?=Html::a(Az::l('Забыли пароль?'), '#')?>
        </p>
        <p class="mb-0">
            <?=Html::a(Az::l('Уже есть аккаунт'), ['/core/core/login'])?>
        </p>

        <?php
        $form = $this->activeEnd();
        ZCardWidget::end();
        ?>

    </div>
</div>



