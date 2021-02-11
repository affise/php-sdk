<?php

declare(strict_types=1);

namespace Affise\Sdk\Transport;

use GuzzleHttp\Psr7\MimeType;
use InvalidArgumentException;

/**
 * Class CreativeFile
 */
class File implements FileInterface
{
    /**
     * @var string|resource
     */
    private $content;
    private string $filename;
    private string $mimeType;

    /**
     * FileContent constructor.
     *
     * @param resource|string $content If string it should be a content of the file (binary string).
     * @param string $mimeType Mime type of the content.
     * @param string|null $filename Filename of the content.
     */
    public function __construct($content, string $mimeType, ?string $filename = null)
    {
        $this->filename = $this->resolveFilename($filename);
        $this->content = $content;
        $this->mimeType = $mimeType;
    }

    /**
     * @param resource $resource
     * @param string $mimeType
     * @param string|null $filename
     *
     * @return \Affise\Sdk\Transport\File
     */
    public static function createFromResource($resource, string $mimeType, ?string $filename = null): File
    {
        return new self($resource, $mimeType, $filename);
    }

    /**
     * @param string $file
     * @param string|null $mimeType
     *
     * @return \Affise\Sdk\Transport\File
     */
    public static function createFromFile(string $file, ?string $mimeType = null): File
    {
        if (!file_exists($file)) {
            throw new InvalidArgumentException("File {$file} does not exist");
        }

        $mimeType = $mimeType ?: MimeType::fromFilename($file);

        if (!$mimeType) {
            throw new InvalidArgumentException('Could not look up mime type for file ' . $file);
        }

        return static::createFromResource(fopen($file, 'r'), $mimeType, basename($file));
    }

    /**
     * @param string $content
     * @param string $contentType
     * @param string|null $filename
     *
     * @return \Affise\Sdk\Transport\File
     */
    public static function createFromContent(string $content, string $contentType, ?string $filename = null): File
    {
        return new File($content, $contentType, $filename);
    }

    protected function resolveFilename(?string $filename): string
    {
        return $filename ? $filename : uniqid();
    }

    /**
     * {@inheritDoc}
     */
    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * {@inheritDoc}
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * {@inheritDoc}
     */
    public function getMimeType(): string
    {
        return $this->mimeType;
    }

    /**
     * Returns a map of the HTTP multipart headers.
     *
     * @param string $fieldName
     *
     * @return array<string, string>
     */
    public function getHeaders(string $fieldName): array
    {
        return [
            'Content-Disposition' => sprintf('form-data; name="%s"; filename="%s"', $fieldName, $this->filename),
            'Content-Type' => $this->mimeType,
        ];
    }
}
