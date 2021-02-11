<?php

declare(strict_types=1);

namespace Affise\Sdk\AdvertiserBilling;

use PHPUnit\Framework\TestCase;

/**
 * Class InvoiceDtoTest
 */
class InvoiceDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'number' => 1,
            'supplier_id' => '5a37c01cbf0b6b18008b4567',
            'created_at' => '2018-01-11',
            'updated_at' => '2018-01-11',
            'start_date' => '2017-12-05',
            'end_date' => '2017-12-07',
            'status' => 'unpaid',
            'detail' => [
                [
                    'offer_id' => 1,
                    'payout_type' => 'RPA',
                    'actions' => 100,
                    'amount' => 100,

                ],
            ],
            'currency' => 'USD',
            'comment' => 'some comment',
        ];
    }

    public function testGetNumber(): void
    {
        $invoicesListDto = new InvoiceDto(static::$requiredAttributes);

        $this->assertEquals(1, $invoicesListDto->getNumber());
    }

    public function testGetSupplierId(): void
    {
        $invoicesListDto = new InvoiceDto(static::$requiredAttributes);

        $this->assertEquals('5a37c01cbf0b6b18008b4567', $invoicesListDto->getSupplierId());
    }

    public function testGetCreatedAt(): void
    {
        $invoicesListDto = new InvoiceDto(static::$requiredAttributes);

        $this->assertEquals('2018-01-11', $invoicesListDto->getCreatedAt());
    }

    public function testGetUpdatedAt(): void
    {
        $invoicesListDto = new InvoiceDto(static::$requiredAttributes);

        $this->assertEquals('2018-01-11', $invoicesListDto->getUpdatedAt());
    }

    public function testGetStartDate(): void
    {
        $invoicesListDto = new InvoiceDto(static::$requiredAttributes);

        $this->assertEquals('2017-12-05', $invoicesListDto->getStartDate());
    }

    public function testGetEndDate(): void
    {
        $invoicesListDto = new InvoiceDto(static::$requiredAttributes);

        $this->assertEquals('2017-12-07', $invoicesListDto->getEndDate());
    }

    public function testGetStatus(): void
    {
        $invoicesListDto = new InvoiceDto(static::$requiredAttributes);

        $this->assertEquals('unpaid', $invoicesListDto->getStatus());
    }

    public function testGetDetail(): void
    {
        $invoicesListDto = new InvoiceDto(static::$requiredAttributes);

        $this->assertEquals(
            [
                new DetailDto(
                    [
                        'offer_id' => 1,
                        'payout_type' => 'RPA',
                        'actions' => 100,
                        'amount' => 100,
                    ]
                ),
            ],
            $invoicesListDto->getDetail()
        );
    }

    public function testGetCurrency(): void
    {
        $invoicesListDto = new InvoiceDto(static::$requiredAttributes);

        $this->assertEquals('USD', $invoicesListDto->getCurrency());
    }

    public function testGetComment(): void
    {
        $invoicesListDto = new InvoiceDto(static::$requiredAttributes);

        $this->assertEquals('some comment', $invoicesListDto->getComment());
    }
}
