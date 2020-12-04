<?php

$data = $this->httpPost('pcontent');
$file = str_replace('/', '\\', $this->httpGet('file'));


$content = Az::$app->utility->pregs->pregReplace($data, '<link[^>]*>+', '');
$content = Az::$app->utility->pregs->pregReplace($content, '<style[^>]*>(?:[^<]+|<\/style>)+', '');
$content = Az::$app->utility->pregs->pregReplace($content, '<script[\s\S]*?>[\s\S]*?<\/script>', '');
$content = Az::$app->utility->pregs->pregReplace($content, '<!--BEGIN(.|\s)*?END-->', '');

$content = str_replace(['<!--', '-->'], ["\n\n<?php\n\n", "\n\n?>\n\n"], $content);


$fileContent = file_get_contents($file);





file_put_contents($file, $content);


?>
