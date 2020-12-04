<?php
const THANKS_URL = 'thanks.php'; // ссылка на страницу "спасибо"
const FLOW_TOKEN = 'pyjDl'; // ТОКЕН ПОТОКА
const CLIENT_TOKEN = 'FKGUF2RUMXKIJIKKSNVYWW'; // ТОКЕН КЛИЕНТА

if (isset($_POST['name']) && $_POST['phone'] != '' ) {
    $post = [
        "stream_code" => FLOW_TOKEN,
        "client" => [
            'name' => $_POST['name'],
            'phone' => $_POST['phone'],
        ],
        'sub1' => $_GET['sub1']
    ];
// отправляем заявку
    $ch = curl_init('https://affiliate.drcash.sh/v1/order');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
    curl_setopt( $ch, CURLOPT_HTTPHEADER,
        array(
            'Content-Type: application/json',
            'Authorization: Bearer '.CLIENT_TOKEN
        )
    );
    $response = json_decode(curl_exec($ch));
    curl_close($ch);
    if (isset($response->uuid)) {
        $arr = (array)$response;
        $arr['name'] = $_POST['name'];
        $arr['phone'] = $_POST['phone'];
        $url = THANKS_URL . (strrpos(THANKS_URL, '?') ? '&' : '?') .
            http_build_query($arr); // добавляем параметры
        header('Location: '. $url); // редирект
        exit;
    }
}
?>
