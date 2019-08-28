<?php declare(strict_types=1);

namespace Bvsk\PluginBoilerplate\Service;

class ExampleDecoratedService
{
    /**
     * @var ExampleService
     */
    private $exampleService;

    public function __construct(ExampleService $exampleService)
    {
        $this->exampleService = $exampleService;
    }
}