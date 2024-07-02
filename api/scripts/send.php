<?php

error_reporting(0);
ini_set('error_reporting', 0);
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);

require_once './../config.php';
require_once './../include/functions.php';
require_once './../vendor/autoload.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: *');
header('Content-Disposition: *');
header('Access-Control-Allow-Headers: *');
header('*');

if (empty($_FILES)) {
    error('Post data empty');
}

include_once "../classes/Upload.php";
include_once "../classes/Excel.php";

$upload = new Upload('Uploaded-' . time() . '.xlsx');
$filePath = $upload->uploadFile($_FILES['file_0']);
if (!$filePath) {
    error('Filepath empty');
}

$excel = new Excel($filePath);
$filename = $excel->save();

$finalExcelUrl = FILES_URL . $filename;

echo json_encode([
    'result' => true,
    'excel' => $finalExcelUrl
]);