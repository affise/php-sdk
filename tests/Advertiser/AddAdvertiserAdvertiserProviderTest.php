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
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * Class AddAdvertiserAdvertiserProviderTest
 */
class AddAdvertiserAdvertiserProviderTest extends TestCase
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
     *
     * @psalm-suppress InvalidArgument
     */
    public function testAddAdvertiserFailsWhenFiltersAreNotSet(): void
    {
        $advertiserProvider = new AdvertiserProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);

        $advertiserProvider->addAdvertiser([]);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testAddAdvertiserWhenFiltersAreSet(): void
    {
        $transport = $this->createMock(TransportInterface::class);

        $data = [
            'title' => 'MyTitle',
            'contact' => 'ThePerson',
            'skype' => 'MySkype',
            'manager' => '5747f68c3b7d9be4018b4570',
            'url' => 'http://www.kemmer.com/blanditiis-architecto-perspiciatis-aut.html',
            'email' => 'yhuels@example.com',
            'allowed_ip' => '193.131.89.234',
            'address_1' => '4912 Russel Trace',
            'address_2' => '20453 Bogisich Cape',
            'city' => 'Baileyfort',
            'country' => 'Guam',
            'zip_code' => 'perspiciatis',
            'vat_code' => 'enim',
            'sub_account_1' => 'et',
            'sub_account_2' => 'animi',
            'sub_account_1_except' => 1016086466,
            'sub_account_2_except' => 2121536579,
            'consider_personal_targeting_only' => 'molestiae',
            'tags' => ['cum'],
        ];

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/advertiser', $data)
            ->willThrowException(new RuntimeException());

        $this->expectException(RuntimeException::class);

        $advertiserProvider = new AdvertiserProvider($transport);
        $advertiserProvider->addAdvertiser($data);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @psalm-suppress InvalidArgument
     */
    public function testAddAdvertiserFailsWhenTitleIsNotPassed(): void
    {
        $advertiserProvider = new AdvertiserProvider($this->createStub(TransportInterface::class));

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Parameter 'title' is required");

        $advertiserProvider->addAdvertiser([]);
    }

    /**
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     */
    public function testAddAdvertiserResponse(): void
    {
        $transport = $this->createMock(TransportInterface::class);
        $attributes = static::$attributes;

        $transport->expects($this->once())
            ->method('post')
            ->with('/3.0/admin/advertiser')
            ->willReturn(
                [
                    'status' => 1,
                    'advertiser' => $attributes,
                ]
            );

        $advertiserProvider = new AdvertiserProvider($transport);
        $response = $advertiserProvider->addAdvertiser(['title' => 'MyTitle']);

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
    public function testAddAdvertiserFailsWhenTransportLayerThrowsException(string $exceptionClass): void
    {
        $transport = $this->createStub(TransportInterface::class);
        $transport->method('post')->willThrowException(new $exceptionClass());

        $advertiserProvider = new AdvertiserProvider($transport);

        $this->expectException($exceptionClass);

        $advertiserProvider->addAdvertiser(['title' => 'MyTitle']);
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
