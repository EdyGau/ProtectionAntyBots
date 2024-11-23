<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Services\FormService;
use App\Handlers\FormHandler;
use App\Builders\FormBuilder;
use App\Protectors\HoneypotProtector;
use App\Controllers\FormController;
use App\Services\TwigService;

$honeypotProtector = new HoneypotProtector();

$formBuilder = new FormBuilder($honeypotProtector);
$formHandler = new FormHandler($honeypotProtector);
$formService = new FormService($formBuilder, $formHandler);
$twigService = new TwigService();

$formController = new FormController($formService, $twigService->getTwig());

if ($_SERVER['REQUEST_URI'] === '/submit' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $formController->submitForm();
} else {
    $formController->showForm();
}
