<?php

declare(strict_types=1);

namespace Affise\Sdk\OtherManaging;

use PHPUnit\Framework\TestCase;

/**
 * Class PaymentSystemsListDtoTest
 */
class PaymentSystemsListDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'id' => 2,
            'lang_label' => 'Wire transfer',
            'fields' => [
                [
                    'id' => 1,
                    'lang_label' => 'IBAN/Account Number',
                    'required' => true,
                ],
            ],
        ];
    }

    public function testGetId(): void
    {
        $paymentSystemsListDto = new PaymentSystemsListDto(static::$requiredAttributes);

        $this->assertEquals(2, $paymentSystemsListDto->getId());
    }

    public function testGetLangLabel(): void
    {
        $paymentSystemsListDto = new PaymentSystemsListDto(static::$requiredAttributes);

        $this->assertEquals('Wire transfer', $paymentSystemsListDto->getLangLabel());
    }

    public function testGetFields(): void
    {
        $paymentSystemsListDto = new PaymentSystemsListDto(static::$requiredAttributes);

        $this->assertEquals(
            [
                new FieldDto(
                    [
                        'id' => 1,
                        'lang_label' => 'IBAN/Account Number',
                        'required' => true,
                    ]
                ),
            ],
            $paymentSystemsListDto->getFields()
        );
    }

    public function testGetCurrency(): void
    {
        $paymentSystemsListDto = new PaymentSystemsListDto(static::$requiredAttributes + ['currency' => 'AED']);
        $this->assertEquals('AED', $paymentSystemsListDto->getCurrency());

        $paymentSystemsListDto = new PaymentSystemsListDto(static::$requiredAttributes);
        $this->assertNull($paymentSystemsListDto->getCurrency());
    }
}
