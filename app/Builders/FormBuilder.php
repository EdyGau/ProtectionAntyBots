<?php

namespace App\Builders;

use App\Protectors\HoneypotProtector;
use App\Interfaces\FormBuilderInterface;

class FormBuilder implements FormBuilderInterface
{
    private string $action;
    private string $method;
    private array $fields = [];
    private HoneypotProtector $honeypotProtector;

    public function __construct(HoneypotProtector $honeypotProtector)
    {
        $this->honeypotProtector = $honeypotProtector;
    }

    /**
     * Set the action URL for the form.
     */
    public function setAction(string $action): self
    {
        $this->action = $action;
        return $this;
    }

    /**
     * Set the method for the form.
     */
    public function setMethod(string $method): self
    {
        $this->method = $method;
        return $this;
    }

    /**
     * Add a field to the form.
     */
    public function addField(string $type, string $name, array $attributes = []): self
    {
        $this->fields[] = [
            'type' => $type,
            'name' => $name,
            'attributes' => $attributes,
        ];
        return $this;
    }

    /**
     * Add honeypot field to the form.
     */
    public function addHoneypot(): self
    {
        $this->fields[] = $this->honeypotProtector->generateField();
        return $this;
    }

    /**
     * Prepare the form data for rendering.
     */
    public function getFormData(): array
    {
        return [
            'action' => $this->action,
            'method' => $this->method,
            'fields' => $this->fields,
        ];
    }
}
