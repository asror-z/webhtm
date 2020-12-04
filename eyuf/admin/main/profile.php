<?php

use kartik\builder\Form;
use zetsoft\models\ALL\CoreCountry;
use zetsoft\models\ALL\CoreInput;
use zetsoft\models\ALL\CoreSpeciality;
use zetsoft\models\user\User;
use zetsoft\models\libra\Computer;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\animo\ZProgressBarWidget;
use zetsoft\widgets\blocks\ZEChartWidgetOld;
use zetsoft\widgets\charts\ZChartFormWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZFileInputWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\widgets\themes\ZPillTabWidget;
use zetsoft\widgets\themes\ZFriendRequestsWidget;


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EyufDocument</title>

    <style>
        #block_users {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #block_users .left {
            width: 40%;
            height: 560px;
            padding: 15px;
        }

        #block_users .right {
            width: 60%;
            height: 560px;
            padding: 15px;
        }

        #block_users .bsh {
            box-shadow: 0 0 10px 1px rgba(0, 0, 0, .1);
            margin: 10px 0;
            border-radius: 4px;
            background: #fff;
            padding: 0 10px;
        }

        #block_users .right .right_block {
            width: 100%;
            padding: 20px 10px;
        }

        #block_users .left .left_top {
            width: 100%;
            text-align: center;
            padding: 20px 10px;
        }

        #block_users .left .left_bottom {
            width: 100%;
        }

        #block_users .left .left_bottom a {
            padding: 4px;
            background: #2192f0;
            color: #fff;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            border-radius: 50%;
            align-items: center;
            justify-content: center;
        }

        #block_users .left .left_bottom .padding {
            padding: 10px 0;
        }

        #block_users .left .left_top .left_user {
            width: 120px;
            height: 120px;
            border: 2px solid #2192f0;
            border-radius: 50%;
            margin: 20px auto
        }

        #block_users .left .left_top h5 {
            color: #2192f0;
            font-weight: 600;
        }

        #block_users .left .left_top h6 {
            font-size: 14px;
            line-height: 40px;
        }

        #block_users .left .left_top button {
            background: #32c770 !important;
            border-radius: 4px !important;
        }

        .user_picture {
            background-color: transparent;
            z-index: 1000;
        }

        .user_picture img {
            border-radius: 50%;
        }

        .umumiy {
            font-weight: bold;
        }
    </style>

</head>
<body>
<div id="block_users">
    <div class="left">
        <?php

        $id = Yii::$app->user->id;
        $model = $this->modelGet(User::class);

        $user = User::findOne(1);
        $special = CoreSpeciality::find()->where(['id' => $user['core_speciality_ids']])->one();
        $country = CoreCountry::find()->where(['id' => $user['core_country_id']])->one();
        $imgPath = $user['id'];
        $img = $user['photo'];
        //$imgg = implode($img);


        ZCardWidget::begin([
            'config' => [
                'type' => ZCardWidget::type['basic'],
            ]
        ]);
        ?>

        <div class="left_top">

            <h5><?= $user['name'] ?></h5>
           <!-- <h6><?/*= $special['name'] */?></h6>-->
            <!--<p><? /*= $user['description'] */ ?></p>-->

            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTR_SudslRQUhsAWTvhFQ9yxJ6-ULKSrG2w6fPOEW4VJSMFRlRy&s"
                 alt="">

            <h2>Абдуллаев Абдулла</h2>

            <h5>Докторант</h5>
            <p></p>

            <?php


            ?>
        </div>
        <? ZCardWidget::end();
        ZCardWidget::begin([
            'config' => [
                'type' => ZCardWidget::type['basic'],
            ]
        ]);
        ?>
        <div class="left_bottom mt-4">
            <div class="container">
                <div class="row">
                    <?= ZChartFormWidget::widget([
                        'model' => $model
                    ]) ?>
                </div>
            </div>
        </div>
        <? ZCardWidget::end() ?>
    </div>
    <div class="right">

        <?php

        ;
        ZCardWidget::begin([
            'config' => [
                'type' => ZCardWidget::type['basic'],
            ]
        ]);

        $umumiy = <<<HTML
        <div style="margin: 5px" class="row">
           <div class="col">
            <h5 class="umumiy">ФИО</h5>
            <p>{$user['title']}</p>
        </div>
        <div class="col">
          <h5 class="umumiy">Номер телефона</h5>
            <p>{$user['phone']}</p>
        </div>
        <div class="col">
          <h5 class="umumiy">Email</h5>
            <p>{$user['email']}</p>
        </div>
        <div class="col">
          <h5 class="umumiy">Зарубежная страна</h5>
            /*<p>{$country['name']}</p>*/
        </div>
</div>
        
HTML;

        echo ZPillTabWidget::widget([
            'config' => [
                'pill' => [
                    'Расчёты' => 'Общие Расчёты Стипендиата',
                    'Общая Информация' => $umumiy,
                    'Рейтинговые Баллы' => 'Рейтинговые баллы',
                    'Изменения' => 'Изменения',

                ],
                'TabColor' => ZPillTabWidget::pillColor['light-blue']
            ]
        ]);

        ZCardWidget::end();
        ZCardWidget::begin([
            'config' => [
                'type' => ZCardWidget::type['basic'],
            ]
        ]);
        ?>

        <div class="progress_bar">
            <p><b>Полная Информация</b></p>
            <?php
            echo ZProgressBarWidget::widget([
                'config' => [
                    'items' => [
                        [
                            'isStriped' => false,
                            'isAnimated' => true,
                            'width' => '80',
                            'label' => 'Расчёты',
                        ],
                        [
                            'isStriped' => false,
                            'isAnimated' => true,
                            'bgColor' => ZProgressBarWidget::btncolor['btn-info'],
                            'label' => Az::l('Базовая Информация'),
                            'width' => '90'
                        ],

                        [
                            'isStriped' => false,
                            'isAnimated' => true,
                            'bgColor' => ZProgressBarWidget::btncolor['btn-info'],
                            'label' => Az::l('Таблицы'),
                            'width' => '90'
                        ],

                        [
                            'isStriped' => false,
                            'isAnimated' => true,
                            'bgColor' => ZProgressBarWidget::btncolor['btn-info'],
                            'label' => Az::l('Общая Информация'),
                            'width' => '90'
                        ],


                    ]
                ],
            ]);

            ZCardWidget::end()
            ?>


            <?


            $active = new Active();
$active->type = Active::type['horizontal'];
$form = $this->activeBegin($active);
            $this->modelSave($model);


            echo ZFormWidget::widget([
                'model' => $model,
                'form' => $form,
                'rows' => [
                    [
                        'attributes' => [
                            'photo' => [
                                'type' => Form::INPUT_WIDGET,
                                'widgetClass' => ZFileInputWidget::class,
                                'options' => [
                                    'config' => [
                                        'maxFileCount' => 1,
                                    ]
                                ]

                            ],
                        ],
                    ],
                ],
                'config' => [
                    'submitBtn' => false,
                    'allowFileTypes' => [
                        'image',
                    ],


                ],
            ]);

            $form = $this->activeEnd(); ?>
        </div>

    </div>
</div>


</body>
</html>
