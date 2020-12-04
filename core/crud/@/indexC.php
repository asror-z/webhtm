<?php

use yii\web\NotFoundHttpException;
use zetsoft\dbitem\core\WebItem;
use zetsoft\dbitem\data\Config;
use zetsoft\dbitem\data\ConfigDB;
use zetsoft\dbitem\data\FormDb;
use zetsoft\models\test\TestTerrabayt;
use zetsoft\system\helpers\ZInflector;
use zetsoft\system\kernels\ZView;
use zetsoft\system\kernels\ZWidget;
use zetsoft\system\module\Models;
use zetsoft\widgets\ajaxify\ZIntercoolerWidget;
use zetsoft\widgets\blocks\ZNProgressWidget;
use zetsoft\widgets\former\ZDynaWidgetRav;
use zetsoft\widgets\menus\ZMmenuWidget;


/** @var ZView $this */


/**
 *
 * Action Params
 */


/** @var Models $model */

$modelClassName = $this->bootFullUrl();
$this->beginPage();

//   $this->timeBefore('1');
if (class_exists($modelClassName))
    $model = new $modelClassName();
else
    throw new NotFoundHttpException();


$action = new WebItem();

$action->title = Azl . $model->configs->title;
$action->icon = 'fal fa-graduation-cap';
$action->type = WebItem::type['html'];
$action->csrf = true;
$action->loader = false;

if ($this->httpGet('spa'))
    $action->debug = false;


$this->paramSet(paramAction, $action);

$this->toolbar();
/**
 *
 * Start Page
 */


?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>


    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="google-site-verification" content="AIsF8XU-eXWtCRTAQo_GLIRcOF48YLENj--OoWFFft8" />
    <title>Заказы</title>
    <!--<link rel="prefetch" href="/render/menus/ZMMmenuWidget/img/logo.svg" as="image">
    <link rel="preload" href="/render/menus/ZMMmenuWidget/img/logo.svg" as="image">

    <link rel="prefetch" href="/render/former/ZDynaWidget/assets/img/edit.svg" as="image" type="image/svg+xml">

    <link rel="preload" href="/render/former/ZDynaWidget/assets/img/edit.svg" as="image" type="image/svg+xml">
    -->

    <!--<link rel="preload" href="http://mplace.zoft.uz/render/menus/ZMMmenuWidget/img/logo.svg" as="image">-->
    <!--<link rel="prefetch" href="/images/common/icons.svg" as="image" type="image/svg+xml"/>-->

    <!--
    <link rel="preload" href="/render/theme/ZFontYandexWidget/assets/fonts/sibirix/FuturaPT-Bold.woff" as="font"
          type="font/woff" crossorigin="anonymous">
    <link rel="preload"
          href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.8.2/webfonts/fa-regular-400.woff2" as="font"
          type="font/woff2" crossorigin="anonymous">

    --><!--<script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>-->






    <link type="image/x-icon" href="/favicon.ico" rel="icon">
    <link href="/render/asrorz/fontawesome-pro-5.12.0-web/css/all.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.8.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/render/asrorz/mdb/css/mdb.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/hint.css@2.6.0/hint.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/file-icon-vectors@1.0.0/dist/file-icon-classic.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/file-icon-vectors@1.0.0/dist/file-icon-square-o.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/file-icon-vectors@1.0.0/dist/file-icon-vivid.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/file-icon-vectors@1.0.0/dist/file-icon-vectors.min.css" rel="stylesheet">
    <link href="/render/asrorz/css/ALL.css" rel="stylesheet">
    <link href="/render/asrorz/css/font.css" rel="stylesheet">
    <link href="/render/asrorz/css/media.css" rel="stylesheet">
    <link href="/render/asrorz/css-app/market.css" rel="stylesheet">
    <link href="/render/asrorz/css/AdminLoader.css" rel="stylesheet">
    <link href="https://rawcdn.githack.com/IanLunn/Hover/5c9f92d2bcd6414f54b4f926fd4bb231e4ce9fd5/css/hover-min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@9.8.2/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="/render/ALL/jquery.loader.js-master/jquery.loader.min.css" rel="stylesheet">
    <link href="/render/theme/ZFontYandexWidget/assets/fonts/sibirix/stylesheet_01.css" rel="stylesheet">
    <link href="/render/asrorz/css/mmenu.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/mhead-js@2.0.0/dist/mhead.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/mburger-css@1.3.3/dist/mburger.css" rel="stylesheet">
    <link href="/render/menus/ZMMmenuWidget/assets/mmenu/fix-modal.css" rel="stylesheet">
    <link href="/render/menus/ZMMmenuWidget/assets/mmenu/mmenuextension.css" rel="stylesheet">
    <link href="/render/menus/ZMMmenuWidget/assets/mmenu-theme/white.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flag-icon-css@3.4.6/css/flag-icon.css" rel="stylesheet">
    <link href="/render/former/ZDynaWidget/assets/no_border.css" rel="stylesheet">
    <link href="/render/former/ZDynaWidget/assets/islom.css" rel="stylesheet">
    <link href="/render/former/ZDynaWidget/assets/main.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jquery-ui-dist@1.12.1/jquery-ui.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jspanel4@4.10.1/dist/jspanel.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <link href="/render/former/ZDynaSearchWidget/asset/css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/icheck-material@1.0.1/icheck-material.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/nprogress@0.2.0/nprogress.css" rel="stylesheet">
    <link href="/vendori/kernel/yiisofts/vendor/kartik-v/yii2-widget-activeform/src/assets/css/activeform.css" rel="stylesheet">
    <link href="/vendori/kernel/yiisofts/vendor/kartik-v/yii2-dynagrid/src/assets/css/kv-dynagrid.css" rel="stylesheet">
    <link href="/vendori/kernel/yiisofts/vendor/kartik-v/yii2-dialog/src/assets/css/bootstrap-dialog-bs4.css" rel="stylesheet">
    <link href="/vendori/kernel/yiisofts/vendor/kartik-v/yii2-grid/src/assets/css/kv-grid.css" rel="stylesheet">
    <link href="/vendori/kernel/yiisofts/vendor/kartik-v/yii2-grid/src/assets/css/kv-grid-expand.css" rel="stylesheet">
    <link href="/vendori/kernel/yiisofts/vendor/kartik-v/yii2-bootstrap4-dropdown/src/assets/css/dropdown.css" rel="stylesheet">
    <link href="/vendori/kernel/yiisofts/vendor/kartik-v/yii2-grid/src/assets/css/jquery.resizableColumns.css" rel="stylesheet">
    <link href="/vendori/kernel/yiisofts/vendor/kartik-v/yii2-grid/src/assets/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="/vendori/kernel/yiisofts/vendor/select2/select2/dist/css/select2.css" rel="stylesheet">
    <link href="/vendori/kernel/yiisofts/vendor/kartik-v/yii2-widget-select2/src/assets/css/select2-addl.css" rel="stylesheet">
    <link href="/vendori/kernel/yiisofts/vendor/kartik-v/yii2-widget-select2/src/assets/css/select2-krajee-bs4.css" rel="stylesheet">
    <link href="/vendori/kernel/yiisofts/vendor/kartik-v/yii2-krajee-base/src/assets/css/kv-widgets.css" rel="stylesheet">
    <link href="/vendori/kernel/yiisofts/vendor/kartik-v/yii2-widget-datepicker/src/assets/css/bootstrap-datepicker4.css" rel="stylesheet">
    <link href="/vendori/kernel/yiisofts/vendor/kartik-v/yii2-widget-datepicker/src/assets/css/datepicker-kv.css" rel="stylesheet">
    <link href="/vendori/kernel/yiisofts/vendor/kartik-v/yii2-widget-datetimepicker/src/assets/css/bootstrap-datetimepicker4.css" rel="stylesheet">
    <link href="/vendori/kernel/yiisofts/vendor/kartik-v/yii2-widget-datetimepicker/src/assets/css/datetimepicker-kv.css" rel="stylesheet">
    <style></style>
    <style>

        .home-mmenu{
            margin-right: 12px !important;
        }
        .mm-searchfield__input:hover{
            background: white;
        }

    </style>
    <style>        label.imgCheckbox {
            margin-bottom: 0 !important;
            width: 100% !important;
        }</style>
    <style>        .clicked {
            opacity: 0.4;
        }
        #w3-width {
            max-width: 1500px;
            width: 1200px;
        }

        .headerStyle {
            background-color: white !important;
        }

        iframe {
            border:none;
        }
    </style>
    <style>
        .displayValue-editable {
            width: 100%;
        }
    </style>
    <style>
        .sz:hover{

            box-shadow: -3px 6px 26px 2px rgba(179,165,179,0.58);
            /*font-size: 25px !important;*/
            /*margin-left: 5px !important;*/
            /*background-color:#0b71a6 !important; */
        }
        .logosz{
            display: block;
            text-indent: -9999px;
            width: 28px;
            height: 20px;
            background-size: 25px 25px;
            background-repeat: no-repeat;d
        background-size: cover;
        }
        .flag-icon-en {
            background-image: url(/render/iconers/ZLangPickerWidget/assets/flags/4x3/us.svg);
        }
        .flag-icon-ru {
            background-image: url(/render/iconers/ZLangPickerWidget/assets/flags/4x3/ru.svg);
        }
        .flag-icon-uzk{
            background-image: url(/render/iconers/ZLangPickerWidget/assets/flags/4x3/uzk.svg);
        }
        .flag-icon-uz {
            background-image: url(/render/iconers/ZLangPickerWidget/assets/flags/4x3/uz.svg);
        }</style>
    <style>        .jsPanel-title {
            margin: 15px 20px!important;
            font-size: 30px!important;
        }

        .jsPanel-content {
            overflow: hidden!important;
        }</style>
    <style>    .swal2-container {
            z-index: 999999!important;
        }</style>
    <style>
        .main {
            padding: 0;
        }

        .searchInput {
            padding: 10px;
            border: 1px solid #eee;
        }

        .searchInput:focus {
            border: 1px solid limegreen !important;
        }

        .reset {
            padding: 10px;
            border: 1px solid #eee;
        }

        .searchIcon {
            font-size: 20px;
        }</style>
    <style>        .jsPanel-title {
            margin: 10px!important;
            font-size: 30px!important;
        }
    </style>
    <style>
        .close-sweetalert {
            margin-top: -10px;
            font-size: 20px;
            transition: all 0.2s;
        }

        #swal2-title {
            margin-top: 5px;
            font-size: 22px;
            display: flex;
            margin: 1% 30px;
            margin-right: 50px;
        }

        .swal2-footer {
            justify-content: flex-end !important;
            margin: 0 !important;
            padding: 0 20px !important;
            border: none !important;
        }
    </style>
    <style>    .jsPanel{
            z-index: 9999!important;
        }</style>
    <style>
        .overflow-no {
            overflow: hidden!important;
        }

        .readonly {
            cursor:pointer;
            color:#000000!important;
        }

        .point-raw {
            width:auto;
            color: #544d9d;
            cursor:pointer;
        }

        .numeratsiya{
            width: 3%!important;
            white-space: nowrap;
        }

        .dynaActions {
            white-space: nowrap;
        }

        .width-deystviya{
            width: !important;
        }

        .content-footer{
            line-height: 16px!important;
        }

        .tbody {
            height: 70vh!important;
            padding-right: 3px!important;
            padding-left: 3px!important;
            padding-bottom: 13px!important;
            overflow-x: hidden!important;
        }

        .grid-view .card{
            border: none !important;
        }

        .tscroll{
            height: 0.1rem;
        }


        .editable-dyna-id {
            width: 50px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-name {
            width: 250px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-code {
            width: 130px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-number {
            width: 100px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-user_id {
            width: 120px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-parent {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-children {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-contact_name {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-status_universal {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-contact_phone {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-add_contact_phone {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-date {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-comment_user {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-responsible {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-place_adress_id {
            width: 220px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-place_region_id {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-distance {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-user_company_ids {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-operator {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-comment_agent {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-tasks {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-source {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-source_type {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-called_time {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-shop_reject_cause_id {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-cpas_track {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-status_client {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-status_callcenter {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-status_autodial {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-status_logistics {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-status_accept {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-status_deliver {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-date_deliver {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-date_approve {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-date_return {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-delayed_deliver_date {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-shop_delay_id {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-shop_delay_cause_id {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-packaging {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-labelled {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-fragile {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-weight {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-weight_plan {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-volume {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-shop_shipment_id {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-price {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-prepayment {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-deliver_price {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-total_price {
            width: 100px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-shop_coupon_id {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-shop_channel_id {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-payment_type {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-additional_payment_type {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-additional_deliver {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-additional_received_money {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-accepted {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-shop_element_ids {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-ware_ids {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-deleted_at {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-deleted_by {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-deleted_text {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-created_at {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-modified_at {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-created_by {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }

        .editable-dyna-modified_by {
            width: 200px!important;
        }

        .pjaxnum{
            padding: 20px!important;
        }

        .editable-dyna-id{
            width: 100%!important;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.4.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-slimscroll@1.3.8/jquery.slimscroll.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.2/dist/sweetalert2.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.2/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@beta/dist/js.cookie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-popover-x@1.4.7/js/bootstrap-popover-x.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/mobile-detect@1.4.4/mobile-detect.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.min.js"></script>
    <script src="/render/asrorz/market/js/loadData.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootbox@5.4.0/dist/bootbox.all.min.js"></script>
    <script src="/render/ALL/jquery.loader.js-master/jquery.loader.min.js"></script>
    <script src="/render/asrorz/js/bootstrap-iconpicker.min.js"></script>
    <script src="/render/asrorz/js/ALL.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/mmenu-js@8.5.13/dist/mmenu.polyfills.js"></script>
    <script src="/render/asrorz/js/mmenu.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/mhead-js@2.0.0/dist/mhead.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2.2.1/src/js.cookie.js"></script>
    <script src="/render/asrorz/js/imageCheckCurrency.js"></script>
    <script src="/render/asrorz/market/js/navbar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.4.0/bootbox.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/onscan.js@1.5.2/onscan.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-ui-dist@1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/copy-to-clipboard@3.3.1/example/index.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jspanel4@4.10.1/dist/jspanel.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jspanel4@4.10.1/dist/extensions/modal/jspanel.modal.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jspanel4@4.10.1/dist/extensions/tooltip/jspanel.tooltip.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jspanel4@4.10.1/dist/extensions/hint/jspanel.hint.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jspanel4@4.10.1/dist/extensions/layout/jspanel.layout.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jspanel4@4.10.1/dist/extensions/contextmenu/jspanel.contextmenu.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jspanel4@4.10.1/dist/extensions/dock/jspanel.dock.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.3/dist/jquery.inputmask.js"></script>
    <script src="/vendori/kernel/yiisofts/vendor/kartik-v/yii2-dialog/src/assets/js/dialog.js"></script>
    <script>var krajeeDialogDefaults_d92bf583 = {"alert":{"type":"type-info","title":"Информация","buttonLabel":"<span class=\"fas fa-check\"></span> Ok"},"confirm":{"type":"type-warning","title":"Подтверждение","btnOKClass":"btn-warning","btnOKLabel":"<span class=\"fas fa-check\"></span> Ok","btnCancelLabel":"<span class=\"fas fa-ban\"></span>  Отмена"},"prompt":{"draggable":false,"title":"Информация","buttons":[{"label":"Отмена","icon":"fas fa-ban","cssClass":"btn-outline-secondary"},{"label":"Ok","icon":"fas fa-check","cssClass":"btn-primary"}],"closable":false},"dialog":{"draggable":true,"title":"Информация","buttons":[{"label":"Отмена","icon":"fas fa-ban","cssClass":"btn-outline-secondary"},{"label":"Ok","icon":"fas fa-check","cssClass":"btn-primary"}]}};
        var krajeeDialog_dfeddae9 = {"id":"w37"};
        var krajeeDialog=new KrajeeDialog(true,krajeeDialog_dfeddae9,krajeeDialogDefaults_d92bf583);
        var kvExpandRow_57dbe199 = {"gridId":"w38","hiddenFromExport":true,"detailUrl":"/crud/shop-order/expand.aspx","onDetailLoaded":"","expandIcon":"<span class=\"far fa-plus-square\"></span>","collapseIcon":"<span class=\"far fa-minus-square\"></span>","expandTitle":"","collapseTitle":"","expandAllTitle":"","collapseAllTitle":"","rowCssClass":"default","animationDuration":"fast","expandOneOnly":true,"enableRowClick":false,"enableCache":false,"rowClickExcludedTags":["A","BUTTON","INPUT"],"collapseAll":false,"expandAll":false,"extraData":[],"msgDetailLoading":"<small>Loading &hellip;</small>"};

        var krajeeDialog_a6f88bf1 = {"id":"w41"};
        var krajeeDialog=new KrajeeDialog(true,krajeeDialog_a6f88bf1,krajeeDialogDefaults_d92bf583);
        var s2options_e9bc2761 = {"themeCss":".select2-container--krajee-bs4","sizeCss":"","doReset":true,"doToggle":false,"doOrder":false};
        window.select2_77f141fd = {"placeholder":"","allowClear":true,"id":true,"disabled":false,"name":true,"element":[],"minimumInputLength":0,"tags":false,"tokenSeparators":[","," "],"ajax":{"url":"\/api\/core\/select\/select2.aspx?modelClassName=ShopOrder\u0026attribute=user_id\u0026modelId=\u0026limit=7","dataType":"json","delay":250,"processResults":null,"cache":true},"":"","theme":"krajee-bs4","language":"ru"};

        window.select2_9c83a47b = {"placeholder":"","allowClear":true,"id":true,"disabled":false,"name":true,"element":[],"minimumInputLength":0,"tags":false,"tokenSeparators":[","," "],"ajax":{"url":"\/api\/core\/select\/select2.aspx?modelClassName=ShopOrder\u0026attribute=parent\u0026modelId=\u0026limit=7","dataType":"json","delay":250,"processResults":null,"cache":true},"":"","theme":"krajee-bs4","language":"ru"};

        var s2options_608c74da = {"themeCss":".select2-container--krajee-bs4","sizeCss":"","doReset":true,"doToggle":true,"doOrder":false};
        window.select2_16b783ee = {"placeholder":"","allowClear":true,"id":true,"disabled":false,"name":true,"element":[],"minimumInputLength":0,"tags":false,"tokenSeparators":[","," "],"ajax":{"url":"\/api\/core\/select\/select2.aspx?modelClassName=ShopOrder\u0026attribute=children\u0026modelId=\u0026limit=7","dataType":"json","delay":250,"processResults":null,"cache":true},"":"","theme":"krajee-bs4","language":"ru"};

        window.select2_b0dd059c = {"placeholder":"","allowClear":true,"id":true,"disabled":false,"name":true,"element":[],"minimumInputLength":0,"tags":false,"tokenSeparators":[","," "],"ajax":{"url":"\/api\/core\/select\/select2.aspx?modelClassName=ShopOrder\u0026attribute=status_universal\u0026modelId=\u0026limit=7","dataType":"json","delay":250,"processResults":null,"cache":true},"":"","theme":"krajee-bs4","language":"ru"};

        window.kvDatepicker_c12d1a5e = {"orientation":"bottom","autoclose":true,"assumeNearbyYear":false,"calendarWeeks":false,"container":"body","datesDisabled":[],"daysOfWeekDisabled":[],"daysOfWeekHighlighted":[],"disableTouchKeyboard":true,"enableOnReadonly":true,"endDate":"","forceParse":true,"format":"yyyy-mm-dd","immediateUpdates":false,"keepEmptyValues":false,"keyboardNavigation":true,"language":"ru","maxViewMode":4,"minViewMode":0,"multidate":false,"multidateSeparator":",","showOnFocus":true,"startDate":null,"startView":0,"showWeekDays":true,"templates":{"leftArrow":"\u0026laquo;","rightArrow":"\u0026raquo;"},"title":"","todayBtn":false,"todayHighlight":true,"toggleActive":true,"weekStart":0,"zIndexOffset":10};

        window.select2_8e1c58b7 = {"placeholder":"","allowClear":true,"id":true,"disabled":false,"name":true,"element":[],"minimumInputLength":0,"tags":false,"tokenSeparators":[","," "],"ajax":{"url":"\/api\/core\/select\/select2.aspx?modelClassName=ShopOrder\u0026attribute=responsible\u0026modelId=\u0026limit=7","dataType":"json","delay":250,"processResults":null,"cache":true},"":"","theme":"krajee-bs4","language":"ru"};

        window.select2_440fd514 = {"placeholder":"","allowClear":true,"id":true,"disabled":false,"name":true,"element":[],"minimumInputLength":0,"tags":false,"tokenSeparators":[","," "],"ajax":{"url":"\/api\/core\/select\/select2.aspx?modelClassName=ShopOrder\u0026attribute=place_adress_id\u0026modelId=\u0026limit=7","dataType":"json","delay":250,"processResults":null,"cache":true},"":"","theme":"krajee-bs4","language":"ru"};

        window.select2_3582850a = {"placeholder":"","allowClear":true,"id":true,"disabled":false,"name":true,"element":[],"minimumInputLength":0,"tags":false,"tokenSeparators":[","," "],"ajax":{"url":"\/api\/core\/select\/select2.aspx?modelClassName=ShopOrder\u0026attribute=place_region_id\u0026modelId=\u0026limit=7","dataType":"json","delay":250,"processResults":null,"cache":true},"":"","theme":"krajee-bs4","language":"ru"};

        window.select2_0126ab5a = {"placeholder":"","allowClear":true,"id":true,"disabled":false,"name":true,"element":[],"minimumInputLength":0,"tags":false,"tokenSeparators":[","," "],"ajax":{"url":"\/api\/core\/select\/select2.aspx?modelClassName=ShopOrder\u0026attribute=user_company_ids\u0026modelId=\u0026limit=7","dataType":"json","delay":250,"processResults":null,"cache":true},"":"","theme":"krajee-bs4","language":"ru"};

        window.select2_7e413270 = {"placeholder":"","allowClear":true,"id":true,"disabled":false,"name":true,"element":[],"minimumInputLength":0,"tags":false,"tokenSeparators":[","," "],"":"","theme":"krajee-bs4","language":"ru"};

        window.select2_04703b5f = {"placeholder":"","allowClear":true,"id":true,"disabled":false,"name":true,"element":[],"minimumInputLength":0,"tags":false,"tokenSeparators":[","," "],"ajax":{"url":"\/api\/core\/select\/select2.aspx?modelClassName=ShopOrder\u0026attribute=source\u0026modelId=\u0026limit=7","dataType":"json","delay":250,"processResults":null,"cache":true},"":"","theme":"krajee-bs4","language":"ru"};

        window.select2_92cfd1a7 = {"placeholder":"","allowClear":true,"id":true,"disabled":false,"name":true,"element":[],"minimumInputLength":0,"tags":false,"tokenSeparators":[","," "],"ajax":{"url":"\/api\/core\/select\/select2.aspx?modelClassName=ShopOrder\u0026attribute=source_type\u0026modelId=\u0026limit=7","dataType":"json","delay":250,"processResults":null,"cache":true},"":"","theme":"krajee-bs4","language":"ru"};

        window.datetimepicker_380c1b41 = {"bootcssVer":3,"icontype":"fas","fontAwesome":true,"icons":{"leftArrow":"fa-arrow-left","rightArrow":"fa-arrow-right"},"format":"d-m-yyyy","weekStart":0,"startDate":"","endDate":"","daysOfWeekDisabled":"","autoclose":true,"startView":2,"timezone":"Asia\/Tashkent","language":"ru"};

        window.select2_bd5b86fe = {"placeholder":"","allowClear":true,"id":true,"disabled":false,"name":true,"element":[],"minimumInputLength":0,"tags":false,"tokenSeparators":[","," "],"ajax":{"url":"\/api\/core\/select\/select2.aspx?modelClassName=ShopOrder\u0026attribute=shop_reject_cause_id\u0026modelId=\u0026limit=7","dataType":"json","delay":250,"processResults":null,"cache":true},"":"","theme":"krajee-bs4","language":"ru"};

        window.select2_c8a6f295 = {"placeholder":"","allowClear":true,"id":true,"disabled":false,"name":true,"element":[],"minimumInputLength":0,"tags":false,"tokenSeparators":[","," "],"ajax":{"url":"\/api\/core\/select\/select2.aspx?modelClassName=ShopOrder\u0026attribute=status_client\u0026modelId=\u0026limit=7","dataType":"json","delay":250,"processResults":null,"cache":true},"":"","theme":"krajee-bs4","language":"ru"};

        window.select2_159204ec = {"placeholder":"","allowClear":true,"id":true,"disabled":false,"name":true,"element":[],"minimumInputLength":0,"tags":false,"tokenSeparators":[","," "],"ajax":{"url":"\/api\/core\/select\/select2.aspx?modelClassName=ShopOrder\u0026attribute=status_callcenter\u0026modelId=\u0026limit=7","dataType":"json","delay":250,"processResults":null,"cache":true},"":"","theme":"krajee-bs4","language":"ru"};

        window.select2_593354d1 = {"placeholder":"","allowClear":true,"id":true,"disabled":false,"name":true,"element":[],"minimumInputLength":0,"tags":false,"tokenSeparators":[","," "],"ajax":{"url":"\/api\/core\/select\/select2.aspx?modelClassName=ShopOrder\u0026attribute=status_autodial\u0026modelId=\u0026limit=7","dataType":"json","delay":250,"processResults":null,"cache":true},"":"","theme":"krajee-bs4","language":"ru"};

        window.select2_99a39639 = {"placeholder":"","allowClear":true,"id":true,"disabled":false,"name":true,"element":[],"minimumInputLength":0,"tags":false,"tokenSeparators":[","," "],"ajax":{"url":"\/api\/core\/select\/select2.aspx?modelClassName=ShopOrder\u0026attribute=status_logistics\u0026modelId=\u0026limit=7","dataType":"json","delay":250,"processResults":null,"cache":true},"":"","theme":"krajee-bs4","language":"ru"};

        window.select2_d7ed6e79 = {"placeholder":"","allowClear":true,"id":true,"disabled":false,"name":true,"element":[],"minimumInputLength":0,"tags":false,"tokenSeparators":[","," "],"ajax":{"url":"\/api\/core\/select\/select2.aspx?modelClassName=ShopOrder\u0026attribute=status_accept\u0026modelId=\u0026limit=7","dataType":"json","delay":250,"processResults":null,"cache":true},"":"","theme":"krajee-bs4","language":"ru"};

        window.select2_8b341767 = {"placeholder":"","allowClear":true,"id":true,"disabled":false,"name":true,"element":[],"minimumInputLength":0,"tags":false,"tokenSeparators":[","," "],"ajax":{"url":"\/api\/core\/select\/select2.aspx?modelClassName=ShopOrder\u0026attribute=status_deliver\u0026modelId=\u0026limit=7","dataType":"json","delay":250,"processResults":null,"cache":true},"":"","theme":"krajee-bs4","language":"ru"};

        window.kvDatepicker_4f8529f8 = {"orientation":"bottom","autoclose":true,"assumeNearbyYear":false,"calendarWeeks":false,"container":"body","datesDisabled":[],"daysOfWeekDisabled":[],"daysOfWeekHighlighted":[],"disableTouchKeyboard":true,"enableOnReadonly":true,"endDate":"","forceParse":true,"format":"d-m-yyyy","immediateUpdates":false,"keepEmptyValues":false,"keyboardNavigation":true,"language":"ru","maxViewMode":4,"minViewMode":0,"multidate":false,"multidateSeparator":",","showOnFocus":true,"startDate":null,"startView":0,"showWeekDays":true,"templates":{"leftArrow":"\u0026laquo;","rightArrow":"\u0026raquo;"},"title":"","todayBtn":false,"todayHighlight":true,"toggleActive":true,"weekStart":0,"zIndexOffset":10};

        window.select2_74598fd1 = {"placeholder":"","allowClear":true,"id":true,"disabled":false,"name":true,"element":[],"minimumInputLength":0,"tags":true,"tokenSeparators":[","," "],"ajax":{"url":"\/api\/core\/select\/select2.aspx?modelClassName=ShopOrder\u0026attribute=shop_delay_id\u0026modelId=\u0026limit=7","dataType":"json","delay":250,"processResults":null,"cache":true},"":"","theme":"krajee-bs4","language":"ru"};

        window.select2_bf5a1cd2 = {"placeholder":"","allowClear":true,"id":true,"disabled":false,"name":true,"element":[],"minimumInputLength":0,"tags":true,"tokenSeparators":[","," "],"ajax":{"url":"\/api\/core\/select\/select2.aspx?modelClassName=ShopOrder\u0026attribute=shop_delay_cause_id\u0026modelId=\u0026limit=7","dataType":"json","delay":250,"processResults":null,"cache":true},"":"","theme":"krajee-bs4","language":"ru"};

        window.select2_7b3c0e95 = {"placeholder":"","allowClear":true,"id":true,"disabled":false,"name":true,"element":[],"minimumInputLength":0,"tags":false,"tokenSeparators":[","," "],"ajax":{"url":"\/api\/core\/select\/select2.aspx?modelClassName=ShopOrder\u0026attribute=packaging\u0026modelId=\u0026limit=7","dataType":"json","delay":250,"processResults":null,"cache":true},"":"","theme":"krajee-bs4","language":"ru"};

        window.select2_ae52bca2 = {"placeholder":"","allowClear":true,"id":true,"disabled":false,"name":true,"element":[],"minimumInputLength":0,"tags":false,"tokenSeparators":[","," "],"ajax":{"url":"\/api\/core\/select\/select2.aspx?modelClassName=ShopOrder\u0026attribute=shop_shipment_id\u0026modelId=\u0026limit=7","dataType":"json","delay":250,"processResults":null,"cache":true},"":"","theme":"krajee-bs4","language":"ru"};

        window.select2_575f3158 = {"placeholder":"","allowClear":true,"id":true,"disabled":false,"name":true,"element":[],"minimumInputLength":0,"tags":false,"tokenSeparators":[","," "],"ajax":{"url":"\/api\/core\/select\/select2.aspx?modelClassName=ShopOrder\u0026attribute=shop_coupon_id\u0026modelId=\u0026limit=7","dataType":"json","delay":250,"processResults":null,"cache":true},"":"","theme":"krajee-bs4","language":"ru"};

        window.select2_43915666 = {"placeholder":"","allowClear":true,"id":true,"disabled":false,"name":true,"element":[],"minimumInputLength":0,"tags":false,"tokenSeparators":[","," "],"ajax":{"url":"\/api\/core\/select\/select2.aspx?modelClassName=ShopOrder\u0026attribute=shop_channel_id\u0026modelId=\u0026limit=7","dataType":"json","delay":250,"processResults":null,"cache":true},"":"","theme":"krajee-bs4","language":"ru"};

        window.select2_5efb8764 = {"placeholder":"","allowClear":true,"id":true,"disabled":false,"name":true,"element":[],"minimumInputLength":0,"tags":false,"tokenSeparators":[","," "],"ajax":{"url":"\/api\/core\/select\/select2.aspx?modelClassName=ShopOrder\u0026attribute=payment_type\u0026modelId=\u0026limit=7","dataType":"json","delay":250,"processResults":null,"cache":true},"":"","theme":"krajee-bs4","language":"ru"};

        window.select2_93cc5624 = {"placeholder":"","allowClear":true,"id":true,"disabled":false,"name":true,"element":[],"minimumInputLength":0,"tags":false,"tokenSeparators":[","," "],"ajax":{"url":"\/api\/core\/select\/select2.aspx?modelClassName=ShopOrder\u0026attribute=additional_payment_type\u0026modelId=\u0026limit=7","dataType":"json","delay":250,"processResults":null,"cache":true},"":"","theme":"krajee-bs4","language":"ru"};

        window.select2_df2b42e3 = {"placeholder":"","allowClear":true,"id":true,"disabled":false,"name":true,"element":[],"minimumInputLength":0,"tags":false,"tokenSeparators":[","," "],"ajax":{"url":"\/api\/core\/select\/select2.aspx?modelClassName=ShopOrder\u0026attribute=shop_element_ids\u0026modelId=\u0026limit=7","dataType":"json","delay":250,"processResults":null,"cache":true},"":"","theme":"krajee-bs4","language":"ru"};

        window.select2_0cad87e1 = {"placeholder":"","allowClear":true,"id":true,"disabled":false,"name":true,"element":[],"minimumInputLength":0,"tags":false,"tokenSeparators":[","," "],"ajax":{"url":"\/api\/core\/select\/select2.aspx?modelClassName=ShopOrder\u0026attribute=ware_ids\u0026modelId=\u0026limit=7","dataType":"json","delay":250,"processResults":null,"cache":true},"":"","theme":"krajee-bs4","language":"ru"};

        window.select2_ff26407a = {"placeholder":"","allowClear":true,"id":true,"disabled":false,"name":true,"element":[],"minimumInputLength":0,"tags":false,"tokenSeparators":[","," "],"ajax":{"url":"\/api\/core\/select\/select2.aspx?modelClassName=ShopOrder\u0026attribute=deleted_by\u0026modelId=\u0026limit=7","dataType":"json","delay":250,"processResults":null,"cache":true},"":"","theme":"krajee-bs4","language":"ru"};

        window.select2_3fd3e919 = {"placeholder":"","allowClear":true,"id":true,"disabled":false,"name":true,"element":[],"minimumInputLength":0,"tags":false,"tokenSeparators":[","," "],"ajax":{"url":"\/api\/core\/select\/select2.aspx?modelClassName=ShopOrder\u0026attribute=created_by\u0026modelId=\u0026limit=7","dataType":"json","delay":250,"processResults":null,"cache":true},"":"","theme":"krajee-bs4","language":"ru"};

        window.select2_736b77ef = {"placeholder":"","allowClear":true,"id":true,"disabled":false,"name":true,"element":[],"minimumInputLength":0,"tags":false,"tokenSeparators":[","," "],"ajax":{"url":"\/api\/core\/select\/select2.aspx?modelClassName=ShopOrder\u0026attribute=modified_by\u0026modelId=\u0026limit=7","dataType":"json","delay":250,"processResults":null,"cache":true},"":"","theme":"krajee-bs4","language":"ru"};
    </script>
</head>


<?php

    /* require Root . '/webhtm/block/metas/main.php';
     require Root . '/webhtm/block/assets/main.php';*/

    $this->head();

    ?>

</head>


<body class="<?= ZWidget::skin['white-skin'] ?>">

<?php

$this->beginBody();

//echo ZNProgressWidget::widget([]);

/*if (!$this->httpGet('spa'))
    echo ZMmenuWidget::widget()*/

?>

<div id="page">

    <?
    /*    if (!$this->httpGet('spa'))
            require Root . '/webhtm/block/navbar/admin.php';*/

    /*   echo ZSessionGrowlWidget::widget();

   */
    /*    require Root . '/webhtm/block/header/main.php';
        require Root . '/webhtm/block/navbar/admin.php';*/
    ?>

    <div id="content" class="content-footer p-3">


        <div class="row">
            <div class="col-md-12 col-12">

                <?

                $model->configs->orderCheck = true;
                $model->configs->editClass = ALLData::editClass['sweetAs'];
                $model->configs->type = ALLData::type['array'];

                ///       $model->columns();

                echo $this->cacheRedis('aa', function () use ($model) {
                    return ZDynaWidgetRav::widget([
                        'model' => $model,
                    ]);
                });


                //    vdd(get_declared_classes());


                //     file_put_contents('11.txt', $app);

                /** @var ZView $this */

                /*   echo ZDynaWidget::widget([
                       'model' => $model,
                       'config' => [
                           'perfectScrollbar' => false,
                       ]
                   ]);*/

                ?>

            </div>
        </div>


    </div>
    <!-- --><? /*= $this->require( '/webhtm\block\footer\mplace\footerAll.php') */ ?>
</div>


<?php $this->endBody() ?>

</body>
</html>

<?php $this->endPage() ?>
