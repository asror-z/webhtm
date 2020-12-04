<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;



/** @var ZView $this */

/**
 *
 * Action Params
 */

$action = new WebItem();
$action->title = Azl . Az::l('create');
$action->icon = 'fal fa-calendar-edit';
$action->type = WebItem::type['html'];
$action->csrf = 1;
$action->cache = false;
$action->toolbar = false;
$action->debug = false;
$action->call = null;
$action->loader = false;
$action->cacheHttp = false;

/**@var ZView $this */


$this->paramSet(paramAction, $action);

/**
 *
 * Start Page
 */


$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>

    <?php

   require Root . '/webhtm/block/metas/main.php';
   require Root . '/webhtm/block/assets/main.php';

    $this->head();
    $this->fileCss('/render/grapeAssets/slider/HorizontalSlider/styleHorizontalSlider.css');
    

    
    $this->fileJs('/render/grapeAssets/slider/HorizontalSlider/jsHorizontalSlider.js');




    ?>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

echo ZNProgressWidget::widget([]);

?>


<div class="hs__container">
    <div class="hs__wrapper">
        <div class="hs__header">
            <h2 class="hs__headline">Headline 1
            </h2>
            <div class="hs__arrows"><a class="arrow disabled arrow-prev"></a><a class="arrow arrow-next"></a></div>
        </div>
        <ul class="hs p-0 m-0">
            <li class="hs__item">
                <div class="hs__item__image__wrapper">
                    <!--img.hs__item__image(src="https://source.unsplash.com/random/300×300/?album&sig"+[n]+[i], alt="")--><img class="hs__item__image" src="https://picsum.photos/id/112/300/300" alt=""/>
                </div>
                <div class="hs__item__description"><span class="hs__item__title">Amazing title 1</span><span class="hs__item__subtitle">some subtitle</span></div>
            </li>
            <li class="hs__item">
                <div class="hs__item__image__wrapper">
                    <!--img.hs__item__image(src="https://source.unsplash.com/random/300×300/?album&sig"+[n]+[i], alt="")--><img class="hs__item__image" src="https://picsum.photos/id/122/300/300" alt=""/>
                </div>
                <div class="hs__item__description"><span class="hs__item__title">Amazing title 2</span><span class="hs__item__subtitle">some subtitle</span></div>
            </li>
            <li class="hs__item">
                <div class="hs__item__image__wrapper">
                    <!--img.hs__item__image(src="https://source.unsplash.com/random/300×300/?album&sig"+[n]+[i], alt="")--><img class="hs__item__image" src="https://picsum.photos/id/132/300/300" alt=""/>
                </div>
                <div class="hs__item__description"><span class="hs__item__title">Amazing title 3</span><span class="hs__item__subtitle">some subtitle</span></div>
            </li>
            <li class="hs__item">
                <div class="hs__item__image__wrapper">
                    <!--img.hs__item__image(src="https://source.unsplash.com/random/300×300/?album&sig"+[n]+[i], alt="")--><img class="hs__item__image" src="https://picsum.photos/id/142/300/300" alt=""/>
                </div>
                <div class="hs__item__description"><span class="hs__item__title">Amazing title 4</span><span class="hs__item__subtitle">some subtitle</span></div>
            </li>
            <li class="hs__item">
                <div class="hs__item__image__wrapper">
                    <!--img.hs__item__image(src="https://source.unsplash.com/random/300×300/?album&sig"+[n]+[i], alt="")--><img class="hs__item__image" src="https://picsum.photos/id/152/300/300" alt=""/>
                </div>
                <div class="hs__item__description"><span class="hs__item__title">Amazing title 5</span><span class="hs__item__subtitle">some subtitle</span></div>
            </li>
            <li class="hs__item">
                <div class="hs__item__image__wrapper">
                    <!--img.hs__item__image(src="https://source.unsplash.com/random/300×300/?album&sig"+[n]+[i], alt="")--><img class="hs__item__image" src="https://picsum.photos/id/162/300/300" alt=""/>
                </div>
                <div class="hs__item__description"><span class="hs__item__title">Amazing title 6</span><span class="hs__item__subtitle">some subtitle</span></div>
            </li>
            <li class="hs__item">
                <div class="hs__item__image__wrapper">
                    <!--img.hs__item__image(src="https://source.unsplash.com/random/300×300/?album&sig"+[n]+[i], alt="")--><img class="hs__item__image" src="https://picsum.photos/id/172/300/300" alt=""/>
                </div>
                <div class="hs__item__description"><span class="hs__item__title">Amazing title 7</span><span class="hs__item__subtitle">some subtitle</span></div>
            </li>
            <li class="hs__item">
                <div class="hs__item__image__wrapper">
                    <!--img.hs__item__image(src="https://source.unsplash.com/random/300×300/?album&sig"+[n]+[i], alt="")--><img class="hs__item__image" src="https://picsum.photos/id/182/300/300" alt=""/>
                </div>
                <div class="hs__item__description"><span class="hs__item__title">Amazing title 8</span><span class="hs__item__subtitle">some subtitle</span></div>
            </li>
            <li class="hs__item">
                <div class="hs__item__image__wrapper">
                    <!--img.hs__item__image(src="https://source.unsplash.com/random/300×300/?album&sig"+[n]+[i], alt="")--><img class="hs__item__image" src="https://picsum.photos/id/192/300/300" alt=""/>
                </div>
                <div class="hs__item__description"><span class="hs__item__title">Amazing title 9</span><span class="hs__item__subtitle">some subtitle</span></div>
            </li>
            <li class="hs__item">
                <div class="hs__item__image__wrapper">
                    <!--img.hs__item__image(src="https://source.unsplash.com/random/300×300/?album&sig"+[n]+[i], alt="")--><img class="hs__item__image" src="https://picsum.photos/id/1102/300/300" alt=""/>
                </div>
                <div class="hs__item__description"><span class="hs__item__title">Amazing title 10</span><span class="hs__item__subtitle">some subtitle</span></div>
            </li>
            <li class="hs__item">
                <div class="hs__item__image__wrapper">
                    <!--img.hs__item__image(src="https://source.unsplash.com/random/300×300/?album&sig"+[n]+[i], alt="")--><img class="hs__item__image" src="https://picsum.photos/id/1112/300/300" alt=""/>
                </div>
                <div class="hs__item__description"><span class="hs__item__title">Amazing title 11</span><span class="hs__item__subtitle">some subtitle</span></div>
            </li>
            <li class="hs__item">
                <div class="hs__item__image__wrapper">
                    <!--img.hs__item__image(src="https://source.unsplash.com/random/300×300/?album&sig"+[n]+[i], alt="")--><img class="hs__item__image" src="https://picsum.photos/id/1122/300/300" alt=""/>
                </div>
                <div class="hs__item__description"><span class="hs__item__title">Amazing title 12</span><span class="hs__item__subtitle">some subtitle</span></div>
            </li>
            <li class="hs__item">
                <div class="hs__item__image__wrapper">
                    <!--img.hs__item__image(src="https://source.unsplash.com/random/300×300/?album&sig"+[n]+[i], alt="")--><img class="hs__item__image" src="https://picsum.photos/id/1132/300/300" alt=""/>
                </div>
                <div class="hs__item__description"><span class="hs__item__title">Amazing title 13</span><span class="hs__item__subtitle">some subtitle</span></div>
            </li>
            <li class="hs__item">
                <div class="hs__item__image__wrapper">
                    <!--img.hs__item__image(src="https://source.unsplash.com/random/300×300/?album&sig"+[n]+[i], alt="")--><img class="hs__item__image" src="https://picsum.photos/id/1142/300/300" alt=""/>
                </div>
                <div class="hs__item__description"><span class="hs__item__title">Amazing title 14</span><span class="hs__item__subtitle">some subtitle</span></div>
            </li>
            <li class="hs__item">
                <div class="hs__item__image__wrapper">
                    <!--img.hs__item__image(src="https://source.unsplash.com/random/300×300/?album&sig"+[n]+[i], alt="")--><img class="hs__item__image" src="https://picsum.photos/id/1152/300/300" alt=""/>
                </div>
                <div class="hs__item__description"><span class="hs__item__title">Amazing title 15</span><span class="hs__item__subtitle">some subtitle</span></div>
            </li>
            <li class="hs__item">
                <div class="hs__item__image__wrapper">
                    <!--img.hs__item__image(src="https://source.unsplash.com/random/300×300/?album&sig"+[n]+[i], alt="")--><img class="hs__item__image" src="https://picsum.photos/id/1162/300/300" alt=""/>
                </div>
                <div class="hs__item__description"><span class="hs__item__title">Amazing title 16</span><span class="hs__item__subtitle">some subtitle</span></div>
            </li>
            <li class="hs__item">
                <div class="hs__item__image__wrapper">
                    <!--img.hs__item__image(src="https://source.unsplash.com/random/300×300/?album&sig"+[n]+[i], alt="")--><img class="hs__item__image" src="https://picsum.photos/id/1172/300/300" alt=""/>
                </div>
                <div class="hs__item__description"><span class="hs__item__title">Amazing title 17</span><span class="hs__item__subtitle">some subtitle</span></div>
            </li>
            <li class="hs__item">
                <div class="hs__item__image__wrapper">
                    <!--img.hs__item__image(src="https://source.unsplash.com/random/300×300/?album&sig"+[n]+[i], alt="")--><img class="hs__item__image" src="https://picsum.photos/id/1182/300/300" alt=""/>
                </div>
                <div class="hs__item__description"><span class="hs__item__title">Amazing title 18</span><span class="hs__item__subtitle">some subtitle</span></div>
            </li>
            <li class="hs__item">
                <div class="hs__item__image__wrapper">
                    <!--img.hs__item__image(src="https://source.unsplash.com/random/300×300/?album&sig"+[n]+[i], alt="")--><img class="hs__item__image" src="https://picsum.photos/id/1192/300/300" alt=""/>
                </div>
                <div class="hs__item__description"><span class="hs__item__title">Amazing title 19</span><span class="hs__item__subtitle">some subtitle</span></div>
            </li>
            <li class="hs__item">
                <div class="hs__item__image__wrapper">
                    <!--img.hs__item__image(src="https://source.unsplash.com/random/300×300/?album&sig"+[n]+[i], alt="")--><img class="hs__item__image" src="https://picsum.photos/id/1202/300/300" alt=""/>
                </div>
                <div class="hs__item__description"><span class="hs__item__title">Amazing title 20</span><span class="hs__item__subtitle">some subtitle</span></div>
            </li>
        </ul>
    </div>
</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>



