<?

use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;
use zetsoft\widgets\iconers\ZLangPickerWidget;

/** @var ZView $this */

global $boot;

if ($boot->env('devChatra'))
    require_once Root . '/webhtm/block/footer/chatra.php';

?>


<footer class="footer">
    &nbsp;&nbsp;
    <div class="row  align-items-center">
        <div class="col-lg-7  justify-content-center">
            <p class="text-white pl-2 text-footer d-flex justify-content-around">
                © 2020 Bozorboy.com
            </p>
        </div>
        <div class="col-lg-5 d-flex ">
                        <?
                        echo ZLangPickerWidget::widget([]);
                        ?>
                    <?
                    if (!$boot->userDev())
                        require_once Root . '/webhtm/block/counts/eyuf/ALL.php';
                    else
                        if ($boot->env('devFooter'))
                            require_once Root . '/webhtm/block/counts/eyuf/ALL.php';
                    ?>

        </div>
    </div>
    &nbsp;&nbsp;
</footer>

<style>
    .footer{
        background-color: #125188;
        position: sticky;
        clear: both;
        width: 100%;
        top: 100%;

    }


      .text-footer{
       padding:0;
       margin:0;
      }

</style>




