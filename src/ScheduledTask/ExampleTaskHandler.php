<?php declare(strict_types=1);

namespace Bvsk\PluginBoilerplate\ScheduledTask;

use Shopware\Core\Framework\MessageQueue\ScheduledTask\ScheduledTaskHandler;

class ExampleTaskHandler extends ScheduledTaskHandler
{
    public function run(): void
    {
        echo 'Do stuff!';
    }
}