<?php

namespace App\Service;

use App\Entity\Language;
use App\Entity\Paste;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class PasteService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getData(FormInterface $form): array
    {
        return [
            'nick' => $form->get('nick')->getData(),
            'title' => $form->get('title')->getData(),
            'content' => $form->get('content')->getData(),
            'language' => $form->get('language')->getData()
        ];
    }

    public function addPaste(array $data): int
    {
        $paste = $this->createNewPaste($data);
        $this->entityManager->persist($paste);
        $this->entityManager->flush();

        return $paste->getId();
    }

    public function getPaste(int $id): Paste
    {
        $paste = $this->entityManager->getRepository(Paste::class)->findOneBy(['id' => $id]);

        if (!$paste) {
            throw new NotFoundResourceException();
        }

        return $paste;
    }

    public function getLanguages(): array
    {
        return $this->entityManager->getRepository(Language::class)->findAll();
    }

    private function createNewPaste(array $data): Paste
    {
        $paste = new Paste();
        $paste->setNick($data['nick']);
        $paste->setTitle($data['title']);
        $paste->setContent($data['content']);
        $paste->setCreatedAt(new DateTimeImmutable());
        $language = $this->findLanguage($data['language']);
        $paste->setLanguage($language);
        return $paste;
    }

    private function findLanguage(int $id): Language
    {
        $language = $this->entityManager->getRepository(Language::class)->findOneBy(['id' => $id]);
        if (!$language) {
            throw new NotFoundResourceException();
        }

        return $language;
    }

}