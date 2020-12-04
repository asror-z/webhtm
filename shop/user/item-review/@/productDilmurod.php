<?php
use yii\caching\TagDependency;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\dbitem\data\TabItem;
use zetsoft\former\shop\ShopProductItemForm;
use zetsoft\models\core\CoreAdvancedItem;
use zetsoft\models\faqs\Faqs;
use zetsoft\models\user\User;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\cards\ZAzCardWidget;
use zetsoft\widgets\former\ZAccardionWidget;
use zetsoft\widgets\former\ZDynaWidgetPop;
use zetsoft\widgets\former\ZFormWidget;
use zetsoft\widgets\former\ZListViewWidget;
use zetsoft\widgets\incores\ZFaqAccordionWidget;
use zetsoft\widgets\inputes\ZKStarRatingWidget;
use zetsoft\widgets\market\ZFooterAllWidget;
use zetsoft\widgets\market\ZMenuWidgetAbdulloh;
use zetsoft\widgets\market\ZMSwiperDbWidget;
use zetsoft\widgets\market\ZMSwiperWidget;
use zetsoft\widgets\menus\ZSidebarWidget;
use zetsoft\widgets\navigat\ZAAccordionWidget;
use zetsoft\widgets\navigat\ZAccLayWidget;
use zetsoft\widgets\navigat\ZAccLayWidget3;
use zetsoft\widgets\navigat\ZAccLayWidgetNew;
use zetsoft\widgets\navigat\ZAccLayWidgetTest;
use zetsoft\widgets\navigat\ZSmartTabWidget;
use zetsoft\widgets\navigat\ZLiloAccordionWidget;
use zetsoft\widgets\navigat\ZMarketDropdownWidget;
use zetsoft\widgets\navigat\ZShowMoreWidget;
use zetsoft\widgets\navigat\ZSmartTabWidget;
use zetsoft\widgets\themes\ZTabWidget;


$item = new ProductItem();

/** @var ZView $this */
$item->id = 42;
$item->product_id = 4;
$item->user_name = 'Otabek';
$item->created_at = 'on March 5th, 2014';
$item->user_image = 'https://cdn4.iconfinder.com/data/icons/small-n-flat/24/user-alt-512.png';
$item->rating = 3.5;
$item->text = 'I was very pleased with the quality of the product as I received it. But after about one week of charging it became intermittent for a couple of days and stopped working';
$item->like = 0;
$item->islike = false;
$item->dislike = 0;
$item->isdislike = false;
$item->brand = '';


function message($items)
{


      $result_part = '';
      $review = <<<HTML
     <div class="detailBox w-100  m-3">
         <div class="actionBox  p-2">
            <ul style="list-style: none;" class="commentList overflow-auto p-0">
                <li class="m-0 mt-2 pb-1">
                 <div style="width:40px" class="commenterImage  float-left mr-2 h-100">
                    <img class="w-100 rounded-circle" src="{user_image}"/>
                 </div>
                 <div class="commentText d-flex justify-content-between">
                    <div class="w-75">
                        <div class="d-flex justify-content-between">
                            <p class="m-0 ">{user_name}</p>
                            <div class="d-flex">
                               {rating}
                                <p class="m-0 ml-2 font-weight-bold">lorem ipsum takoy delaw</p>
                            </div>
                        </div>
                        {text}
                        <div class="d-flex button-links align-items-center">
                            <button class="rounded btn-outline-success reply-btn bg-white mr-3">
                                <i class="fas fa-reply mr-1 text-success"></i> <span><?= Az::l('reply') ?></span>
                            </button>
                            <a href="#" onclick="add_like({id})">
                                <i id="like-element-{id}" class="fas fa-thumbs-up mr-1 {classLike} "></i>
                                <span class="text-muted" id="text-like-{id}">{like_count}</span>
                            </a>
                            <a onclick="dis_like({id})" class="dislike ml-4">
                                <i id="dislike-element-{id}" class="fas fa-thumbs-down mr-1 {classDislike}"></i>
                                <span class="text-muted" id="text-dislike-{id}">{dislike_count}</span>
                            </a>
                        </div>
                        <div class="hidden-reply-box d-none">
                            <div class="d-flex">
                                <div class="comment-text-input w-75">
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
                        <div class="reply-comment border-left pl-2 mt-1">
                            <ul class="list-group">
                                <li class="list-group-item border-0">
                                    <div class="reply-comment-box-header d-flex align-items-center">
                                        <div class="reply-comment-box-image">
                                            <img class="rounded-circle" src="http://placekitten.com/50/50"/>
                                        </div>
                                        <div class="reply-comment-box-title ml-1 d-flex flex-column">
                                            <span>Shoxruh</span>
                                            <span class="fe-08 font-weight-light">on March 5th, 2014</span>
                                        </div>
                                    </div>
                                   {text}
                                    <div class="d-flex button-links align-items-center">
                                        <button class="rounded btn-outline-primary reply-btn bg-white mr-3">
                                            <i class="fas fa-reply mr-1"></i> <span>reply</span>
                                        </button>
                                        <a href="#" class="like">
                                            <i class="fas fa-thumbs-up mr-1"></i>
                                            <span>15</span>
                                        </a>
                                        <a href="#" class="dislike ml-4">
                                            <i class="fas fa-thumbs-down mr-1"></i>
                                            <span>10</span>
                                        </a>
                                    </div>
                                    <div class="hidden-reply-box d-none">
                                        <div class="d-flex">
                                            <div class="comment-text-input w-75">
                                                <input class="form-control w-100 rounded-pill reply-comment-text-input"
                                                       type="text" placeholder="Your comments"/>
                                            </div>
                                            <div class="w-25 add-btn">
                                                <button class="border-0 rounded-pill btn-success w-100 py-2 ml-1 add-comment-btn">
                                                    Add
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </li>

                            </ul>

                        </div>
                    </div>
                    <span class="date text-dark fe-10 float-right">{created_at}</span>

                </div>
            </li>
        </ul>
    </div>
    </div>
HTML;
      foreach ($items as $item)
      {
                $rating = ZKStarRatingWidget::widget([
                    'name' => 'gggfg',
                    'config' => [
                        'show' => false
                    ]
                ]);
                $text = ZShowMoreWidget::widget([
                    'config' => [
                        'comment' => $item->text,
                    ]
                ]);
          $class_like = $item->islike ? 'text-success' : 'text-muted';
          $class_dislike = $item->isdislike ? 'text-success' : 'text-muted';
          $children = '';
          //vdd($item->items);
          if (empty($items->item))
             $children = message($item->items);

          $result_part .= strtr($review, [
                  '{id}' => $item->id,
              '{user_name}' =>  $item->user_name,
              '{user_image}' =>  $item->user_image,
              '{children}' => $children,
              '{like_count}' => $item->like,
              '{dislike_count}' => $item->dislike,
              '{text}' => $text,
              '{rating}' => $rating,
              '{created_at}' => $item->created_at,
              '{classLike}' => $class_like,
              '{classDislike}' => $class_dislike,
          ]);

      }
      return $result_part;
}


$items = Az::$app->market->review->getReviewByProductId('19');
$result = message($items);


// vdd($content);
?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>

        <?php

        require Root . '/webhtm/block/metas/main.php';
        require Root . '/webhtm/block/assets/main.php';

        //echo ZSidebarWidget::widget([]);

        $this->head();

        ?>

    </head>
    <body class="<?= ZWidget::skin['white-skin'] ?>">

    <?php $this->beginBody(); ?>

    <?php

    echo $result;

    ?>


    <?php $this->endBody() ?>

    </body>
    </html>
    <script>
        $(document).ready(function () {
            $('.reply-btn').on("click", function () {
                var parent = $(this).parent('.button-links');
                var form = parent.next('.hidden-reply-box');
                parent.removeClass('d-flex');
                parent.addClass('d-none');
                form.removeClass('d-none');
            })
            $(document).mouseup(function (event) {
                var container = new Array();
                container.push($('.hidden-reply-box'));

                $.each(container, function (key, value) {
                    if (!$(value).is(e.target) // if the target of the click isn't the container...
                        && $(value).has(e.target).length === 0) // ... nor a descendant of the container
                    {
                        $(value).addClass('d-none');
                        var parent = $(this).prev('.button-links');
                        parent.addClass('d-flex');
                        parent.removeClass('d-none');

                    }
                });
            });
            $('.add-comment-btn').one("click", function () {
                var replyParent = $(this).parent('.add-btn');
                var replyTextParent = replyParent.prev('.comment-text-input');
                var replyTextChild = replyTextParent.children('.reply-comment-text-input').val();
                console.log(replyTextChild);
                var hiddenBox = replyParent.parents('.hidden-reply-box:first');
                var replyComment = hiddenBox.next('.reply-comment');
                var replyCommentList = replyComment.children('.list-group');
                //replyCommentList.("<li class='list-group-item text-success border-0'>" + replyTextChild + "</li>")
                replyCommentList.append("<li class='list-group-item border-0'>" +
                    "<div class='reply-comment-box-header d-flex align-items-center'>" +
                    "<div class='reply-comment-box-image'>" +
                    "<img class='rounded-circle' src='http://placekitten.com/50/50' />" +
                    "</div>" +
                    "<div class='reply-comment-box-title ml-1 d-flex flex-column'>" +
                    "<span>Shoxruh</span>" +
                    "<span class='fe-08 font-weight-light'>on March 5th, 2014</span>" +
                    "</div></div>" +
                    "<p class='reply-comment-box-text'>" + replyTextChild + "</p></li>");
            })
        })


        function dislike_data(id) {
            $.ajax({
                method: 'GET',
                url: '/core/product/dislike.aspx',
                data: {
                    id
                },
                success: function (data) {

                    $('#text-dislike-' + id).html(data);

                }
            })
        }

        function like_data(id) {
            $.ajax({
                method: 'GET',
                url: '/core/product/like.aspx',
                data: {
                    id
                },
                success: function (data) {

                    $('#text-like-' + id).html(data);

                }
            })

        }
        function add_like(id) {

            if (($('#like-element-' + id).hasClass('text-muted'))&&
                ($('#dislike-element-' + id).hasClass('text-muted'))) {

                like_data(id);

                $('#like-element-' + id).removeClass('text-muted');
                $('#like-element-' + id).addClass('text-success');

            } else if (($('#like-element-' + id).hasClass('text-muted'))&&($('#dislike-element-' + id).hasClass('text-success'))){

                dislike_data(id);
                like_data(id);


                $('#like-element-' + id).removeClass('text-muted');
                $('#like-element-' + id).addClass('text-success');
                $('#dislike-element-' + id).removeClass('text-success');
                $('#dislike-element-' + id).addClass('text-muted');
            }
            else if (($('#like-element-' + id).hasClass('text-success'))&&($('#dislike-element-' + id).hasClass('text-muted'))){

                like_data(id);

                $('#like-element-' + id).removeClass('text-success');
                $('#like-element-' + id).addClass('text-muted');
            }
        }


        function dis_like(id) {

            if (($('#like-element-' + id).hasClass('text-muted'))&&
                ($('#dislike-element-' + id).hasClass('text-muted'))) {

                dislike_data(id);

                $('#dislike-element-' + id).removeClass('text-muted');
                $('#dislike-element-' + id).addClass('text-success');

            } else if (($('#dislike-element-' + id).hasClass('text-muted'))&&($('#like-element-' + id).hasClass('text-success'))){

                dislike_data(id);
                like_data(id);

                $('#dislike-element-' + id).removeClass('text-muted');
                $('#dislike-element-' + id).addClass('text-success');
                $('#like-element-' + id).removeClass('text-success');
                $('#like-element-' + id).addClass('text-muted');
            }
            else if (($('#dislike-element-' + id).hasClass('text-success'))&&($('#like-element-' + id).hasClass('text-muted'))){

                dislike_data(id);

                $('#dislike-element-' + id).removeClass('text-success');
                $('#dislike-element-' + id).addClass('text-muted');
            }
        }





    </script>
<?php $this->endPage()


?>


<?php

/*
 *     <?php

                         //reply($item);



                         foreach ($item->items as $itemReply){ ?>

                        <!-- second div-->
                        <div class="reply-comment border-left pl-2 mt-1">
                            <ul class="list-group">
                                <li class="list-group-item border-0">
                                    <div class="reply-comment-box-header d-flex align-items-center">
                                        <div class="reply-comment-box-image">
                                            <img class="rounded-circle" src="http://placekitten.com/50/50"/>
                                        </div>
                                        <div class="reply-comment-box-title ml-1 d-flex flex-column">
                                            <span>Shoxruh</span>
                                            <span class="fe-08 font-weight-light">on March 5th, 2014</span>
                                        </div>
                                    </div>
                                    <?
                                    echo ZShowMoreWidget::widget([
                                        'config' => [
                                            'comment' => $item->text,
                                        ]
                                    ])
                                    ?>
                                    <div class="d-flex button-links align-items-center">
                                        <span><?= $itemReply->text ?></span>
                                        <button class="rounded btn-outline-primary reply-btn bg-white mr-3">
                                            <i class="fas fa-reply mr-1"></i> <span>reply</span>
                                        </button>
                                        <a href="#" class="like">
                                            <i class="fas fa-thumbs-up mr-1"></i>
                                            <span>15</span>
                                        </a>
                                        <a href="#" class="dislike ml-4">
                                            <i class="fas fa-thumbs-down mr-1"></i>
                                            <span>10</span>
                                        </a>
                                    </div>
                                    <div class="hidden-reply-box d-block">
                                        <div class="d-flex">
                                            <div class="comment-text-input w-75">
                                                <input class="form-control w-100 rounded-pill reply-comment-text-input"
                                                       type="text" placeholder="Your comments"/>
                                            </div>
                                            <div class="w-25 add-btn">
                                                <button class="border-0 rounded-pill btn-success w-100 py-2 ml-1 add-comment-btn">
                                                    Add
                                                </button>
                                            </div>


                                        </div>
                                    </div>

                                </li>

                            </ul>

                        </div>
                        <!--end second -->

                         <?php } ?>
 */
