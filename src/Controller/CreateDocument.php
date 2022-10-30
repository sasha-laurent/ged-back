<?php

namespace App\Controller;

use App\Factory\DocumentFactory;
use App\Repository\UserRepository;
use App\Service\FileHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class CreateDocument extends AbstractController
{
    public function __invoke(Request $request, FileHandler $fileHandler, UserRepository $userRepository)
    {
        /** @var UploadedFile $file */
        $file = $request->files->get('file');

        $fileHandler->upload($file);

        return DocumentFactory::create(
            $request->get('name'),
            $file->getClientOriginalName(),
            $userRepository->find($request->get('authorId'))
        );
    }
}