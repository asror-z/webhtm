<?php

use zetsoft\system\kernels\ZView;
use zetsoft\service\calls\Asterisk;

$action->title = Azl . 'Веб-действия';

$action->icon = 'fa fa-cubes';
$action->debug = true;
$action->type = WebItem::type['ajax'];::type['part'];

$usernumber = $_GET['number'] ?? '202';

$mainPoint = new Asterisk;
$data = $mainPoint->getDataFromMainDb($usernumber);

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
</head>
<body>
<hr>
<div class="col">
    <form action="/core/tester/asterisk/main.aspx?" method="get" class="form-inline">
        <div class="form-group">
            <label>Input user For Main Table:</label>
            <input type="text" name="number" class="form-control ml-2">
        </div>
        <div class="form-group ml-2">
            <button type="submit" class="btn btn-warning btn-block">Submit</button>
        </div>
    </form>
</div>
<hr>
<div class="col">
    <form action="/core/tester/asterisk/searchintime.aspx?" method="get" class="form-inline">
        <div class="form-group">
            <label>Input user For Date Seach:</label>
            <input type="text" name="number" class="form-control ml-2">
        </div>
        <!-- time one from  -->
        <div class="form-group">
            <label>From:</label>
            <input type="date" name="time1" class="form-control ml-2">
        </div>

        <!-- time two to  -->
        <div class="form-group">
            <label>To : </label>
            <input type="date" name="time2" class="form-control ml-2">
        </div>

        <button type="submit" class="btn btn-success ml-2 btn-blocks">Submit</button>
    </form>
</div>
<hr>
<div class="col">
    <a href="/core/tester/asterisk/unanswered.aspx?src=<?= $usernumber ?>"><button class="btn btn-danger">Unaswered</button></a>
    <h2>Current User: <?=$usernumber?></h2>
</div>
<hr>

<table class="table table-hover table-bordered">
    <thead>
    <tr class="bg-info text-white">
        <th scope="col">Type</th>
        <th scope="col">From:</th>
        <th scope="col">To:</th>
        <th scope="col">Date-Time</th>
        <th scope="col">Duration <br />on seconds</th>
        <th scope="col">Play audio</th>
        <th scope="col">Action</th>
    </tr>
    </thead>
<?php foreach($data as $key => $val): ?>
    <tbody>
    <?php if($val['cnam'] === '')
    {
    $changeStyle = "style='color:red;'";
    }else{
        $changeStyle = '';
    }
     ?>
    <tr <?= $changeStyle?>>
        <th scope="row"><?= $val['disposition'] ?></th>
        <td><?= $val['src'] ?></td>
        <td><?= $val['dst'] ?></td>
        <td><?= $val['calldate'] ?></td>
        <td><?= $val['duration'] ?></td>
        <td>
            <?php if($val['recordingfile'] !== ''): ?>
                <audio id="player" controls class="js-player">
                    <source src="/../../../..<?php echo $mainPoint->getSmallPath($val['recordingfile']);?>" type="audio/wav"/>
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
