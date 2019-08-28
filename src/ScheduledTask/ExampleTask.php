<?php declare(strict_types=1);

namespace Bvsk\PluginBoilerplate\ScheduledTask;

use Shopware\Core\Framework\ScheduledTask\ScheduledTask;

class ExampleTask extends ScheduledTask
{
    public static function getTaskName(): string
    {
        return 'vendor_prefix.example_task';
    }

    public static function getDefaultInterval(): int
    {
        return 300; // 5 minutes
    }
}