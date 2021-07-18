<?php
declare(strict_types=1);

error_reporting(E_ALL);
require_once __DIR__ . '/vendor/autoload.php';

use taskforce\models\actions\DataConverter;
use taskforce\models\actions\DirectoryScan;


$directory = 'data/';
$csvExtension = '.csv';
$directorySql = 'data/sql/';
if(!file_exists(__DIR__.'/'.$directorySql)) {
    mkdir(__DIR__.'/'.$directorySql,0777);
}
$csvFiles = new DirectoryScan($directory);
$csvFilesList = $csvFiles->showFiles($csvExtension);
//
$csvConverter = new DataConverter($directorySql);

foreach ($csvFilesList as $csvFile) {
    $csvConverter->convert($csvFile);
}
