<?php

use zetsoft\system\kernels\ZView;
use zetsoft\service\calls\Asterisk;

$action->title = Azl . 'Веб-действия';

$action->icon = 'fa fa-cubes';
$action->debug = true;
$action->type = WebItem::type['ajax'];::type['part'];
$uniqid = $_GET['uniqueid'];
$mainPoint = new Asterisk;
$data = $mainPoint->celfind($uniqid);
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
<a href="/core/tester/asterisk/main.aspx">
    <button class="btn btn-warning">Home</button>
</a>

<table class="table table-hover table-bordered">
    <thead>
    <tr class="bg-info text-white">
        <th scope="col">Event Type</th>
        <th scope="col">Event Time</th>
        <th scope="col">Cid Name</th>
        <th scope="col">Cid Number</th>
        <th scope="col">Cid Ani</th>
        <th scope="col">Cid Rdnis</th>
        <th scope="col">Cid Dnid</th>
        <th scope="col">Extension</th>
        <th scope="col">Context</th>
        <th scope="col">Channel Name</th>
        <th scope="col">App Name</th>
        <th scope="col">App Data</th>
        <th scope="col">AmafLags</th>
        <th scope="col">Account Code</th>
        <th scope="col">Unique ID</th>
        <th scope="col">Linked ID</th>
        <th scope="col">Peer</th>
        <th scope="col">User Defined Type</th>
        <th scope="col">Extra</th>
    </tr>
    </thead>
    <tbody>
          <?php foreach($data as $val): ?>
    <tr>
        <th scope="row"><?= $val['eventtype'] ?></th>
        <th scope="row"><?= $val['eventtime'] ?></th>
        <th scope="row"><?= $val['cid_name'] ?></th>
        <th scope="row"><?= $val['cid_num'] ?></th>
        <th scope="row"><?= $val['cid_ani'] ?></th>
        <th scope="row"><?= $val['cid_rdnis'] ?></th>
        <th scope="row"><?= $val['cid_dnid'] ?></th>
        <th scope="row"><?= $val['exten'] ?></th>
        <th scope="row"><?= $val['context'] ?></th>
        <th scope="row"><?= $val['channame'] ?></th>
        <th scope="row"><?= $val['appname'] ?></th>
        <th scope="row"><?= $val['appdata'] ?></th>
        <th scope="row"><?= $val['amaflags'] ?></th>
        <th scope="row"><?= $val['accountcode'] ?></th>
        <th scope="row"><?= $val['uniqueid'] ?></th>
        <th scope="row"><?= $val['linkedid'] ?></th>
        <th scope="row"><?= $val['peer'] ?></th>
        <th scope="row"><?= $val['userdeftype'] ?></th>
        <th scope="row"><?= $val['extra'] ?></th>
    </tr>
        <?php endforeach;?>
    </tbody>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
            integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>

</table>
</body>
</html>



