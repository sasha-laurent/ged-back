<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\UrlHelper;

class FileHandler
{
    const UPLOADS_DIRECTORY_NAME = 'uploads';

    private string $publicPath;
    private UrlHelper $urlHelper;

    public function __construct(string $publicPath, UrlHelper $urlHelper)
    {
        $this->publicPath = $publicPath;
        $this->urlHelper = $urlHelper;
    }

    public function upload(UploadedFile $file)
    {
        // todo : clean file name, make it unique ...
        $file->move($this->publicPath.'/'.self::UPLOADS_DIRECTORY_NAME, $file->getClientOriginalName());
    }

    public function getFilePath(string $fileName)
    {
        return $this->urlHelper->getAbsoluteUrl('/'.self::UPLOADS_DIRECTORY_NAME.'/'.$fileName);
    }
}