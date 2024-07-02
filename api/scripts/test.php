<?php

require_once './../config.php';
require_once './../include/functions.php';
require_once './../vendor/autoload.php';

use \ConvertApi\ConvertApi;

ConvertApi::setApiSecret('oTrmLwGC47YRQFN1');
$result = ConvertApi::convert('xlsx', ['File' => TEMP_PATH . 'test.pdf']);
$result->saveFiles(TEMP_PATH . 'test-' . time() . '.xlsx');