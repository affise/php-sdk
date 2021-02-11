<?php

declare(strict_types=1);

namespace Affise\Sdk\User;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * Class ChangeUserPasswordDtoTest
 */
class ChangeUserPasswordDtoTest extends TestCase
{
    /**
     * @return void
     */
    public function testConstructWithEmptyAttributes(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new ChangeUserPasswordDto([]);
    }

    /**
     * @return void
     */
    public function testConstructWithRequiredAttributesOnly(): void
    {
        $changeUserPasswordDto = new ChangeUserPasswordDto(
            [
                'id' => '5fe360de2d5119ff779037fe',
                'password' => '123456',
            ]
        );

        $this->assertEquals('5fe360de2d5119ff779037fe', $changeUserPasswordDto->getId());
        $this->assertEquals('123456', $changeUserPasswordDto->getPassword());
    }

    /**
     * @return void
     */
    public function testConstruct(): void
    {
        $changeUserPasswordDto = new ChangeUserPasswordDto(
            [
                'id' => '5fe360de2d5119ff779037fe',
                'password' => '123456',
            ]
        );

        $this->assertEquals('5fe360de2d5119ff779037fe', $changeUserPasswordDto->getId());
        $this->assertEquals('123456', $changeUserPasswordDto->getPassword());
    }
}
