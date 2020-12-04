<?php
$this->beginPage();
use yii\bootstrap4\Html; ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    
    <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon">

    <!-- Assets -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.12.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.12.1/css/v4-shims.min.css">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/render/asrorz/mdb/css/mdb.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mburger-css@1.3.3/dist/mburger.css">


    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.js"></script>


    <link rel="stylesheet" href="/render/asrorz/css/ALL.css">
    <script type="text/javascript" src="/render/asrorz/js/ALL.js"></script>


    <?php
    $this->head();

    $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);


    ?>


</head>
<body style="overflow: hidden">

<?php $this->beginBody() ?>


<div class="pr-2 pl-2">
    <?= $this->require($content); ?>
</div>

<?php $this->endBody() ?>

</body>
</html>

<?php
$this->endPage()
?>

