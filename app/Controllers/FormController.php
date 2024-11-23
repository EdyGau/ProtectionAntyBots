<?php

namespace App\Controllers;

use App\Services\FormService;
use Twig\Environment;

class FormController
{
    private FormService $formService;
    private Environment $twig;

    public function __construct(FormService $formService, Environment $twig)
    {
        $this->formService = $formService;
        $this->twig = $twig;
    }

    /**
     * @return void
     */
    public function showForm(): void
    {
        $form = $this->formService->generateForm('/submit', 'POST');

        echo $this->twig->render('form.html.twig', [
            'form' => $form,
            'message' => null
        ]);
    }

    /**
     * @return void
     */
    public function submitForm(): void
    {
        $data = filter_input_array(INPUT_POST);

        try {
            $this->formService->handleFormSubmission($data);

            echo $this->twig->render('success.html.twig', ['message' => 'Form submitted successfully!']);
        } catch (\InvalidArgumentException $e) {
//            TODO logs function
            echo $this->twig->render('error.html.twig', ['message' => 'Invalid input, please check the form fields.']);
        }
    }
}


