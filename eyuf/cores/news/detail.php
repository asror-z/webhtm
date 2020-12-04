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
use zetsoft\system\Az;
use zetsoft\widgets\ajaxify\ZInstantclickWidget;
use zetsoft\widgets\former\ZFormBuilderWidget;
use zetsoft\widgets\navigat\ZNewsCardWidget;
use zetsoft\widgets\navigat\ZNewsCardWidget5;
use zetsoft\widgets\navigat\ZNewsCardWidget4;
use zetsoft\system\control;
use zetsoft\widgets\themes\ZCardWidget;
use zetsoft\dbitem\core\WebItem;
use zetsoft\models\news\News;
use zetsoft\models\news\NewsType;
use zetsoft\system\helpers\ZArrayHelper;



$action = new WebItem();
$action->title = Azl . 'Новости';
$action->icon = 'fal fa-globe';

$action->csrf = true;
$action->debug = true;
$action->layout = true; $action->debug = false;
$action->cache = false;
$action->call = null;
$action->cacheHttp = false;
$this->paramSet(paramAction, $action);
$this->title();
$this->toolbar();

$id = $this->httpGet('id');


?>
<div class="row">
    <div class="col-lg-8" style=" padding-right: 10px; border: none;">
        <?php

        /* start|AzimjonToirov|16-10-2020 */
        $current = News::findOne($id);
        $newsType = NewsType::findOne($current->news_type_id)->name;

            ZCardWidget::begin([
                'config' => [
                    'hasIcon' => false,
                    'title' => $newsType,
                    'type' => ZCardWidget::type['dynCard'],
                ]
            ]);
        ?>

        <div class="justify-content-center">
            <?php
            echo ZNewsCardWidget::widget([
                'config' => [
                    'type' => ZNewsCardWidget::type['four'],
                    'subTitle' => $current->name,
                    'title' => $current->title,
                    'imgUrl' => '/uploaz/eyuf/News/image/' 
                        . $current->id . '/' 
                        . ZArrayHelper::getValue($current->image, 0),
                    'text' => $current->text,
                    'time' => $current->created_at,
                ]
            ]);
        /* end|AzimjonToirov|16-10-2020 */

            ?>
        </div>

        <?
        ZCardWidget::end();
        ?>

    </div>
    <div class="col-lg-4">
        <div class="row">
            <div class="col-md-12" style="padding-left: 0px">
                <div class="card mt-12">
                    <div class="card-header bg-success p-2 text-white">
                        <b class="pl-2 mb-1 mt-1 text-center">Сўнгги янгиликлар</b>
                    </div>
                    <div class="text-decoration-none overFlowForNews">
                        <?php

                    //start|AzimjonToirov|16-10-2020

                        $latestNews = News::find()
                            ->limit(6)
                            ->all();

                        foreach ($latestNews as $news) :

                            echo ZNewsCardWidget::widget([
                                'config' => [
                                    'id' => $news->id,
                                    'type' => ZNewsCardWidget::type['two'],
                                    'title' => $news->name,
                                    'imgUrl' => '/uploaz/eyuf/News/image/' 
                                    . $news->id . '/' 
                                    . ZArrayHelper::getValue($news->image, 0),
                                    'time' => $news->created_at,
                                ]
                            ]);

                    //end|AzimjonToirov|16-10-2020

                        ?> 
                        </hr> 
                        <? endforeach ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
