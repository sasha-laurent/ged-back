<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Repository\DocumentRepository;
use App\Service\Authenticator;
use App\Service\FileHandler;

class DocumentProvider implements ProviderInterface
{
    private DocumentRepository $documentRepository;
    private FileHandler $fileHandler;
    private Authenticator $authenticator;

    public function __construct(DocumentRepository $documentRepository, FileHandler $fileHandler, Authenticator $authenticator)
    {
        $this->documentRepository = $documentRepository;
        $this->fileHandler = $fileHandler;
        $this->authenticator = $authenticator;
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {

        $authenticatedUser = $this->authenticator->getAuthenticatedUser();

        if (!$authenticatedUser) {
            return [];
        }

        $documents = $this->documentRepository->findBy(['author' => $authenticatedUser]);

        array_map(function ($document) {
            $document->setPath($this->fileHandler->getFilePath($document->getPath()));
        },$documents);

        return $documents;
    }
}