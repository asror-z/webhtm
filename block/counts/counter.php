<?php

/**@var ZView $this*/
use zetsoft\system\kernels\ZView;

$this->grape = true;

?>




<!-- counter -->
<script src="https://www.codementor.io/@jamesezechukwu/how-to-create-a-simple-counter-using-javascript-html-css-bxcjgbbxa" > </script>
<script>
    var counter_list = [10,10000,10000];
    var str_counter_0 = counter_list[0];
    var str_counter_1 = counter_list[1];
    var str_counter_2 = counter_list[2];
    var display_str = "";
    var display_div = document.getElementById("display_div_id");

    function incrementCount(current_count){
        setInterval(function(){
            // clear count
            while (display_div.hasChildNodes()) {
                display_div.removeChild(display_div.lastChild);
            }
            str_counter_0++;
            if (str_counter_0 > 99) {
                str_counter_0 = 10; // reset count
                str_counter_1++;    // increase next count
            }
            if(str_counter_1>99999){
                str_counter_2++;
            }
            display_str = str_counter_2.toString() + str_counter_1.toString() + str_counter_0.toString();
            for (var i = 0; i < display_str.length; i++) {
                var new_span = document.createElement('span');
                new_span.className = 'num_tiles';
                new_span.innerText = display_str[i];
                display_div.appendChild(new_span);
            }
        },1000);
    }
</script>
<!-- end of code counter -->



<a href='https://www.symptoma.com/en/info/covid-19'>2019-nCoV Acute Respiratory Disease</a> <script type='text/javascript' src='https://www.freevisitorcounters.com/auth.php?id=541614d0116883fbe816a20ee0524b04ce14645d'></script>
<script type="text/javascript" src="https://www.freevisitorcounters.com/en/home/counter/641264/t/0"></script>

<!--
    http://s3.envato.com/files/2526287/index.html
-->


<link rel="stylesheet" type="text/css" href="counter.css" />
<script type="text/javascript" src="counter.js"></script>

<div style="width: 100%; height: 100%; margin: 0px auto;">
    <div id="my_counter_1" style="position: relative; top: 45%; margin: 0px auto; background-color: white;
border: 5px solid #dddddd;
border-radius: 5px;
-moz-border-radius: 5px;
-moz-box-shadow: 5px 5px 10px #000000;
-webkit-box-shadow: 5px 5px 10px #000000;
-khtml-box-shadow: 5px 5px 10px #000000;
box-shadow: 5px 5px 10px #000000;"></div>
</div>


<script type="text/javascript">

    var myCounter = null
    var timerId = null

    function loadCounter(){
        myCounter = new Counter("my_counter_1",
            {
                digitsNumber : 5,
                direction : Counter.ScrollDirection.Upwards,

                characterSet : Counter.DefaultCharacterSets.numericUp,
                charsImageUrl : "images/numeric_up_blackbg5.png",
                markerImageUrl : "marker.png"
            });
        myCounter.value = 0;
        timerId = window.setInterval("myCounter.setValue(parseInt(myCounter.value) + 1,
        300);",
        500);

    }

    loadCounter();
</script>

<!--
     end of counter code    http://s3.envato.com/files/2526287/index.html
-->



<!--LiveInternet counter--><script type="text/javascript">
    document.write('<a href="//www.liveinternet.ru/click" '+
        'target="_blank"><img src="//counter.yadro.ru/hit?t53.6;r'+
        escape(document.referrer)+((typeof(screen)=='undefined')?'':
            ';s'+screen.width+'*'+screen.height+'*'+(screen.colorDepth?
            screen.colorDepth:screen.pixelDepth))+';u'+escape(document.URL)+
        ';h'+escape(document.title.substring(0,150))+';'+Math.random()+
        '" alt="" title="LiveInternet: number of pageviews and visitors'+
        ' for 24 hours is shown" '+
        'border="0" width="88" height="31"><\/a>')
</script><!--/LiveInternet-->

<!-- hotjar Counter -->
Hotjar Tracking Code for http://eyuf.zettest.uz/cores/main/index.aspx
<script>
    (function(h,o,t,j,a,r){
        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
        h._hjSettings={hjid:1705781,hjsv:6};
        a=o.getElementsByTagName('head')[0];
        r=o.createElement('script');r.async=1;
        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
        a.appendChild(r);
    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
</script>


<!-- Default Statcounter code for eyuf http://eyuf.zettest.uz -->
<script type="text/javascript">
    var sc_project=12207161;
    var sc_invisible=0;
    var sc_security="1d799e83";
    var sc_https=1;
    var scJsHost = "https://";
    document.write("<sc"+"ript type='text/javascript' src='" + scJsHost+
        "statcounter.com/counter/counter.js'></"+"script>");
</script>
<noscript><div class="statcounter"><a title="web stats"
                                      href="https://statcounter.com/" target="_blank"><img class="statcounter"
                                                                                           src="https://c.statcounter.com/12207161/0/1d799e83/0/" alt="web
stats"></a></div></noscript>
<!-- End of Statcounter Code -->


<!-- counter -->
<div id="counter"></div>
<button id="reset">Reset</button>

<script>
    var n = localStorage.getItem('on_load_counter');

    if (n === null) {
        n = 0;
    }

    n++;

    localStorage.setItem("on_load_counter", n);

    document.getElementById('counter').innerHTML = n;


    function reset_counter() {
        localStorage.removeItem('on_load_counter');
    }

    document.getElementById('reset').addEventListener('click', reset_counter);
</script>
