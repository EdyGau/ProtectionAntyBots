<?php

namespace App\Services;

use App\Builders\FormBuilder;
use App\Handlers\FormHandler;
use App\Protectors\HoneypotProtector;

class FormService
{
    private FormBuilder $formBuilder;
    private FormHandler $formHandler;

    public function __construct(FormBuilder $formBuilder, FormHandler $formHandler)
    {
        $this->formBuilder = $formBuilder;
        $this->formHandler = $formHandler;
    }

    /**
     * Generate the form data.
     *
     * @param string $action
     * @param string $method
     * @return array
     */
    public function generateForm(string $action, string $method): array
    {
        return $this->formBuilder
            ->setAction($action)
            ->setMethod($method)
            ->addField('text', 'username', ['placeholder' => 'Username'])
            ->addField('text', 'surname', ['placeholder' => 'Surname'])
            ->addField('email', 'email', ['placeholder' => 'Email'])
            ->addField('password', 'password', ['placeholder' => 'Password'])
            ->addHoneypot()
            ->getFormData();
    }

    /**
     * Handle form submission through the handler.
     *
     * @param array $data
     * @return array
     * @throws \Exception
     */
    public function handleFormSubmission(array $data): array
    {
        return $this->formHandler->handle($data);
    }
}
