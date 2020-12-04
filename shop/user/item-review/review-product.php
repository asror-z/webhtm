<?php

use Carbon\Carbon;
use yii\caching\TagDependency;
use zetsoft\dbitem\chat\ReviewItem;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\TabItem;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\former\shop\ShopProductItemForm;
use zetsoft\inserts\eyuf\CoreReviewInsert;
use zetsoft\models\core\CoreAdvancedItem;
use zetsoft\models\faqs\Faqs;
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
use zetsoft\widgets\themes\ZTabWidget;


$role = $this->userRole();

function message($items, $product_id, $role, $market_id)
{
    global $role;

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
                                <div>
                                    <div class="d-block float-left">
                                        <p class="m-0 font-weight-bold">{user_name}</p>
                                        <div class="ml-1">{rating}</div>
                                    </div>  
                                    <div class="d-block float-right">
                                        <div class="ml-2 small date fe-10 float-right text-muted">{created_at}</div>
                                        <div class="ml-2 text-muted">{time_ago}</div>
                                    </div> 
                                </div>
                                <div>
                                    <ul class="list-unstyled">
                                        <li>{virtues}</li>
                                        <li>{drawbacks}</li>
                                        <li>{text}</li>
                                        <li>{comment_image}</li>
                                        
                                    </ul>
                                </div>
                             
        
                                <div class="d-flex button-links align-items-center float-right">
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
         <script>


    $(document).ready(function () {
        
    })
    var check = true;

    function dislike_data(id) {

        $.ajax({
            method: 'GET',
            url: '/core/product/dislike.aspx',
            data: {
                id
            },
            success: function (data) {
                check = true;
                $('#text-dislike-' + id).html(data);
                $('.dislike').attr('onclick','dis_like({item_id})');
                console.log('dislike')

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
                check = true;
                $('#text-like-' + id).html(data);
                console.log(data);


            }
        });

    }

    function add_like(id) {
        console.log(id)
        if (check) {
            check = false;
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
            } else if (($('#like-element-' + id).hasClass('text-success')) && ($('#dislike-element-' + id).hasClass('text-muted'))) {

                like_data(id);

                $('#like-element-' + id).removeClass('text-success');
                $('#like-element-' + id).addClass('text-muted');
            }
        }
    }


    function dis_like(id) {
        console.log(id);
        if (check) {
            check = false;
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
        }
    }


</script>
HTML;

           /// vdd($items);
    foreach ($items as $item) {
        $rating = ZKStarRatingWidget::widget([
            'name' => 'gggfg',
            'config' => [
                'value' => $item->rating,
                'show' => false,
                'readonly' => true,
            ]
        ]);
        
        if ($role === 'user')
            $url = Zurl::to(['/core/user/user-auth/login-register']);
        else
            $url = Zurl::to(['/shop/user/item-review/review-reply', 'id' => $item->product_id, 'type' => $item->type, 'market_id' => $market_id, 'review_id' => $item->id ]);

        $button = ZButtonWidget::widget([
            'config' => [
                'text' => Az::l('Ответить'),
                'url' => $url,
                'btnRounded' => false,
                //'btnStyle' => 'btn-outline-success',
                'btnSize' => 'btn-sm',
                'class' => 'small p-1 pl-2 pr-2'
            ]
        ]);

        $class_like = $item->islike ? 'text-success' : 'text-muted';
        $class_dislike = $item->isdislike ? 'text-success' : 'text-muted';


        if (count($item->items) < 1) {

            $children = '<div class="border-left bordered-secondary">';
            $children .= message($item->items, $product_id, $role, $market_id);
            $children .= '</div>';
        } else {
            $children = '<div class="border-left childdd bordered-secondary">';
            $children .= message($item->items, $product_id, $role, $market_id);
            $children .= '</div>';
        }

        $virutes = '<b class="font-weight-bolder d-block">' . Az::l('Достоинства ') . '</b>';
        $drawbacks = '<b class="font-weight-bolder d-block">' . Az::l('Недостатки  ') . '</b>';
        $time_ago = Carbon::parse($item->created_at)->diffForHumans();
        $image = '';


        if (!empty($item->photo))
            $image = '<img class="rounded p-1 border" width="80px" height="auto" src=" ' . $item->photo . ' "/>';
        if ($item->virtues === '')
            $virutes = '';
        if ($item->drawbacks === '')
            $drawbacks = '';

        $result_part .= strtr($review, [
            '{user_name}' => $item->user_name,
            '{user_image}' => $item->user_image,
            '{children}' => $children,
            '{like_count}' => $item->like,
            '{class_like}' => $class_like,
            '{class_dislike}' => $class_dislike,
            '{dislike_count}' => $item->dislike,
            '{text}' => '<b class="font-weight-bolder">' . Az::l('Коммент') . '</b>' . $item->text,
            '{rating}' => $rating,
            //     '{created_at}' => $item->created_at,
            '{created_at}' => '',
            '{button}' => $button,
            '{item_id}' => $item->id,
            '{virtues}' => $virutes . '<span class="pl-3"></span>' . $item->virtues,
            '{drawbacks}' => $drawbacks . '<span class="pl-3"></span>' . $item->drawbacks,
            '{comment_image}' => $image,
            '{time_ago}' => $time_ago,

        ]);

    }

    return $result_part;
}


$product_id = $this->httpGet('id');
$items = Az::$app->market->review->getReviewByProductId($product_id);
//vdd($items);

if (!empty($items))
    $result = message($items, $product_id, $role, $market_id);

else
    $result = '<center><h5>' . Az::l('Для данного продукта еще нету отзывов, но вы можете быть первыми!') . '</h5></center>';


echo $result;

?>
<!--

I have remove the like and dislike js code
cuz it doesn't work properly

-->

