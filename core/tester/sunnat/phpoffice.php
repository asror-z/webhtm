<a href="/core/tester/sunnat/excel1.aspx">Excel test</a>

<?php

use PhpOffice\PhpSpreadsheet\Reader\Ods;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$reader = new Ods();
$spreadsheet = $reader->load("D:/Develop/Projects/ALL/asrorz/zettest/binary/excels/Native.xlsx/binary/excels/Native.xlsx");

