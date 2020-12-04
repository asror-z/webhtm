<?php

use zetsoft\dbitem\core\WebItem;
use zetsoft\models\page\PageBlocksType;
use zetsoft\service\ALL\App;
use zetsoft\system\Az;
use zetsoft\system\helpers\ZArrayHelper;
use zetsoft\system\helpers\ZFileHelper;

$action = new WebItem();
$action->title = Azl . 'Grapes';
$action->icon = 'fal fa-calendar-edit';
$action->type = WebItem::type['ajax'];
$action->csrf = true;
$action->cache = false;
$action->toolbar = false;
$action->debug = false;
$action->call = null;
$action->cacheHttp = false;

$this->paramSet(paramAction, $action);

$html = $this->httpPost('content');
$file = str_replace('/', '\\', $this->httpPost('file'));
$actions = $this->httpPost('actions');
$serialize = $this->httpGet('GrapeForm');

$css = $this->httpPost('css');
$css = str_replace(['"', '<style>', '{', '}', ';'], ['', "\n<style>\n", "{\n\t", "\n}\n", ";\n\t"], $css);

$service = Az::$app->App->eyuf->grape;
$content = $service->pregMatchFix($html);

$name = ZArrayHelper::getValue($serialize, 'name');
$page_blocks_type_id = ZArrayHelper::getValue($serialize, 'page_blocks_type_id');
$page_blocks_type = PageBlocksType::findOne($page_blocks_type_id);

$folderPath = Root . '/webhtm/block/' . $page_blocks_type->name . '/App';
if (!file_exists($folderPath))
    ZFileHelper::createDirectory($folderPath);

$path = Root . '/webhtm/block/' . $page_blocks_type->name . '/App/' . $name . '_' . App . '.php';
$content = $service->writeBlock($actions, $content, $css, $path);

file_put_contents($path, $content);
