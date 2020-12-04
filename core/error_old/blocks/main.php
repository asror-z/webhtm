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
            ?>
            <!-- <a href="#" id="copy-stacktrace" title="Copy the stacktrace for use in a bug report or pastebin">
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAZCAYAAAArK+5dAAAABGdBTUEAALGPC/xhBQAAAAZiS0dEAP8A/wD/oL2nkwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAR1JREFUSMftlTFKxEAYhb8n2c7CarGR9RAWHkFsvMIqCy4iVpZ6AS9gIXqDbbdYLEUstLPwBt5AXQw+mxTDkkyymWwh+CAQMsP/zZt/XkbAEbAPiOVlYGr7rmqCgCcgo71y27tVg9lC8Wvbt3UVJV0CB0ENYoBQG5K2Gqx6vak9Ac8kyvZO1dgaK1YnAEnDpj2I6azk2wXQB04l9WzftAbYfixZ+Wfx+gocS2IR0lUPToCXAjLqHGD7o9jCB2AcQjo7RbbnwDlwH0Ky1LpFLyYluzKW9J7qYAbkwCB4wj/BYeMkx9JakY0JMPgbSf4HJAPeVgnIgBGwHXFzBWy2Btj+irmQNE91UKfvAtTmas1luy6Re8AQ6C1Z/AeY/gK6sUu5CuQ0NQAAAABJRU5ErkJggg=="
                     alt="Copy Stacktrace"/>
            </a>
            <a href="https://stackoverflow.com/search?<? /*= http_build_query(['q' => $exception->getMessage()]) */ ?>"
               title="Search error on Stackoverflow" target="_blank">
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABcAAAAZCAYAAADaILXQAAAABGdBTUEAALGPC/xhBQAAAAZiS0dEAP8A/wD/oL2nkwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAc9JREFUSMe11MuLzlEcx/GXuTQpCzQYl3EL0UxNNDRNsWAht40UC7OzkT9BsrCQkI2ysJeSknssRsl9lFyGGrkUjRqDlEth2HzU0+SZeeZ5PN86nfP7ds7n+z3v7/f8qMw6MFEVbDt6cKTYhtoKxOuxAXPxFQ8rFa/D76z7s27PuIWBSlDsxmGMz3cNjgXPWUwoV3gh7kboBJrib8SV+A+Ui+UDHmEVpmMtHuAV+rAO8/ERveUwf4Nr6Ezm6/E2vnosxQpcx2Ap4u059BJD+IRLaEUzVifJ49k7E8txrhTxfdiGjRF/ji+4HN6LsSxIDgXXTdyoLaH15qWYk4JjMxrC+WoCdUS8DTtxEb9GEx/CbZzOQ1mQIO3YmvUZ3MPK3Kb77+FxYyxoAzahK2zhZ0TP437BIxuxW6ZhP2bn0XwOgl6cSgvOwlQswkm8H860mLWGcWeBrx9P8DjzjnBux7PhAoVYmjO/w49kvAYtCdRYpCYv0iU9mBEaA/heKN6TeUuuPNymJEhLxpKCf0kXnoZ7E3bhTt0YijmQTuguuPWcBOor1sfF7Gj6txS78C9njSraSJnvTV9XRXywGpnvwbcy9SaPJt5WDeYH/2MtX8Mf2fhjE3QWPKAAAAAASUVORK5CYII="
                     alt="Search Stackoverflow"/>
            </a>
            <a href="https://www.google.com/search?<? /*= http_build_query(['q' => $exception->getMessage()]) */ ?>"
               title="Search error on Google" target="_blank">
                <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAAZCAYAAAAxFw7TAAAABGdBTUEAALGPC/xhBQAAAAZiS0dEAP8A/wD/oL2nkwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAZZJREFUOMvl1T9IlVEYBvCf37301+iPFgYtBhUYQUIQiGaEgVCDELg11l5jo2MNgTg5NYiTNN2GIKJIA0MwGlIMFQoirAjRoUiq5XxwOHz33rrq1APf8pznPO/7nu897+G/Q1ONtYPoxVkcxk58wxJe4g1+/41hK25gAKUaAecxjFcxmW44h1F0IqtTXSuuBN1MTpYjQRfu18mqCF+KSj6GMTQn4qd4iHdYx1FcxHXswxAqRVHuhbTz7zku1MjqCLqr/eWTGE/4W3jRSNtk6Eu4x42a5YbnE25iM41dRlvCva2irRRoU6xk2B8R6/ixiQQPZViNiOZwxRrFRhmf0BKRHZgtEE+E3ouxG4Nxk5cxjdMRea2K4YMC7lJiuJDhSSLqr9a0CXbgZsJNlfAVJ9AeLfRgEe9rmN0Noy3HGobyQTCHq0GYb+jH8SD8jo1wly+HO3wmCTKC2aYtmDYwidv4FW/+gNeh3F3/YPYMd/CzaMB+xCPswak6Q/ZzqGg4HEfdN+VAeFM6w5uyN5znchj703lW24o/8/BJk5VnLk0AAAAASUVORK5CYII="
                     alt="Search Google"/>
            </a>-->
            <?

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
                    <textarea id="clipboard"><?= $handler->htmlEncode($exception) ?></textarea>
                    <span id="copied">Copied!</span>
                    <!--<button class="btn btn-primary">
                        <a href="<? /*= $baseUrl */ ?>" class="text-light" id="copy-stacktrace"
                           title="Перейти на главную">
                            Перейти на главную</a>
                    </button>-->
                    <!-- Icon Credit: Font Awesome by Dave Gandy-http://fontawesome.io ; fa-clipboard, fa-stackoverflow, fa-google-->

                    <?php if ($exception instanceof \yii\base\ErrorException) : ?>
                    <!--<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEwAAABACAMAAACHi2FiAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyBpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNS1jMDE0IDc5LjE1MTQ4MSwgMjAxMy8wMy8xMy0xMjowOToxNSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6Mjk0MTdEMEI1QjhGMTFFM0I3QzE5ODkzMUQwNUQyMzYiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6Mjk0MTdEMEE1QjhGMTFFM0I3QzE5ODkzMUQwNUQyMzYiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBXaW5kb3dzIj4gPHhtcE1NOkRlcml2ZWRGcm9tIHN0UmVmOmluc3RhbmNlSUQ9InhtcC5paWQ6NThCMjFBODBDNTUwMTFFMkE0QzFFREYxQTMyMDUzRTEiIHN0UmVmOmRvY3VtZW50SUQ9InhtcC5kaWQ6NThCMjFBODFDNTUwMTFFMkE0QzFFREYxQTMyMDUzRTEiLz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+IDw/eHBhY2tldCBlbmQ9InIiPz6hNq0vAAACylBMVEXz8/Plc3P////m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"
                         class="erroricon" alt="Error"/>-->

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
