<?php


class Upload
{
    private $fileName;

    public function __construct($fileName)
    {
        $this->fileName = $fileName;
    }

    public function uploadFile($file)
    {
        $fileFullPath = FILES_PATH . $this->fileName;

        if (!move_uploaded_file($file['tmp_name'], $fileFullPath)) {
            return null;
        }

        return $fileFullPath;
    }
}