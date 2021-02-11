<?php

declare(strict_types=1);

namespace Affise\Sdk\Transport;

use PHPUnit\Framework\TestCase;

/**
 * Class GuzzleMultipartUtilsTest
 */
class GuzzleMultipartUtilsTest extends TestCase
{
    public function testConvertData(): void
    {
        $resource = tmpfile();
        $file = File::createFromFile(__DIR__ . '/test.txt.zip');
        $data = [
            'a' => 10,
            'b' => [20, 30, 40],
            'c' => [
                'x' => 100,
                'y' => 200,
                'z' => 300,
            ],
            'd' => [
                'one' => [1000, 2000, 3000],
                'two' => ['aa' => 25, 'bb' => 45, 'cc' => 15],
                'three' => [
                    'xx' => [250],
                    'yy' => ['a' => ['aaa' => 75, 'bbb' => 85], 'b' => 85],
                    'zz' => [$resource],
                    'aa' => $file,
                ],
            ],
        ];

        $expected = [
            ['name' => 'a', 'contents' => '10'],
            ['name' => 'b[0]', 'contents' => '20'],
            ['name' => 'b[1]', 'contents' => '30'],
            ['name' => 'b[2]', 'contents' => '40'],
            ['name' => 'c[x]', 'contents' => '100'],
            ['name' => 'c[y]', 'contents' => '200'],
            ['name' => 'c[z]', 'contents' => '300'],
            ['name' => 'd[one][0]', 'contents' => '1000'],
            ['name' => 'd[one][1]', 'contents' => '2000'],
            ['name' => 'd[one][2]', 'contents' => '3000'],
            ['name' => 'd[two][aa]', 'contents' => '25'],
            ['name' => 'd[two][bb]', 'contents' => '45'],
            ['name' => 'd[two][cc]', 'contents' => '15'],
            ['name' => 'd[three][xx][0]', 'contents' => '250'],
            ['name' => 'd[three][yy][a][aaa]', 'contents' => '75'],
            ['name' => 'd[three][yy][a][bbb]', 'contents' => '85'],
            ['name' => 'd[three][yy][b]', 'contents' => '85'],
            ['name' => 'd[three][zz][0]', 'contents' => $resource],
            [
                'name' => 'd[three][aa]',
                'contents' => $file->getContent(),
                'filename' => $file->getFilename(),
                'headers' => ['Content-Type' => $file->getMimeType()],
            ],
        ];

        $this->assertEquals($expected, GuzzleMultipartUtils::convertData($data));
    }
}

