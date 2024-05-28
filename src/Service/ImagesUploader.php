<?php
namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class ImagesUploader
{
    private $targetDirectory;
    private $slugger;

    public function __construct($targetDirectory, SluggerInterface $slugger)
    {
        $this->targetDirectory = $targetDirectory;
        $this->slugger = $slugger;
    }

    public function upload(UploadedFile $file)
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $safeFilename.'-'.uniqid().'.'.$file->guessExtension();
        

        // Créer le répertoire cible s'il n'existe pas
        $this->createTargetDirectory();

        try
        {
            $file->move($this->getTargetDirectory(), $fileName);
        } catch (FileException $e) {
            // Gérer l'exception
            throw new FileException('Échec du téléchargement de l\'image.', 0, $e);
        }

        return $fileName;
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }

    private function createTargetDirectory()
    {
        if (!is_dir($this->targetDirectory)) {
            if (!mkdir($this->targetDirectory, 0777, true) && !is_dir($this->targetDirectory)) {
                throw new FileException(sprintf('Le répertoire "%s" ne peut pas être créé', $this->targetDirectory));
            }
        }
    }
}