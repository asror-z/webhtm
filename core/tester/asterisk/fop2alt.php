<?php

use zetsoft\service\calls\ReactAmiF;
use zetsoft\system\kernels\ZView;
use zetsoft\service\calls\Asterisk;

$action->title = Azl . 'Веб-действия11111';

$action->icon = 'fa fa-cubes';
$action->debug = true;
$action->type = WebItem::type['ajax'];::type['part'];


?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="buttons">
    <button id="dial">Dial</button>
    <button id="transfer">Transfer</button>
    <button id="hangup">HangUp</button>
    <button id="whisper">whisper</button>
    <button id="listen">Listen</button>
    <button id="refresh">Refresh</button>
</div>
<p id="res">

</p>
<div>
</div>


<script>
    $('button').on('click', function () {
        let action = $(this).attr('id');
        $.ajax({
            type: "GET",
            url: "api.aspx",
            data: {
                action: action
            },
            success: function(response){
                $('#res').html(response);
            }
        });
    });
</script>
</body>
</html>
