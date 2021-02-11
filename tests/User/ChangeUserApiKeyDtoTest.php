<?php

declare(strict_types=1);

namespace Affise\Sdk\User;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * Class ChangeUserApiKeyDtoTest
 */
class ChangeUserApiKeyDtoTest extends TestCase
{
    /**
     * @return void
     */
    public function testConstructWithEmptyAttributes(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new ChangeUserApiKeyDto([]);
    }

    /**
     * @return void
     */
    public function testConstructWithRequiredAttributesOnly(): void
    {
        $changeUserApiKeyDto = new ChangeUserApiKeyDto(
            [
                'id' => '5fe360de2d5119ff779037fe',
                'api_key' => 'b2018c322280b3e12b29366fc629d7a1',
            ]
        );

        $this->assertEquals('5fe360de2d5119ff779037fe', $changeUserApiKeyDto->getId());
        $this->assertEquals('b2018c322280b3e12b29366fc629d7a1', $changeUserApiKeyDto->getApiKey());
    }

    /**
     * @return void
     */
    public function testConstruct(): void
    {
        $changeUserApiKeyDto = new ChangeUserApiKeyDto(
            [
                'id' => '5fe360de2d5119ff779037fe',
                'api_key' => 'b2018c322280b3e12b29366fc629d7a1',
            ]
        );

        $this->assertEquals('5fe360de2d5119ff779037fe', $changeUserApiKeyDto->getId());
        $this->assertEquals('b2018c322280b3e12b29366fc629d7a1', $changeUserApiKeyDto->getApiKey());
    }
}
