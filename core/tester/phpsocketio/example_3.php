<?php
use zetsoft\system\Az;
use zetsoft\system\kernels\ZView;

/** @var ZView $this */
$action = new WebItem();

$this->title = Az::l('example_3');
$action->type = WebItem::type['html'];
$action->icon =1;

?>


<script src="https://cdn.jsdelivr.net/npm/detectrtc@1.4.0/DetectRTC.min.js"></script>
<script>
    if (DetectRTC.isWebRTCSupported === false) {
        alert('Please use Chrome or Firefox.');
    }

    if (DetectRTC.hasWebcam === false) {
        alert('Please install an external webcam device.');
    }

    if (DetectRTC.hasMicrophone === false) {
        alert('Please install an external microphone device.');
    }

    if (DetectRTC.hasSpeakers === false && (DetectRTC.browser.name === 'Chrome' || DetectRTC.browser.name === 'Edge')) {
        alert('Oops, your system can not play audios.');
    }
    DetectRTC.load(function () {
        console.log(DetectRTC);
    });
</script>
