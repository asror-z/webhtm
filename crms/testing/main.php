<?php
use zetsoft\dbitem\core\WebItem;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\service\calls\Fop;



/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'testd';
$action->icon = 'fa fa-database';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->debug = true;
$action->cache = false;
$action->call = null;
$action->cacheHttp = false;
$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();

/**
 *
 * Start Page
 */

$this->beginPage();
?>
<h1>helo</h1>
<?php
$callerID = '204';

$content = new Fop();
$content->sipPeers();
$statuses = $content->statuses;
$content->coreShowChannels();
$liveChannels = $content->liveChannels;
$content->showConnectedChannels();
$connectedChannels = $content->connectedChannels;
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <?php
        require Root . '/webhtm/block/metas/main.php';
        require Root . '/webhtm/block/assets/main.php';
    $this->head();
    ?>

</head>
    <body class="<?= ZWidget::skin['white-skin'] ?>">
<?php
$this->beginBody();

echo ZNProgressWidget::widget([]);

?>
<div id="page">
    <?
        require Root . '/webhtm/block/navbar/main.php';
    ?>
    <div id="content" class="content-footer p-3">
        <div class="row">
            <div class="col-md-12 col-12">
                <header class="header">
                    <nav class="navbar navbar-expand-xl navbar-light bg-light ">
                        <div class="w-25">
                            <p id="<?=$callerID?>" class="OwnerInfo font-weight-normal mb-0">Owner Info : <?=$callerID?></p>
                            <p class="font-weight-bolder text-wrap">Live Response: <span id="res"></span></p>
                        </div>
                        <div class="container-lg">
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav mr-auto buttons">
                                    <li class="nav-item ml-2 ">
                                        <button id="dial" class="action_buttons btn btn-secondary" disabled>Dial</button>
                                    </li>
                                    <li class="nav-item ml-2">
                                        <button id="transfer" class="action_buttons btn btn-secondary" disabled>Transfer</button>
                                    </li>
                                    <li class="nav-item ml-2 ">
                                        <button id="hangup" class="action_buttons btn btn-secondary" disabled>HangUp</button>

                                    </li>
                                    <li class="nav-item ml-2">
                                        <button id="whisper" class="action_buttons btn btn-secondary" disabled>whisper</button>
                                    </li>
                                    <li class="nav-item ml-2">
                                        <button id="listen" class="action_buttons btn btn-secondary" disabled>Listen</button>
                                    </li>
                                    <li class="nav-item ml-2">
                                        <button id="barge" class="action_buttons btn btn-secondary" disabled>BargeIn</button>
                                    </li>
                                    <li class="nav-item ml-2">
                                        <div class="btn-group">
                                            <button class="btn btn-primary dropdown-toggle live_response_button" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Actions
                                            </button>
                                            <div class="dropdown-menu">
                                                <button id="callhistory" type="button" class="dropdown-item action_buttons" data-toggle="modal" data-target="#staticBackdrop">
                                                    Call History
                                                </button>
                                                <button id="missedcalls" type="button" class="dropdown-item action_buttons" data-toggle="modal" data-target="#staticBackdropmissed">
                                                    Missed Calls
                                                </button>
                                                <div class="dropdown-divider"></div>
                                                <button id="records" class="dropdown-item action_buttons">Records</button>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="nav-item ml-2">
                                        <button id="phone" class="action_buttons btn btn-warning">Phone</button>
                                    </li>

                                </ul>
                            </div>
                            <div >
                                <form class="form-inline my-2 my-lg-0">
                                    <input class="form-control mr-sm-2 live_search_input" type="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-danger my-2 my-sm-0" type="submit">Update</button>
                                </form>
                            </div>
                        </div>
                    </nav>
                    
                </header>
                <!-- Modal -->
                <div class="modal fade  m-auto" id="staticBackdrop">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel"><strong>User : </strong><?=$callerID?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="live_callhistory"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Understood</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade  m-auto" id="staticBackdropmissed">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel"><strong>User : </strong><?=$callerID?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="live_missedcalls"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Understood</button>
                            </div>
                        </div>
                    </div>
                </div>

                    <div class="extensions_list col-9 ">
                        <div class="container-xl">
                            <div class="extensions row border border-secondary p-2  ">
                                <?php foreach ($statuses as $key => $val): ?>
                                    <?php
                                    if(array_key_exists($key, $liveChannels)){
                                        $live = 'live';
                                        $connectionData = 'Connected to: ' . $connectedChannels[$key];
                                    }else{
                                        $live = '';
                                        $connectionData = '';
                                    }
                                    if($val !== 'UNKNOWN'){
                                        $btn_status = 'success';
                                    }else{
                                        $btn_status = 'secondary';
                                    }
                                    ?>
                                    <div class="col-2 p-1">
                                        <div class=" bg-<?=$btn_status?> text-white rounded-lg
                p-1"><button type="button"  id="<?=$val?>" class="choose_exension  <?= $live ?> btn btn-outline-<?=$btn_status?> bg-white" data-num="<?=$key?>" ><?=$key?></button><div > <span class="badge badge-<?=$btn_status?>"><?=$val?> <?=$connectionData?></span></div></div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar col-3 p-0 m-0  bg-light">
                        <div class="container-fluid border border-secondary rounded-lg p-0">
                            <div id="accordion">
                                <div class="card w-100">
                                    <div class="border-bottom" id="headingOne">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link w-100" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                Collapsible Group Item #1
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                        </div>
                                    </div>
                                </div>
                                <div class="card w-100">
                                    <div class="border-bottom" id="headingTwo">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed w-100" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                Collapsible Group Item #2
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                        <div class="card-body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                        </div>
                                    </div>
                                </div>
                                <div class="card w-100">
                                    <div class="border-bottom" id="headingThree">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link collapsed w-100" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                Collapsible Group Item #3
                                            </button>
                                        </h5>
                                    </div>
                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                        <div class="card-body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
  

<script>
    let action;
    let stat = 'OK';
    let res = $('#res');
    let action_but = $('.action_buttons');
    let live;
    let arr;
    let data;
    let callhistory = false;
    let missed = false;
    let choose_exension = $('.choose_exension');
    let owner = $('.OwnerInfo').attr('id');
    let ext = owner;
    $('#myModal').modal('toggle');
    action_but.on('click', function () {
        action = $(this).attr('id');
        if(action == 'transfer'){
            owner = prompt('Transfer to?');
        }
        if(action == 'callhistory'){
            callhistory = true;
        }
        if(action == 'missedcalls'){
            missed = true;
        }

        arr = {actionType:action,callerId:owner,extension:ext};
        data = JSON.stringify(arr);
        $.ajax({
            type: "GET",
            url: "Api1.php",
            data: {json:data},
            success: function(response){
                if(callhistory){
                    callhistory = false;
                    console.log('callhistory=false');
                    $('.live_callhistory').html(response);
                }else if(missed){
                    missed = false;
                    console.log('missed=false');
                    $('.live_missedcalls').html(response);
                }else

                {
                    res.html(response);
                }
            }
        });

    });
    choose_exension.on('click', function(){
        ext = $(this).html();
        stat = $(this).attr('id');
        if(stat != 'UNKNOWN') {
            action_but.prop('disabled', false);
            action_but.removeClass('btn-secondary');
            action_but.addClass('btn-success');
        }else{
            action_but.prop('disabled', true);
            action_but.removeClass('btn-success');
            action_but.addClass('btn-secondary');
        }
        if($(this).hasClass('live')){
            $('#listen').prop('disabled', false);
            $('#whisper').prop('disabled', false);
            $('#hangup').prop('disabled', false);
            $('#transfer').prop('disabled', false);
            $('#barge').prop('disabled', false);
            $('#dial').prop('disabled', true);
        }else{
            $('#listen').prop('disabled', true);
            $('#whisper').prop('disabled', true);
            $('#hangup').prop('disabled', true);
            $('#transfer').prop('disabled', true);
            $('#barge').prop('disabled', true);
        }
        res.html(ext + ':' + stat);
    });
    let live_search = '';
    $('.live_search_input').on('keyup', function(){
        live_search = $('.live_search_input').val();
        $.each(choose_exension, function(key, value){
            let elem = $(value);
            let num = $(value).attr('data-num');
            if(num.indexOf(live_search)){
                console.log('found');
                elem.parent().parent().css('display', 'none');
            }else{
                elem.parent().parent().css('display', 'block');
            }
        });
    });
</script>







<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
