<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\user\User;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 * @license  MurodovMirbosit
 */

$action = new WebItem();

$action->title = Azl . 'Настройки профиля';
$action->icon = 'fa fa-line-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;

if ($this->httpGet('spa'))
    $action->debug = false;



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
    require Root . '/webhtm/block/assets/App/main_arbit.php';

    $this->head();

    ?>

</head>


<body class="hold-transition sidebar-mini">

<?php



$this->beginBody();

echo ZNProgressWidget::widget([]);
echo $this->require( '\webhtm\cpas\blocks\header.php');
?>


    <?


        

    echo ZSessionGrowlWidget::widget();$id = $this->userIdentity()->id;

    $model = User::findOne($id);

    $auth_key = $model->auth_key;
    $referal_link = $model->referal_link;
    ?>

<div id="content" class="content-footer p-3 ">
    <h3 class="font-family">Личная информация</h3>
        <div class="row border rounded mx-auto">
            <div class="col-md-6 col-6 ">
                <div>
                    <label for="country"><?= Az::l('Ваш ключ авторизации')?></label>
                    <div class="d-flex align-items-center">
                        <input class="form-control" type="text" id="auth-key" name="auth-key" value="<?= $auth_key?>" readonly>
                        <button onclick="copyToClipboard()" class="btn btn-info btn-md"><i class="fas fa-copy"></i></button>
                    </div>

                </div>

            </div>
            <div class="col-md-6 col-6">
                
                <div>
                    <label for="country"><?= Az::l('Ваша реферальная ссылка')?></label>
                    <div class="d-flex align-items-center">
                        <input class="form-control" type="text" id="auth-key" name="auth-key" value="<?= $referal_link?>" readonly>
                        <button onclick="copyToClipboard()" class="btn btn-info btn-md"><i class="fas fa-copy"></i></button>
                    </div>

                </div>



            </div>

            <div class="col-md-12 col-12">
                <?

                $model = $this->userIdentity();
                $url = ZUrl::to([
                    '/cpas/'.$this->userIdentity()->role.'/statistic',
                ]);

                if ($this->modelSave($model)) {
                    return $this->urlRedirect($url);
                }
                $model->cards = [
                    [
                        'title' => Az::l('Первый этап'),
                        'shows' => true,
                        'items' => [
                            [
                                'title' => Az::l('Форма'),
                                'shows' => true,
                                'items' => [
                                    [
                                        'name',
                                        'title',
                                    ],

                                    [
                                        'password',
                                        'gender',
                                    ],
                                    [
                                        'website',
                                        'phone',
                                    ],
                                    [
                                        'email',
                                        'number',
                                    ],
                                    
                                    [
                                        'photo',
                                        'social',
                                    ],

                                    [
                                        'user_company_id',
                                        'place_adress_ids',
                                        'currency',
                                    ],
                                    
                                    
                                ],
                            ],
                        ],
                    ],

                ];
                $active = new Active();
                $active->type = Active::type['vertical'];
                $form = $this->activeBegin($active);
                echo ZFormBuildWidget::widget([
                    'model' => $model,
                    'form' => $form,
                    'config' => [
                        'topBtn' => false
                    ]
                ]);

                $this->activeEnd();




                ?>
            </div>
        </div>
        </div>
    <script>
        function copyToClipboard() {
            /* Get the text field */
            var copyText = document.getElementById("auth-key");
            /* Select the text field */
            copyText.select();

            copyText.setSelectionRange(0, 99999); /*For mobile devices*/
            /* Copy the text inside the text field */

            document.execCommand("copy");
        }
    </script>

<? echo $this->require( '\webhtm\cpas\blocks\footer.php');
 $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
