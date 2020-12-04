<?php

use kartik\builder\Form;
use rmrevin\yii\fontawesome\FA;
use yii\bootstrap\Modal;
use zetsoft\dbitem\data\ZFormDB;
use zetsoft\models\ALL\CoreAction;
use zetsoft\models\ALL\CoreConfigDb;
use zetsoft\models\ALL\CoreCountry;
use zetsoft\models\ALL\CoreDegree;
use zetsoft\models\ALL\CoreGroup;
use zetsoft\models\ALL\CoreInput;
use zetsoft\models\ALL\CoreSpeciality;
use zetsoft\models\user\User;
use zetsoft\models\App\eyuf\Candidate;
use zetsoft\models\App\eyuf\EyufDocument;
use zetsoft\models\App\eyuf\EyufReport;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\models\libra\Computer;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\module\Models;
use zetsoft\widgets\animo\ZProgressbarJsWidget;
use zetsoft\widgets\animo\ZProgressBarWidget;
use zetsoft\widgets\blocks\ZEChartWidgetOld;
use zetsoft\widgets\blocks\ZLineChartWidget;
use zetsoft\widgets\dialogs\ZAlertCardWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\former\ZViewWidget;
use zetsoft\widgets\inptest\ZKColorInputWidget;
use zetsoft\widgets\inputes\ZFileInputWidget;
use zetsoft\widgets\inputes\ZInputWidgetOLD;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZKAlertBlockWidget;
use zetsoft\widgets\notifier\ZKAlertWidget;
use zetsoft\widgets\notifier\ZModalNewWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\widgets\themes\ZPillTabWidget;
use zetsoft\widgets\themes\ZFriendRequestsWidget;
use zetsoft\models\ALL\CoreCompany;
use zetsoft\widgets\former\ZDynaWidget;


?>


<?php
/** @var ZView $this */
$model = $user = $this->userIdentity();


/*if ($user->role != 'scholar') {
    $this->alertInfo('Ошибка', '');
    return 0;
}*/

if ($this->userIsGuest())
    return Az::l('You have login to page');


$candidate = EyufScholar::findOne([
    'user_id' => $user->id
]);

$scholar = new EyufScholar();
$imageUrl = $this->userPhoto();

ZModalNewWidget::begin([
    'id' => 'profPic'
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
    'event' => [
        'buttonClick' => 'window.top.location.href = "/logics/scholar/index.aspx"',
    ]
]);

$this->activeEnd();


ZModalNewWidget::end();

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
<?php
$list = Az::$app->App->eyuf->getDocs()->getDocListHTM();
if (!($list === null)) {
    echo ZKAlertBlockWidget::widget([
        'config' => [
            'isUseSessionFlash' => false,
            'delay' => 2000,
            'body' => $list,
            'title' => 'asdasd',
            'alert' => 'asdsadas',
            'titleOptions' => [
                'tag' => 'span',
                'class' => 'kv-alert-title'
            ],
        ],
    ]);
}


?>

<div class="row">
    <div class="col-md-4">
        <?php
        $country = CoreCountry::find()->where(['id' => $candidate['core_country_id']])->one();

        $ProfileRightButton = ZButtonWidget::widget([
            'config' => [
                'icon' => 'fas fa-' . FA::_EDIT,
                'type' => ZButtonWidget::btnType['button'],
                'btnStyle' => ZButtonWidget::btnStyle['btn-transparent'],
                'class' => 'text-white',
                'btnFloating' => false,
                'btn' => false,
                'hasIcon' => true,
                'iconColor' => '#ffffff',

            ],
            'event' => [
                'click' => ' $(profPic).modal(\'show\') '
            ]

        ]);


        ZCardWidget::begin([
            'config' => [
                'type' => ZCardWidget::type['profileCard'],
                'imageUrl' => $imageUrl,
                'color' => ZColor::color['primary-color'],
                'title' => $user->title,
                'ProfileRightButton' => $ProfileRightButton,
            ]
        ]);

        ?>

        <div class="left_top">
            <!--<div>

                <div class="profilePic mb-4">
                    <div class="photo_edit">
                        <img src="/publish/image/photo_edit.png"/>
                    </div>
                </div>
            </div>-->

          

            <div class="photoplace width-30 m-auto bg-danger">

            </div>
        </div>

        <?php ZCardWidget::end();

        ?>

        <?php
        /*        ZCardWidget::begin();


                echo ZKAlertBlockWidget::widget([
                    'config' => [
                        'isUseSessionFlash' => false,
                        'delay' => 2000,
                        'body' => Az::$app->App->eyuf->getDocs()->getEmptyColumnsHTM(),
                        'title' => 'asdasd',
                        'alert' => 'asdsadas',
                        'titleOptions' =>  [
                            'tag' => 'span',
                            'class' => 'kv-alert-title'
                        ],
                    ],
                ]);



                echo ZKAlertBlockWidget::widget([
                    'config' => [
                        'isUseSessionFlash' => false,
                        'delay' => 2000,
                        'body' => Az::$app->App->eyuf->getDocs()->getDocListHTM(),
                        'title' => 'asdasd',
                        'alert' => 'asdsadas',
                        'titleOptions' =>  [
                            'tag' => 'span',
                            'class' => 'kv-alert-title'
                        ],
                    ],
                ]);
                ZCardWidget::end();
                */ ?>
        <?php
        /* ZCardWidget::begin();

         echo ZKAlertBlockWidget::widget([
             'config' => [
                 'isUseSessionFlash' => false,
                 'delay' => 2000,
                 'body' => Az::$app->App->eyuf->getDocs()->getDocListHTM(),
                 'title' => 'asdasd',
                 'alert' => 'asdsadas',
                 'titleOptions' => [
                     'tag' => 'span',
                     'class' => 'kv-alert-title'
                 ],
             ],
         ]);
         ZCardWidget::end();*/
        ?>
        <?php

        $Sch = EyufScholar::findOne(['user_id' => $user->id]);

        echo ZViewWidget::widget([
            'model' => $Sch,
        ]);
        ?>

    </div>
    <div class="col-md-8">

        <?php


        /*   ZCardWidget::begin([
               'config' => [
                   'type' => ZCardWidget::type['mdbCard'],
               ]
           ]);

           $umumiy = <<<HTML
           <div style="margin: 5px" class="row">
              <div class="col">
               <h5 class="umumiy">Ф.И.О</h5>
               <p>{$user['title']}</p>
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
                       'Документы' => '',
                       'Рейтинг баллов' => 'Если вы оцениваете объекты и публикуете подробные отзывы, то получаете за это баллы и повышайте свой рейтинг.',
                       'Редактировать' => 'Узнайте, как редактировать текст и изображения в файлах PDF с помощью Acrobat для настольных ПК, а также как редактировать.',

                   ],
                   'TabColor' => ZPillTabWidget::TabColor['light-blue']
               ]
           ]);

           ZCardWidget::end();*/


        ?>

        <?php

        $action->title = Azl . 'Профиль';
        $action->icon = '';

        $docs = new EyufDocument();
        $docs->configs->query = EyufDocument::find()
            ->where([
                'eyuf_scholar_id' => $Sch->id
            ]);

        $docs->configs->edit = true;
        if ($this->userRole() === 'scholar') {
            $docs->configs->nameOff = [
                'correct'
            ];
            $docs->configs->editsEx = [
                'status',
                'correct'
            ];
        }


        /** @var ZView $this */
        echo ZDynaWidget::widget([
            'model' => $docs,
            'config' => [
                'title' => Az::l('Мои документы'),
                'titleCreate' => Az::l('Добавить документ'),
                'actionClone' => false,
                'createUrl' => '/logics/scholar/doc-add.aspx',
                'viewUrl' => '/logics/scholar/doc-show',
                'updateUrl' => '/logics/scholar/doc-update',
                'btnEdit' => function ($url, $model) {
                    if ($model->status !== true)
                        return ZButtonWidget::widget([
                            'config' => [

                                'title' => Az::l('Изменить'),
                                'url' => '/eyuf/logics/scholar/doc-update?id=' . $model->id,
                                'hasIcon' => true,
                                'btnRounded' => false,
                                'btn' => false,
                                'icon' => 'fa fa-' . FA::_EDIT,
                                'confirm' => Az::l('Are you sure you want DELETE columns?')
                            ]
                        ]);
                }
            ],

        ]);

        
        $report = new EyufReport();
        $report->configs->query = EyufReport::find()
            ->where([
                'eyuf_scholar_id' => $Sch->id
            ]);

        $report->configs->edit = true;
        $report->configs->nameOff = [
            'correct'
        ];

        /** @var ZView $this */
        echo ZDynaWidget::widget([
            'model' => $report,
            'config' => [
                'title' => Az::l('Мои отчеты'),
                'edit' => false,
                'columnCheckbox' => false,
                'search' => false,
                'topCreate' => true,
                'topUpdate' => true,
                'actionDelete' => false,
                'actionClone' => false,
                'topFilter' => false,
                'topSort' => false,
                'topSetting' => true,
                'topExport' => true,
                'titleCreate' => Az::l('Добавить отчет'),
                'createUrl' => '/logics/scholar/add-report.aspx'
            ]
        ]);

        ?>


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



