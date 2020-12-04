<?php

use Carbon\Carbon;
use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;

use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\menus\ZSidebarWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\navigat\ZReadMoreWidget;

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
      foreach ($items as $item)
      {

          $rating = ZKStarRatingWidget::widget([
              'name' => 'gggfg',
              'config' => [
                'value' => $item->rating,
                  'show' => false
              ]
          ]);

          $button = ZButtonWidget::widget([

              'config' => [
                //  'btnRounded' => false,
                  'text' => Az::l('Ответить'),
                  'url' => Zurl::to(['/shop/user/review/review-product-reply','id' => $item->id]),
                  'btnStyle'=>'btn-outline-success',
                  'btnSize'=>'btn-sm',
                  'class' => 'small p-1 pl-2 pr-2'
              ]
          ]);

          $class_like = $item->islike ? 'text-success' : 'text-muted';
          $class_dislike = $item->isdislike ? 'text-success' : 'text-muted';


          
          if(count($item->items) < 1) {

              $children = '<div class="border-left bordered-secondary">';
              $children .= message($item->items);
              $children .= '</div>';
          }else{
              $children = '<div class="border-left childdd bordered-secondary">';
              $children .= message($item->items);
              $children .= '</div>';
          }

          $virutes = '<b class="font-weight-bolder">'.Az::l('Достоинства :').'</b>';
          $drawbacks = '<b class="font-weight-bolder">'.Az::l('Недостатки : ').'</b>';
          $time_ago = Carbon::parse($item->created_at)->diffForHumans();
          $image = '';


          if($item->photo !=='')
             $image = '<img class="rounded p-1 border" width="80px" height="auto" src=" '.$item->photo.' "/>';
          if($item->virtues ==='')
            $virutes ='';
          if($item->drawbacks ==='')
            $drawbacks ='';

          $result_part .= strtr($review, [
              '{user_name}' =>  $item->user_name,
              '{user_image}' =>  $item->user_image,
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
              '{virtues}' => $virutes.$item->virtues,
              '{drawbacks}' => $drawbacks.$item->drawbacks,
              '{comment_image}' => $image,
              '{time_ago}' => $time_ago,

          ]);

      }

      

      return $result_part;
}

$productId= $this->httpGet('id');

$items = Az::$app->market->review->getReviewByProductId($productId);
$result = message($items);
vdd($items);

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

    <?php $this->beginBody(); ?>

    <?php

    echo $result;

    ?>

    <?php $this->endBody() ?>

    </body>
    </html>

<?php $this->endPage()


?>

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
            var container = [];
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

                }
            });

    }
    function add_like(id) {
        if(check) {
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
        if(check) {
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
<style>
    .commentText{line-height: 19px!important;}
</style>
