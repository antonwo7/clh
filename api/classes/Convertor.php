<?php


use PhpOffice\PhpSpreadsheet\IOFactory;
use \ConvertApi\ConvertApi;

class Convertor
{
    private $filePath;

    function __construct ($filePath)
    {
        $this->filePath = $filePath;
        ConvertApi::setApiSecret(AI_API_KEY);
    }

    public function convertToExcel ()
    {
        $ExcelFilePath = str_replace(['.PDF', '.pdf'], '.xlsx', $this->filePath);
        $result = ConvertApi::convert('xlsx', ['File' => $this->filePath]);
        $result->saveFiles($ExcelFilePath);

        return $ExcelFilePath;
    }
}