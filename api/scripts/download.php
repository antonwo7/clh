<?php

require_once './../config.php';
require_once './../vendor/autoload.php';

header('Access-Control-Allow-Origin: *');
header('Content-Type: *');
header('Content-Disposition: *');
header('Access-Control-Allow-Headers: *');
header('*');

$error = json_encode(['result' => false, 'message' => 'Files empty']);

if (empty($_POST['file'])) {
    echo $error;
    die();
}

$filePath = $_POST['file'];//"EDS-1695859655\\EDS-1.docx";//$_POST['file'];
$fileName = basename($filePath);
$fileFullPath = FILES_PATH . $filePath;

header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Description: File Transfer');
header('Content-Disposition: attachment; filename=' . $fileFullPath);
//header('Expires: 0');
//header('Pragma: public');

if($fd = fopen($fileFullPath, 'r')){
    while (!feof($fd)){
        echo fread($fd, 1024);
    }
    fclose($fd);
}
