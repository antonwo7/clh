<?php


class IA
{
    private $apiKey, $apiUrl;

    function __construct ($apiKey, $apiUrl)
    {
        $this->apiKey = $apiKey;
        $this->apiUrl = $apiUrl;
    }

    public function convertPDFToExcel (string $fileUrl)
    {
        $excelUrl = $this->sendConvertPDFToExcelRequest($fileUrl);
        return $excelUrl;
    }

    private function sendConvertPDFToExcelRequest (string $fileUrl)
    {
        $parameters = array();
        $parameters["url"] = $fileUrl;
//        $parameters["pages"] = $pages;
        $parameters["async"] = false;
        $data = json_encode($parameters);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("x-api-key: " . $this->apiKey, "Content-type: application/json"));
        curl_setopt($curl, CURLOPT_URL, $this->apiUrl . 'pdf/convert/to/xlsx');
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($curl);
        $result = json_decode($result, true);

        return !empty($result['url']) ? $result['url'] : null;
    }
}