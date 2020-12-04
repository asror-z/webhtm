<?php

use yii\caching\TagDependency;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\TabItem;
use zetsoft\former\auth\AuthRegisterForm;
use zetsoft\former\shop\ShopProductItemForm;
use zetsoft\models\core\CoreAdvancedItem;
use zetsoft\models\faqs\Faqs;
use zetsoft\models\shop\ShopQuestion;
use zetsoft\models\shop\ShopReview;
use zetsoft\models\user\User;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;

use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\cards\ZAzCardWidget;

use zetsoft\widgets\former\ZAccardionWidget;
use zetsoft\widgets\former\ZDynaWidgetPop;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\former\ZListViewWidget;
use zetsoft\widgets\incores\ZFaqAccordionWidget;
use zetsoft\widgets\inputes\ZKStarRatingWidget;
use zetsoft\widgets\inputes\ZTextAreaWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\market\ZFooterAllWidgetOrg;
use zetsoft\widgets\market\ZMenuWidgetAbdulloh;
use zetsoft\widgets\market\ZMSwiperDbWidget;
use zetsoft\widgets\market\ZMSwiperWidget;
use zetsoft\widgets\menus\ZSidebarWidget;
use zetsoft\widgets\navigat\ZAAccordionWidget;
use zetsoft\widgets\navigat\ZAccLayWidget;
use zetsoft\widgets\navigat\ZAccLayWidget3;
use zetsoft\widgets\navigat\ZAccLayWidgetNew;
use zetsoft\widgets\navigat\ZAccLayWidgetTest;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\navigat\ZSmartTabWidget;
use zetsoft\widgets\navigat\ZLiloAccordionWidget;
use zetsoft\widgets\navigat\ZMarketDropdownWidget;
use zetsoft\widgets\navigat\ZShowMoreWidget;
use zetsoft\widgets\notifier\ZJspanelWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\widgets\themes\ZTabWidget;


/**@var ZView $this*/
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




$userId =$this->userIdentity()->id;



$model = new ShopQuestion();
$model->configs->nameOn =[
    'text',
    'photo'
];
$model->columns();

if ($this->modelSave($model)) {

    $model->user_id = $userId;
    $model->type = $type;
    if(isset($market_id))
        $model->user_company_id = $market_id;
    if(isset($product_id))
        $model->shop_product_id = $product_id;
    $model->save();
    
    if(isset($market_id))
        $model->urlRedirect(['/shop/user/market-single/questions','id'=>$market_id]);
    if(isset($product_id))
        $model->urlRedirect(['/shop/user/product-single/questions-answers','id'=>$product_id]);

}

?>

<?
    $this->fileCss('/webhtm/shop/user/item-question/asset/style.css');
?>



           <?php $form = $this->activeBegin();?>

           <?php

           echo ZFormWidget::widget([
               'model' => $model,
               'form' => $form,
               'config' => [
                   'topBtn' => false,
                   'botBtn' => false,
               ],
               'event' => [
                   'buttonClick' => <<<JS
                        function(event) {
                             $('#form-modal').modal('hide');
                        } 
                    JS,

               ]
           ]);

           ?>

           <div class="float-right">
               <?
               echo ZButtonWidget::widget([

                   'config' => [
                       'text' => Az::l('Отправить'),
                       'btnRounded' => true,
                       'btn' => true,
                       'btnStyle' => ZButtonWidget::btnStyle['btn-outline-success'],
                       'btnType'=> 'submit',
                       'url' => '/core/user/user-auth/login-register.aspx',
                       'hasIcon' => false,
                       'class' => 'z-depth-1 rounded text-muted',
                       'btnSize'=>'btn-md mt-0',
                   ]
               ]);
               ?>
           </div>



           <?php $this->activeEnd();?>


   


