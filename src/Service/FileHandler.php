<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileHandler
{
    private string $uploadPath;

    public function __construct(string $uploadPath)
    {
        $this->uploadPath = $uploadPath;
    }

    public function upload(UploadedFile $file)
    {
        // todo : clean file name, make it unique,

        $file->move($this->uploadPath, $file->getClientOriginalName());
    }

    public function getFilePath(UploadedFile $file)
    {
        // todo : return url instead of path

        return $this->uploadPath.'/'.$file->getClientOriginalName();
    }
}