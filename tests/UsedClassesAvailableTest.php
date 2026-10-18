<?php declare(strict_types=1);

namespace Bvsk\PluginBoilerplate\Tests;

use Shopware\Core\Framework\Test\TestCaseBase\IntegrationTestBehaviour;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Finder\Finder;

class UsedClassesAvailableTest extends TestCase
{
    use IntegrationTestBehaviour;

    public function testClassesAreInstantiable(): void
    {
        $namespace = rtrim(str_replace('Tests', '', __NAMESPACE__), '\\');

        foreach ($this->getPluginClasses() as $class) {
            $classRelativePath = str_replace(['.php', '/'], ['', '\\'], $class->getRelativePathname());

            /** @var class-string $className */
            $className = $namespace . '\\' . $classRelativePath;

            $this->getMockBuilder($className)
                ->disableOriginalConstructor()
                ->getMock();
        }

        // Nothing broke so far, classes seem to be instantiable
        $this->addToAssertionCount(1);
    }

    private function getPluginClasses(): Finder
    {
        $finder = new Finder();
        $finder->in(__DIR__ . '/../src');
        $finder->exclude('Resources');

        return $finder->files()->name('*.php');
    }
}
