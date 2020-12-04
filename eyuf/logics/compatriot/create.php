<?php

use zetsoft\models\core\CoreSetting;
use zetsoft\models\App\eyuf\EyufRequest;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\App\eyuf\EyufCompatriot;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\themes\ZColWidget;
use zetsoft\widgets\themes\ZRowWidget;
use zetsoft\dbitem\core\WebItem;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'Создание Соотечественников';
$action->icon = 'fa fa-graduation-cap';
$action->layout = false;
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
    require Root . '/webhtm/block/assets/App/main_eyuf.php';

    $this->head();

    ?>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

echo ZNProgressWidget::widget([]);

?>

<div id="page">

    <?
/*
    if (!$this->httpGet('spa'))
        require Root . '/webhtm/block/navbar/main.php';*/

    echo ZSessionGrowlWidget::widget(); ?>

    <div id="content" class="content-footer p-3">



        <div class="row">
            <div class="col-md-12">
                <?
                //  E-mail  =  email  Телефон
                //  Высшие образования  =  higher_education
                // Дополнительное образование  = additional_education
                // Опыт работы  = experience
                // Достижения   =  awards


                $card = false;

                $model = new EyufCompatriot();

                $model->configs->nameOff =[
                    'name'
                ];

                $model->cards = [
                    [
                        'title' => Az::l('Основное'),
                        'items' => [
                            [
                                'title' => Az::l('Форма'),
                                'items' => [
                                    [
                                        'name',
                                    ],

                                    [
                                        'title',
                                    ],
                                    [
                                        'birthdate',
                                    ],
                                    [
                                        'photo',
                                    ],
                                    [
                                        'lang_nationality_id',
                                    ],
                                    [
                                        'citizenship',
                                    ],
                                    [
                                        'place_country_id',
                                    ],
                                    [
                                        'address',
                                    ],

                                ],
                            ],
                        ],
                    ],

                    [
                        'title' => Az::l('Телефон'),
                        'items' => [
                            [
                                'title' => Az::l('Форма'),
                                'items' => [

                                    [
                                        'phone'
                                    ],
                                ],
                            ],
                        ],
                    ],

                    [
                        'title' => Az::l(' E-mail'),
                        'items' => [
                            [
                                'title' => Az::l('Форма'),
                                'items' => [

                                    [
                                        'email'
                                    ],
                                ],
                            ],
                        ],
                    ],


                    [
                        'title' => Az::l('Высшие образования'),
                        'items' => [
                            [
                                'title' => Az::l('Форма'),
                                'items' => [

                                    [
                                     'higher_education'
                                    ],
                                ],
                            ],
                        ],
                    ],

                    [
                        'title' => Az::l('Дополнительное образование'),
                        'items' => [
                            [
                                'title' => Az::l('Форма'),
                                'items' => [

                                    [
                                        'additional_education'
                                    ],
                                ],
                            ],
                        ],
                    ],

                    [
                        'title' => Az::l('Опыт работы '),
                        'items' => [
                            [
                                'title' => Az::l('Форма'),
                                'items' => [
                                    [
                                        'experience'
                                    ],
                                ],
                            ],
                        ],
                    ],


                    [
                        'title' => Az::l('Достижения'),
                        'items' => [
                            [
                                'title' => Az::l('Форма'),
                                'items' => [

                                    [
                                        'awards'
                                    ],
                                ],
                            ],
                        ],
                    ],


                ];

                $model->columns();

                if ($this->modelSave($model)) {
                    /**
                     *
                     * Post save Actions
                     */
                     $this->paramSet(paramIframe, true);
                    $this->urlRedirect(['index', true]);
                }

                $active = new Active();
                $active->type = Active::type['horizontal'];
                $form = $this->activeBegin($active);

                echo ZFormBuildWidget::widget([
                    'model' => $model,
                    'form' => $form,
                    'config' => [
                        'stepType' => ZFormBuildWidget::stepType['wizard'],
                        'blockType' => ZFormBuildWidget::blockType['card'],
                    ]
                ]);

                $this->activeEnd();

                ?>
            </div>
        </div>


    </div>

</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
