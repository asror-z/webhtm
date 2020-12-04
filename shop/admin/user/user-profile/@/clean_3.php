<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

use zetsoft\dbitem\core\WebItem;
use zetsoft\former\auth\AuthPassChangeForm;
use zetsoft\models\user\User;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZHPasswordInputWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\navigat\ZButtonIconsWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\user\User;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Создание Пользователь';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;




$pass = new AuthPassChangeForm();

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

    $this->require( '/webhtm/block/metas/main.php');
    $this->require( '/webhtm/block/assets/main.php');

    $this->head();

    ?>

</head>



<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

echo ZNProgressWidget::widget([]);

?>

<div id="page">
    <div id="content" class="content-footer p-3">

        <div class="container-fluid">
            <?

            $id = $this->userIdentity()->id;

            //  $id = $this->httpGet('id');

            if ($id === null)
                $id = 1;

            $model = User::findOne(29);


            if ($this->modelSave($model)) {
                $this->modelPost();

                /**
                 *
                 * Post save Actions
                 */
                /*
                                 $this->urlRedirect(['index', true]);*/
            }


            $active = new Active();
            //$active->class = 'row';

            $form = $this->activeBegin($active);

            ?>
            <div class="row">
                <div class="col-12">

                    <div class="row p-1 ">
                        <div class="col-md-6 px-3">

                            <h3 class="font-family ">Личная информация</h3>

                            <div class="row">
                                <div class="col-12 ">

                                    <div class="profiles col-md-12 mt-2">
                                        <?
                                        //  vdd($model);
                                        $model->configs->nameOn = [
                                            'name',
                                        ];

                                        $model->columns();


                                        echo ZFormWidget::widget([
                                            'model' => $model,
                                            'form' => $form,
                                            'config' => [
                                                'botBtn' => false,
                                                'topBtn' => false,

                                            ]
                                        ]);


                                        ?>
                                    </div>

                                    <h5 class="mt-5">Фамилия</h5>
                                    <div class="profiles col-md-12">
                                        <?

                                        $model->configs->nameOn = [
                                            'name',
                                        ];

                                        $model->columns();


                                        echo ZFormWidget::widget([
                                            'model' => $model,
                                            'form' => $form,
                                            'config' => [
                                                'botBtn' => false,
                                                'topBtn' => false,

                                            ]
                                        ]);


                                        ?>
                                    </div>

                                </div>
                            </div>

                            <div class="row my-5 ">
                                <div class="col-md-6">

                                    <?

                                    $model->configs->nameOn = [
                                        'lang',
                                    ];

                                    $model->columns();


                                    echo ZKSelect2Widget::widget([
                                        'model' => $model,
                                        'attribute' => 'attribute',
                                        'data' => [
                                            'men' => Az::l('Мужской'),
                                            'women' => Az::l('Женский'),
                                        ],
                                        'config' => [
                                            'placeholder' => 'Пол',
                                            'theme' => ZKSelect2Widget::theme['bootstrap'],
                                            'size' => ZKSelect2Widget::size['md'],
                                        ]
                                    ]);

                                    ?>

                                </div>
                                <div class="col-md-6">

                                    <?

                                    $model->configs->nameOn = [
                                        'lastseen',
                                    ];

                                    $model->columns();


                                    echo ZFormWidget::widget([
                                        'model' => $model,
                                        'form' => $form,
                                        'config' => [
                                            'botBtn' => false,
                                            'topBtn' => false,
                                        ]
                                    ]);

                                    ?>

                                </div>
                            </div>

                        </div>

                        <div class="col-md-6 px-3 ">
                            <h3>Фото профиля</h3>
                            <?

                            $model->configs->nameOn = [
                                'photo',
                            ];
                            $model->columns();

                            echo ZFormWidget::widget([
                                'model' => $model,
                                'form' => $form,
                                'config' => [
                                    'botBtn' => false,
                                    'topBtn' => false,
                                ]
                            ]);

                            ?>
                        </div>

                    </div>

                    <div class="border-bottom border"></div>

                    <div class="row p-1">
                        <div class="col-md-6 px-3 pb-5">

                            <h3>Контактная информация</h3>
                            <div class="row">
                                <div class="col-12 ">
                                    <h5>Телефон</h5>
                                    <div class="profiles">
                                        <?

                                        $model->configs->nameOn = [
                                            'phone',
                                            'contact',

                                        ];
                                        $model->columns();

                                        echo ZFormWidget::widget([
                                            'model' => $model,
                                            'form' => $form,
                                            'config' => [
                                                'botBtn' => false,
                                                'topBtn' => false,
                                            ]
                                        ]);


                                        ?>
                                    </div>


                                    <h5 class="mt-5">Электронная почта</h5>
                                    <div class="profiles col-md-12">
                                        <?

                                        $model->configs->nameOn = [
                                            'email',

                                        ];
                                        $model->columns();

                                        echo ZFormWidget::widget([
                                            'model' => $model,
                                            'form' => $form,
                                            'config' => [
                                                'botBtn' => false,
                                                'topBtn' => false,
                                            ]
                                        ]);


                                        ?>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6 px-3 pb-5">
                            <h3>Изменение пароля</h3>


                            <div class="row">
                                <div class="col-12 ">
                                    <div class="">
                                        <?

                                        $model->configs->nameOn = [

                                            'password',

                                        ];
                                        $model->columns();

                                        echo ZFormWidget::widget([
                                            'model' => $pass,
                                            'form' => $form,
                                            'config' => [
                                                'botBtn' => false,
                                                'topBtn' => false,
                                            ]
                                        ]);

                                        $this->activeEnd();
                                        ?>
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <?
                                        echo ZButtonWidget::widget([
                                            'config' => [
                                                'text' => 'Сохранить',
                                                'btnType' => 'submit',
                                                'class' => 'border-0 bg-success text-white rounded rgba-stylish-light'
                                            ]
                                        ]);
                                        ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
</div>
</div>

<script>

    $(document).ready(function () {

        setTimeout(function () {
            $('.file-input .file-caption-main .btn-file ').addClass('p-2')
        },50)
    })
</script>

<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
