<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\former\ZGrapesJsWidgetMaladoy;
use zetsoft\widgets\iconers\ZLangPickerWidget;


/** @var ZView $this */

/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Grapes';
$action->icon = 'fal fa-calendar-edit';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->cache = false;
$action->toolbar = false;
$action->debug = false;
$action->call = null;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$this->title();

$this->paramSet('widget', true);

/**
 *
 * Start Page
 */


$this->beginPage();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="<?= Yii::$app->language ?>">
<head>

    <?php

    require Root . '/webhtm/block/metas/main.php';
    require Root . '/webhtm/block/assets/main.php';

    $this->head();

    $this->fileCss('/render/former/ZGrapesJsWidget/newAssets/grapesMain.css');
    ?>
</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

?>

<!--card section start -->

    <div class="container-fluid">
    
        <div class="col-md-4 p-5">
            <div class="row">
                <label>Search</label>
                <input type="text" id="searchTemplate" class="form-control">
            </div>
        </div>

        <div class="row">
            
            <div class="col-md-12 p-5">

                <div class="d-flex">

                    <div class="col-md-4 border grapesCard" >
                        <div class="plusCard">
                            <i class="fal fa-plus"></i>
                        </div>
                        <div class="cardTitles">
                            <p>addCard</p>
                        </div>
                    </div>

                    <div class="col-md-4 border ml-2 grapesCard" style="background: url('https://cdn2.editmysite.com/images/landing-pages/global/features/Website-Templates/designed-templates@2x.png'); background-size: 100%;">
                        <div class="flexButtons d-none">
                            <a class="flexBtns select-btn text-dark "><i class="fal fa-user"></i></a>
                            <a class="flexBtns text-dark d-felx"><i class="fal fa-user"></i></a>
                            <a class="flexBtns text-dark d-felx"><i class="fal fa-user"></i></a>
                            <a class="flexBtns text-dark d-felx"><i class="fal fa-user"></i></a>
                        </div>
                        <div class="cardTitles">
                            <p>Test</p>
                        </div>
                    </div>

                    <div class="col-md-4 border ml-2 grapesCard" style="background: url('https://cdn2.editmysite.com/images/landing-pages/global/features/Website-Templates/designed-templates@2x.png'); background-size: 100%;">
                        <div class="flexButtons d-none">
                            <a class="flexBtns select-btn text-dark "><i class="fal fa-user"></i></a>
                            <a class="flexBtns text-dark d-felx"><i class="fal fa-user"></i></a>
                            <a class="flexBtns text-dark d-felx"><i class="fal fa-user"></i></a>
                            <a class="flexBtns text-dark d-felx"><i class="fal fa-user"></i></a>
                        </div>
                        <div class="cardTitles">
                            <p>Best</p>
                        </div>
                    </div>

                </div>

            </div>
        </div>
        
    </div>

<!-- card section end -->

<script>
    $('.grapesCard').on('mouseenter',function () {
        $('.flexButtons').removeClass('d-none');
    });
    $('.grapesCard').on('mouseleave',function () {
        $('.flexButtons').addClass('d-none');
    });

    $('#searchTemplate').on('keyup', function () {
       var cards = $('.grapesCard');
       var i = 0;
       var searchVal = $(this).val();
        
        for(i; i < cards.length; i++){
          var cardsTitleParent = $(cards[i]).children('.cardTitles');
          var titlesParent = cardsTitleParent.children();
          var titles = titlesParent.text();
          var lowers = titles.toLowerCase();
          var uppers = titles.toUpperCase();
            
          $(cards[i]).addClass('d-none');

          if (titles.includes(searchVal) || lowers.includes(searchVal) || uppers.includes(searchVal)){
              $(cards[i]).removeClass('d-none');
          }

          if (searchVal === ''){
              $(cards[i]).removeClass('d-none');
          }

        }
    });
</script>


<?php
$this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
