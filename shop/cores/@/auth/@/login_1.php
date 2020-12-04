<?php

use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZHInputWidget;
use zetsoft\widgets\inputes\ZHPasswordInputWidget;
use zetsoft\widgets\inputes\ZKCheckboxXWidget;
use zetsoft\widgets\inputes\ZKPasswordInputWidget;
use zetsoft\widgets\inputes\ZKSwitchInputWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\themes\ZCardWidget;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use yii\authclient\widgets\AuthChoice;
use yii\bootstrap4\Html;

/** @var ZView $this */


?>

<div class="row justify-content-center">
    <div class="col-md-8 col-sm-12 mt-5"  style="margin: auto 0">
        <?php
        ZCardWidget::begin([
            'config' => [
                'isHeader' => false,
                'cardTitleBool' => false,
                'footerBool' => false,
                'cardBottomBtnBool' => false,
                'mytheme' => 'login-rad0',
                'cardWidth' => '70%'
            ]
        ]);

        // @TODO: add class to body div -> "login-card-body"

        Az::$app->forms->active->enableAjaxValidation = false;
        $form = $this->activeBegin();
        ?>
        <div class="login-logo">
            <a href="/" target="_blank" >
                <img src="/zetimg/<?=App?>/logo.jpg" alt="ZCore.uz">
            </a>
        </div>

        <?php


        $this->title = Az::l("Вход в систему ") . $boot->env('appTitle');

        echo ZFormWidget::widget([

            'model' => $form,
            'form' => $form,
            'config' => [
                'submitBtn' => false
            ],
            'rows' => [
                [
                    'attributes' => [
                        'name' => [
                            'type' => Form::INPUT_WIDGET,
                            'widgetClass' => ZHInputWidget::class,
                            'options' => [

                            ],
                        ],
                    ],
                ],
                [
                    'attributes' => [
                        'password' => [
                            'type' => Form::INPUT_WIDGET,
                            'widgetClass' => ZHPasswordInputWidget::class,
                            'options' => [

                            ],
                        ],
                    ],
                ],
                [
                    'attributes' => [
                        'remember' => [
                            'type' => Form::INPUT_WIDGET,
                            'widgetClass' => ZKSwitchInputWidget::class,
                        ],
                    ],
                ],


            ],
        ]);


        echo ZButtonWidget::widget([
            'config' => [
                'all' => [
                    [
                        'url' => '#',
                        'name' => 'Log In',
                        'type' => ZButtonWidget::layout['default'],
                        'color' => ZButtonWidget::btnStyle['btn-outline-primary'],

                        'btnSize' => ZButtonWidget::btnSize['btn-lg']
                    ]
                ]
            ]
        ]);

        ?>

        <div class="social-auth-links text-center mb-3"><p>- или -</p>
            <?php $authAuthChoice = AuthChoice::begin([
                'baseAuthUrl' => ['core/auth']
            ]); ?>

            <ul class="auth-clients ">
                <?php foreach ($authAuthChoice->getClients() as $client): ?>
                    <li><?= $authAuthChoice->clientLink($client, '<i class="fab fa-'.$client->getName().' fa-2x "></i>', [
                            'class' => $client->getName(),
                        ]) ?></li>
                <?php endforeach; ?>
            </ul>

            <?php AuthChoice::end(); ?>
        </div>

        <div class="row justify-content-end">
            <form class="form-inline ml-0">
                <div class="form-group">
                    <a>
                        <?= Html::a(Az::l('Забыли пароль?'), '#', ['class' => 'btn btn-outline-info']) ?>
                    </a>
                    <a >
                        <?= Html::a(Az::l('Зарегистрироваться'), ['/core/core/register'],
                            ['class' => 'btn btn-outline-info']) ?>
                    </a>
                </div>


              
        </div>
        <?php
        $form = $this->activeEnd();
        ZCardWidget::end();
        ?>
    </div>

</div>
