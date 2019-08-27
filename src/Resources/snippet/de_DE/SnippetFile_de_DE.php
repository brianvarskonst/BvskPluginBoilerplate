<?php declare(strict_types=1);

namespace Bvsk\PluginBoilerplate\Resources\snippet\de_DE;

use Shopware\Core\Framework\Snippet\Files\SnippetFileInterface;

class SnippetFile_de_DE implements SnippetFileInterface
{
    /**
     * Returns the displayed name.
     *
     * Example:
     * messages.en-GB
     */
    public function getName(): string
    {
        return 'storefront.de-DE';
    }

    /**
     * Returns the path to the json language file.
     *
     * Example:
     * /appPath/subDirectory/messages.en-GB.json
     */
    public function getPath(): string
    {
        return __DIR__ . '/storefront.de-DE.json';
    }

    /**
     * Returns the associated language ISO.
     *
     * Example:
     * en-GB
     * de-DE
     */
    public function getIso(): string
    {
        return 'de-DE';
    }

    /**
     * Return the snippet author, which will be used when editing a file snippet in a snippet set
     *
     * Example:
     * shopware
     * pluginName
     */
    public function getAuthor(): string
    {
        return 'brianvarskonst';
    }

    /**
     * Returns a boolean which determines if its a base language file
     */
    public function isBase(): bool
    {
        return false;
    }
}