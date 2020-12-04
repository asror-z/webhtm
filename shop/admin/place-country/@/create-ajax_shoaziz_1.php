
<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\ware\WareEnterItem;
use zetsoft\service\forms\Active;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\models\ware\WareEnter;
use zetsoft\widgets\inputes\ZLibraInputWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Создание прихода в склад';
$action->icon = 'fal fa-film';
$action->type = WebItem::type['html'];
$action->csrf = true;
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

    echo ZSessionGrowlWidget::widget();?>

    <div id="content" class="content-footer p-3">

        <div class="row">
            <div class="mx-auto pt-3 col-md-11 col-11">

                <?


                $id = $this->httpGet('ware_enter_id');
                $model = new WareEnterItem();

                if ($this->modelSave($model)) {

                    $this->paramSet(paramIframe, true);

                    $this->urlRedirect([
                        'process',
                        'ware_enter_id' => $model->id,
                    ]);
                }


                $active = new Active();
                $active->method = Active::method['post'];
                $active->childClass = 'my-3';

                $form = $this->activeBegin($active);

                $model->ware_enter_id = $id;
                $model->configs->nameOff = [
                    'name',
                ];
                $model->configs->options = [
                    'shop_element_id' => [
                        'event' => [
                            'select' => <<<JS
    function() {
      
        
        $.ajax({
            url: '/api/orders/measure.aspx',
            data: {
                shop_element_id: $(this).val(),
            },
            success: function(response) {
                        
               var measure = $('#wareenteritem-measure');
               measure.val(response.output)
               measure.trigger('change')
                
            }
        })    
        
    }
JS,

                        ]
                    ]
                ];


                $model->columns();

                echo ZLibraInputWidget::widget([
                    'config' => [
                        'funcName' => 'libra',
                        'inputSelector' => '#wareenteritem-weight',
                        'buttonSelector' => '#w31',
                        'autorun' => true,
                    ],
                ]);

                echo ZFormBuildWidget::widget([
                    'model' => $model,
                    'form' => $form,
                    'config' => [
                        'cols' => 1,
                        'topBtn' => false,
                        'stepType' => ZFormBuildWidget::stepType['none'],
                        'blockType' => ZFormBuildWidget::blockType['naked']
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
