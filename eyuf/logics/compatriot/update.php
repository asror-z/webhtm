<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\App\eyuf\EyufCompatriot;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\former\ZFormBuildWidget;


/** @var ZView $this */

$action = new WebItem();

$action->layout = true;
$action->debug = false;
$action->icon = 'fa fa-graduation-cap';
$action->title = Azl . 'Редактирование  Соотечественники';
$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

$id = $this->httpGet('id');

if (empty($id))
    $model = new EyufCompatriot();


$model = EyufCompatriot::findOne($id);

$model->cards = [
    [
        'title' => Az::l('Первый этап'),
        'items' => [
            [
                'title' => Az::l('Форма'),
                'items' => [
                    [
                        'name',
                        'title',
                        'birthdate',
                    ],
                    [
                        'photo',
                    ],
                    [
                        'lang_nationality_id',
                        'address',
                    ],
                    [
                        'place_country_id',
                        'citizenship',

                    ],
                    [
                        'phone',
                        'email',
                    ],

                    [
                        'govs_speciality_ids',
                        'govs_degree_ids',
                    ],
                    [
                        'higher_education',

                    ],
                    [
                        'additional_education',
                    ],
                    [
                        'experience',
                    ],
                    [
                        'awards',
                    ]
                ],
            ],
        ],
    ]
];

$model->columns();


if ($this->modelSave($model))
    $this->urlRedirect(['index', true]);


?>

<div class="row">
    <div class="col-md-12 col-12">

        <?
        $active = new Active();

        $active->type = Active::type['horizontal'];

        $form = $this->activeBegin($active);

        echo ZFormBuildWidget::widget([
            'model' => $model,
            'form' => $form,
            'config' => [
                'stepType' => ZFormBuildWidget::stepType['none'],
                'blockType' => ZFormBuildWidget::blockType['card'],
            ]
        ]);

        $this->activeEnd();
        
        ?>
    </div>
</div>
