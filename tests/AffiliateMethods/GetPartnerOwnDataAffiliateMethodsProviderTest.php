<?php

declare(strict_types=1);

namespace Affise\Sdk\AffiliateMethods;

use Affise\Sdk\Exception\AccessDeniedException;
use Affise\Sdk\Exception\BadRequestException;
use Affise\Sdk\Exception\EndpointNotFoundException;
use Affise\Sdk\Exception\TimeoutException;
use Affise\Sdk\Exception\TokenMissingException;
use Affise\Sdk\Exception\TransportException;
use Affise\Sdk\Transport\TransportInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class GetPartnerOwnDataAffiliateMethodsProviderTest
 */
class GetPartnerOwnDataAffiliateMethodsProviderTest extends TestCase
{
    private static array $attributes;

    public static function setupBeforeClass(): void
    {
        static::$attributes = [
            'partner_id' => 2,
            'id' => '5f297e9a6dc8e2f008745d7c',
            'api_key' => 'ca30365558190b87c9fe1c496e467c2d',
            'created_at' => '2020-08-04T15:28:26Z',
            'email' => 'gleason.enrique@example.net',
            'status' => '1',
            'updated_at' => '2021-01-06T12:35:17Z',
            'ref' => '0',
            'lang' => 'en',
            'manager_id' => '5f9008bfafd0ba5d88c4dee8',
            'notes' => '',
            'ref_percent' => '0',
            'pay_acc' => '',
            'pay_acc_wmz' => '',
            'balance_ru' => 'voluptatem',
            'hold_ru' => 'quibusdam',
            'available_ru' => 'qui',
            'balance_usd' => 'blanditiis',
            'hold_usd' => 'optio',
            'available_usd' => 'atque',
            'address_1' => 'rthrth',
            'city' => 'rthrt',
            'country' => 'AE',
            'sub_accounts' => [['value' => '', 'except' => 0], ['value' => '', 'except' => 0]],
            'tipalti_info' => '[]',
            'contact_person' => 'aliquid',
            'type' => 'affiliate',
            'permissions' => [
                'general' => ['marketplace' => ['level' => 'deny'], 'settings' => ['level' => 'deny']],
                'stats' => [
                    'affiliate-postback' => ['level' => 'read'],
                    'clicks-list' => ['level' => 'read'],
                    'comparison-report' => ['level' => 'read'],
                    'conversions-export' => ['level' => 'read'],
                    'conversions-import' => ['level' => 'deny'],
                    'conversions-list' => ['level' => 'read'],
                    'entity-account-manager' => [
                        'level' => 'read',
                        'default_level' => 'read',
                        'exceptions' => ['strings' => []],
                    ],
                    'entity-affiliate-manager' => [
                        'level' => 'read',
                        'default_level' => 'read',
                        'exceptions' => ['strings' => []],
                    ],
                    'referral' => ['level' => 'read'],
                    'server-postback' => ['level' => 'read'],
                    'slice-account_manager_id' => ['level' => 'read'],
                    'slice-advertiser_id' => ['level' => 'read'],
                    'slice-affiliate_id' => ['level' => 'read'],
                    'slice-affiliate_manager_id' => ['level' => 'read'],
                    'slice-browser' => ['level' => 'read'],
                    'slice-city' => ['level' => 'read'],
                    'slice-connection-type' => ['level' => 'read'],
                    'slice-country' => ['level' => 'read'],
                    'slice-day' => ['level' => 'read'],
                    'slice-device' => ['level' => 'read'],
                    'slice-goal' => ['level' => 'read'],
                    'slice-landing' => ['level' => 'read'],
                    'slice-mobile-carrier' => ['level' => 'read'],
                    'slice-offer_id' => ['level' => 'read'],
                    'slice-os' => ['level' => 'read'],
                    'slice-prelanding' => ['level' => 'read'],
                    'slice-smart_id' => ['level' => 'read'],
                    'slice-sub1' => ['level' => 'read'],
                    'slice-sub2' => ['level' => 'read'],
                    'slice-trafficback_reason' => ['level' => 'read'],
                    'stats-export' => ['level' => 'read'],
                    'view-custom' => ['level' => 'read'],
                    'view-kpi' => ['level' => 'read'],
                    'view-retention-rate' => ['level' => 'read'],
                ],
                'users' => [
                    'entity-account-manager' => ['level' => 'deny', 'exceptions' => ['strings' => []]],
                    'entity-advertiser' => ['level' => 'deny', 'exceptions' => ['strings' => []]],
                    'entity-affiliate' => ['level' => 'deny', 'exceptions' => ['ints' => []]],
                    'entity-affiliate-manager' => ['level' => 'deny', 'exceptions' => ['strings' => []]],
                    'entity-common-manager' => ['level' => 'deny', 'exceptions' => ['strings' => []]],
                    'entity-preset' => ['level' => 'deny'],
                    'view-users' => ['level' => 'deny'],
                ],
            ],
            'work_hours' => '',
            'last_login_at' => '2021-01-20T09:55:07Z',
        ];
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testGetPartnerOwnDataResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = static::$attributes;

        $transport->expects($this->once())
            ->method('get')
            ->with('/3.1/partner/me')
            ->willReturn(
                [
                    'status' => 1,
                    'user' => $attributes,
                ]
            );

        $affiliateMethodsProvider = new AffiliateMethodsProvider($transport);
        $response = $affiliateMethodsProvider->getPartnerOwnData();

        $this->assertEquals(1, $response->getStatus());
        $this->assertInstanceOf(GetPartnerOwnDataDto::class, $response->getData());
        $this->assertEquals(new GetPartnerOwnDataDto($attributes), $response->getData());
    }

    /**
     * @param string $exceptionClass
     *
     * @psalm-param class-string<\Affise\Sdk\Exception\TransportException> $exceptionClass
     *
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @dataProvider exceptionsProvider
     *
     * @psalm-suppress UnsafeInstantiation
     */
    public function testGetPartnerOwnDataFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('get')->willThrowException(new $exceptionClass());

        $affiliateMethodsProvider = new AffiliateMethodsProvider($transport);

        $this->expectException($exceptionClass);

        $affiliateMethodsProvider->getPartnerOwnData();
    }

    /**
     * @return array<array<string>>
     * @psalm-return array<array<class-string<\Affise\Sdk\Exception\TransportException>>>
     */
    public function exceptionsProvider(): array
    {
        return [
            [AccessDeniedException::class],
            [BadRequestException::class],
            [EndpointNotFoundException::class],
            [TimeoutException::class],
            [TokenMissingException::class],
            [TransportException::class],
        ];
    }
}
