<?
/* @var $this \yii\web\View */
/* @var $exception \Exception */

/* @var $handler \yii\web\ErrorHandler */

global $boot;
$userDev = $boot->enableDebug();
$query = http_build_query(['q' => 'yii2 ' . $exception->getMessage()]);

use rmrevin\yii\fontawesome\FA;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\widgets\navigat\ZButtonWidget;


?>
<div id="vantaClouds2" style="width: 100%; height: 100vh; ">
    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" display="none">
        <symbol id="new-window" viewBox="0 0 24 24">
            <g transform="scale(0.0234375 0.0234375)">
                <path d="M598 128h298v298h-86v-152l-418 418-60-60 418-418h-152v-86zM810 810v-298h86v298c0 46-40 86-86 86h-596c-48 0-86-40-86-86v-596c0-46 38-86 86-86h298v86h-298v596h596z"></path>
            </g>
        </symbol>
    </svg>

    <div class="row firstRow mb-2">
        <div class="col-md-4"></div>
        <div class="col-md-4 logoDiv d-flex justify-content-center">
            <?
            /*
             * Copy button
             * */
            echo zetsoft\widgets\navigat\ZButtonWidget::widget([
                'id' => 'copy-stacktrace',
                'config' => [
                    'hasIcon' => true,
                    'btnType' => ZButtonWidget::btnType['link'],
                    'btnRounded' => false,
                    'btnFloating' => true,
                    'icon' => 'fas fa-copy',
                    //'title' => 'Перейти на главную',
                    'color' => ZColor::gradient['blue-gradient'],
                    'url' => '#',
                    'blank' => true,
                    'target' => ZButtonWidget::target['_self'],
                    'iconColor' => '#ffffff',
                    'title' => 'Copy the stacktrace for use in a bug report or pastebin'
                ],
            ]);
            /*
             * Stack-Overflow button
             * */
            echo ZButtonWidget::widget([
                'id' => 'copy-stacktrace',
                'config' => [
                    'hasIcon' => true,
                    'btnType' => ZButtonWidget::btnType['link'],
                    'btnRounded' => false,
                    'btnFloating' => true,
                    'icon' => 'fab fa-stack-overflow',
                    //'title' => 'Перейти на главную',
                    'color' => ZColor::gradient['blue-gradient'],
                    'url' => 'https://stackoverflow.com/search?' . $query,
                    'iconColor' => '#ffffff',
                    'title' => 'Search error on Stackoverflow',
                    'blank' => true,
                    'target' => ZButtonWidget::target['_blank'],
                ],
            ]);
            /*
             * Google-search button
             * */
            echo ZButtonWidget::widget([
                'id' => 'copy-stacktrace',
                'config' => [
                    'hasIcon' => true,
                    'btnType' => ZButtonWidget::btnType['link'],
                    'btnRounded' => false,
                    'btnFloating' => true,
                    'icon' => 'fab fa-google',
                    // 'title' => 'Search error on Google',
                    'color' => ZColor::gradient['blue-gradient'],
                    'url' => "https://www.google.com/search?" . $query,
                    'blank' => true,
                    'target' => ZButtonWidget::target['_blank'],
                    'iconColor' => '#ffffff',
                    'title' => 'Search error on Google'
                ],
            ]);

            /*
             * Home button
             * */
            $baseUrl = Az::$app->utility->urlApp->getBase();
            echo ZButtonWidget::widget([
                'config' => [
                    'hasIcon' => true,
                    'btnType' => ZButtonWidget::btnType['link'],
                    'btnRounded' => false,
                    'btnFloating' => true,
                    'icon' => 'fa fa-home',
                    'title' => 'Перейти на главную',
                    'color' => ZColor::gradient['blue-gradient'],
                    'url' => $baseUrl,
                    'target' => ZButtonWidget::target['_self'],
                    'iconColor' => '#ffffff'
                ],
            ]);

            /*
             * Back button
             * */
            $previusPage = Az::$app->utility->urlApp->getBack();
            echo ZButtonWidget::widget([
                'config' => [
                    'hasIcon' => true,
                    'btnType' => ZButtonWidget::btnType['link'],
                    'btnRounded' => false,
                    'btnFloating' => true,
                    'icon' => 'fas fa-arrow-left',
                    'title' => 'Предыдущая страница',
                    'color' => ZColor::gradient['blue-gradient'],
                    'url' => $previusPage,
                    'target' => ZButtonWidget::target['_self'],
                    'iconColor' => '#ffffff'
                ],
            ]);
            ?>
        </div>
    </div>

    <!--  firstCard starts -->

    <div class="row">
        <div class="col-1"></div>
        <div class="card col-10 p-0 mb-2 firstCard">
            <div class="card-header header">
                <div class="tools">
                    <textarea id="clipboard">
                        <!--{handlerHtmlEncode}-->
                        <?= $handler->htmlEncode($exception) ?>
                    </textarea>
                    <span id="copied">Copied!</span>
                    <?php if ($exception instanceof \yii\base\ErrorException) : ?>
                </div>
                <h3 class="text-danger mt-4 text-center">
                    <span><?= $handler->htmlEncode($exception->getName()) ?></span>
                    &ndash; <?= $handler->addTypeLinks(get_class($exception)) ?>
                </h3>
                <?php else : ?>
            </div>
            <h3 class="mt-2 text-center"><?php
                if ($exception instanceof \yii\web\HttpException) {
                    echo '<span>' . $handler->createHttpStatusLink($exception->statusCode, $handler->htmlEncode($exception->getName())) . '</span>';
                    echo ' &ndash; ' . $handler->addTypeLinks(get_class($exception));
                } else {
                    $name = $handler->getExceptionName($exception);
                    if ($name !== null) {
                        echo '<span>' . $handler->htmlEncode($name) . '</span>';
                        echo ' &ndash; ' . $handler->addTypeLinks(get_class($exception));
                    } else {
                        echo '<span>' . $handler->htmlEncode(get_class($exception)) . '</span>';

                    }
                }

                ?></h3>
            <?php endif; ?>
        </div><!-- card header end -->

        <div class="card-body">
            <h2 class="text-center text-bold"><?= nl2br($handler->htmlEncode($exception->getMessage())) ?></h2>
        </div>
        <?php if ($exception instanceof \yii\db\Exception && !empty($exception->errorInfo)) : ?>
            <pre>Error Info: <?= $handler->htmlEncode(print_r($exception->errorInfo, true)) ?></pre>
        <?php endif ?>

    </div>
</div><!--  firstCard end -->

<?php
if ($userDev):
    ?>
    <!--  secondCard starts -->
    <div class="row">
        <div class="col-1"></div>
        <div class="card col-10 p-0 secondCard">
            <div class="card-body">

                <div class="call-stack">
                    <?= $handler->renderCallStack($exception) ?>
                </div>

                <div class="request">
                    <div class="code">
                        <?= $handler->renderRequest() ?>
                    </div>
                </div>

            </div>
        </div>
    </div><!--  secondCard end -->
    </div><!--  VantaJs end -->
<?php
endif;
?>
