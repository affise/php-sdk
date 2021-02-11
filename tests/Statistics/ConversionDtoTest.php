<?php

declare(strict_types=1);

namespace Affise\Sdk\Statistics;

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
            'id' => '5bd00d73901fcf20008b4574',
            'action_id' => '5bd00c641d580e000162cf94',
            'status' => 1,
            'conversion_id' => '5bd00d73901fcf20008b4574',
            'cbid' => '5bd00c641d580e000162cf94',
            'currency' => 'USD',
            'offer' => [
                'id' => 7,
                'title' => 'Test Offer',
                'offer_id' => '5b59b752f44d940011105103',
                'url' => 'http://affise.com',
            ],
            'offer_id' => 7,
            'goal' => '',
            'ip' => 'soluta',
            'country' => '',
            'country_name' => '',
            'city' => 'Undefined',
            'city_id' => 0,
            'isp_code' => '',
            'ua' => 'fugit',
            'browser' => 'Unknown Unknown',
            'os' => 'Linux Unknown',
            'device' => 'desktop',
            'device_type' => 'desktop',
            'click_time' => '2018-10-22 09:08:36',
            'createdAt' => '2018-10-22 09:13:07',
            'updatedAt' => '2018-10-22 09:13:07',
            'partner' => [
                'id' => 2,
                'email' => 'olga86@example.org',
                'login' => 'Yvette Michael',
                'name' => 'Yvette Michael',
            ],
            'supplier_id' => '5b5f415035752723008b456a',
            'partner_id' => 2,
            'goal_value' => '1',
            'sum' => 0,
            'revenue' => 3,
            'payouts' => 3,
            'earnings' => 3,
            'advertiser' => [
                'id' => '5b5f415035752723008b456a',
                'title' => 'Text supplier 2',
            ],
            'payment_type' => 'fixed',
            'payment_status' => 'opened',
            'is_paid' => '1',
            'charge' => 6,
            'earning' => 3,
            'click_id' => '5bd00c641d580e000162cf94',
        ];
    }

    public function testGetId(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes);

        $this->assertEquals('5bd00d73901fcf20008b4574', $conversionDto->getId());
    }

    public function testGetActionId(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes);

        $this->assertEquals('5bd00c641d580e000162cf94', $conversionDto->getActionId());
    }

    public function testGetStatus(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes);

        $this->assertEquals(1, $conversionDto->getStatus());
    }

    public function testGetConversionId(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes);

        $this->assertEquals('5bd00d73901fcf20008b4574', $conversionDto->getConversionId());
    }

    public function testGetCbid(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes);

        $this->assertEquals('5bd00c641d580e000162cf94', $conversionDto->getCbid());
    }

    public function testGetCurrency(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes);

        $this->assertEquals('USD', $conversionDto->getCurrency());
    }

    public function testGetOffer(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes);

        $this->assertEquals(
            new OfferDto(
                [
                    'id' => 7,
                    'title' => 'Test Offer',
                    'offer_id' => '5b59b752f44d940011105103',
                    'url' => 'http://affise.com',
                ]
            ),
            $conversionDto->getOffer()
        );
    }

    public function testGetOfferId(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes);

        $this->assertEquals(7, $conversionDto->getOfferId());
    }

    public function testGetGoal(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes);

        $this->assertEquals('', $conversionDto->getGoal());
    }

    public function testGetIp(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes);

        $this->assertEquals('soluta', $conversionDto->getIp());
    }

    public function testGetCountry(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes);

        $this->assertEquals('', $conversionDto->getCountry());
    }

    public function testGetCountryName(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes);

        $this->assertEquals('', $conversionDto->getCountryName());
    }

    public function testGetCity(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes);

        $this->assertEquals('Undefined', $conversionDto->getCity());
    }

    public function testGetCityId(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes);

        $this->assertEquals(0, $conversionDto->getCityId());
    }

    public function testGetIspCode(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes);

        $this->assertEquals('', $conversionDto->getIspCode());
    }

    public function testGetUa(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes);

        $this->assertEquals('fugit', $conversionDto->getUa());
    }

    public function testGetBrowser(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes);

        $this->assertEquals('Unknown Unknown', $conversionDto->getBrowser());
    }

    public function testGetOs(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes);

        $this->assertEquals('Linux Unknown', $conversionDto->getOs());
    }

    public function testGetDevice(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes);

        $this->assertEquals('desktop', $conversionDto->getDevice());
    }

    public function testGetDeviceType(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes);

        $this->assertEquals('desktop', $conversionDto->getDeviceType());
    }

    public function testGetClickTime(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes);

        $this->assertEquals('2018-10-22 09:08:36', $conversionDto->getClickTime());
    }

    public function testGetCreatedAt(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes);

        $this->assertEquals('2018-10-22 09:13:07', $conversionDto->getCreatedAt());
    }

    public function testGetUpdatedAt(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes);

        $this->assertEquals('2018-10-22 09:13:07', $conversionDto->getUpdatedAt());
    }

    public function testGetPartner(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes);

        $this->assertEquals(
            new PartnerDto(
                [
                    'id' => 2,
                    'email' => 'olga86@example.org',
                    'login' => 'Yvette Michael',
                    'name' => 'Yvette Michael',
                ]
            ),
            $conversionDto->getPartner()
        );
    }

    public function testGetSupplierId(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes);

        $this->assertEquals('5b5f415035752723008b456a', $conversionDto->getSupplierId());
    }

    public function testGetPartnerId(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes);

        $this->assertEquals(2, $conversionDto->getPartnerId());
    }

    public function testGetGoalValue(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes);

        $this->assertEquals('1', $conversionDto->getGoalValue());
    }

    public function testGetSum(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes);

        $this->assertEquals(0, $conversionDto->getSum());
    }

    public function testGetRevenue(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes);

        $this->assertEquals(3, $conversionDto->getRevenue());
    }

    public function testGetPayouts(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes);

        $this->assertEquals(3, $conversionDto->getPayouts());
    }

    public function testGetEarnings(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes);

        $this->assertEquals(3, $conversionDto->getEarnings());
    }

    public function testGetAdvertiser(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes);

        $this->assertEquals(
            new AdvertiserDto(
                [
                    'id' => '5b5f415035752723008b456a',
                    'title' => 'Text supplier 2',
                ]
            ),
            $conversionDto->getAdvertiser()
        );
    }

    public function testGetPaymentType(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes);

        $this->assertEquals('fixed', $conversionDto->getPaymentType());
    }

    public function testGetPaymentStatus(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes);

        $this->assertEquals('opened', $conversionDto->getPaymentStatus());
    }

    public function testGetIsPaid(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes);

        $this->assertEquals('1', $conversionDto->getIsPaid());
    }

    public function testGetCharge(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes);

        $this->assertEquals(6, $conversionDto->getCharge());
    }

    public function testGetEarning(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes);

        $this->assertEquals(3, $conversionDto->getEarning());
    }

    public function testGetClickId(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes);

        $this->assertEquals('5bd00c641d580e000162cf94', $conversionDto->getClickId());
    }

    public function testGetHoldDateExpire(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes + ['hold_date_expire' => 'non']);
        $this->assertEquals('non', $conversionDto->getHoldDateExpire());

        $conversionDto = new ConversionDto(static::$requiredAttributes + ['hold_date_expire' => null]);
        $this->assertNull($conversionDto->getHoldDateExpire());

        $conversionDto = new ConversionDto(static::$requiredAttributes);
        $this->assertNull($conversionDto->getHoldDateExpire());
    }

    public function testGetDistrict(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes + ['district' => 'et']);
        $this->assertEquals('et', $conversionDto->getDistrict());

        $conversionDto = new ConversionDto(static::$requiredAttributes + ['district' => null]);
        $this->assertNull($conversionDto->getDistrict());

        $conversionDto = new ConversionDto(static::$requiredAttributes);
        $this->assertNull($conversionDto->getDistrict());
    }

    public function testGetSub1(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes + ['sub1' => 'autem']);
        $this->assertEquals('autem', $conversionDto->getSub1());

        $conversionDto = new ConversionDto(static::$requiredAttributes + ['sub1' => null]);
        $this->assertNull($conversionDto->getSub1());

        $conversionDto = new ConversionDto(static::$requiredAttributes);
        $this->assertNull($conversionDto->getSub1());
    }

    public function testGetSub2(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes + ['sub2' => 'autem']);
        $this->assertEquals('autem', $conversionDto->getSub2());

        $conversionDto = new ConversionDto(static::$requiredAttributes + ['sub2' => null]);
        $this->assertNull($conversionDto->getSub2());

        $conversionDto = new ConversionDto(static::$requiredAttributes);
        $this->assertNull($conversionDto->getSub2());
    }

    public function testGetSub3(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes + ['sub3' => 'officia']);
        $this->assertEquals('officia', $conversionDto->getSub3());

        $conversionDto = new ConversionDto(static::$requiredAttributes + ['sub3' => null]);
        $this->assertNull($conversionDto->getSub3());

        $conversionDto = new ConversionDto(static::$requiredAttributes);
        $this->assertNull($conversionDto->getSub3());
    }

    public function testGetSub4(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes + ['sub4' => 'itaque']);
        $this->assertEquals('itaque', $conversionDto->getSub4());

        $conversionDto = new ConversionDto(static::$requiredAttributes + ['sub4' => null]);
        $this->assertNull($conversionDto->getSub4());

        $conversionDto = new ConversionDto(static::$requiredAttributes);
        $this->assertNull($conversionDto->getSub4());
    }

    public function testGetSub5(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes + ['sub5' => 'qui']);
        $this->assertEquals('qui', $conversionDto->getSub5());

        $conversionDto = new ConversionDto(static::$requiredAttributes + ['sub5' => null]);
        $this->assertNull($conversionDto->getSub5());

        $conversionDto = new ConversionDto(static::$requiredAttributes);
        $this->assertNull($conversionDto->getSub5());
    }

    public function testGetSub6(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes + ['sub6' => 'vero']);
        $this->assertEquals('vero', $conversionDto->getSub6());

        $conversionDto = new ConversionDto(static::$requiredAttributes + ['sub6' => null]);
        $this->assertNull($conversionDto->getSub6());

        $conversionDto = new ConversionDto(static::$requiredAttributes);
        $this->assertNull($conversionDto->getSub6());
    }

    public function testGetSub7(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes + ['sub7' => 'totam']);
        $this->assertEquals('totam', $conversionDto->getSub7());

        $conversionDto = new ConversionDto(static::$requiredAttributes + ['sub7' => null]);
        $this->assertNull($conversionDto->getSub7());

        $conversionDto = new ConversionDto(static::$requiredAttributes);
        $this->assertNull($conversionDto->getSub7());
    }

    public function testGetSub8(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes + ['sub8' => 'provident']);
        $this->assertEquals('provident', $conversionDto->getSub8());

        $conversionDto = new ConversionDto(static::$requiredAttributes + ['sub8' => null]);
        $this->assertNull($conversionDto->getSub8());

        $conversionDto = new ConversionDto(static::$requiredAttributes);
        $this->assertNull($conversionDto->getSub8());
    }

    public function testGetCustomField1(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes + ['custom_field_1' => 'quisquam']);
        $this->assertEquals('quisquam', $conversionDto->getCustomField1());

        $conversionDto = new ConversionDto(static::$requiredAttributes + ['custom_field_1' => null]);
        $this->assertNull($conversionDto->getCustomField1());

        $conversionDto = new ConversionDto(static::$requiredAttributes);
        $this->assertNull($conversionDto->getCustomField1());
    }

    public function testGetCustomField2(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes + ['custom_field_2' => 'expedita']);
        $this->assertEquals('expedita', $conversionDto->getCustomField2());

        $conversionDto = new ConversionDto(static::$requiredAttributes + ['custom_field_2' => null]);
        $this->assertNull($conversionDto->getCustomField2());

        $conversionDto = new ConversionDto(static::$requiredAttributes);
        $this->assertNull($conversionDto->getCustomField2());
    }

    public function testGetCustomField3(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes + ['custom_field_3' => 'rerum']);
        $this->assertEquals('rerum', $conversionDto->getCustomField3());

        $conversionDto = new ConversionDto(static::$requiredAttributes + ['custom_field_3' => null]);
        $this->assertNull($conversionDto->getCustomField3());

        $conversionDto = new ConversionDto(static::$requiredAttributes);
        $this->assertNull($conversionDto->getCustomField3());
    }

    public function testGetCustomField4(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes + ['custom_field_4' => 'aliquid']);
        $this->assertEquals('aliquid', $conversionDto->getCustomField4());

        $conversionDto = new ConversionDto(static::$requiredAttributes + ['custom_field_4' => null]);
        $this->assertNull($conversionDto->getCustomField4());

        $conversionDto = new ConversionDto(static::$requiredAttributes);
        $this->assertNull($conversionDto->getCustomField4());
    }

    public function testGetCustomField5(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes + ['custom_field_5' => 'quas']);
        $this->assertEquals('quas', $conversionDto->getCustomField5());

        $conversionDto = new ConversionDto(static::$requiredAttributes + ['custom_field_5' => null]);
        $this->assertNull($conversionDto->getCustomField5());

        $conversionDto = new ConversionDto(static::$requiredAttributes);
        $this->assertNull($conversionDto->getCustomField5());
    }

    public function testGetCustomField6(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes + ['custom_field_6' => 'fugiat']);
        $this->assertEquals('fugiat', $conversionDto->getCustomField6());

        $conversionDto = new ConversionDto(static::$requiredAttributes + ['custom_field_6' => null]);
        $this->assertNull($conversionDto->getCustomField6());

        $conversionDto = new ConversionDto(static::$requiredAttributes);
        $this->assertNull($conversionDto->getCustomField6());
    }

    public function testGetCustomField7(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes + ['custom_field_7' => 'est']);
        $this->assertEquals('est', $conversionDto->getCustomField7());

        $conversionDto = new ConversionDto(static::$requiredAttributes + ['custom_field_7' => null]);
        $this->assertNull($conversionDto->getCustomField7());

        $conversionDto = new ConversionDto(static::$requiredAttributes);
        $this->assertNull($conversionDto->getCustomField7());
    }

    public function testGetComment(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes + ['comment' => 'consectetur']);
        $this->assertEquals('consectetur', $conversionDto->getComment());

        $conversionDto = new ConversionDto(static::$requiredAttributes + ['comment' => null]);
        $this->assertNull($conversionDto->getComment());

        $conversionDto = new ConversionDto(static::$requiredAttributes);
        $this->assertNull($conversionDto->getComment());
    }

    public function testGetReferrer(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes + ['referrer' => 'voluptas']);
        $this->assertEquals('voluptas', $conversionDto->getReferrer());

        $conversionDto = new ConversionDto(static::$requiredAttributes + ['referrer' => null]);
        $this->assertNull($conversionDto->getReferrer());

        $conversionDto = new ConversionDto(static::$requiredAttributes);
        $this->assertNull($conversionDto->getReferrer());
    }

    public function testGetLandingId(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes + ['landing_id' => 'iusto']);
        $this->assertEquals('iusto', $conversionDto->getLandingId());

        $conversionDto = new ConversionDto(static::$requiredAttributes + ['landing_id' => null]);
        $this->assertNull($conversionDto->getLandingId());

        $conversionDto = new ConversionDto(static::$requiredAttributes);
        $this->assertNull($conversionDto->getLandingId());
    }

    public function testGetPrelandingId(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes + ['prelanding_id' => 'consequuntur']);
        $this->assertEquals('consequuntur', $conversionDto->getPrelandingId());

        $conversionDto = new ConversionDto(static::$requiredAttributes + ['prelanding_id' => null]);
        $this->assertNull($conversionDto->getPrelandingId());

        $conversionDto = new ConversionDto(static::$requiredAttributes);
        $this->assertNull($conversionDto->getPrelandingId());
    }

    public function testGetCurrencyId(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes + ['currency_id' => 'inventore']);
        $this->assertEquals('inventore', $conversionDto->getCurrencyId());

        $conversionDto = new ConversionDto(static::$requiredAttributes + ['currency_id' => null]);
        $this->assertNull($conversionDto->getCurrencyId());

        $conversionDto = new ConversionDto(static::$requiredAttributes);
        $this->assertNull($conversionDto->getCurrencyId());
    }

    public function testGetPrice(): void
    {
        $conversionDto = new ConversionDto(static::$requiredAttributes + ['price' => 'commodi']);
        $this->assertEquals('commodi', $conversionDto->getPrice());

        $conversionDto = new ConversionDto(static::$requiredAttributes + ['price' => null]);
        $this->assertNull($conversionDto->getPrice());

        $conversionDto = new ConversionDto(static::$requiredAttributes);
        $this->assertNull($conversionDto->getPrice());
    }
}
