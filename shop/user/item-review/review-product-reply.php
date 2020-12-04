<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\shop\ShopReview;
use zetsoft\models\user\User;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;

use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZJspanelWidget;

/** @var ZView $this */
$action = new WebItem();

$action->title = Azl . 'History';
$action->icon = 'fa fa-area-chart';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;

$action->cache = false;

$action->call = [
//    TagDependency::invalidate()
];
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();
/** @var ZView $this */
$this->beginPage();

$userId = $this->userIdentity()->id;

$reviewId = $this->httpGet('id');
$type = $this->httpGet('type');

$item = ShopReview::findOne($reviewId);

if (!isset($item)) {
    $item = new ShopReview();
    $item->id = 1;
    $item->code = 4545;
    $item->type = 'asd';
    $item->shop_brand_id = 1;
    $item->shop_product_id = 4;
    $item->user_company_id = 4;
    $item->rating = 4.25;
    $item->parent_id = 'adasdas';
    $item->rating_option = json_encode('{"hey": 45}');
    $item->text = 'kajshdkjashdkaj';
    $item->virtues = 'asdas';
    $item->drawbacks = 'asdaskd';
    $item->experience = 'asdkjas';
    $item->recommend = true;
    $item->anonymous = true;
    $item->like = 45;
    $item->dislike = 45;
    $item->photo = null;
    $item->user_id = 1;
    $item->created_at = '2020-06-09 15:58:42';
    $item->modified_at = '2020-06-09 15:58:42';
}

$user = User::findOne($item->user_id);

//vdd($user);

$model = new ShopReview();
$model->configs->nameOn = [
    'text',
    'virtues',
    'drawbacks',
    'photo'
];
$model->columns();

if ($this->modelSave($model)) {
    /*$model->user_id = $userId;*/
    $model->user_id = 27;

    $model->type = $type;
    $model->shop_product_id = $item->shop_product_id;
    $model->rating = 0;
    $model->parent_id = $reviewId;
    //$model->user_id = $userId;
    //$model->text = 'qwe';
    $model->like = 0;
    $model->dislike = 0;
    $model->save();
    return $this->urlRedirect(['/shop/user/product-single/review','id'=>$item->shop_product_id]);

}

/**
 * @property int $id
 * @property string $type
 * @property int $core_brand_id
 * @property int $shop_product_id
 * @property int $user_company_id
 * @property float $rating
 * @property string $text
 * @property string $parent_id
 * @property int $user_id
 * @property int $like
 * @property int $dislike
 * @property string $created_at
 * @property string $modified_at
 * @property int $created_by
 * @property int $modified_by
 */


// vdd($content);
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

    <?php

    require Root . '/webhtm/block/metas/main.php';
    require Root . '/webhtm/block/assets/main.php';

    //require Root . '/render/menus/ZSidebarWidget/ready/main.php';

    
    $this->head();

    ?>

</head>
<body class="<?= ZWidget::skin['white-skin'] ?>">
<?php $this->beginBody();

require Root . '/webhtm/block/header/main.php';
require Root . '/webhtm/block/navbar/main.php';
?>

<div class="card view view-cascade overlay container my-2 pt-4 pr-4 pl-4 pb-1 mt-1">


    <?php $form = $this->activeBegin(); ?>

    <?php


    echo $this->require( '\render/market/ZCommentWidget/ready/review.php', [
        'item' => $item,
        'user' => $user,
    ]);

    echo ZFormWidget::widget([
        'model' => $model,
        'form' => $form,
        'config' => [
            'topBtn' => false,
            'botBtn' => false,
        ],
    ]);

    ?>

    <div class="float-right">
        <?
        echo ZButtonWidget::widget([

            'config' => [
                'btnType' => 'submit',
                'text' => Az::l('Отправить'),
                'btnRounded' => false,
                'btnSize' => 'btn-md mt-0',
                'btnStyle' => ZButtonWidget::btnStyle['btn-outline-success'],
                'class' => 'rounded ',
            ]
        ]);
        ?>
    </div>
</div>

<script>
    $(document).ready(function () {

        var mainParent =  $('.kv-fileinput-caption');
        
        console.log(mainParent);

    });
</script>

    <?php $this->activeEnd(); ?>

    <?

    echo ZFooterAllWidget::widget();
    echo ZJspanelWidget::widget([]);

    ?>


<?php $this->endBody() ?>
</body>
</html>
<style>
    .cke_contents {
        height: 60% !important;
    }

    .file-drop-zone-title {
        padding: 10px !important;
    }

    .kv-fileinput-caption {
        margin-top: 0.8rem;
    }

    .input-group-append {
        margin: 0 !important;
        padding: 0 !important;
    }
</style>
<?php $this->endPage()


?>



