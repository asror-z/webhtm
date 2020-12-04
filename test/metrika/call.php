<?php

function getUserIpAddr(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
        //ip from share internet
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
        //ip pass from proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else{
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

if (isset($_POST)){

    $url = 'main/create-lead.aspx';
    $cpas_statistics_id = urlencode($_POST['cpas_statistics_id']);
    $catalog_id = urlencode($_POST['catalog_id']);;
    $customer =  urlencode($_POST['name']);
    $tel =  urlencode($_POST['number']);
    $amount =  urlencode($_POST['amount']);
    $auth_key = '2r8fDXeG7xrHC2mqXB24XTeQ2pBJmw5bXkHQzRkgdBD42HEpgKzu4dBzuEbuzKH8';

    $params = array(
        'catalog_id' => $catalog_id,
        'name' => $customer,
        'phone_number' => $tel,
        'amount' => $amount,
        'auth_key' => $auth_key,
        'cpas_statistics_id' => $cpas_statistics_id,
    );


    $return = goCurl('main/create-lead.aspx', $params);
    $array = json_decode($return, true);

    $code = $array['code'];
    //vdd($code);
    $code1 = 0;
    header('Location: /render/cpas/test/thanks.php');
    /*
    if ($code1 === 0){
        header('Location: /render/cpas/test/thanks.php');
    }
    else{
        vdd($response);
    }*/



}
function goCurl($url, $data){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "/api/cpas/$url");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    $return = curl_exec($ch);
    curl_close($ch);

    return $return;
}
?>
