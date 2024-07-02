<?php


class ReadFilter implements \PhpOffice\PhpSpreadsheet\Reader\IReadFilter
{
    public function readCell($columnAddress, $row, $worksheetName = '') {
        if ($row <= 10000) {
            return true;
        }
        return false;
    }
}