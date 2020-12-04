<?php

$r = $this->httpGet('r');
 switch($r)
 {
     case 1: $r = "Нет такого имя пользователья";break;
     case 2: $r = "Нет Email аддрес на `GitHub` ";break;

 }

?>
<div class="row justify-content-center">
    <b>!Error:   <?= $r; ?></b>
</div>

<a href='/core/tester/register/signin.aspx' >Back </a>
