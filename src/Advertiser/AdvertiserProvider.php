<?php 

declare(strict_types=1);

namespace Affise\Sdk\Advertiser;

use Affise\Sdk\Helper\AbstractProvider;
use Affise\Sdk\Helper\PaginableResponse;
use Affise\Sdk\Helper\MessageResponse;
use Affise\Sdk\Helper\Pagination;
use Affise\Sdk\Helper\Response;
use InvalidArgumentException;

/**
* Class AdvertiserProvider
*
* Advertiser managing (admin methods)
*/
class AdvertiserProvider extends AbstractProvider
{
    /**
    * Get advertiser.
    *
    * @param string $id
    *
    * @return \Affise\Sdk\Helper\Response<\Affise\Sdk\Advertiser\AdvertiserDto>
    *
    * @throws \Affise\Sdk\Exception\TransportException
    *
    * @see https://api.affise.com/docs3.1/#get-advertiser
    */
    public function getAdvertiser(string $id): Response
    {
        $response = $this->transport->get(sprintf('/3.0/admin/advertiser/%s', $id));

        return new Response($response['status'], new AdvertiserDto($response['advertiser']));
    }

    /**
    * Get a list of advertisers.
    *
    * @param array<string, mixed> $filters
    * @psalm-param array{
    * page?: int,
    * limit?: int,
    * order?: string,
    * orderType?: string,
    * updated_at?: string,
    * } $filters
    *
    * @return \Affise\Sdk\Helper\PaginableResponse<\Affise\Sdk\Advertiser\AdvertisersListDto>
    *
    * @throws \Affise\Sdk\Exception\TransportException
    *
    * @see https://api.affise.com/docs3.1/#advertisers-list
    */
    public function advertisersList(array $filters = []): PaginableResponse
    {
        $response = $this->transport->get('/3.0/admin/advertisers', $filters);

        $pagination = Pagination::createFromArray($response['pagination']);
        $items = array_map(fn(array $item) => new AdvertisersListDto($item), $response['advertisers']);

        return new PaginableResponse($response['status'], $items, $pagination);
    }

    /**
    * Add new advertiser.
    *
    * @param array<string, mixed> $data
    * @psalm-param array{
    * title: string,
    * country?: string,
    * consider_personal_targeting_only?: string,
    * sub_account_2_except?: int,
    * sub_account_1_except?: int,
    * sub_account_2?: string,
    * sub_account_1?: string,
    * vat_code?: string,
    * zip_code?: string,
    * city?: string,
    * contact?: string,
    * address_2?: string,
    * address_1?: string,
    * allowed_ip?: string,
    * email?: string,
    * url?: string,
    * manager?: string,
    * skype?: string,
    * tags?: array<string>,
    * } $data
    *
    * @return \Affise\Sdk\Helper\Response<\Affise\Sdk\Advertiser\AdvertiserDto>
    *
    * @throws \Affise\Sdk\Exception\TransportException
    *
    * @see https://api.affise.com/docs3.1/#add-advertiser
    */
    public function addAdvertiser(array $data): Response
    {
        if (empty($data['title'])) {
            throw new InvalidArgumentException("Parameter 'title' is required");
        }

        $response = $this->transport->post('/3.0/admin/advertiser', $data, ['Content-Type' => 'application/x-www-form-urlencoded']);

        return new Response($response['status'], new AdvertiserDto($response['advertiser']));
    }

    /**
    * Change an advertiser’s data.
    *
    * @param string $id
    * @param array<string, mixed> $data
    * @psalm-param array{
    * title?: string,
    * country?: string,
    * consider_personal_targeting_only?: string,
    * sub_account_2_except?: int,
    * sub_account_1_except?: int,
    * sub_account_2?: string,
    * sub_account_1?: string,
    * vat_code?: string,
    * zip_code?: string,
    * city?: string,
    * contact?: string,
    * address_2?: string,
    * address_1?: string,
    * note?: string,
    * allowed_ip?: string,
    * email?: string,
    * url?: string,
    * manager?: string,
    * skype?: string,
    * tags?: array<string>,
    * } $data
    *
    * @return \Affise\Sdk\Helper\Response<\Affise\Sdk\Advertiser\AdvertiserDto>
    *
    * @throws \Affise\Sdk\Exception\TransportException
    *
    * @see https://api.affise.com/docs3.1/#edit-advertisers
    */
    public function editAdvertisers(string $id, array $data = []): Response
    {
        $response = $this->transport->post(sprintf('/3.0/admin/advertiser/%s', $id), $data);

        return new Response($response['status'], new AdvertiserDto($response['advertiser']));
    }

    /**
    * Change an advertiser password and send it by email .
    *
    * @param string $id
    *
    * @return \Affise\Sdk\Helper\MessageResponse<string>
    *
    * @throws \Affise\Sdk\Exception\TransportException
    *
    * @see https://api.affise.com/docs3.1/#send-password-to-advertiser
    */
    public function sendPasswordToAdvertiser(string $id): MessageResponse
    {
        $response = $this->transport->post(sprintf('/3.0/admin/advertiser/%s/sendpass', $id));

        return new MessageResponse($response['status'], $response['message']);
    }

    /**
    * Un-put affiliate from blacklist for specified advertisers.
    *
    * @param array<string, mixed> $filters
    * @psalm-param array{
    * advertisers_id: array<string>,
    * pid: int,
    * } $filters
    *
    * @return \Affise\Sdk\Helper\MessageResponse<string>
    *
    * @throws \Affise\Sdk\Exception\TransportException
    *
    * @see https://api.affise.com/docs3.1/#advertisers-enable-affiliate
    */
    public function advertisersEnableAffiliate(array $filters): MessageResponse
    {
        if (empty($filters['advertisers_id'])) {
            throw new InvalidArgumentException("Parameter 'advertisers_id' is required");
        }

        if (empty($filters['pid'])) {
            throw new InvalidArgumentException("Parameter 'pid' is required");
        }

        $response = $this->transport->post('/3.0/admin/advertiser/enable-affiliate', $filters);

        return new MessageResponse($response['status'], $response['message']);
    }

    /**
    * Put affiliate to blacklist for specified advertisers.
    *
    * @param array<string, mixed> $filters
    * @psalm-param array{
    * advertisers_id: array<string>,
    * pid: int,
    * } $filters
    *
    * @return \Affise\Sdk\Helper\MessageResponse<string>
    *
    * @throws \Affise\Sdk\Exception\TransportException
    *
    * @see https://api.affise.com/docs3.1/#advertisers-disable-affiliate
    */
    public function advertisersDisableAffiliate(array $filters): MessageResponse
    {
        if (empty($filters['advertisers_id'])) {
            throw new InvalidArgumentException("Parameter 'advertisers_id' is required");
        }

        if (empty($filters['pid'])) {
            throw new InvalidArgumentException("Parameter 'pid' is required");
        }

        $response = $this->transport->post('/3.0/admin/advertiser/disable-affiliate', $filters);

        return new MessageResponse($response['status'], $response['message']);
    }
}
