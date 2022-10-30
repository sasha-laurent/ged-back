<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Repository\DocumentRepository;
use App\Service\FileHandler;

class DocumentProvider implements ProviderInterface
{
    private DocumentRepository $documentRepository;
    private FileHandler $fileHandler;

    public function __construct(DocumentRepository $documentRepository, FileHandler $fileHandler)
    {
        $this->documentRepository = $documentRepository;
        $this->fileHandler = $fileHandler;
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        $documents = $this->documentRepository->findAll();

        array_map(function ($document) {
            $document->setPath($this->fileHandler->getFilePath($document->getPath()));
        },$documents);

        return $documents;
    }
}