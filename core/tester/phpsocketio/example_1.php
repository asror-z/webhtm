<?php
    $fileLocation = Root . 'upload\eyuf\CoreTest\\';

// RECEIVE UPLOADS:
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isFileUploadRequest = $_POST['sentPhotos'];
    if ($isFileUploadRequest) {
        vdd($isFileUploadRequest);

        $filePondArray = $_POST['filepond'];

        $baseFileLocation = $this->fileLocation;
        $numFilePondObjects = sizeof($filePondArray);
        if ( !$numFilePondObjects ) { die('No photos sent!'); }

        echo '<b>You sent '.$numFilePondObjects.' pics. Each pic has 3 versions.</b><br>';

        // iterate through the objects...
        for ($xx=0; $xx<$numFilePondObjects; $xx++) {

            $thisFilePondJSON_object = $filePondArray[$xx];

            $thisFilePondArray = json_decode($thisFilePondJSON_object, true);

            // isolate the encoded pics...
            $thisFilePondArray_picData = $thisFilePondArray['data'];
            $thisFilePondArray_numPics = sizeof($thisFilePondArray_picData);

            // iterate through pics in this object...
            for ($yy=0; $yy<$thisFilePondArray_numPics; $yy++){

                $thisPic_PhotoNumber = $xx + 1;

                $thisPic_version = $thisFilePondArray_picData[$yy]['name'];
                if (!$thisPic_version) { $thisPic_version = 'v1_50px'; }
                $thisPic_name_temp = 'photo_' . $thisPic_PhotoNumber . '_'. $thisPic_version .'.jpg';

                $thisPic_encodedData = $thisFilePondArray_picData[$yy]['data'];
                $thisPic_decodedData = base64_decode($thisPic_encodedData);

                $thisPic_fullPathAndName = $baseFileLocation . $thisPic_name_temp;
                echo '<br>Photo will save as: <b>'. $thisPic_fullPathAndName .'</b>';
                //write the pic here
                //file_put_contents($thisPic_fullPathAndName, $thisPic_decodedData);

            }

            echo '<br>';

        }
    }
}

?>

<?php

echo zetsoft\widgets\inptest\ZFilepondWidget::widget();

?>
