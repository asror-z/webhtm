<?php

use Carbon\Carbon;
use zetsoft\dbitem\chat\QuestionItem;
use zetsoft\dbitem\chat\ReviewItem;
use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\inputes\ZHorizontalTouchSpinWidget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\navigat\ZReadMoreWidget;


$market_id = $this->httpGet('id');
$model = Az::$app->market->question->getQuestionsByCompanyId
($market_id);
if(empty($model))
    echo Az::l('Для данного магазина еще не задали вопрос, но вы можете быть первыми!');

if (!isset($model) ) {
    $item = new \zetsoft\dbitem\chat\QuestionItem();
    $item->id = 1;
    $item->company_id = '45';
    $item->user_name = 'user name';
    $item->user_image = 'https://pluspng.com/img-png/user-png-icon-male-user-icon-512.png';
    $item->text = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium aliquam corporis fuga, hic laboriosam modi nihil non, nulla odit quas sit tenetur totam voluptatem voluptatibus, voluptatum. Aut id sunt velit.';
    $item->votes = '';
    $item->brand = '';
    $item->type = 'answers';
    $item->like = 12;
    $item->islike = 12;
    $item->isdislike = 34;
    $item->questionUrl;
    $item->dislike = 234;
    $item->created_at;
    $item->items = [];
    $item->votes = 2;
    $model[] = $item;
    $model[] = $item;
}

$role = $this->userRole();
$actionLock  = false;
if ($role === 'user')
    $actionLock  = true;

?>

<script src="https://cdn.jsdelivr.net/npm/jquery.shorten@1.0.0/src/jquery.shorten.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-load-more@1.3.0/jquery.simpleLoadMore.min.js"></script>
<div class="ui ml-2 mr-2 input focus">


    <?php foreach ($model as $quations) {?>


        <div class="mt-2">
            <div class="row">
                <div class="border-right ml-1 border-success col-1 align-self-start p-0 d-flex flex-column justify-content-center align-items-center">
                    <?= ZHorizontalTouchSpinWidget::widget([
                    'config' => [
                        'id' => $quations->id,
                        'amount' => $quations->votes,
                        'locked' => $actionLock ,
                    ],
                ]); ?>
                </div>
                <div class="col-10">
                    <div class="row">
                        <div class="col-lg-1 col-sm-2 col-xl-1 fw-700">
                            Question:
                        </div>
                        <div class="col-lg-11 col-sm-10 col-xl-10">
                            <p class="searchable  text-justify text-dark">

                                <?= $quations->text ?>
                            </p>
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

                                        <?= $answers->text ?> <br> <span class="writeby  float-right text-muted">
                               <?= Carbon::parse($answers->created_at)->diffForHumans(); ?>
                               </span>

                                        <br/>
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
                                        </div>
                                    </div>

                                <?php } ?>
                            <div>
                                <?php
                                    if($actionLock)
                                        $url = Zurl::to(['/core/user/user-auth/login-register']);
                                    else
                                        $url = Zurl::to(['/shop/user/item-question/review-reply', 'id' => $quations->id, 'type' => $quations->type,'market_id' => $market_id]);
                                echo ZButtonWidget::widget([

                                    'config' => [
                                        'btnRounded' => false,
                                        'text' => Az::l('Ответить'),
                                        'url' =>  $url,
                                        'btnSize' => 'btn-sm',
                                        'class' => 'small p-1 pl-2 pr-2'
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

        <style>
            .showmore {
                line-height: 18px;
            }
        </style>
    <?php } ?>
</div>
