<?php

/**
 *
 *
 * Author:  Asror Zakirov
 * https://www.linkedin.com/in/asror-zakirov
 * https://github.com/asror-z
 *
 */

/*use zetsoft\system\Az;
use zetsoft\widgets\former\ZDynaWidgetX10052020;
use zetsoft\widgets\inputes\ZInputWidget;

Az::$app->controller->layout = 'test3';
echo ZInputWidget::widget();*/


use zetsoft\system\Az;
use zetsoft\models\test\Test5;
use zetsoft\service\search\TntSearchService;
use zetsoft\system\kernels\ZView;


/** @var ZView $this */

$action->title = Azl . 'TntSearch';

$action->icon = 'fa fa-th';
$action->debug = true;
$this->csrf = true;
$action->type = WebItem::type['html'];

$control = new TntSearchService();
$control->getFileNames();
?>

<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
          integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
<div>
    <div>
        <label for="index">Name of The Index File:</label> <br>
        <input type="text" name="index" value="test5" class="indexName"
               placeholder="Index File Name">
        <button id="update" class="actionButton">Create/Update Index</button>
    </div>
    <!--<div>
        <select name="indexSelect" id="indexSelect">
        <?php /*foreach($control->files as $filename):*/?>
            <option value="<?/*=$filename*/?>"><?/*=$filename*/?></option>
            <?php /*endforeach;*/?>
        </select>
    </div>-->
    <div>
        <label for="search">Search</label> <br>
        <input type="text" name="search" class="searchFor" placeholder="Should Have">
        <input type="text" name="shouldNotHave" class="shouldNotHave" placeholder="Should Not Have">
        <button id="search" class="actionButton">Search</button>
    </div>
</div>
<div class="result" id="res1">

</div>
<!-- JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    let action;
    let data;
    let searchF;
    let name;
    let json;
    let shouldNotHave;
    $('.actionButton').on('click', function () {
        action = $(this).attr('id');
        searchF = $('.searchFor').val();
        name = $('.indexName').val();
        shouldNotHave = $('.shouldNotHave').val();
        data = {
            action: action,
            name: name,
            search: searchF,
            shouldNotHave: shouldNotHave
        };
        json = JSON.stringify(data);
        console.log('sending');
        $.ajax({
            type: 'GET',
            url: "test.aspx",
            data: {
                json: json
            },
            success: function (event) {
            console.log('done');
                $("#res1").html(result);
            },
            error: function (err) {
                $("#res1").html('Try to Index First!');
                console.log(err);
            },
        });
    });
</script>
</body>
</html>



