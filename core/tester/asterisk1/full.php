<?php
namespace zetsoft\service\calls;


use zetsoft\models\App\eyuf\db2\CallsCdr;
use zetsoft\service\ALL\Asteriskk;
use zetsoft\system\actives\ZActiveRecord;
use \zetsoft\system\kernels\ZFrame;


$usernumber = $_POST['number'] ?? '701';
$total= CallsCdr::find()->count();

$limit = 20;

// How many pages will there be
$pages = ceil($total / $limit);

// What page are we currently on?
$page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
    'options' => array(
        'default'   => 1,
        'min_range' => 1,
    ),
)));
$offset = ($page - 1)  * $limit;

// Some information to display to the user
$start = $offset + 1;
$end = min(($offset + $limit), $total);

// The "back" link
$prevlink = ($page > 1) ? '<li class="page-item"><a href="?page=1" title="First page" class="page-link">&laquo;</a></li><li class="page-item"><a href="?page=' . ($page - 1) . '" title="Previous page" class="page-link">&lsaquo;</a></li> ' : '<li class="page-item"><span class="page-link">&laquo;</span></li> <li class="page-item"><span class="page-link">&lsaquo;</span></li>';

// The "forward" link
$nextlink = ($page < $pages) ? '<li class="page-item"><a href="?page=' . ($page + 1) . '" title="Next page" class="page-link">&rsaquo;</a></li> <li class="page-item"><a href="?page=' . $pages . '" title="Last page" class="page-link">&raquo;</a></li>' : '<li class="page-item"><span class="page-link">&rsaquo;</span></li> <li class="page-item"><span class="page-link">&raquo;</span></li>';

// Display the paging information
$stmt = CallsCdr::findBySql("SELECT * FROM cdr GROUP BY cdr.calldate LIMIT  :limit  OFFSET :offset",
    [':limit'=>$limit,':offset'=>$offset])->all();
$query = CallsCdr::findBySql("SELECT * FROM cdr WHERE src=:src",[':src'=>$usernumber]);
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
<div class="m-3">
    <div class="row">
        <div class="col">
            <form action="full.php" method="post" class="form-inline">
                <div class="form-group">
                    <label>Input user:</label>
                    <input type="text" name="number" class="form-control ml-2">
                </div>
                <div class="form-group ml-2">
                    <button type="submit" class="btn btn-warning btn-block">Submit</button>
                </div>
            </form>
        </div>

        <div class="col">
            <form action="searchintime.php" method="post" class="form-inline">
                <!-- User Number -->
                <div class="form-group">
                    <label>Input user:</label>
                    <input type="text" name="userNumber" class="form-control ml-2">
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

        <div class="col">
            <a href="unansweredcalls.php?src=<?php echo $usernumber ?>"><button class="btn btn-danger">Unaswered</button></a>
        </div>

    </div>
</div>

<h1>User Number:<?php echo $usernumber ?></h1>
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
    <tbody>

    <?php while($row = $query->fetch()): ?>
        <?php if($row['src'] === $usernumber): ?>
            <tr>
            <th scope="row"><?php echo $row['disposition']; ?></th>
            <td><?php echo $row['src']; ?></td>
            <td><?php echo $row['dst']; ?></td>
            <td><?php echo $row['calldate']; ?></td>
            <td><?php echo $row['duration']; ?></td>
            <td>

                <?php if($row['recordingfile'] !== ''): ?>

                    <audio id="player" controls class="js-player">
                        <source src="<?php echo getFullPath($row['recordingfile']) ?> "/>
                    </audio>

                <?php else:
                    echo "Recorded File does not " ;
                    ?>

                <?php endif; ?>
            </td>

            <td>


                <?php if($row['recordingfile'] !== ''){
                    $pathtodelete = 'download.php?file=';
                }else{
                    $pathtodelete = '#';
                } ?>
                <a href="<?php echo $pathtodelete . $row['recordingfile']; ?>" >
                    <button type="button" class="btn btn-primary btn-sm btn-block">Download</button>
                </a>




                <a href="moreinfo.php?id=<?php echo $row['uniqueid'] ?>"><button class="btn btn-success btn-sm btn-block">More Info</button></a>



                <!--Yes No modal -->

                <!-- Modal -->

                <!-- Button trigger modal -->


                <!-- Modal -->


                <!--Yes No modal END -->
            </td>
        <?php endif; ?>
        </tr>
    <?php  endwhile; ?>



    </tbody>
</table>

<script>
    const players = Plyr.setup('.js-player');
    const player = new Plyr('.js-player', {
        controls: ['play-large', 'play', 'progress', 'current-time', 'mute', 'volume', 'captions', 'settings', 'pip', 'airplay', 'fullscreen'],
        settings: ['captions', 'quality', 'speed', 'loop'],
        disableContextMenu: true,
    });

    //const player = new Plyr.setup(".js-player");

</script>


<nav aria-label="...">
    <ul class="pagination">
        <li class="page-item">
            <?php

            echo '<div id="paging"><p>', $prevlink, ' Page ', $page, ' of ', $pages, ' pages, displaying ', $start, '-', $end, ' of ', $total, ' results ', $nextlink, ' </p></div>';

            ?>

        </li>

    </ul>
</nav>








<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>
