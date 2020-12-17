<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\cpas\CpasOffer;
use zetsoft\models\cpas\CpasOfferItem;
use zetsoft\models\cpas\CpasLand;
use zetsoft\models\cpas\CpasStream;
use zetsoft\models\cpas\CpasTeaser;
use zetsoft\service\forms\Active;
use zetsoft\system\assets\ZColor;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZUrl;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidget;
use zetsoft\widgets\former\ZFormBuildWidget;
use zetsoft\widgets\inputes\ZInputWidget;
use zetsoft\widgets\inputes\ZKSelect2Widget;
use zetsoft\widgets\navigat\ZButtonWidget;
use zetsoft\widgets\notifier\ZSessionGrowlWidget;
use zetsoft\widgets\themes\ZCardWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 */

$action = new WebItem();

$action->title = Azl . 'Создать новый поток';
$action->icon = 'fa fa-globe';
$action->type = WebItem::type['html'];
$action->csrf = false;
$action->debug = false;



$this->paramSet(paramAction, $action);

$this->title();
$this->toolbar();


/**
 *
 * Start Page
 */

$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Az::$app->language ?>">
<head>

    <?php

    require Root . '/webhtm/block/metas/main.php';
    require Root . '/webhtm/block/assets/App/main_arbit.php';

    $this->head();

    ?>


</head>


<body class="hold-transition sidebar-mini">

<?php

$this->beginBody();

echo $this->require( '\webhtm\cpas\blocks\header.php');

echo ZNProgressWidget::widget([]);

?>

<div id="page">

    <?
    $id = $this->httpGet('id');

    echo ZSessionGrowlWidget::widget();?>
    <div class="container-fluid bg-light">
        <div class="mt-2">
            <h2 class="text-muted">Новый поток</h2>

        </div>
        <div class="col-md-12">
            <div class="row">
                

                <div class="col-md-12">




                    <div class="mb-2">

                        <?



                        $active = new Active();
                        $active->type = Active::type['horizontal'];
                        $form = $this->activeBegin($active);
                        $stream = new CpasStream();
                        $stream->cpas_offer_id = $id;
                        $stream->user_id = $this->userIdentity()->id;
                        

                        $stream->cards = [
                            [
                                'title' => Az::l('Первый этап'),
                                'shows' => true,
                                'items' => [
                                    [
                                        'title' => Az::l('Форма'),
                                        'shows' => true,
                                        'items' => [
                                            ['cpas_offer_id'],
                                            ['title'],
                                            ['postback'],
                                            ['counter']
                                        ],
                                    ],
                                ],
                            ],
                        ];


                        $stream->configs->hasLabel = false;
                        $stream->columns();



                        echo ZFormBuildWidget::widget([
                            'model' => $stream,
                            'form' => $form,
                            'config' => [

                                'stepType' => ZFormBuildWidget::stepType['none'],
                                'blockType' => ZFormBuildWidget::blockType['card'],
                                'stepOptions' => [],
                                'blockOptions' => [
                                    'config' => [
                                        'headerColor' => ZColor::color['green-special'],
                                        'classHeadColor' => 'bg-white text-dark px-3 pb-3',
                                    ]
                                ],
                                'isStepsVertical' => false,
                                'topBtn' => false,
                                'botBtn' => true,
                                'btnTitle' => null,
                                'isCard' => true,
                                'btnClass' => '',
                                'btnStyle' => ZButtonWidget::btnStyle['btn-outline-default'],
                            ]
                        ]);



                        $this->activeEnd();
                        #endregion
                        if ($this->modelSave($stream)) {

                            $url = ZUrl::to([
                                '/cpas/client/createNewAll',
                                'model' => $stream->className,
                                'id' => $stream->id  ,
                            ]);

                            return $this->urlRedirect($url);

                        }

                        ?>
                    </div>
                </div>


           

        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#CpasStreams").click(function () {
                var sites = [];
                $.each($(".checkbox-CpasSites:checkbox:checked"), function () {
                    sites.push($(this).val());
                });
                var widgets = [];
                $.each($(".checkbox-CpasWidgets:checkbox:checked"), function () {
                    widgets.push($(this).val());
                });

                console.log(widgets)
                console.log(sites)
                $('#cpasstreams-cpas_widgets_ids').val([widgets]);
                $('#cpasstreams-cpas_landing_ids').val([sites]);

            });
        });


    </script>


        <? echo $this->require( '\webhtm\cpas\blocks\footer.php'); ?>
</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
