<?php

use Carbon\Carbon;
use yii\caching\TagDependency;
use zetsoft\dbitem\chat\ReviewItem;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\TabItem;
use zetsoft\former\shop\ShopProductItemForm;
use zetsoft\models\core\CoreAdvancedItem;
use zetsoft\models\faqs\Faqs;
use zetsoft\models\user\User;
use zetsoft\service\market\Review;
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
use zetsoft\widgets\navigat\ZReadMoreWidget;
use zetsoft\widgets\navigat\ZShowMoreWidget;
use zetsoft\widgets\navigat\ZSmartTabWidget;
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

$this->title();
$this->toolbar();
/** @var ZView $this */
$this->beginPage();
$this->registerJsFile('/render/asrorz/market/js/review.js');
$productId = $this->httpGet('id');
//vdd($productId);
$items = Az::$app->market->review->getReviewByBrandId($productId);



if (!isset($items) || $items === false || $items === []) {
    $items = new ReviewItem();
    $items->id = 15;
    $items->product_id = 18;
    $items->user_name = 'UserName';
    $items->user_image = 'https://pluspng.com/img-png/user-png-icon-male-user-icon-512.png';
    $items->text = 'Text';
    $items->photo = '';
    $items->rating = 3;
    $items->like = true;
    $items->created_at = '10';
    $items->virtues = 'virtues';
    $items->drawbacks = 'drawback';
    $items->dislike = true;
    $items->type = 'type';
    $items->isdislike = false;
    $items->islike = null;
}
//vdd($items);
//$result = message($items);


function message($items)
{

    echo ZReadMoreWidget::widget([
        'config' => [
            'parentclass' => 'actionBox',
            /*'itemInSummary' => 0,*/
            'itemClass' => 'childdd',
        ]
    ]);

    $review = '';
    $result_part = '';
    $review .= <<<HTML
         <div class="detailBox w-100 card-cascade container-fluid overlay pt-1 pl-1 pb-1 m-1">
                <div class="actionBox  pl-2 pt-2 pb-2">
                <ul class="list-unstyled mb-0 commentList p-0">
                    <li class="m-0 mt-2 pb-1">
                        <div style="width:40px" class="commenterImage  float-left mr-2 h-100">
                            <img class="w-100 rounded-circle" src="{user_image}"/>
                        </div>
                        <div class="commentText d-flex mr-0 pl-0">
                            <div class="w-100">
                                <div class="d-flex">
                                    <div class="d-block">
                                        <p class="m-0 font-weight-bold">{user_name}</p>
                                        <div class="ml-1">{rating}</div>
                                    </div>  
                                    <div class="d-block">
                                        <div class="ml-2 small date fe-10 float-right text-muted">{created_at}</div>
                                        <div class="ml-2 text-muted">{time_ago}</div>
                                    </div> 
                                </div>
                                
                                <ul class="list-unstyled">
                                    <li>{virtues}</li>
                                    <li>{drawbacks}</li>
                                    <li>{text}</li>
                                    <li>{comment_image}</li>
                                    
                                </ul>
                              
                             
        
                                <div class="d-flex button-links align-items-center">
                                    {button}
                                    <a href="#" onclick="add_like({item_id})">
                                        <i id="like-element-{item_id}" class="fas fa-thumbs-up mr-1 {class_like} "></i>
                                        <span class="text-muted" id="text-like-{item_id}">{like_count}</span>
                                    </a>
                                    <a onclick="dis_like({item_id})" class="dislike ml-4">
                                        <i id="dislike-element-{item_id}" class="fas fa-thumbs-down mr-1 {class_dislike}"></i>
                                        <span class="text-muted" id="text-dislike-{item_id}">{dislike_count}</span>
                                    </a>
                                </div>
                                <div class="hidden-reply-box d-none">
                                    <div class="d-flex">
                                        <div class="comment-text-input w-100">
                                            <input class="form-control w-100 rounded-pill reply-comment-text-input" type="text"
                                                   placeholder="Your comments"/>
                                        </div>
                                        <div class="w-25 add-btn">
                                            <button class="border-0 rounded-pill btn-success w-100 py-2 ml-1 add-comment-btn">
                                                Add
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                             
                        </div>
        
                    </li>
                </ul>
                       {children}
            </div>
            
         </div>
HTML;


    foreach ($items as $item) {

 //       $item = Az::$app->market->review->getReviewByBrandId($productId);
   //   $item = new ReviewItem();
    //    $item->id = 15;
//        $item->product_id = 18;
//        $item->user_name = 'UserName';
//        $item->user_image = '';
//        $item->text = 'Text';
//        $item->photo = 'https://png.pngtree.com/png-vector/20190710/ourmid/pngtree-user-vector-avatar-png-image_1541962.jpg';
//               $item->rating = 3;
//        $item->like = true;
//        $item->created_at = '10';
//        $item->virtues = 'virtues';
//        $item->drawbacks = 'drawback';
//        $item->dislike = true;
//        $item->type = 'type';
//        $item->isdislike = false;
//        $item->islike = null;
//        $created_at = 10 / 10 / 2020;



        $rating = ZKStarRatingWidget::widget([
            'name' => 'gggfg',
            'config' => [
                'show' => false,
                'value' => $item->rating,
            ]
        ]);


        $button = ZButtonWidget::widget([

            'config' => [
                //  'btnRounded' => false,
                'text' => Az::l('Ответить'),
                'url' => Zurl::to(['/shop/user/review/review-reply', 'id' => $item->id, 'type' => $item->type]),
                'btnStyle' => 'btn-outline-success',
                'btnSize' => 'btn-sm',
                'class' => 'small p-1 pl-2 pr-2'
            ]
        ]);

        $class_like = $item->islike ? 'text-success' : 'text-muted';
        $class_dislike = $item->isdislike ? 'text-success' : 'text-muted';


        if (count($item->items) < 1) {

            $children = '<div class="border-left bordered-secondary">';
            $children .= message($item->items);
            $children .= '</div>';
        } else {
            $children = '<div class="border-left childdd bordered-secondary">';
            $children .= message($item->items);
            $children .= '</div>';
        }

        $virutes = '<b class="font-weight-bolder">' . Az::l('Достоинства :') . '</b>';
        $drawbacks = '<b class="font-weight-bolder">' . Az::l('Недостатки : ') . '</b>';
        //$time_ago = Carbon::parse($item->created_at)->diffForHumans();
        $image = '<img class="rounded p-1 border" width="80px" height="auto" src="' . $item->photo . '"/>';


        if ($item->photo !== '')
            $image = '<img class="rounded p-1 border" width="80px" height="auto" src="' . $item->photo . '"/>';
        /*if($item->virtues ==='')
          $virutes ='';
        if($item->drawbacks ==='')
          $drawbacks ='';*/

        $result_part .= strtr($review, [
            '{user_name}' => $item->user_name,
            '{user_image}' => $item->user_image,
            '{children}' => $children,
            '{like_count}' => $item->like,
            '{class_like}' => $class_like,
            '{class_dislike}' => $class_dislike,
            '{dislike_count}' => $item->dislike,
            '{text}' => $item->text,
            '{rating}' => $rating,
            '{created_at}' => $item->created_at,
            '{button}' => $button,
            '{item_id}' => $item->id,
            '{virtues}' => $virutes . $item->virtues,
            '{drawbacks}' => $drawbacks . $item->drawbacks,
            '{comment_image}' => $image,
            //'{time_ago}' => $time_ago,

        ]);

    }


    return $result_part;
}


?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

    <?php

    require Root . '/webhtm/block/metas/main.php';
    require Root . '/webhtm/block/assets/main.php';

    echo ZSidebarWidget::widget([]);

    $this->head();

    ?>

</head>
<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php $this->beginBody(); ?>

<?php

$result = message($items);


echo $result;

?>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage()


?>

<script>
    // var check = true;

    function dislike_data(id) {

        $.ajax({
            method: 'GET',
            url: '/core/product/dislike.aspx',
            data: {
                id
            },
            success: function (data) {
                //   check = true;
                $('#text-dislike-' + id).html(data);
                //$('.dislike').attr('onclick','dis_like({item_id})');

            }
        });

    }

    function like_data(id) {

        $.ajax({
            method: 'GET',
            url: '/core/product/like.aspx',
            data: {
                id
            },
            success: function (data) {
                //   check = true;
                $('#text-like-' + id).html(data);


            }
        });

    }

    function add_like(id) {
        // if (check) {
        //    check = false;
        console.log($('#dislike-element-' + id).hasClass('text-muted'))
        if (($('#like-element-' + id).hasClass('text-muted')) &&
            ($('#dislike-element-' + id).hasClass('text-muted'))) {

            like_data(id);

            $('#like-element-' + id).removeClass('text-muted');
            $('#like-element-' + id).addClass('text-success');

        } else if (($('#like-element-' + id).hasClass('text-muted')) && ($('#dislike-element-' + id).hasClass('text-success'))) {

            dislike_data(id);
            like_data(id);


            $('#like-element-' + id).removeClass('text-muted');
            $('#like-element-' + id).addClass('text-success');
            $('#dislike-element-' + id).removeClass('text-success');
            $('#dislike-element-' + id).addClass('text-muted');
        } else if (($('#like-element-' + id).hasClass('text-success')) && ($('#dislike-element-' + i d
    ).
        hasClass('text-muted')
    ))
        {

            like_data(id);

            $('#like-element-' + id).removeClass('text-success');
            $('#like-element-' + id).addClass('text-muted');
        }
    }
    }


    function dis_like(id) {

        // if (check) {
        //  check = false;
        if (($('#like-element-' + id).hasClass('text-muted')) &&
            ($('#dislike-element-' + id).hasClass('text-muted'))) {

            dislike_data(id);

            $('#dislike-element-' + id).removeClass('text-muted');
            $('#dislike-element-' + id).addClass('text-success');

        } else if (($('#dislike-element-' + id).hasClass('text-muted')) && ($('#like-element-' + id).hasClass('text-success'))) {

            dislike_data(id);
            like_data(id);

            $('#dislike-element-' + id).removeClass('text-muted');
            $('#dislike-element-' + id).addClass('text-success');
            $('#like-element-' + id).removeClass('text-success');
            $('#like-element-' + id).addClass('text-muted');
        } else if (($('#dislike-element-' + id).hasClass('text-success')) && ($('#like-element-' + id).hasClass('text-muted'))) {

            dislike_data(id);

            $('#dislike-element-' + id).removeClass('text-success');
            $('#dislike-element-' + id).addClass('text-muted');
        }
        // }
    }


</script>
<style>
    .commentText {
        line-height: 19px !important;
    }
</style>
