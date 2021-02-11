<?php

declare(strict_types=1);

namespace Affise\Sdk\Advertiser;

use Affise\Sdk\Exception\AccessDeniedException;
use Affise\Sdk\Exception\BadRequestException;
use Affise\Sdk\Exception\EndpointNotFoundException;
use Affise\Sdk\Exception\TimeoutException;
use Affise\Sdk\Exception\TokenMissingException;
use Affise\Sdk\Exception\TransportException;
use Affise\Sdk\Transport\TransportInterface;
use Affise\Sdk\User\Role;
use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * Class EditAdvertisersAdvertiserProviderTest
 */
class EditAdvertisersAdvertiserProviderTest extends TestCase
{
    private static array $attributes;

    public static function setupBeforeClass(): void
    {
        static::$attributes = [
            'id' => '5b5f415035752723008b456a',
            'title' => 'Test supplier',
            'manager' => '5ef49b78885352fa094eb7cd',
            'manager_obj' => [
                'id' => '5ef49b78885352fa094eb7cd',
                'first_name' => 'Irina',
                'last_name' => 'SGSWWGfg',
                'work_hours' => '10:00 - 19:00',
                'email' => 'sdfgdfs@example.com',
                'api_key' => '5b6e54d325b57da37f2a8138e51b8e3d',
                'roles' => [
                    Role::ROLE_SECTION_SUPPLIER,
                    Role::ROLE_SECTION_AUTOMATION,
                    Role::ROLE_SECTION_DASHBOARD,
                    Role::ROLE_SECTION_NEWS,
                    Role::ROLE_SECTION_OFFER,
                ],
                'updated_at' => '2020-12-14 11:03:22',
                'created_at' => '2020-06-25 15:43:26',
                'last_login_at' => '2020-10-27 15:46:33',
                'type' => 'account_manager',
            ],
            'allowed_ip' => [],
            'disallowed_ip' => [],
            'country' => 'AD',
            'sub_accounts' => [['value' => null, 'except' => false], ['value' => null, 'except' => false]],
            'updated_at' => '2020-10-27 21:39:55',
            'consider_personal_targeting_only' => false,
            'tags' => ['test'],
            'hosts_only' => false,
            'offers' => 0,
            'has_user' => false,
        ];
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testEditAdvertisersShouldNotFailsWhenFiltersAreEmpty(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/advertiser/59490d317e28febe1e8b456c', [])
            ->willReturn(
                [
                    'status' => 1,
                    'advertiser' => static::$attributes,
                ]
            );

        $advertiserProvider = new AdvertiserProvider($transport);
        $advertiserProvider->editAdvertisers('59490d317e28febe1e8b456c', []);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testEditAdvertisersWhenOptionalFiltersAreSet(): void
    {
        $data = [
            'title' => 'MyTitle2',
            'contact' => 'ThePerson2',
            'skype' => 'MySkype2',
            'manager' => '5747f68c3b7d9be4018b4570',
            'url' => 'https://lowe.info/aspernatur-qui-repudiandae-dolor-id-dolores.html',
            'email' => 'reinhold.jaskolski@example.net',
            'allowed_ip' => '113.232.184.44',
            'note' => 'autem',
            'address_1' => '7644 Alvena Valley Suite 627',
            'address_2' => '39216 Malvina Orchard',
            'city' => 'Ryanberg',
            'country' => 'Switzerland',
            'zip_code' => 'ipsa',
            'vat_code' => 'rerum',
            'sub_account_1' => 'magni',
            'sub_account_2' => 'facilis',
            'sub_account_1_except' => 100152812,
            'sub_account_2_except' => 527091225,
            'consider_personal_targeting_only' => 'deleniti',
            'tags' => ['perferendis', 'ex', 'illo'],
        ];

        $transport = $this->createMock(TransportInterface::class);
        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/advertiser/59490d317e28febe1e8b456c', $data)
            ->willThrowException(new RuntimeException());

        $advertiserProvider = new AdvertiserProvider($transport);

        $this->expectException(RuntimeException::class);

        $advertiserProvider->editAdvertisers('59490d317e28febe1e8b456c', $data);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testEditAdvertisersResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = static::$attributes;

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/advertiser/59490d317e28febe1e8b456c')
            ->willReturn(
                [
                    'status' => 1,
                    'advertiser' => $attributes,
                ]
            );

        $advertiserProvider = new AdvertiserProvider($transport);
        $response = $advertiserProvider->editAdvertisers('59490d317e28febe1e8b456c');

        $this->assertEquals(1, $response->getStatus());
        $this->assertInstanceOf(AdvertiserDto::class, $response->getData());
        $this->assertEquals(new AdvertiserDto($attributes), $response->getData());
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
    public function testEditAdvertisersFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('post')->willThrowException(new $exceptionClass());

        $advertiserProvider = new AdvertiserProvider($transport);

        $this->expectException($exceptionClass);

        $advertiserProvider->editAdvertisers('59490d317e28febe1e8b456c');
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
