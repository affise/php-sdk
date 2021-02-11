<?php

declare(strict_types=1);

namespace Affise\Sdk\Transport;

/**
 * Class MultipartUtils
 */
abstract class GuzzleMultipartUtils
{
    /**
     * Converts a request data map to guzzle's @see{\GuzzleHttp\Psr7\MultipartStream} format.
     *
     * @param array<string, mixed> $data
     *
     * @return array<array<string, mixed>>
     * @psalm-return array<array{name: string, contents: string|resource}>
     */
    public static function convertData(array $data): array
    {
        $result = [];

        foreach ($data as $name => $value) {
            $result = array_merge($result, static::convertItem($name, $value));
        }

        return $result;
    }

    /**
     * @param string|int $name
     * @param mixed $value
     *
     * @return array<array<string, mixed>>
     * @psalm-return array<array{name: string, contents: string|resource, filename?: string, headers?: array<string, string>}>
     */
    protected static function convertItem($name, $value): array
    {
        if (is_array($value)) {
            $result = [];

            foreach ($value as $i => $v) {
                $result = array_merge($result, static::convertItem($name . sprintf('[%s]', $i), $v));
            }

            return $result;
        }

        if ($value instanceof FileInterface) {
            return [
                [
                    'name' => (string) $name,
                    'contents' => $value->getContent(),
                    'filename' => $value->getFilename(),
                    'headers' => [
                        'Content-Type' => $value->getMimeType(),
                    ],
                ],
            ];
        }

        return [
            [
                'name' => (string) $name,
                'contents' => is_resource($value) ? $value : (string) $value,
            ],
        ];
    }
}
