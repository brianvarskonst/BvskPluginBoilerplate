<?php declare(strict_types=1);

namespace Bvsk\PluginBoilerplate\Command;

use Shopware\Core\Framework\Uuid\Uuid;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ExampleCommand extends Command
{
    /** @var ContainerInterface */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct();
        $this->container = $container;
    }

    protected function configure(): void
    {
        $this->setName('boilerplate:example')
            ->setDescription('Example Console Command from PluginBoilerplate Plugin to start with.')
            ->addArgument('maxAmount', InputArgument::OPTIONAL, 'Max amount of generated uuids.');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $style = new SymfonyStyle($input, $output);
        $style->title('PluginBoilerplate Example Console Command: Generate Random Hex Uuids');

        $maxAmount = (int)($input->getArgument('maxAmount') ?? 10);

        for ($i = 0; $i < $maxAmount; ++$i) {
            $style->text(sprintf('Random Hex Uuid: %s', Uuid::randomHex()));
        }
    }
}