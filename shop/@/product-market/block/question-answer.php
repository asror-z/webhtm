<?php

use Carbon\Carbon;
use zetsoft\dbitem\shop\ProductItem;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\inputes\ZHorizontalTouchSpinWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\navigat\ZReadMoreWidget;
use zetsoft\widgets\navigat\ZReadMoreWidget;


/** @var ZView $this */
$product_id = $this->myId();

//$model = Az::$app->market->question->getQuestionsByProductId($product_id);
if (!isset($shopOrderItem)) {
    $item = new \zetsoft\dbitem\chat\QuestionItem();
    $item->id = 12;
    $item->product_id = '45';
    $item->user_name = 'user name';
    $item->user_image = 'https://pluspng.com/img-png/user-png-icon-male-user-icon-512.png';
    $item->text = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium aliquam corporis fuga, hic laboriosam modi nihil non, nulla odit quas sit tenetur totam voluptatem voluptatibus, voluptatum. Aut id sunt velit.';
    $item->votes = '';
    $item->brand = '';
    $item->type = 'sal';
    $item->like = 12;
    $item->islike = 12;
    $item->isdislike = 34;
    $item->questionUrl;
    $item->dislike = 234;
    $item->created_at;
    $item->items = [];
    $item->votes = 2;
    $model[] = $item;
}


//vdd($model);

$role = $this->userRole();
$actionLock  = false;
if ($role === 'user')
    $actionLock  = true;

//Az::$app->market->question->actionVote(1);
?>
<script src="https://cdn.jsdelivr.net/npm/jquery.shorten@1.0.0/src/jquery.shorten.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-load-more@1.3.0/jquery.simpleLoadMore.min.js"></script>
<div class="ui ml-2 mr-2 input focus">


    <?php foreach ($model

    as $quations){ ?>


    <div class="mt-2">
        <div class="row">
            <div class="border-right ml-1 border-success col-1 align-self-start p-0 d-flex flex-column justify-content-center align-items-center"
            ">
            <?= ZHorizontalTouchSpinWidget::widget([
                'config' => [
                    'id' => $quations->id,
                    'amount' => $quations->votes,
                    'locked' => false,
                ],
            ]); ?>
        </div>
        <div class="col-10">
            <div class="row">
                <div class="col-lg-1 col-sm-2 col-xl-1 fw-700">
                    Question:
                </div>
                <div class="col-lg-11 col-sm-10 col-xl-10">
                    <!-- <p class="searchable fw-700 text-justify font-weight-bold text-dark">-->

                    <?= $quations->text ?>
                    <!-- </p>-->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-1 col-sm-2 col-xl-1 fw-700 ">
                    Answers:
                </div>
                <div class="col-lg-11 col-sm-10 col-xl-10 answers showmore" id="<?= $quations->id ?>">
                    <?php
                    if (!empty($quations->items))
                        foreach ($quations->items as $answers) { ?>
                            <div class="showMoreContent parent searchable mb-0 text-justify">

                                <?= $answers->text ?><span class="writeby  float-right text-muted">
                           <?= Carbon::parse($answers->created_at)->diffForHumans(); ?>
                           </span>
                                <div class="ml-4 pl-3 commentsParent border-left">
                                    <?php
                                    if (!empty($answers->items))
                                        echo '<span class="text-success">Comments:</span>';
                                    foreach ($answers->items as $comment) { ?>
                                        <p class="parent searchable mb-0 text-justify d-flex">
                                        <div class="commentItem">
                                            <?= $comment->text ?>
                                            <span class="writeby float-right text-muted">
                                          <?= Carbon::parse($answers->created_at)->diffForHumans(); ?>
                                          </span>

                                        </div>

                                        </p>

                                    <?php } ?>

                                    <div>
                                        <?php
                                        echo ZButtonWidget::widget([

                                            'config' => [
                                                //  'btnRounded' => false,
                                                'text' => Az::l('Комментировать'),
                                                'url' => Zurl::to(['/shop/user/product/review-reply.aspx', 'id' => $answers->id, 'type' => $answers->type]),
                                                'btnStyle' => 'btn-outline-success',
                                                'btnSize' => 'btn-sm',
                                                'class' => 'small p-0 pl-2 pr-2'
                                            ]
                                        ]);
                                        ?>
                                    </div>
                                </div>
                            </div>

                        <?php } ?>
                    <div>
                        <?php
                        echo ZButtonWidget::widget([

                            'config' => [
                                //  'btnRounded' => false,
                                'text' => Az::l('Ответить'),
                                'url' => Zurl::to(['/shop/user/product/review-reply', 'id' => $quations->id, 'type' => $quations->type]),
                                'btnStyle' => 'btn-outline-dark',
                                'btnSize' => 'btn-md',
                                'class' => 'small p-0 pl-2 pr-2'
                            ]
                        ]);
                        ?>
                    </div>
                </div>
                <?= ZReadMoreWidget::widget([
                    'id' => $quations->id,
                    'config' => [

                        'parentclass' => 'showmore',
                        'itemInSummary' => 1,
                        'itemClass' => 'showMoreContent',
                        'more' => 'Посмотреть больше ответов',
                        'les' => 'Посмотреть меньше ответов',
                    ]
                ]); ?>

                <?= ZReadMoreWidget::widget([
                    'id' => $quations->id,
                    'config' => [

                        'parentclass' => 'commentsParent',
                        'itemInSummary' => 1,
                        'itemClass' => 'commentItem',
                        'more' => Az::l('Показать больше комментариев'),
                        'les' => Az::l('Показать меньше комментариев'),
                    ]
                ]); ?>
            </div>
        </div>
    </div>
</div>

    <script>
        /*    $('.showMoreContent').shorten({
                moreText: 'Читать далее',
                lessText: 'Меньше',
                showChars: 200,
            });*/
    </script>
    <style>
        .showmore {
            line-height: 18px;
        }
    </style>
<?php } ?>
