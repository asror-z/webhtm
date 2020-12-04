<?php

use zetsoft\system\kernels\ZView;
use zetsoft\service\calls\Asterisk;

$action->title = Azl . 'Веб-действия';

$action->icon = 'fa fa-cubes';
$action->debug = true;
$action->type = WebItem::type['ajax'];::type['part'];

//$usernumber = $_GET['number'] ?? '202';
//$linkedid = '1588423621.162';

$mainPoint = new Asterisk;
$data = $mainPoint->getTransferCall();

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.plyr.io/3.5.10/plyr.js"></script>
    <link rel="stylesheet" href="https://cdn.plyr.io/3.5.10/plyr.css" />
    <script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
    <style>
        button{
            padding: 10px 20px;
            margin: 20px;
            cursor: pointer;
            background: #27ae60;
            color: #fff;
            font-weight: bold;
            border: none;

        }
    </style>

</head>
<body>
    <pre>
        <?php  //print_r($data); die; ?>
    </pre>

    <hr>
    <div class="col">
        <a href="/core/tester/asterisk/main.aspx"><button class="btn btn-primary">Home</button></a>
    </div>
    <hr>

    <table class="table table-hover table-bordered">
        <thead>
        <tr class="bg-info text-white">
            <th scope="col">Type</th>
            <th scope="col">From:</th>
            <th scope="col">To:</th>
            <th scope="col">LinkedId:</th>
            <th scope="col">Date-Time</th>
            <th scope="col">Duration <br />on seconds</th>
            <th scope="col">Play audio</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <?php foreach($data as $val): ?>

            <tbody>
            <tr>
                <th scope="row"><?= $val['disposition'] ?></th>
                <td><?= $val['src'] ?></td>
                <td><?= $val['dst'] ?></td>
                <td><?= $val['linkedid'] ?></td>
                <td><?= $val['calldate'] ?></td>
                <td><?= $val['duration'] ?></td>
                <td>
                    <?php if($val['recordingfile'] !== ''): ?>
                        <audio id="player" controls class="js-player">
                            <source src="/../../../..<?php //echo $mainPoint->getSmallPath($val['recordingfile']);?>" type="audio/wav"/>
                        </audio>
                    <?php else:
                        echo 'Recorded File does not exist!';
                        ?>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if($val['recordingfile'] !== ''){
                        $pathtodelete = '/core/tester/asterisk/download.aspx?name=';
                    }else{
                        $pathtodelete = '#';
                    } ?>
                    <a href="<?=$pathtodelete . $val['recordingfile'] ?>">
                        <button type="button" class="btn btn-primary btn-sm btn-block" id="singleDown">Download</button> </a>
                    <a href="/core/tester/asterisk/allinfo.aspx?uniqueid=<?=$val['uniqueid']?>"><button class="btn btn-success btn-sm btn-block">More Info</button></a>
                </td>
            </tr>
            </tbody>
        <?php endforeach; ?>
        <script>
            const players = Plyr.setup('.js-player');
            const player = new Plyr('.js-player', {
                controls: ['play-large', 'play', 'progress', 'current-time', 'mute', 'volume', 'captions', 'settings', 'pip', 'airplay', 'fullscreen'],
                settings: ['captions', 'quality', 'speed', 'loop'],
                disableContextMenu: true,
            });
        </script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


</body>
</html>
