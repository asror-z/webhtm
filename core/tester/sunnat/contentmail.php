<?php

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html >
<head>
    <style type="text/css">
        .heading {...}
        .list {
            background: red;
            color: white;
            font-size: 20px;
        }
        .footer {...}
    </style>
    <?php $this->head() ?>

</head>
<body>

<?php $this->beginBody() ?>

<h1 class="heading" >This Header </h1>

fsdlfjsdklf
<div class="footer"> This Footer </div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>



