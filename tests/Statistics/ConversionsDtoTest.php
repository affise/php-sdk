<?php

declare(strict_types=1);

namespace Affise\Sdk\Statistics;

use PHPUnit\Framework\TestCase;

/**
 * Class ConversionsDtoTest
 */
class ConversionsDtoTest extends TestCase
{
    private static array $requiredAttributes;

    public static function setUpBeforeClass(): void
    {
        static::$requiredAttributes = [
            'id' => '59359e1d7e28feb7568b456a',
            'action_id' => '59359dcb7e28fee0558b4567',
            'status' => 'confirmed',
            'currency' => 'USD',
            'country' => 'US',
            'city' => 'New York',
            'ip' => 'vel',
            'browser' => 'porro',
            'os' => 'odit',
            'device' => 'Other',
            'offer' => [
                'id' => 934,
                'offer_id' => '59313e097960ad2774b4f274',
                'title' => 'HD-smart [Web]',
                'url' => 'http://affise.com/1',
            ],
            'offer_id' => 934,
            'sub1' => '',
            'sub2' => '',
            'sub3' => '',
            'sub4' => '',
            'sub5' => '',
            'custom_field_1' => '',
            'custom_field_2' => '',
            'custom_field_3' => '',
            'custom_field_4' => '',
            'custom_field_5' => '',
            'custom_field_6' => '',
            'custom_field_7' => '',
            'ua' => 'minima',
            'comment' => '',
            'created_at' => '2017-06-06 03:08:29',
            'click_time' => '2017-06-06 03:07:07',
            'referrer' => 'minima',
            'payouts' => 1234.75,
            'clickid' => '59359dcb7e28fee0558b4567',
            'partner' => [
                'id' => 610,
                'email' => 'antonette.kuhn@example.org',
                'login' => 'example',
                'name' => '',
            ],
            'goal_value' => '1',
            'sum' => 0.0,
            'revenue' => 12345.70,
            'earnings' => 11111.25,
            'advertiser' => [
                'id' => '56cc49dc3b7d9b89058b45f0',
                'title' => 'Example',
            ],
            'payment_status' => 'opened',
            'is_paid' => '1',
        ];
    }

    public function testGetId(): void
    {
        $conversionsDto = new ConversionsDto(static::$requiredAttributes);

        $this->assertEquals('59359e1d7e28feb7568b456a', $conversionsDto->getId());
    }

    public function testGetActionId(): void
    {
        $conversionsDto = new ConversionsDto(static::$requiredAttributes);

        $this->assertEquals('59359dcb7e28fee0558b4567', $conversionsDto->getActionId());
    }

    public function testGetStatus(): void
    {
        $conversionsDto = new ConversionsDto(static::$requiredAttributes);

        $this->assertEquals('confirmed', $conversionsDto->getStatus());
    }

    public function testGetCurrency(): void
    {
        $conversionsDto = new ConversionsDto(static::$requiredAttributes);

        $this->assertEquals('USD', $conversionsDto->getCurrency());
    }

    public function testGetCountry(): void
    {
        $conversionsDto = new ConversionsDto(static::$requiredAttributes);

        $this->assertEquals('US', $conversionsDto->getCountry());
    }

    public function testGetDistrict(): void
    {
        $conversionsDto = new ConversionsDto(static::$requiredAttributes + ['district' => 'test']);
        $this->assertEquals('test', $conversionsDto->getDistrict());

        $conversionsDto = new ConversionsDto(static::$requiredAttributes + ['district' => null]);
        $this->assertNull($conversionsDto->getDistrict());

        $conversionsDto = new ConversionsDto(static::$requiredAttributes);
        $this->assertNull($conversionsDto->getDistrict());
    }

    public function testGetCity(): void
    {
        $conversionsDto = new ConversionsDto(static::$requiredAttributes);

        $this->assertEquals('New York', $conversionsDto->getCity());
    }

    public function testGetIp(): void
    {
        $conversionsDto = new ConversionsDto(static::$requiredAttributes);

        $this->assertEquals('vel', $conversionsDto->getIp());
    }

    public function testGetBrowser(): void
    {
        $conversionsDto = new ConversionsDto(static::$requiredAttributes);

        $this->assertEquals('porro', $conversionsDto->getBrowser());
    }

    public function testGetOs(): void
    {
        $conversionsDto = new ConversionsDto(static::$requiredAttributes);

        $this->assertEquals('odit', $conversionsDto->getOs());
    }

    public function testGetDevice(): void
    {
        $conversionsDto = new ConversionsDto(static::$requiredAttributes);

        $this->assertEquals('Other', $conversionsDto->getDevice());
    }

    public function testGetOffer(): void
    {
        $conversionsDto = new ConversionsDto(static::$requiredAttributes);

        $this->assertEquals(
            new OfferDto([
                'id' => 934,
                'offer_id' => '59313e097960ad2774b4f274',
                'title' => 'HD-smart [Web]',
                'url' => 'http://affise.com/1',
            ]),
            $conversionsDto->getOffer()
        );
    }

    public function testGetOfferId(): void
    {
        $conversionsDto = new ConversionsDto(static::$requiredAttributes);

        $this->assertEquals('934', $conversionsDto->getOfferId());
    }

    public function testGetIosIdfa(): void
    {
        $conversionsDto = new ConversionsDto(static::$requiredAttributes + ['ios_idfa' => 'test']);
        $this->assertEquals('test', $conversionsDto->getIosIdfa());

        $conversionsDto = new ConversionsDto(static::$requiredAttributes + ['ios_idfa' => null]);
        $this->assertNull($conversionsDto->getIosIdfa());

        $conversionsDto = new ConversionsDto(static::$requiredAttributes);
        $this->assertNull($conversionsDto->getIosIdfa());
    }

    public function testGetAndroidId(): void
    {
        $conversionsDto = new ConversionsDto(static::$requiredAttributes + ['android_id' => 'test']);
        $this->assertEquals('test', $conversionsDto->getAndroidId());

        $conversionsDto = new ConversionsDto(static::$requiredAttributes + ['android_id' => null]);
        $this->assertNull($conversionsDto->getAndroidId());

        $conversionsDto = new ConversionsDto(static::$requiredAttributes);
        $this->assertNull($conversionsDto->getAndroidId());
    }

    public function testGetSub1(): void
    {
        $conversionsDto = new ConversionsDto(static::$requiredAttributes);

        $this->assertEquals('', $conversionsDto->getSub1());
    }

    public function testGetSub2(): void
    {
        $conversionsDto = new ConversionsDto(static::$requiredAttributes);

        $this->assertEquals('', $conversionsDto->getSub2());
    }

    public function testGetSub3(): void
    {
        $conversionsDto = new ConversionsDto(static::$requiredAttributes);

        $this->assertEquals('', $conversionsDto->getSub3());
    }

    public function testGetSub4(): void
    {
        $conversionsDto = new ConversionsDto(static::$requiredAttributes);

        $this->assertEquals('', $conversionsDto->getSub4());
    }

    public function testGetSub5(): void
    {
        $conversionsDto = new ConversionsDto(static::$requiredAttributes);

        $this->assertEquals('', $conversionsDto->getSub5());
    }

    public function testGetCustomField1(): void
    {
        $conversionsDto = new ConversionsDto(static::$requiredAttributes);

        $this->assertEquals('', $conversionsDto->getCustomField1());
    }

    public function testGetCustomField2(): void
    {
        $conversionsDto = new ConversionsDto(static::$requiredAttributes);

        $this->assertEquals('', $conversionsDto->getCustomField2());
    }

    public function testGetCustomField3(): void
    {
        $conversionsDto = new ConversionsDto(static::$requiredAttributes);

        $this->assertEquals('', $conversionsDto->getCustomField3());
    }

    public function testGetCustomField4(): void
    {
        $conversionsDto = new ConversionsDto(static::$requiredAttributes);

        $this->assertEquals('', $conversionsDto->getCustomField4());
    }

    public function testGetCustomField5(): void
    {
        $conversionsDto = new ConversionsDto(static::$requiredAttributes);

        $this->assertEquals('', $conversionsDto->getCustomField5());
    }

    public function testGetCustomField6(): void
    {
        $conversionsDto = new ConversionsDto(static::$requiredAttributes);

        $this->assertEquals('', $conversionsDto->getCustomField6());
    }

    public function testGetCustomField7(): void
    {
        $conversionsDto = new ConversionsDto(static::$requiredAttributes);

        $this->assertEquals('', $conversionsDto->getCustomField7());
    }

    public function testGetUa(): void
    {
        $conversionsDto = new ConversionsDto(static::$requiredAttributes);

        $this->assertEquals('minima', $conversionsDto->getUa());
    }

    public function testGetComment(): void
    {
        $conversionsDto = new ConversionsDto(static::$requiredAttributes);

        $this->assertEquals('', $conversionsDto->getComment());
    }

    public function testGetCreatedAt(): void
    {
        $conversionsDto = new ConversionsDto(static::$requiredAttributes);

        $this->assertEquals('2017-06-06 03:08:29', $conversionsDto->getCreatedAt());
    }

    public function testGetClickTime(): void
    {
        $conversionsDto = new ConversionsDto(static::$requiredAttributes);

        $this->assertEquals('2017-06-06 03:07:07', $conversionsDto->getClickTime());
    }

    public function testGetReferrer(): void
    {
        $conversionsDto = new ConversionsDto(static::$requiredAttributes);

        $this->assertEquals('minima', $conversionsDto->getReferrer());
    }

    public function testGetPayouts(): void
    {
        $conversionsDto = new ConversionsDto(static::$requiredAttributes);

        $this->assertEquals(1234.75, $conversionsDto->getPayouts());
    }

    public function testGetClickid(): void
    {
        $conversionsDto = new ConversionsDto(static::$requiredAttributes);

        $this->assertEquals('59359dcb7e28fee0558b4567', $conversionsDto->getClickId());
    }

    public function testGetPartner(): void
    {
        $conversionsDto = new ConversionsDto(static::$requiredAttributes);

        $this->assertEquals(
            new PartnerDto([
                'id' => 610,
                'email' => 'antonette.kuhn@example.org',
                'login' => 'example',
                'name' => '',
            ]),
            $conversionsDto->getPartner()
        );
    }

    public function testGetGoalValue(): void
    {
        $conversionsDto = new ConversionsDto(static::$requiredAttributes);

        $this->assertEquals('1', $conversionsDto->getGoalValue());
    }

    public function testGetSum(): void
    {
        $conversionsDto = new ConversionsDto(static::$requiredAttributes);

        $this->assertEquals(0.0, $conversionsDto->getSum());
    }

    public function testGetRevenue(): void
    {
        $conversionsDto = new ConversionsDto(static::$requiredAttributes);

        $this->assertEquals(12345.70, $conversionsDto->getRevenue());
    }

    public function testGetEarnings(): void
    {
        $conversionsDto = new ConversionsDto(static::$requiredAttributes);

        $this->assertEquals(11111.25, $conversionsDto->getEarnings());
    }

    public function testGetAdvertiser(): void
    {
        $conversionsDto = new ConversionsDto(static::$requiredAttributes);

        $this->assertEquals(
            new AdvertiserDto([
                'id' => '56cc49dc3b7d9b89058b45f0',
                'title' => 'Example',
            ]),
            $conversionsDto->getAdvertiser()
        );
    }

    public function testGetPaymentStatus(): void
    {
        $conversionsDto = new ConversionsDto(static::$requiredAttributes);

        $this->assertEquals('opened', $conversionsDto->getPaymentStatus());
    }

    public function testGetIsPaid(): void
    {
        $conversionsDto = new ConversionsDto(static::$requiredAttributes);

        $this->assertEquals('1', $conversionsDto->getIsPaid());
    }

    public function testGetGoal(): void
    {
        $conversionsDto = new ConversionsDto(static::$requiredAttributes + ['goal' => 'eveniet']);
        $this->assertEquals('eveniet', $conversionsDto->getGoal());

        $conversionsDto = new ConversionsDto(static::$requiredAttributes + ['goal' => null]);
        $this->assertNull($conversionsDto->getGoal());

        $conversionsDto = new ConversionsDto(static::$requiredAttributes);
        $this->assertNull($conversionsDto->getGoal());
    }

    public function testGetForensiq(): void
    {
        $conversionsDto = new ConversionsDto(static::$requiredAttributes + ['forensiq' => 'velit']);
        $this->assertEquals('velit', $conversionsDto->getForensiq());

        $conversionsDto = new ConversionsDto(static::$requiredAttributes + ['forensiq' => null]);
        $this->assertNull($conversionsDto->getForensiq());

        $conversionsDto = new ConversionsDto(static::$requiredAttributes);
        $this->assertNull($conversionsDto->getForensiq());
    }

    public function testGetPaymentType(): void
    {
        $conversionsDto = new ConversionsDto(static::$requiredAttributes + ['payment_type' => 'perferendis']);
        $this->assertEquals('perferendis', $conversionsDto->getPaymentType());

        $conversionsDto = new ConversionsDto(static::$requiredAttributes + ['payment_type' => null]);
        $this->assertNull($conversionsDto->getPaymentType());

        $conversionsDto = new ConversionsDto(static::$requiredAttributes);
        $this->assertNull($conversionsDto->getPaymentType());
    }

    public function testGetHoldDateExpire(): void
    {
        $conversionsDto = new ConversionsDto(static::$requiredAttributes + ['hold_date_expire' => 'explicabo']);
        $this->assertEquals('explicabo', $conversionsDto->getHoldDateExpire());

        $conversionsDto = new ConversionsDto(static::$requiredAttributes + ['hold_date_expire' => null]);
        $this->assertNull($conversionsDto->getHoldDateExpire());

        $conversionsDto = new ConversionsDto(static::$requiredAttributes);
        $this->assertNull($conversionsDto->getHoldDateExpire());
    }
}
