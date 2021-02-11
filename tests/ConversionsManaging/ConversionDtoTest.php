<?php

declare(strict_types=1);

namespace Affise\Sdk\ConversionsManaging;

use PHPUnit\Framework\TestCase;

/**
* Class ConversionDtoTest
*/
class ConversionDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'offer' => 1000,
            'pid' => 500,
        ];
    }

    public function testGetOffer(): void
    {
        $importSingleConversionDto = new ConversionDto(static::$requiredAttributes);

        $this->assertEquals(1000, $importSingleConversionDto->getOffer());
    }

    public function testGetPid(): void
    {
        $importSingleConversionDto = new ConversionDto(static::$requiredAttributes);

        $this->assertEquals(500, $importSingleConversionDto->getPid());
    }

    public function testGetActionId(): void
    {
        $importSingleConversionDto = new ConversionDto(static::$requiredAttributes + ['action_id' => 'quisquam']);
        $this->assertEquals('quisquam', $importSingleConversionDto->getActionId());

        $importSingleConversionDto = new ConversionDto(static::$requiredAttributes + ['action_id' => null]);
        $this->assertNull($importSingleConversionDto->getActionId());

        $importSingleConversionDto = new ConversionDto(static::$requiredAttributes);
        $this->assertNull($importSingleConversionDto->getActionId());
    }

    public function testGetGoal(): void
    {
        $importSingleConversionDto = new ConversionDto(static::$requiredAttributes + ['goal' => 100]);
        $this->assertEquals(100, $importSingleConversionDto->getGoal());

        $importSingleConversionDto = new ConversionDto(static::$requiredAttributes + ['goal' => null]);
        $this->assertNull($importSingleConversionDto->getGoal());

        $importSingleConversionDto = new ConversionDto(static::$requiredAttributes);
        $this->assertNull($importSingleConversionDto->getGoal());
    }

    public function testGetIp(): void
    {
        $importSingleConversionDto = new ConversionDto(static::$requiredAttributes + ['ip' => 'aspernatur']);
        $this->assertEquals('aspernatur', $importSingleConversionDto->getIp());

        $importSingleConversionDto = new ConversionDto(static::$requiredAttributes + ['ip' => null]);
        $this->assertNull($importSingleConversionDto->getIp());

        $importSingleConversionDto = new ConversionDto(static::$requiredAttributes);
        $this->assertNull($importSingleConversionDto->getIp());
    }

    public function testGetUa(): void
    {
        $importSingleConversionDto = new ConversionDto(static::$requiredAttributes + ['ua' => 'ut']);
        $this->assertEquals('ut', $importSingleConversionDto->getUa());

        $importSingleConversionDto = new ConversionDto(static::$requiredAttributes + ['ua' => null]);
        $this->assertNull($importSingleConversionDto->getUa());

        $importSingleConversionDto = new ConversionDto(static::$requiredAttributes);
        $this->assertNull($importSingleConversionDto->getUa());
    }

    public function testGetSum(): void
    {
        $importSingleConversionDto = new ConversionDto(static::$requiredAttributes + ['sum' => 100]);
        $this->assertEquals(100, $importSingleConversionDto->getSum());

        $importSingleConversionDto = new ConversionDto(static::$requiredAttributes + ['sum' => null]);
        $this->assertNull($importSingleConversionDto->getSum());

        $importSingleConversionDto = new ConversionDto(static::$requiredAttributes);
        $this->assertNull($importSingleConversionDto->getSum());
    }

    public function testGetComment(): void
    {
        $importSingleConversionDto = new ConversionDto(static::$requiredAttributes + ['comment' => 'consequatur']);
        $this->assertEquals('consequatur', $importSingleConversionDto->getComment());

        $importSingleConversionDto = new ConversionDto(static::$requiredAttributes + ['comment' => null]);
        $this->assertNull($importSingleConversionDto->getComment());

        $importSingleConversionDto = new ConversionDto(static::$requiredAttributes);
        $this->assertNull($importSingleConversionDto->getComment());
    }
}
