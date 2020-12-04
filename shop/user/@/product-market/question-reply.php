<?php

use zetsoft\dbitem\chat\QuestionItem;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\core\CoreAdvancedItem;
use zetsoft\models\shop\ShopQuestion;
use zetsoft\models\user\User;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\navigat\ZButtonWidget;


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

$product_id = $this->httpGet('id');

$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();
/** @var ZView $this */
$this->beginPage();

$userId =$this->userIdentity()->id;

$questionId= $this->httpGet('id');
$product_id= $this->httpGet('product_id');
$type= $this->httpGet('type');
if($type === 'answers'){
    $type = 'comment';
}

if($type === 'question'){
    $type = 'answers';
}


$item = ShopQuestion::findOne($questionId);
 if($item===null){
       $item = new QuestionItem();
       $item->user_image = 'qweqw';
       $item->user_name = 'qweqw';
       $item->text = 'qweqw';

 }
/*$user = User::findOne($item->user_id);*/
$user = User::findOne(1);

$model = new ShopQuestion();
$model->configs->nameOn =[
    'text',
    'photo'
];
$model->columns();

if ($this->modelSave($model)) {
    /*$model->user_id = $userId;*/
    $model->user_id = 4;

    $model->type = $type;
//    $model->shop_product_id = $item->shop_product_id;
    
    $model->parent_id = $questionId;
  //  $model->user_id = $userId;
    //$model->text = 'qwe';
    $model->save();

    //return $this->redirect();
 // return  $this->urlGoBack();

  return $this->urlRedirect(['/shop/user/product-single/questions-answers','id'=>$product_id]);

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

    <div class="card view view-cascade overlay container pt-4 pr-4 pl-4 pb-1 mt-1">
        <?php $this->beginBody(); ?>

        <?php $form = $this->activeBegin();?>

        <?php


        echo $this->require( '\render\market\ZCommentWidget\clean\reviewJavohir.php', [
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
                    'btnType'=> 'submit',

                    'text' => Az::l('Send'),
                    'btnStyle'=>'btn-success',
                    'btnSize'=>'btn-md mt-0',
                ]
            ]);
            ?>
        </div>



        <?php $this->activeEnd();?>
        <?php $this->endBody() ?>
    </div>

    </body>
    </html>
    <style>
        .cke_contents{
            height :60%!important;
        }
        .file-drop-zone-title{padding: 10px!important;}
        .kv-fileinput-caption{
            margin-top: 0.8rem;
        }
        .input-group-append{
            margin: 0!important;
            padding: 0!important;
        }
    </style>
<?php $this->endPage()


?>



