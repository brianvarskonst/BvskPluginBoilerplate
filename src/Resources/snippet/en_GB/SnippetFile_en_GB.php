<?php declare(strict_types=1);

namespace Bvsk\PluginBoilerplate\Resources\snippet\en_GB;

use Shopware\Core\Framework\Snippet\Files\SnippetFileInterface;

class SnippetFile_en_GB implements SnippetFileInterface
{

    /**
     * Returns the displayed name.
     *
     * Example:
     * messages.en-GB
     */
    public function getName(): string
    {
        return 'storefront.en-GB';
    }

    /**
     * Returns the path to the json language file.
     *
     * Example:
     * /appPath/subDirectory/messages.en-GB.json
     */
    public function getPath(): string
    {
        return __DIR__ . '/storefront.en-GB.json';
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
        return 'en-GB';
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