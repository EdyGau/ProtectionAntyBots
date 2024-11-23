<?php

namespace App\Services;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigService
{
    private Environment $twig;

    public function __construct()
    {
        $loader = new FilesystemLoader(__DIR__ . '/../Templates');

        $this->twig = new Environment($loader, [
            'cache' => __DIR__ . '/../../var/cache/twig',
            'debug' => true,
        ]);
    }

    public function getTwig(): Environment
    {
        return $this->twig;
    }
}
