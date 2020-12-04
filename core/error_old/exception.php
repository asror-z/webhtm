<?php
/* @var $this \yii\web\View */
/* @var $exception \Exception */

/* @var $handler \yii\web\ErrorHandler */

use PhpOffice\PhpSpreadsheet\Shared\OLE\PPS\Root;
use yii\helpers\ArrayHelper;
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView; ?>
<?php if (method_exists($this, 'beginPage')) : ?>
    <?php $this->beginPage() ?>
<?php endif ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8"/>

    <title>
        <?php

        $name = $handler->getExceptionName($exception);
        if ($exception instanceof \yii\web\HttpException) {
            echo (int)$exception->statusCode . ' ' . $handler->htmlEncode($name);
        } else {
            if ($name !== null) {
                echo $handler->htmlEncode($name . ' – ' . get_class($exception));
            } else {
                echo $handler->htmlEncode(get_class($exception));
            }
        }
        ?>
    </title>

    <!-- styles -->
    <?
    require Root . '/webhtm/core/error/blocks/style.php';
    ?>
    <style>
        .call-stack ul li .code .lines-item {
            position: absolute;
            z-index: 200;
            display: block;
            width: 40px;
            text-align: right;
            color: #aaa;
            line-height: 21px;
            font-size: 12px;
            font-family: Consolas, monospace;
        }

        .call-stack ul li .code pre {
            position: relative;
            z-index: 200;
            left: 50px;
            line-height: 20px;
            font-size: 12px;
            font-family: Consolas, monospace;
            display: inline;
        }

        /*this css written for exception.php*/
        .secondCard {
            border-top: 5px solid #2980b9;
            opacity: .9;
            min-height: 45vh;
            max-height: 65vh;
            overflow-y: auto;
        }
    </style>
</head>



<body>

<!-- main -->
<?
require Root . '/webhtm/core/error/blocks/main.php'
?>

<!-- vanta js scripts -->
<?
require Root . '/webhtm/core/error/blocks/script.php';
?>

<script>
    window.onload = function () {
        var codeBlocks = document.getElementsByTagName('pre'),
            callStackItems = document.getElementsByClassName('call-stack-item');

        // highlight code blocks
        for (var i = 0, imax = codeBlocks.length; i < imax; ++i) {
            hljs.highlightBlock(codeBlocks[i], '    ');
        }

        var refreshCallStackItemCode = function (callStackItem) {
            if (!callStackItem.getElementsByTagName('pre')[0]) {
                return null;
            }
            var top = callStackItem.getElementsByClassName('code-wrap')[0].offsetTop - window.pageYOffset + 3,
                lines = callStackItem.getElementsByTagName('pre')[0].getClientRects(),
                lineNumbers = callStackItem.getElementsByClassName('lines-item'),
                errorLine = callStackItem.getElementsByClassName('error-line')[0],
                hoverLines = callStackItem.getElementsByClassName('hover-line');
            for (var i = 0, imax = lines.length; i < imax; ++i) {
                if (!lineNumbers[i]) {
                    continue;
                }
                lineNumbers[i].style.top = parseInt(lines[i].top - top - 252) + 'px';
                hoverLines[i].style.top = parseInt(lines[i].top - top - 285) + 'px';
                hoverLines[i].style.height = parseInt(lines[i].bottom - lines[i].top + 6) + 'px';
                if (parseInt(callStackItem.getAttribute('data-line')) == i) {
                    errorLine.style.top = parseInt(lines[i].top - top - 252) + 'px';
                    errorLine.style.height = parseInt(lines[i].bottom - lines[i].top + 6) + 'px';
                }
            }
        };

        for (var i = 0, imax = callStackItems.length; i < imax; ++i) {
            refreshCallStackItemCode(callStackItems[i]);

            // toggle code block visibility
            callStackItems[i].getElementsByClassName('element-wrap')[0].addEventListener('click', function (event) {
                if (event.target.nodeName.toLowerCase() === 'a') {
                    return null;
                }

                var callStackItem = this.parentNode,
                    code = callStackItem.getElementsByClassName('code-wrap')[0];

                if (typeof code !== 'undefined') {
                    code.style.display = window.getComputedStyle(code).display == 'block' ? 'none' : 'block';
                    refreshCallStackItemCode(callStackItem);
                }
            });
        }

        // handle copy stacktrace action on clipboard button
        document.getElementById('copy-stacktrace').onclick = function (e) {
            e.preventDefault();
            var textarea = document.getElementById('clipboard');
            textarea.focus();
            textarea.select();
            try {
                succeeded = document.execCommand('copy');
            } catch (err) {
                succeeded = false;
            }
            if (succeeded) {
                document.getElementById('copied').style.display = 'block';
            } else {
                // fallback: show textarea if browser does not support copying directly
                textarea.style.top = 0;
            }
        }
    };

    // Highlight lines that have text in them but still support text selection:
    document.onmousedown = function () {
        document.getElementsByTagName('body')[0].classList.add('mousedown');
    }
    document.onmouseup = function () {
        document.getElementsByTagName('body')[0].classList.remove('mousedown');
    }
</script>
<?php if (method_exists($this, 'endBody')) : ?>
    <?php $this->endBody() // to allow injecting code into body (mostly by Yii Debug Toolbar)
    ?>
<?php endif ?>
</body>

</html>
<?php if (method_exists($this, 'endPage')) : ?>
    <?php $this->endPage() ?>
<?php endif ?>
