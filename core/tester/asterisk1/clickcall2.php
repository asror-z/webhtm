<?php
namespace zetsoft\service\calls;

use zetsoft\service\calls\FtpWriteCall;




?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        button{
            padding: 10px 20px;
            margin: 20px;
            cursor: pointer;
            background: #27ae60;
            color: #fff;
            font-weight: bold;
            border: none;

        }
    </style>
</head>
<body>
<a href="/core/tester/asterisk/clickcall.aspx?ext=202">
    <button>202</button>
</a>
<a href="/core/tester/asterisk/clickcall.aspx?ext=300">
    <button>300</button>
</a>
<a href="/core/tester/asterisk/clickcall.aspx?ext=400">
    <button>400</button>
</a>
<a href="/core/tester/asterisk/clickcall.aspx?ext=701">
    <button>701</button>
</a>
</body>
</html>


<?php
$ext  = $_GET['ext'] ?? '';

Az::$app->asteriskk->cc->call($ext, '202');
?>
