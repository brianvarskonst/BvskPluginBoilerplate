<?php declare(strict_types=1);

namespace Bvsk\PluginBoilerplate\ScheduledTask;

use Shopware\Core\Framework\ScheduledTask\ScheduledTaskHandler;

class ExampleTaskHandler extends ScheduledTaskHandler
{
    public static function getHandledMessages(): iterable
    {
        return [ExampleTask::class];
    }

    public function run(): void
    {
        echo 'Do stuff!';
    }
}