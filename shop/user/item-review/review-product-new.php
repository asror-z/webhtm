<?php

use rmrevin\yii\fontawesome\FAL;
use yii\caching\TagDependency;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\FormDb;
use zetsoft\dbitem\data\TabItem;
use zetsoft\former\auth\AuthRegisterForm;
use zetsoft\former\shop\ShopProductItemForm;
use zetsoft\models\core\CoreAdvancedItem;
use zetsoft\models\faqs\Faqs;
use zetsoft\models\shop\ShopReview;
use zetsoft\models\user\User;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;

use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\cards\ZAzCardWidget;

use zetsoft\widgets\former\ZAccardionWidget;
use zetsoft\widgets\former\ZDynaWidgetPop;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\former\ZListViewWidget;
use zetsoft\widgets\incores\ZFaqAccordionWidget;
use zetsoft\widgets\inputes\ZKStarRatingWidget;
use zetsoft\widgets\inputes\ZReviewInput2Widget;
use zetsoft\widgets\inputes\ZReviewInputWidget;
use zetsoft\widgets\inputes\ZTextAreaWidget;
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
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\widgets\themes\ZTabWidget;
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

$userId = $this->userIdentity()->id;
$model = new ShopReview();


if ($this->modelSave($model)) {
    $model->user_id = $userId;
    $model->type = $review_type;
    $model->shop_product_id = $product_id;
    $model->columns['rating']->title = 'Общий рейтинг';
    $model->like = 0;
    $model->dislike = 0;
    $model->save();
    $this->urlRedirect(['/shop/user/product-single/review', 'id'=> $product_id], true);

}
   

    $form = $this->activeBegin();

    echo Az::l('Общая оценка :');

    $model->configs->nameOn = [
        'rating',
    ];
    $model->columns();

    echo ZFormBuildWidget::widget([
        'model' => $model,
        'form' => $form,
        'config' => [
            'topBtn' => false,
            'botBtn' => false,
        ],
    ]);

    $model->configs->nameOn = [
        'experience',
    ];
    $model->columns();

    echo ZFormBuildWidget::widget([
        'model' => $model,
        'form' => $form,
        'config' => [
            'topBtn' => false,
            'botBtn' => false,
        ],
    ]);

    echo Az::l('Коммент:');

    $model->configs->nameOn = [
        'text'
    ];
    $model->columns();

    echo ZFormBuildWidget::widget([
        'model' => $model,
        'form' => $form,
        'config' => [
            'topBtn' => false,
            'botBtn' => false,
        ],
    ]);

    ?>
    <div class="row">
        <div class="col-md-12">
            <?php

            echo Az::l('Обшие параметры :');
            $model->configs->nameOn = [
                'anonymous',
                'recommend',
            ];
            $model->columns();

            echo ZFormBuildWidget::widget([
                'model' => $model,
                'form' => $form,
                'config' => [
                    'topBtn' => false,
                    'botBtn' => false,
                ],
            ]);


            ?>
        </div>
    </div>
    <?php

    $model->configs->nameOn = [
        'virtues',
        'drawbacks',
    ];
    $model->columns();

    echo ZFormBuildWidget::widget([
        'model' => $model,
        'form' => $form,
        'config' => [
            'topBtn' => false,
            'botBtn' => false,
        ],
    ]);

    ?>
    <div class="float-right">
        <?php


        echo ZButtonWidget::widget([
            'config' => [
                'btnType' => ZButtonWidget::btnType['submit'],
                'text' => Az::l('Send'),
                'btnRounded' => false,
                'btnStyle' => 'btn-outline-success',
            ]
        ]);

        $this->activeEnd();
        ?>
    </div>

