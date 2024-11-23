<?php

namespace App\Handlers;

use App\Protectors\HoneypotProtector;
use Exception;

class FormHandler
{
    private HoneypotProtector $honeypotProtection;

    public function __construct(HoneypotProtector $honeypotProtection)
    {
        $this->honeypotProtection = $honeypotProtection;
    }

    /**
     * Handle form submission and return validation status.
     *
     * @param array $data
     * @return array
     * @throws Exception
     */
    public function handle(array $data): array
    {
        if (!$this->honeypotProtection->validate($data)) {
            throw new \RuntimeException('Bot detected! Honeypot field was filled.!');
        }

        return [
            'status' => 'success',
            'message' => 'Form submitted successfully!',
        ];
    }
}

