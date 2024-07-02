<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Spreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Excel
{
    private $filePath;
    private $operationTable = [];
    private $periodTable = [];
    private $liqs = [];
    private $spreadSheet;

    function __construct ($filePath)
    {
        $this->filePath = $filePath;
        $this->spreadSheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($this->filePath);
        $this->getOperations();
        $this->getPeriods();
        $this->getLiqs();
        $this->setLiqs();
    }

    private function getOperations()
    {
        $sheet = $this->spreadSheet->getSheet(2);
        foreach ($sheet->getRowIterator() as $row) {
            $rowIndex = $row->getRowIndex();
            if ($rowIndex < 2) continue;

            $row = [
                'date' => $this->getExcelDate($sheet, 'I' . $rowIndex),
                'concept' => trim($sheet->getCell('J' . $rowIndex)->getValue()),
                'import' => trim($sheet->getCell('K' . $rowIndex)->getValue()),
                'dh' => trim($sheet->getCell('L' . $rowIndex)->getValue()),
                'date_value' => $this->getExcelDate($sheet, 'M' . $rowIndex),
            ];

            if (empty($row['date'])) {
                break;
            }

            $this->operationTable[] = $row;
        }
    }

    private function getPeriods()
    {
        $sheet = $this->spreadSheet->getSheet(4);
        foreach ($sheet->getRowIterator() as $row) {
            $rowIndex = $row->getRowIndex();
            if ($rowIndex < 11) continue;

            $value = $this->getExcelDate($sheet, 'H' . $rowIndex);

            if (empty($value)) {
                break;
            }

            $this->periodTable[] = $value;
        }
    }

    private function getLiqs()
    {
        foreach ($this->periodTable as $i => $periodData) {
            $dateFrom = $i === 0 ? DateTime::createFromFormat('d/m/Y', '01/01/1970') : DateTime::createFromFormat('d/m/Y', $this->periodTable[$i - 1]);
            $dateTo = DateTime::createFromFormat('d/m/Y', $this->periodTable[$i]);

            $liq = array_values(array_filter($this->operationTable, function($operation) use ($dateFrom, $dateTo) {
                $dataOperation = DateTime::createFromFormat('d/m/Y', $operation['date_value']);
                return $dataOperation > $dateFrom && $dataOperation <= $dateTo;
            }));

            $this->liqs[] = $liq;
        }

        $dateFrom = DateTime::createFromFormat('d/m/Y', $this->periodTable[count($this->periodTable) - 1]);
        $dateTo = DateTime::createFromFormat('d/m/Y', '01/01/2200');

        $liq = array_values(array_filter($this->operationTable, function($operation) use ($dateFrom, $dateTo) {
            $dataOperation = DateTime::createFromFormat('d/m/Y', $operation['date_value']);
            return $dataOperation > $dateFrom && $dataOperation <= $dateTo;
        }));
        $this->liqs[] = $liq;
    }

    private function setLiqs()
    {
        foreach ($this->liqs as $i => $liq) {
            if ($i > 2) break;

            $initialIndex = $i === 0 ? 12 : 13;
            $sheetIndex = $i + 1;
            $sheet = $this->spreadSheet->getSheetByName("LIQ $sheetIndex");
            if (!$sheet) continue;

            $formulaValueIndexDefault = 11;

            $formulaValueIndexTemp = $formulaValueIndexDefault;

            $IFormulaValueDefault = $sheet->getCell("I{$formulaValueIndexTemp}")->getValue();
            $JFormulaValueDefault = $sheet->getCell("J{$formulaValueIndexTemp}")->getValue();
            $KFormulaValueDefault = $sheet->getCell("K{$formulaValueIndexTemp}")->getValue();

            $formulaValueIndexTemp = $formulaValueIndexDefault + 1;

            $GFormulaValueDefault = $sheet->getCell("G{$formulaValueIndexTemp}")->getValue();
            $HFormulaValueDefault = $sheet->getCell("H{$formulaValueIndexTemp}")->getValue();

            foreach ($liq as $j => $row) {
                $currentIndex = $j + $initialIndex;
                $sheet->setCellValue("B{$currentIndex}", $row['date']);
                $sheet->setCellValue("C{$currentIndex}", $row['concept']);
                $sheet->setCellValue("D{$currentIndex}", $row['import']);
                $sheet->setCellValue("E{$currentIndex}", $row['dh']);
                $sheet->setCellValue("F{$currentIndex}", $row['date_value']);

//                if ($j > 0) continue;

                $IFormulaValue = str_replace($formulaValueIndexDefault + 1,  $currentIndex + 1, $IFormulaValueDefault);
                $IFormulaValue = str_replace($formulaValueIndexDefault,  $currentIndex, $IFormulaValue);

                $JFormulaValue = str_replace($formulaValueIndexDefault + 1,  $currentIndex + 1, $JFormulaValueDefault);
                $JFormulaValue = str_replace($formulaValueIndexDefault,  $currentIndex, $JFormulaValue);

                $KFormulaValue = str_replace($formulaValueIndexDefault + 1,  $currentIndex + 1, $KFormulaValueDefault);
                $KFormulaValue = str_replace($formulaValueIndexDefault,  $currentIndex, $KFormulaValue);

                $sheet->setCellValueExplicit("I{$currentIndex}", $IFormulaValue, 'f');
                $sheet->setCellValue("J{$currentIndex}", $JFormulaValue);
                $sheet->setCellValue("K{$currentIndex}", $KFormulaValue);

                $GFormulaValue = str_replace($formulaValueIndexDefault + 1,  $currentIndex, $GFormulaValueDefault);
                $GFormulaValue = str_replace($formulaValueIndexDefault,  $currentIndex - 1, $GFormulaValue);

                $HFormulaValue = str_replace($formulaValueIndexDefault + 1,  $currentIndex, $HFormulaValueDefault);
                $HFormulaValue = str_replace($formulaValueIndexDefault,  $currentIndex - 1, $HFormulaValue);

                $sheet->setCellValue("G{$currentIndex}", $GFormulaValue);
                $sheet->setCellValue("H{$currentIndex}", $HFormulaValue);
            }
        }
    }

    private function getExcelDate ($sheet, $c)
    {
        $date = null;
        $dateString = trim($sheet->getCell($c)->getValue());
        $date = DateTime::createFromFormat('d/m/Y', $dateString);
        if (!$date) {
            if (is_numeric($dateString)) {
                $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($dateString);
            } else {
                $date = null;
            }
        }

        return $date ? $date->format('d/m/Y') : null;
    }

    public function save($initialLetter = 'A', $indexInitial = 1)
    {
        $newFilename = 'Liquidacion-' . time() . '.xlsx';
        $excelParsedPath = FILES_PATH . $newFilename;
        $writer = new Xlsx($this->spreadSheet);
        $writer->save($excelParsedPath);

        return $newFilename;
    }
}