<?php

declare(strict_types=1);

namespace Affise\Sdk\Affiliate;

use Affise\Sdk\Exception\AccessDeniedException;
use Affise\Sdk\Exception\BadRequestException;
use Affise\Sdk\Exception\EndpointNotFoundException;
use Affise\Sdk\Exception\TimeoutException;
use Affise\Sdk\Exception\TokenMissingException;
use Affise\Sdk\Exception\TransportException;
use Affise\Sdk\Transport\TransportInterface;
use Affise\Sdk\User\Role;
use Affise\Sdk\User\UserDto;
use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * Class EditAffiliateAffiliateProviderTest
 */
class EditAffiliateAffiliateProviderTest extends TestCase
{
    private static array $attributes;

    public static function setupBeforeClass(): void
    {
        static::$attributes = [
            'id' => 5,
            'created_at' => '2019-07-16 16:55:45',
            'updated_at' => '2019-07-16 17:17:05',
            'email' => 'affise@gmail.com',
            'login' => 'dima.ivanov',
            'ref_percent' => '2',
            'notes' => 'note',
            'manager' => [
                'id' => '5cd5530ad596c1c0008b4567',
                'first_name' => 'admin',
                'last_name' => 'admin',
                'work_hours' => '24',
                'email' => 'admin@admin.adm',
                'skype' => 'admin',
                'api_key' => '7eed552d6477f30f4b66fa663c4dfcab42eee7a4',
                'roles' => [Role::ROLE_MANAGER_AFFILIATE],
                'type' => UserDto::TYPE_AFFILIATE_MANAGER,
            ],
            'status' => 'active',
            'level' => 1,
            'payment_systems' => [
                [
                    'id' => 3,
                    'active' => 0,
                    'system' => 'Webmoney',
                    'fields' => ['BA731035962466786892', 'PK83DELLCTnbVB5RMU5TL1X4'],
                    'currency' => 1,
                    'system_id' => 1,
                ],
            ],
            'customFields' => [
                [
                    'name' => 'Skype',
                    'value' => 'skype',
                    'label' => 'skype',
                    'id' => 1,
                ],
            ],
            'balance' => [
                'RUB' => ['balance' => 0, 'hold' => 0, 'available' => 0],
                'USD' => ['balance' => 0, 'hold' => 0, 'available' => 0],
                'EUR' => ['balance' => 0, 'hold' => 0, 'available' => 0],
                'BTC' => ['balance' => 0, 'hold' => 0, 'available' => 0],
            ],
            'offersCount' => 0,
            'api_key' => 'eff64a90010faabc92f845a7969a618986478993',
            'ref' => '2',
            'sub_accounts' => [['value' => 'sub1', 'except' => 0], ['value' => 'sub2', 'except' => 1]],
        ];
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testEditAffiliateShouldNotFailsWhenFiltersAreEmpty(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/partner/5', [])
            ->willReturn(
                [
                    'status' => 1,
                    'partner' => static::$attributes,
                    'id' => 5,
                ]
            );

        $affiliateProvider = new AffiliateProvider($transport);
        $affiliateProvider->editAffiliate(5, []);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testEditAffiliateWhenOptionalFiltersAreSet(): void
    {
        $filters = [
            'password' => '123456',
            'login' => 'aut',
            'country' => 'Saint Pierre and Miquelon',
            'contact_person' => 'eum',
            'ref_percent' => 'nemo',
            'notes' => 'iusto',
            'status' => 'quo',
            'manager_id' => 'et',
            'payment_systems' => [['system_id' => '1']],
            'custom_fields' => ['et', 'ea'],
            'ref' => 1739512479,
            'sub_account_1' => 'eius',
            'sub_account_2' => 'voluptatibus',
            'sub_account_1_except' => 34497419,
            'sub_account_2_except' => 747009894,
            'tipalti_payee_id' => 1688466375,
            'tags' => ['nihil', 'veritatis', 'ea'],
        ];

        $transport = $this->createMock(TransportInterface::class);
        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/partner/5', $filters)
            ->willThrowException(new RuntimeException());

        $affiliateProvider = new AffiliateProvider($transport);

        $this->expectException(RuntimeException::class);

        $affiliateProvider->editAffiliate(5, $filters);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testEditAffiliateContentTypeIsNotJson(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $filters = [
            'password' => '123456',
            'login' => 'aut',
            'country' => 'Saint Pierre and Miquelon',
            'contact_person' => 'eum',
            'ref_percent' => 'nemo',
            'notes' => 'iusto',
            'status' => 'quo',
            'manager_id' => 'et',
            'payment_systems' => [['system_id' => '1']],
            'custom_fields' => ['et', 'ea'],
            'ref' => 1739512479,
            'sub_account_1' => 'eius',
            'sub_account_2' => 'voluptatibus',
            'sub_account_1_except' => 34497419,
            'sub_account_2_except' => 747009894,
            'tipalti_payee_id' => 1688466375,
            'tags' => ['nihil', 'veritatis', 'ea'],
        ];

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/partner/5', $filters, ['Content-Type' => 'multipart/form-data'])
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $affiliateProvider = new AffiliateProvider($transport);
        $affiliateProvider->editAffiliate(5, $filters);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testEditAffiliateResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = static::$attributes;

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/partner/5')
            ->willReturn(
                [
                    'status' => 1,
                    'partner' => $attributes,
                    'id' => 5,
                ]
            );

        $affiliateProvider = new AffiliateProvider($transport);
        $response = $affiliateProvider->editAffiliate(5);

        $this->assertEquals(1, $response->getStatus());
        $this->assertInstanceOf(AffiliateDto::class, $response->getData());
        $this->assertEquals(new AffiliateDto($attributes), $response->getData());
        $this->assertEquals(5, $response->getId());
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
    public function testEditAffiliateFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('post')->willThrowException(new $exceptionClass());

        $affiliateProvider = new AffiliateProvider($transport);

        $this->expectException($exceptionClass);

        $affiliateProvider->editAffiliate(5);
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
