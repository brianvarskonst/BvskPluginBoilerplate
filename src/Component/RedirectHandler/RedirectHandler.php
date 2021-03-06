<?php declare(strict_types=1);

namespace Bvsk\PluginBoilerplate\Component\RedirectHandler;

use Bvsk\PluginBoilerplate\BvskPluginBoilerplate;
use Doctrine\DBAL\Connection;
use RuntimeException;
use Shopware\Core\Framework\Uuid\Uuid;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;

class RedirectHandler
{
    /** @var Connection */
    private $connection;

    /** @var RouterInterface */
    private $router;

    public function __construct(Connection $connection, RouterInterface $router)
    {
        $this->connection = $connection;
        $this->router = $router;
    }

    public function encode(string $url): string
    {
        $hash = base64_encode(hash_hmac('sha256', $url, getenv('APP_SECRET')));

        $this->connection->insert(BvskPluginBoilerplate::PLUGIN_TEMPORARY_REDIRECT_TABLE, [
            'id' => Uuid::randomBytes(),
            'hash' => $hash,
            'url' => $url,
        ]);

        $params = [
            'hash' => $hash,
        ];

        return $this->router->generate('boilerplate_redirect', $params, UrlGeneratorInterface::ABSOLUTE_URL);
    }

    public function decode(string $hash): string
    {
        $query = 'SELECT url FROM ' . BvskPluginBoilerplate::PLUGIN_TEMPORARY_REDIRECT_TABLE . ' WHERE hash = ?';

        $url = $this->connection->fetchColumn($query, [$hash]);

        if (empty($url)) {
            throw new RuntimeException('no matching url for hash found');
        }

        return (string)$url;
    }
}