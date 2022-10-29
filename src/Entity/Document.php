<?php

namespace App\Entity;

class Document
{
    private string $name;
    private string $path;
    private User $author;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Document
     */
    public function setName(string $name): Document
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     * @return Document
     */
    public function setPath(string $path): Document
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        return $this->author;
    }

    /**
     * @param User $author
     * @return Document
     */
    public function setAuthor(User $author): Document
    {
        $this->author = $author;
        return $this;
    }
}