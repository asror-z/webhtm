<?php


use zetsoft\models\news\News;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\ajaxify\ZInstantclickWidget;
use yii\data\ActiveDataProvider;
use zetsoft\widgets\navigat\ZNewsCardWidget;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\dbitem\core\WebItem;
use zetsoft\system\helpers\ZArrayHelper;


/** @var ZView $item */


$action = new WebItem();
$action->title = Azl . 'Новости';
$action->icon = 'fal fa-globe';

$action->csrf = true;
$action->debug = true;
$action->layout = true;
$action->debug = false;
$action->cache = false;
$action->call = null;
$action->cacheHttp = false;
$this->paramSet(paramAction, $action);
$this->title();
$this->toolbar();


ZCardWidget::begin([
    'config' => [
        'title' => $action->title,
        'type' => ZCardWidget::type['dynCard'],
    ]
]);
?>

<div class="row ml-1 mr-2">
    <div class="col-lg-7">
        <div class="row">
        
            <?php
            /* start|AzimjonToirov|16-10-2020 */
            $lastNews = News::find()
                ->orderBy([
                    'id' => SORT_DESC
                ])
                ->one();

            if (!empty($lastNews))
                echo ZNewsCardWidget::widget([
                    'config' => [
                        'type' => ZNewsCardWidget::type['three'],
                        'id' => $lastNews->id,
                        'title' => $lastNews->title,
                        'imgUrl' => '/uploaz/eyuf/News/image/'
                            . $lastNews->id . '/'
                            . ZArrayHelper::getValue($lastNews->image, 0),
                        'subTitle' => $lastNews->name,
                        'time' => $lastNews->created_at,
                    ]
                ]);
            ?>

        </div>
        <div class="row">
            <?php
            $centeredNews = News::find()
                ->where(['position' => 'center'])
                ->all();

            foreach ($centeredNews as $t) :

                ?>
                <div class="col-md-6">
                    <?php
                    echo ZNewsCardWidget::widget([
                        'config' => [
                            'id' => $t->id,
                            'type' => ZNewsCardWidget::type['one'],
                            'title' => $t->name,
                            'imgUrl' => '/uploaz/eyuf/News/image/'
                                . $t->id . '/'
                                . ZArrayHelper::getValue($t->image, 0),
                            'time' => $t->created_at,
                            'text' => $t->title
                        ]
                    ]);

                    ?></div>
            <? endforeach ?>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="row">
            <?php

            $recommendedNews = News::find()
                ->where(['position' => 'right'])
                ->all();

            foreach ($recommendedNews as $news) :

                ?>
                <div class="col-12">
                    <?php
                    echo ZNewsCardWidget::widget([
                        'config' => [
                            'id' => $news->id,
                            'type' => ZNewsCardWidget::type['two'],
                            'title' => $news->name,
                            'text' => $news->title,
                            'imgUrl' => '/uploaz/eyuf/News/image/'
                                . $news->id . '/'
                                . ZArrayHelper::getValue($news->image, 0),
                            'time' => $news->created_at,
                        ]
                    ]);
                    /* end|AzimjonToirov|16-10-2020 */
                    ?>

                </div>
            <? endforeach ?>
        </div>
    </div>
</div>
<? ZCardWidget::end() ?>













