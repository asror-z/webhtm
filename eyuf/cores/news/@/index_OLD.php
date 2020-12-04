<?php


use phpDocumentor\Reflection\Types\Null_;
use zetsoft\models\ALL\CoreNews;
use zetsoft\widgets\former\ZDynaWidget;
use kartik\dynagrid\DynaGrid;
use kartik\grid\EditableColumn;
use yii\data\ActiveDataProvider;
use zetsoft\widgets\navigat\ZNewsCardWidget;
use zetsoft\widgets\themes\ZCardWidget;
use function GuzzleHttp\Promise\all;

$action->title = Azl . 'Список Новостей';
$action->icon = 'fa fa-globe';

ZCardWidget::begin([
    'config' => [
        'title' => $this->title,
        'type' => ZCardWidget::type['dynCard'],
    ]
]);
?>
<!--<div class="container-fluid">-->
<div class="row">
    <div class="col-7">
        <div class="row">
            <?php

            $news = CoreNews::find()
                ->indexBy('id')
                ->all();
            $text = null;
            foreach ($news as $new) {
                if ($text === null)
                    $text = $new;
                else if ($new->created_at > $text->created_at) $text = $new;
            }

            /** @var ActiveDataProvider $provider */

            ?>

            <div class="col-md-12 ml-3">
                <?php
                echo ZNewsCardWidget::widget([
                    'config' => [
                        'type' => ZNewsCardWidget::type['three'],
                        'id' => $text->id,
                        'title' => $text->title,
                        'imgUrl' => '/upload/corenews/image/' . $text->id . '/' . $text->image[0],
                        'subTitle' => $text->name,
                        'text' => $text->text,
                        'time' => $text->created_at,
                    ]
                ]);
                ?>

            </div>
        </div>
        <div class="row">
            <?php

            $text = CoreNews::find()
                ->where([
                    'type' => 'center'
                ])
                ->all();
            /** @var ActiveDataProvider $provider */

            foreach ($text as $t) {

                ?>

                <div class="col-md-6">
                    <?php
                    echo ZNewsCardWidget::widget([
                        'config' => [
                            'id' => $t->id,
                            'type' => ZNewsCardWidget::type['one'],
                            'title' => $t->title,
                            'imgUrl' => '/upload/corenews/image/' . $t->id . '/' . $t->image[0],
                            'subTitle' => $t->name,
                            'text' => $t->text,
                            'time' => $t->created_at,
                        ]
                    ]);
                    ?>


                </div>
                <?


            }
            ?>
        </div>
    </div>


    <div class="col-5">
        <div class="card">
            <div class="card-header bg-dark">
                <h3 class="text-center text-light">So'nggi Yangiliklar</h3>
            </div>
            <div class="card-body text-decoration-none">
            <?php

            $text = CoreNews::find()
                ->where([
                    'type' => 'right'
                ])
                ->all();
            /** @var ActiveDataProvider $provider */

            foreach ($text as $t) {

                ?>

                
                            <!--
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header bg-dark">
                                        <h3 class="text-center text-light">{title} </h3>
                                    </div>
                                    <div class="card-body text-decoration-none">


                                    </div>
                                </div>
                            </div>

                            -->
                            <?php
                            echo ZNewsCardWidget::widget([
                                'config' => [
                                    'id' => $t->id,
                                    'type' => ZNewsCardWidget::type['five'],
                                    'title' => $t->title,
                                    'imgUrl' => '/upload/corenews/image/' . $t->id . '/' . $t->image[0],
                                    'subTitle' => $t->name,
                                    'text' => $t->text,
                                    'time' => $t->created_at,
                                ]
                            ]);
                            ?>
                            <hr>



                <?


            }
            ?>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
<?
ZCardWidget::end();

?>











