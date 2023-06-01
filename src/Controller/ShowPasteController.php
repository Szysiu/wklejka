<?php

namespace App\Controller;

use App\Service\PasteService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class ShowPasteController extends AbstractController
{
    #[Route('/{id}', name: 'show_paste')]
    public function index(int $id, PasteService $pasteService): Response
    {
        try {
            $paste = $pasteService->getPaste($id);
        } catch (NotFoundResourceException) {
            $this->addFlash('error', 'Brak wklejki o takim id');
            return $this->redirectToRoute('app_index');
        }

        return $this->render('show_paste/index.html.twig', [
            'paste' => $paste
        ]);
    }
}
