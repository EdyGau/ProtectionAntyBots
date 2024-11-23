<?php

namespace App\Protectors;

class HoneypotProtector
{
    private string $honeypotFieldName;

    /**
     * Constructor to define the honeypot field name.
     *
     * @param string $honeypotFieldName
     */
    public function __construct(string $honeypotFieldName = 'user_email')
    {
        $this->honeypotFieldName = $honeypotFieldName;
    }

    /**
     * Generate a honeypot field definition.
     *
     * @return array
     */
    public function generateField(): array
    {
        return [
            'type' => 'text',
            'name' => $this->honeypotFieldName,
            'attributes' => [
                'style' => 'display:none;'
            ],
        ];
    }

    /**
     * Validate the honeypot field.
     *
     * @param array $data
     * @return bool
     */
    public function validate(array $data): bool
    {
        return empty($data[$this->honeypotFieldName] ?? '');
    }
}
