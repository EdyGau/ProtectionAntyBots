<?php

namespace App\Interfaces;

interface FormBuilderInterface
{
    /**
     * Set the action URL for the form.
     *
     * @param string $action
     * @return self
     */
    public function setAction(string $action): self;

    /**
     * Set the method for the form.
     *
     * @param string $method
     * @return self
     */
    public function setMethod(string $method): self;

    /**
     * Add a field to the form.
     *
     * @param string $type
     * @param string $name
     * @param array $attributes
     * @return self
     */
    public function addField(string $type, string $name, array $attributes = []): self;

    /**
     * Add honeypot field to the form.
     *
     * @return self
     */
    public function addHoneypot(): self;

    /**
     * Prepare the form data for rendering in the view.
     *
     * @return array
     */
    public function getFormData(): array;

}
