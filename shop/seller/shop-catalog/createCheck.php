<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\user\User;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\shop\ShopCatalog;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Создание Каталог магазина';
$action->icon = 'fa fa-line-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;



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
    require Root . '/webhtm/block/assets/main.php';

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

    require Root . '/webhtm/block/navbar/main.php';

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">

        <div class="row">
            <div class="col-md-12">

                <?


                $id = $this->httpGet('id');
                $model = new ShopCatalog();

                if ($this->modelSave($model))
                {

                    /**
                     *
                     * Post save Actions
                     */

                    $this->urlRedirect(['index', true]);
                }


                ZCardWidget::begin([
                    'config' => [
                        'title' => Az::$app->view->title,
                        'type' => ZCardWidget::type['dynCard'],
                    ]
                ]);

                $form = $this->activeBegin();

                $model->configs->options = [
                    'shop_element_id' => [
                        'event' => [
                            'select' => <<<JS
            function() {
                
               $.ajax({
                 method: 'POST',
                 url: '/api/shop/catalog/catalog.aspx',
                 data: {
                    companyId: $('#shopcatalog-user_company_id').val(),
                    elementId: $(this).val()
                 },
                 success: function(options) {
                    console.log(options);
                    
                    $('#shopcatalog-amount').val(options.amount);
                    $('#shopcatalog-price').val(options.price);
                    $('#shopcatalog-price_old').val(options.oldPrice);
                 }
               });
              
            }
JS,

                        ]
                    ]
                ];
                $userId = $this->userIdentity()->id;

                $user = User::findOne(29);

                $model->configs->value = [
                    'user_company_id' => $user->user_company_id
                ];
                $model->columns();

                echo ZFormBuildWidget::widget([
                    'model' => $model,
                    'form' => $form,
                ]);

                $this->activeEnd();

                ZCardWidget::end();

                ?>

            </div>
        </div>


    </div>

</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
