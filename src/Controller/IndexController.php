<?php

namespace App\Controller;

use App\Form\CreatePasteType;
use App\Service\PasteService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(Request $request, PasteService $pasteService): Response
    {
        $form = $this->createForm(CreatePasteType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $pasteService->getData($form);

            try {
                $id = $pasteService->addPaste($data);
                return $this->redirectToRoute('show_paste',['id'=>$id]);
            } catch (Exception $message) {
                $this->addFlash('error', 'Wystąpił błąd');
                return $this->redirectToRoute('app_index');
            }
        }

        return $this->render('index/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
