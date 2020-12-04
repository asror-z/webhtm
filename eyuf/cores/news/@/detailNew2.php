<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://www.facebook.com/asror.zakirov
 * https://github.com/asror-z
 *
 */


use phpDocumentor\Reflection\Types\This;
use yii\data\ActiveDataProvider;
use zetsoft\models\ALL\CoreNews;
use zetsoft\widgets\former\ZFormBuilderWidget;
use zetsoft\widgets\navigat\ZNewsCardWidget;
use zetsoft\system\control;
use zetsoft\widgets\navigat\ZNewsCardWidget4;
use zetsoft\widgets\navigat\ZNewsCardWidget5;

$id = $this->httpGet('id');

?>
<div class="row">
    <div class="col-8">
        <div class="row">
            <?php

            $text = CoreNews::find()
                ->where([
                    'id' => $id
                ])
                ->all();

                //vdd($text);
            /** @var ActiveDataProvider $provider */

            foreach ($text as $t) {

                ?>

                <div class="justify-content-center container">
                    <?php
                    echo ZNewsCardWidget4::widget([
                        'config' => [
                            'type' => ZNewsCardWidget4::type['one'],
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
    <div class="col-4">
        <div class="row">



            <?php

            $text = CoreNews::find()
                ->where([
                    'id' => $id
                ])
                ->all();

                //vdd($text);
            /** @var ActiveDataProvider $provider */

            foreach ($text as $t) {

                ?>

                <div class="justify-content-center container">
                    <?php
                    echo ZNewsCardWidget5::widget([
                        'config' => [
                            'type' => ZNewsCardWidget5::type['one'],
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
</div>
