<?php

use kartik\builder\Form;
use rmrevin\yii\fontawesome\FA;
use yii\bootstrap\Modal;
use zetsoft\models\ALL\CoreConfigDb;
use zetsoft\models\ALL\CoreCountry;
use zetsoft\models\ALL\CoreDegree;
use zetsoft\models\ALL\CoreGroup;
use zetsoft\models\ALL\CoreInput;
use zetsoft\models\ALL\CoreSpeciality;
use zetsoft\models\user\User;
use zetsoft\models\App\eyuf\Candidate;
use zetsoft\models\App\eyuf\EyufDocument;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\models\libra\Computer;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\animo\ZProgressbarJsWidget;
use zetsoft\widgets\animo\ZProgressBarWidget;
use zetsoft\widgets\blocks\ZEChartWidgetOld;
use zetsoft\widgets\blocks\ZLineChartWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\former\ZViewWidget;
use zetsoft\widgets\inputes\ZFileInputWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\widgets\themes\ZPillTabWidget;
use zetsoft\widgets\themes\ZFriendRequestsWidget;
use zetsoft\models\ALL\CoreCompany;
use zetsoft\widgets\former\ZDynaWidget;


?>


<?php
/** @var ZView $this */
$model = $user = $this->userIdentity();

if ($this->userIsGuest())
    return 'You have login to page';


$candidate = EyufScholar::findOne([
    'user_id' => $user->id
]);


$imageUrl = $this->userPhoto();

Modal::begin([
    'size' => 'large',
    'id' => 'dModal'
]);
$active = new Active();
$active->type = Active::type['horizontal'];
$form = $this->activeBegin($active);

$model->configs->rulesAll = [
    [
        validatorSafe
    ]
];
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
                ],
            ],
        ],
    ],
    'config' => [
        'allowFileTypes' => [
            'image',
        ],


    ],
]);

$this->activeEnd();


Modal::end();

?>


<style>
    .photo_edit {
        visibility: hidden;
        padding: 50px;
        margin: 0 auto;
        box-sizing: border-box;
        overflow: hidden;
        background-color: #cbdfea;;
        opacity: 0.7;
        -webkit-transition: background 0.3s ease;
        -moz-transition: background 0.3s ease;
        -o-transition: background 0.3s ease;
        transition: background 0.3s ease;
        border-radius: 50%;
    }

    .photo_edit img {
        max-width: 45px
    }

    .photo_edit img {
        max-width: 45px
    }

    .profilePic {
        width: 150px;
        min-height: 150px;
        margin: 0 auto;
        text-align: center;
        border: 1px solid silver;
        border-radius: 50%;
        background-image: url("<?=$imageUrl?>");
        background-position: center;
        background-size: 100%;
        background-repeat: no-repeat;

    }

    .photo_edit:hover {
        cursor: pointer;
        display: block;
    }

</style>
</head>
<body>
<div class="row">
    <div class="col-md-4">
        <?php
        $country = CoreCountry::find()->where(['id' => $candidate['core_country_id']])->one();

        ZCardWidget::begin([
            'config' => [
                'type' => ZCardWidget::type['mdbCard'],
            ]
        ]);
        ?>

        <div class="left_top">
            <div>

                <div class="profilePic mb-4">
                    <div class="photo_edit">
                        <img src="/render/images/assets/image/photo_edit.png"/>
                    </div>
                </div>
            </div>


            <h5><?= $user->name ?></h5>
            <p><?= "Магистратура"; ?></p> <!--bazadan  olib qoyish kere -->
            <div class="photoplace width-30 m-auto bg-danger">

            </div>
        </div>
        <?php ZCardWidget::end();

        ?>

        <?php

        $Sch = EyufScholar::find()->where(['user_id' => $user->id])->one();

        echo ZViewWidget::widget([
            'model' => $Sch,
        ]);
        ?>

    </div>
    <div class="col-md-8">

        <?php


        ZCardWidget::begin([
            'config' => [
                'type' => ZCardWidget::type['mdbCard'],
            ]
        ]);

        $umumiy = <<<HTML
        <div style="margin: 5px" class="row">
           <div class="col">
            <h5 class="umumiy">Ф.И.О</h5>
            <p>{$user['name']}</p>
        </div>
        <div class="col">
          <h5 class="umumiy">Номер телефона</h5>
            <p>{$user['phone']}</p>
        </div>
        <div class="col">
          <h5 class="umumiy">E-mail</h5>
            <p>{$user['email']}</p>
        </div>
        <div class="col">
          <h5 class="umumiy">Зарубежные страны</h5>
            <p>{$country['name']}</p>
        </div>
</div>
        
HTML;

        echo ZPillTabWidget::widget([
            'config' => [
                'pill' => [
                    'Отчеты' => 'В истекшем финансовом году Всемирный банк продолжал воплощать в жизнь концепцию наших акционеров, стремясь соответствовать поставленным.',
                    'Общая информация' => $umumiy,
                    'Рейтинг баллов' => 'Если вы оцениваете объекты и публикуете подробные отзывы, то получаете за это баллы и повышайте свой рейтинг.',
                    'Редактировать' => 'Узнайте, как редактировать текст и изображения в файлах PDF с помощью Acrobat для настольных ПК, а также как редактировать.',

                ],
                'TabColor' => ZPillTabWidget::pillColor['light-blue']
            ]
        ]);

        ZCardWidget::end();


        ?>

        <?php

        $action->title = Azl . 'Список Документов';
        $action->icon = '';

        $docs = EyufDocument::findOne(['user_id' => $user->id]);

        /** @var ZView $this */
        echo ZDynaWidget::widget([
            'model' => $docs,
        ]);
        ZCardWidget::begin([
            'config' => [
                'type' => ZCardWidget::type['mdbCard'],
            ]
        ]);
        ?>

        <div class="progress_bar">
            <p><b>Полные данные</b></p>
            <?php
            echo ZProgressBarWidget::widget([
                'config' => [
                    'items' => [
                        [
                            'isStriped' => false,
                            'isAnimated' => true,
                            'width' => '80',
                            'label' => 'Отчеты',
                        ],
                        [
                            'isStriped' => false,
                            'isAnimated' => true,
                            'bgColor' => ZProgressBarWidget::btncolor['btn-info'],
                            'label' => Az::l('FОбщая информация'),
                            'width' => '90'
                        ],
                        [
                            'isStriped' => false,
                            'isAnimated' => true,
                            'width' => '50',
                            'bgColor' => ZProgressBarWidget::btncolor['btn-primary'],
                            'label' => Az::l('Таблицы')
                        ],
                        [
                            'isStriped' => false,
                            'isAnimated' => true,
                            'bgColor' => ZProgressBarWidget::btncolor['btn-danger'],
                            'width' => '70',
                            'label' => Az::l('Рейтинг баллов')
                        ],

                    ]
                ],
            ]);

            ZCardWidget::end()
            ?>

        </div>
        <script>
            $('.profilePic').mouseover(function () {
                $('.photo_edit').css('visibility', 'visible');
            });
            $('.profilePic').mouseout(function () {
                $('.photo_edit').css('visibility', 'hidden');
            });
        </script>
    </div>
</div>


<!--
 echo ZButtonWidget::widget([
        'config' => [
            'btnRounded' => false,
            'btnStyle' => ZButtonWidget::btnStyle['btn-info'],
            'btnSize' => ZButtonWidget::btnSize['btn-lg'],
            'text' => 'Добавить информацию',
            'icon' => 'fas fa-'. FA::_PLUS,
            'url' => ZUrl::to(['admin/scholar/create']),


        ]
    ]);
 
 -->

</body>
</html>


