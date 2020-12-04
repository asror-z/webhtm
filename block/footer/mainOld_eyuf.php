<?

use zetsoft\system\kernels\ZView;

/** @var ZView $this */

?>


<footer class="footer-section row ml-0" id="footer">
    <div class="col-md-7">
        <div class="copyright">
            <p class="footer-p text-white">
                © 2020 Фонд Эл-юрт умиди при Агентстве развития государственной службы при
                Президенте Республики Узбекистан
            </p>
        </div>
    </div>

    <div class="col-md-5">
        <div class="row">
            <div class="col-md-6">
                <div class="footer-ul d-flex ">
                    <div class="footer-li ml-auto"><a class="footer-a" href="/ru/cores/main/index.aspx">Русский</a>
                    </div>
                    <div class="footer-li"><a class="footer-a" href="/en/cores/main/index.aspx">English</a></div>
                    <div class="footer-li"><a class="footer-a" href="/uz/cores/main/index.aspx">O'zbekcha</a></div>
                    <div class="footer-li"><a class="footer-a" href="/uzk/cores/main/index.aspx">Ўзбекча</a></div>
                </div>
            </div>
            <div class="col-md-6 d-flex counter-main">
                <?
                if (!$boot->userDev())
                    require_once Root . '/webhtm/block/counts/eyuf/ALL.php';
                else
                    if ($boot->env('devFooter'))
                        require_once Root . '/webhtm/block/counts/eyuf/ALL.php';
                ?>
            </div>
        </div>
</footer>


<style>
    .footer-section {
        bottom: 0;
        width: 100%;
        padding-top: 20px;
        background-color: #125188;
        position: fixed;
        transition: .3s linear;
        -o-transition: .3s linear;
        -moz-transition: .3s linear;
        -webkit-transition: .3s linear;


    }


    .footer-li {
        padding-right: 10px !important;
        text-decoration: none;
    }

    .footer-a {
        padding-right: 30px;
        color: white;
        font-size: 12px;
        text-decoration: none;
    }

    .footer-a:hover {
        color: #fab702;
    }

    .footer-ul {
        list-style: none;
        /* position: absolute;
         float: right;
         padding-left: 30%;*/
    }

    }
    .footer-p {
        font-size: 12px!important;
    }

    .footer-col-2 {
        float: right !important;
    }
    .counter-main{

    }

    .counter-div{
     padding-left: 10px;
     padding-bottom: 10px;
    }

</style>
<script>
    function myFunction() {
        document.getElementById("footer").style.transition = "all 2s";
    }
</script>

