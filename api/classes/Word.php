<?php


class Word
{
    private $excelPath;
    private $templatePath;

    function __construct ($excelPath, $templatePath)
    {
        $this->excelPath = $excelPath;
        $this->templatePath = $templatePath;
    }

    public function saveFiles ($table, $dirName)
    {
        $input = $this->templatePath;

        $files = [];

        foreach ($table as $i => $row) {
            $fileName = $row[0] . '.docx';
            $users = [];
            if (!empty($row[6])) $users[] = $row[6];
            if (!empty($row[7])) $users[] = $row[7];
            $usersString = implode(', ', $users);

            $output = $this->excelPath . $fileName;

            $replacement = [
                'Id Prueba:' => "Id Prueba: $row[0]",
                'Entorno (URL):' => "Entorno (URL): $row[2]",
                'Usuario/ROL:' => "Usuario/ROL: $usersString",
                '(caso de prueba)' => "$row[5]",
                '(resultado)' => "$row[8]"
            ];

            if ($this->searchReplaceWordDocument($input, $output, $replacement)) {
                $files[] = $dirName . '/' . $fileName;
            }

            break;
        }

        return $files;
    }

    function searchReplaceWordDocument(string $input, string $output, array $replacements): bool
    {
        if (!copy($input, $output)) return false;

        $zip = new ZipArchive();
        if ($zip->open($output, ZipArchive::CREATE) !== true) {
            return false;
        }

        $xml = $zip->getFromName('word/document.xml');

        $xml = str_replace(array_keys($replacements), array_values($replacements), $xml);

        if (!$zip->addFromString('word/document.xml', $xml)) return false;

        $zip->close();

        return true;
    }

}