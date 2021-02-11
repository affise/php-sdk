<?php

declare(strict_types=1);

namespace Affise\Sdk\Transport;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * Class FileTest
 */
class FileTest extends TestCase
{
    public function testGetContent(): void
    {
        $content = tmpfile();
        $file = new File($content, 'text/plain');
        $this->assertEquals($content, $file->getContent());

        $content = 'ZmlsZQ==';
        $file = new File($content, 'text/plain');
        $this->assertEquals($content, $file->getContent());
    }

    public function testGetFilename(): void
    {
        $file = new File('test', 'text/plain');
        $this->assertNotEmpty($file->getFilename());

        $file = new File('test', 'text/plain', 'filename');
        $this->assertEquals('filename', $file->getFilename());
    }

    public function testGetMimeType(): void
    {
        $file = new File('test', 'text/plain');
        $this->assertEquals('text/plain', $file->getMimeType());

        $file = new File('test', 'image/png');
        $this->assertEquals('image/png', $file->getMimeType());
    }

    public function testGetHeaders(): void
    {
        $headers = [
            'Content-Disposition' => 'form-data; name="file"; filename="test.txt"',
            'Content-Type' => 'text/plain',
        ];
        $file = File::createFromFile(__DIR__ . '/test.txt');
        $this->assertEquals($headers, $file->getHeaders('file'));

        $headers = [
            'Content-Disposition' => 'form-data; name="another"; filename="test.txt.zip"',
            'Content-Type' => 'application/zip',
        ];
        $file = File::createFromFile(__DIR__ . '/test.txt.zip');
        $this->assertEquals($headers, $file->getHeaders('another'));
    }

    public function testCreateFromResource(): void
    {
        $content = tmpfile();
        $file = File::createFromResource($content, 'text/plain');
        $this->assertEquals('text/plain', $file->getMimeType());
        $this->assertEquals($content, $file->getContent());
        $this->assertNotEmpty($file->getFilename());

        $content = tmpfile();
        $file = File::createFromResource($content, 'text/plain', 'filename');
        $this->assertEquals('text/plain', $file->getMimeType());
        $this->assertEquals($content, $file->getContent());
        $this->assertEquals('filename', $file->getFilename());
    }

    public function testCreateFromContent(): void
    {
        $content = 'test';
        $file = File::createFromContent($content, 'text/plain');
        $this->assertEquals('text/plain', $file->getMimeType());
        $this->assertEquals($content, $file->getContent());
        $this->assertNotEmpty($file->getFilename());

        $content = 'another';
        $file = File::createFromContent($content, 'text/plain', 'filename');
        $this->assertEquals('text/plain', $file->getMimeType());
        $this->assertEquals($content, $file->getContent());
        $this->assertEquals('filename', $file->getFilename());
    }

    public function testCreateFromFile(): void
    {
        $filename = __DIR__ . '/test.txt';
        $file = File::createFromFile($filename);
        $this->assertEquals('text/plain', $file->getMimeType());
        $this->assertIsResource($file->getContent());
        $this->assertEquals(basename($filename), $file->getFilename());

        $filename = __DIR__ . '/test.txt.zip';
        $file = File::createFromFile($filename);
        $this->assertEquals('application/zip', $file->getMimeType());
        $this->assertIsResource($file->getContent());
        $this->assertEquals(basename($filename), $file->getFilename());
    }

    public function testCreateThrowsExceptionWhenFileNotExist(): void
    {
        $this->expectException(InvalidArgumentException::class);

        File::createFromFile('test');
    }
}

