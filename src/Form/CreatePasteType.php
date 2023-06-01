<?php

namespace App\Form;

use App\Service\PasteService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class CreatePasteType extends AbstractType
{
    private PasteService $pasteService;

    public function __construct(PasteService $pasteService)
    {
        $this->pasteService = $pasteService;
    }


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nick', TextType::class, [
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'aria-label' => 'Nick',
                    'aria-describedby' => 'basic-addon1'
                ]
            ])
            ->add('title', TextType::class, [
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'aria-label' => 'Topic',
                    'aria-describedby' => 'basic-addon1'
                ]
            ])
            ->add('language', ChoiceType::class, [
                'required' => false,
                'choices' => $this->generateChoices(),
                'placeholder' => 'Wybierz język ↓',
                'attr' => [
                    'class' => 'form-select text-light select-custom',
                ]
            ])
            ->add('content', TextareaType::class, [
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'aria-label' => 'Text',
                    'aria-describedby' => 'basic-addon1',
                    'style' => 'min-height: 400px;'
                ]
            ]);
    }

    private function generateChoices():array
    {
        $languages = $this->pasteService->getLanguages();
        $choices=[];

        foreach ($languages as $language) {
            $choices[$language->getName()] = $language->getId();
        }

        return $choices;
    }
}
