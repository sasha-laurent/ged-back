<?php

namespace App\Factory;

use App\Entity\Document;
use App\Entity\User;

class DocumentFactory
{
    public static function create(
        string $name,
        string $path,
        User $author
    )
    {
        return (new Document())
            ->setName($name)
            ->setPath($path)
            ->setAuthor($author);
    }
}