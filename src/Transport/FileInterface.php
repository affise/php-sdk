<?php

declare(strict_types=1);

namespace Affise\Sdk\Transport;

/**
 * Interface FileInterface
 *
 * Represents a file data as multipart form data.
 */
interface FileInterface
{
    /**
     * Returns base name of the file.
     *
     * @return string
     */
    public function getFilename(): string;

    /**
     * Returns content of the file.
     *
     * @return resource|string If string it should be a binary string.
     */
    public function getContent();

    /**
     * Returns mime type of the file.
     *
     * @return string
     */
    public function getMimeType(): string;
}
