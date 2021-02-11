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
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * Class NewAffiliateAffiliateProviderTest
 */
class NewAffiliateAffiliateProviderTest extends TestCase
{
    private static array $attributes;

    public static function setupBeforeClass(): void
    {
        static::$attributes = [
            'id' => 5,
            'created_at' => '2019-07-16 16:55:45',
            'updated_at' => '2019-07-16 16:55:45',
            'email' => 'affise@gmail.com',
            'login' => 'treva.jones',
            'ref_percent' => '2',
            'name' => 'Ms. Tressa Jacobson',
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
                'updated_at' => '2020-12-26T10:20:08+00:00',
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
            'address_1' => '80608 Parisian Loop Suite 910',
            'address_2' => '47632 Sabina Walks',
            'city' => 'South Corene',
            'country' => 'Taiwan',
            'zip_code' => 'qui',
            'phone' => 'quo',
            'ref' => '2',
            'sub_accounts' => [['value' => 'sub1', 'except' => 0], ['value' => 'sub2', 'except' => 1]],
            'contactPerson' => 'odit',
        ];
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @psalm-suppress InvalidArgument
     */
    public function testNewAffiliateFailsWhenFiltersAreNotSet(): void
    {
        $affiliateProvider = new AffiliateProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);

        $affiliateProvider->newAffiliate([]);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testNewAffiliateWhenRequiredFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $filters = [
            'email' => 'rozella.boyle@example.com',
            'password' => '123456',
            'country' => 'Jersey',
            'login' => 'excepturi',
            'contact_person' => 'aliquam',
            'ref_percent' => 'voluptates',
            'notes' => 'aspernatur',
            'status' => 'aliquam',
            'manager_id' => 'dolorum',
            'payment_systems' => [['system_id' => '1']],
            'custom_fields' => ['maiores', 'magnam', 'dicta'],
            'ref' => 254981732,
            'sub_account_1' => 'totam',
            'sub_account_2' => 'doloribus',
            'sub_account_1_except' => 67797065,
            'sub_account_2_except' => 1338197406,
            'notify' => 216987557,
            'tipalti_payee_id' => 538753332,
            'tags' => ['distinctio'],
        ];

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/partner', $filters)
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $affiliateProvider = new AffiliateProvider($transport);
        $affiliateProvider->newAffiliate($filters);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testNewAffiliateFailsWhenEmailIsNotPassed(): void
    {
        $affiliateProvider = new AffiliateProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'email' is required");

        $affiliateProvider->newAffiliate(
            [
                'password' => '123456',
                'country' => 'Jersey',
            ]
        );
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testNewAffiliateFailsWhenPasswordIsNotPassed(): void
    {
        $affiliateProvider = new AffiliateProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'password' is required");

        $affiliateProvider->newAffiliate(
            [
                'email' => 'rozella.boyle@example.com',
                'country' => 'Jersey',
            ]
        );
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testNewAffiliateFailsWhenCountryIsNotPassed(): void
    {
        $affiliateProvider = new AffiliateProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'country' is required");

        $affiliateProvider->newAffiliate(
            [
                'email' => 'rozella.boyle@example.com',
                'password' => '123456',
            ]
        );
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testNewAffiliateContentTypeIsNotJson(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $filters = [
            'email' => 'rozella.boyle@example.com',
            'password' => '123456',
            'country' => 'Jersey',
        ];

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/partner', $filters, ['Content-Type' => 'multipart/form-data'])
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $affiliateProvider = new AffiliateProvider($transport);
        $affiliateProvider->newAffiliate($filters);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testNewAffiliateResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = static::$attributes;

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/partner')
            ->willReturn(
                [
                    'status' => 1,
                    'partner' => $attributes,
                    'id' => 5,
                ]
            );

        $affiliateProvider = new AffiliateProvider($transport);
        $response = $affiliateProvider->newAffiliate(
            [
                'email' => 'rozella.boyle@example.com',
                'password' => '123456',
                'country' => 'Jersey',
            ]
        );

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
    public function testNewAffiliateFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('post')->willThrowException(new $exceptionClass());

        $affiliateProvider = new AffiliateProvider($transport);

        $this->expectException($exceptionClass);

        $affiliateProvider->newAffiliate(
            [
                'email' => 'rozella.boyle@example.com',
                'password' => '123456',
                'country' => 'Jersey',
            ]
        );
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
