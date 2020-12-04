<?php

use kartik\builder\Form;
use rmrevin\yii\fontawesome\FA;
use yii\bootstrap\Modal;
use zetsoft\dbitem\data\ZForm;
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
use zetsoft\models\App\eyuf\EyufInvoice;
use zetsoft\models\App\eyuf\EyufReport;
use zetsoft\models\App\eyuf\EyufScholar;
use zetsoft\models\libra\Computer;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\column\ZKDataColumn;
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
use zetsoft\widgets\themes\ZCardProfileWidget;
use zetsoft\widgets\themes\ZPillTabWidget;
use zetsoft\widgets\themes\ZFriendRequestsWidget;
use zetsoft\models\ALL\CoreCompany;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\dbitem\core\WebItem;



?>


<?php
/** @var ZView $this */

$action = new WebItem();

$action->title = Azl . 'Список Расходы';
$action->icon = 'fa fa-institution';


$action->layout = true; $action->debug = false;


$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$userId = $this->httpGet('userId');
$user = User::findOne(['id' => $userId]);


if ($this->userIsGuest())
    return 'You have login to page';



$scholar = EyufScholar::findOne(['user_id' => $user->id]);
//vdd($scholar->program);
$imageUrl = $this->userPhoto();

ZModalNewWidget::begin([
    'id' => 'profPic'
]);
$active = new Active();
$active->type = Active::type['horizontal'];
$form = $this->activeBegin($active);


echo ZFormWidget::widget([
    'model' => $user,
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

    <div class="row">
        <div class="col-md-4">
            <?php

            ZCardProfileWidget::begin([
                'config' => [
         
                    'imageUrl' => $imageUrl,
                    'color' => ZColor::color['primary-color'],
                    'title' => $user->title,
                ]
            ]);

            ?>

            <div class="left_top">
                <div class="text-center">
                    <p><?php echo $scholar->program ?></p> <!--bazadan  olib qoyish kere -->
                </div>
                <div class="photoplace width-30 m-auto bg-danger">
                </div>
            </div>

            <?php ZCardProfileWidget::end();
            $Sch = EyufScholar::findOne(['user_id' => $user->id]);
            $scholar_edu = EyufScholar::findOne(['user_id' => $user->id]);
           
            $scholar_edu->configs->nameOn= [
                'edu_start', 'edu_end'
            ];
            $scholar_edu->configs->nameOff = [
                      'id'
            ];
            $scholar_edu->configs->filter= false;

            /** @var ZView $this */
            echo ZDynaWidget::widget([
                'model' => $scholar_edu,
                'config' => [
                    'createUrl' => '/logics/accounter/add-invoice.aspx?scholarId=' . $userId,
                    'edit' => false,
                    'toolbar' => false,
                    'columnCheckbox' => false,
                    'search' => false,
                    'actionDelete' => false,
                    'actionClone' => false,
                    'topFilter' => false,
                     'title' => 'период обучения',
                    'summary' => false,
                    'titleCreate' => 'Добавить документ',
                    'columnAction' => false,
                    'columnRelation' => false,
                ]

            ]);

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


            echo ZViewWidget::widget([
                'model' => $Sch,
            ]);
            ?>

        </div>
        <div class="col-md-8">

            <?php

            /*    $model = new EyufInvoice();
                $model->configs->query = EyufInvoice::find()
                    ->where([
                        'eyuf_scholar_id' => $userId
                    ]);


                $model->configs->after = [
                    'status' => [
                        [
                            'class' => ZKDataColumn::class,
                            'format' => ZForm::format['html'],
                            'label' => 'расходы',
                            'value' => function (EyufScholar $model, $key, $index, ZKDataColumn $dataColumn) {
                                return ZButtonWidget::widget([
                                    'config' => [
                                        'url' => ZUrl::to('/logics/accounter/add-invoice.aspx?EyufInvoice[eyuf_scholar_id]=' . $model->id)
                                    ]
                                ]);
                            }
                        ],

                    ]

                ];



            $action = new WebItem();

$action->layout = true; $action->debug = false;
$action->icon = 'fa fa-graduation-cap';


            $action->title = Azl . 'Добавить расходы';
            $action->icon = 'fa fa-institution';



            $scholar = EyufScholar::find()
                ->where([
                    'user_id' => $userId
                ])
                ->one();

                
            /*$id = */

            /** @var EyufInvoice $model */
            $model = new EyufInvoice();
            $model->eyuf_scholar_id = $scholar->id;
            $model->configs->nameOff = [
                'user_id',
                'eyuf_scholar_id'
            ];



            if ($this->modelSave($model)) {

                $model = EyufInvoice::findOne($model->id);
                $currency = $model->getPaysCurrency();

             /*   $model->price_cbu = (int)$currency->cbu * (int)$model->price;
                $model->price_buy = (int)$currency->buy * (int)$model->price;
                $model->price_sell = (int)$currency->sell * (int)$model->price;*/

                if ($model->save())
                    $this->urlRedirect([
                        'invoice-index',
                        'userId' => 97
                    ]);
            }

            ?>


            <div class="row">
                <div class="col-md-12 col-12">

                    <?
/*
                    $active = new Active();
$active->type = Active::type['horizontal'];
$form = $this->activeBegin($active);

                    ZCardWidget::begin([
                        'config' => [
                            'title' => $this->title,
                            'type' => ZCardWidget::type['dynCard'],
                        ]
                    ]);

                    echo ZFormWidget::widget([
                        'model' => $model,
                        'form' => $form,
                    ]);

                    ZCardWidget::end();

                    $this->activeEnd();*/

                    ?>

                </div>
            </div>
            <?php


                /** @var ZView $this */
                echo ZDynaWidget::widget([
                    'model' => $model,
                    'config' => [
                        'createUrl' => '/logics/accounter/add-invoice.aspx?scholarId=' . $userId
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












