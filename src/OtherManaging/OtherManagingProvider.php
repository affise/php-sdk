<?php

declare(strict_types=1);

namespace Affise\Sdk\OtherManaging;

use Affise\Sdk\Helper\AbstractProvider;
use Affise\Sdk\Helper\IdResponse;
use Affise\Sdk\Helper\MessageResponse;
use Affise\Sdk\Helper\PaginableResponse;
use Affise\Sdk\Helper\Pagination;
use Affise\Sdk\Helper\Response;
use InvalidArgumentException;

/**
* Class OtherManagingProvider
*
* Other managing (admin methods)
*/
class OtherManagingProvider extends AbstractProvider
{
    /**
    * Get city list.
    *
    * @param array<string, mixed> $filters
    * @psalm-param array{
    *  country: array<string>,
    *  q?: string,
    *  code?: array<int>,
    * } $filters
    *
    * @return \Affise\Sdk\Helper\PaginableResponse<\Affise\Sdk\OtherManaging\CityListDto>
    *
    * @throws \Affise\Sdk\Exception\TransportException
    *
    * @see https://api.affise.com/docs3.1/#city-list
    */
    public function cityList(array $filters): PaginableResponse
    {
        if (empty($filters['country'])) {
            throw new InvalidArgumentException("Parameter 'country' is required");
        }

        $response = $this->transport->get('/3.1/cities', $filters);

        $pagination = Pagination::createFromArray($response['pagination']);
        $items = array_map(fn(array $item) => new CityListDto($item), $response['cities']);

        return new PaginableResponse($response['status'], $items, $pagination);
    }

    /**
     * Get list of devices.
     *
     * @return \Affise\Sdk\Helper\Response<array<string>>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#devices-list
     */
    public function devicesList(): Response
    {
        $response = $this->transport->get('/3.1/devices');

        return new Response($response['status'], $response['types']);
    }

    /**
     * Get browsers list.
     *
     * @return \Affise\Sdk\Helper\PaginableResponse<string>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#browsers-list
     */
    public function browsersList(): PaginableResponse
    {
        $response = $this->transport->get('/3.1/browsers');

        $pagination = Pagination::createFromArray($response['pagination']);

        return new PaginableResponse($response['status'], $response['browsers'], $pagination);
    }

    /**
     * Get list of currency.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     *  get_only_active?: int,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\Response<array<string, float>>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#currency-list
     */
    public function currencyList(array $filters = []): Response
    {
        /** @psalm-suppress InvalidArrayOffset */
        unset($filters['extended']);

        $response = $this->transport->get('/3.0/admin/currency', $filters);

        return new Response($response['status'], $response['quotes']);
    }

    /**
     * Get extended list of currency.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     *  get_only_active?: int,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\Response<array<\Affise\Sdk\OtherManaging\CurrencyListDto>>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#currency-list
     */
    public function currencyListExtended(array $filters = []): Response
    {
        /** @psalm-suppress InvalidArrayOffset */
        unset($filters['extended']);

        $response = $this->transport->get('/3.0/admin/currency', $filters + ['extended' => 1]);

        $items = array_map(fn(array $item) => new CurrencyListDto($item), $response['quotes']);

        return new Response($response['status'], $items);
    }

    /**
     * Get list of payment systems.
     *
     * @return \Affise\Sdk\Helper\Response<array<\Affise\Sdk\OtherManaging\PaymentSystemsListDto>>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#payment-systems-list
     */
    public function paymentSystemsList(): Response
    {
        $response = $this->transport->get('/3.0/admin/payment_systems');

        $items = array_map(fn(array $item) => new PaymentSystemsListDto($item), $response['payment_systems']);

        return new Response($response['status'], $items);
    }

    /**
     * Get list of signup settings.
     *
     * @return \Affise\Sdk\Helper\Response<array<\Affise\Sdk\OtherManaging\CustomFieldsListDto>>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#custom-fields-list
     */
    public function customFieldsList(): Response
    {
        $response = $this->transport->get('/3.0/admin/custom_fields');

        $items = array_map(fn(array $item) => new CustomFieldsListDto($item), $response['fields']);

        return new Response($response['status'], $items);
    }

    /**
     * Get domains.
     *
     * @return \Affise\Sdk\Helper\Response<array<\Affise\Sdk\OtherManaging\DomainsListDto>>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#domains-list
     */
    public function domainsList(): Response
    {
        $response = $this->transport->get('/3.0/admin/domains');

        $items = array_map(fn(array $item) => new DomainsListDto($item), $response['domains']);

        return new Response($response['status'], $items);
    }

    /**
     * Get ticket.
     *
     * @param string $id
     *
     * @return \Affise\Sdk\Helper\IdResponse<\Affise\Sdk\OtherManaging\TicketDto, string>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#get-ticket
     */
    public function getTicket(string $id): IdResponse
    {
        $response = $this->transport->get(sprintf('/3.0/admin/ticket/%s', $id));

        return new IdResponse($response['status'], new TicketDto($response['ticket']), $response['id']);
    }

    /**
     * Get list of tickets for connection to offers .
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     *  page?: int,
     *  limit?: int,
     *  status?: string,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\PaginableResponse<\Affise\Sdk\OtherManaging\TicketDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#ticket-list
     */
    public function ticketList(array $filters = []): PaginableResponse
    {
        $response = $this->transport->get('/3.0/admin/tickets', $filters);

        $pagination = Pagination::createFromArray($response['pagination']);
        $items = array_map(fn(array $item) => new TicketDto($item), $response['tickets']);

        return new PaginableResponse($response['status'], $items, $pagination);
    }

    /**
     * Approve or reject ticket for connect affiliate to offer.
     *
     * @param string $id
     * @param array<string, mixed> $data
     * @psalm-param array{
     *  do?: string,
     * } $data
     *
     * @return \Affise\Sdk\Helper\MessageResponse<string>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#approve-or-reject-ticket
     */
    public function approveOrRejectTicket(string $id, array $data = []): MessageResponse
    {
        $response = $this->transport->post(sprintf('/3.0/admin/ticket/%s/offer', $id), $data);

        return new MessageResponse($response['status'], $response['message']);
    }

    /**
     * Get list of a partner’s pixels.
     *
     * @param int $id
     *
     * @return \Affise\Sdk\Helper\Response<array<\Affise\Sdk\OtherManaging\PixelDto>>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#pixel-list130
     */
    public function pixelList(int $id): Response
    {
        $response = $this->transport->get(sprintf('/3.0/partner/pixels/%s', $id));

        $items = array_map(fn(array $item) => new PixelDto($item), $response['pixel']);

        return new Response($response['status'], $items);
    }

    /**
     * Add a partner’s pixel.
     *
     * @param array<string, mixed> $data
     * @psalm-param array{
     *  pid: int,
     *  offer_id: int,
     *  name: string,
     *  code: string,
     *  code_type: string,
     *  is_active?: int,
     *  moderation_status?: int,
     * } $data
     *
     * @return \Affise\Sdk\Helper\Response<\Affise\Sdk\OtherManaging\PixelDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#pixel-add131
     */
    public function pixelAdd(array $data): Response
    {
        if (empty($data['pid'])) {
            throw new InvalidArgumentException("Parameter 'pid' is required");
        }

        if (empty($data['offer_id'])) {
            throw new InvalidArgumentException("Parameter 'offer_id' is required");
        }

        if (empty($data['name'])) {
            throw new InvalidArgumentException("Parameter 'name' is required");
        }

        if (empty($data['code'])) {
            throw new InvalidArgumentException("Parameter 'code' is required");
        }

        if (empty($data['code_type'])) {
            throw new InvalidArgumentException("Parameter 'code_type' is required");
        }

        $response = $this->transport->post('/3.0/partner/pixel', $data);

        return new Response($response['status'], new PixelDto($response['pixel']));
    }

    /**
     * Edit a partner’s pixel.
     *
     * @param int $id
     * @param array<string, mixed> $data
     * @psalm-param array{
     *  name?: string,
     *  code?: string,
     *  code_type?: string,
     *  is_active?: int,
     *  moderation_status?: int,
     * } $data
     *
     * @return \Affise\Sdk\Helper\Response<\Affise\Sdk\OtherManaging\PixelDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#pixel-edit132
     */
    public function pixelEdit(int $id, array $data = []): Response
    {
        $response = $this->transport->post(sprintf('/3.0/partner/pixel/%s', $id), $data);

        return new Response($response['status'], new PixelDto($response['pixel']));
    }

    /**
     * Delete a partner’s pixel.
     *
     * @param int $id
     *
     * @return \Affise\Sdk\Helper\Response<\Affise\Sdk\OtherManaging\PixelDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#pixel-remove133
     */
    public function pixelRemove(int $id): Response
    {
        $response = $this->transport->delete(sprintf('/3.0/partner/pixel/%s/remove', $id));

        return new Response($response['status'], new PixelDto($response['pixel']));
    }

    /**
     * SmartLink categories list.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     *  id?: array<string>,
     *  name?: string,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\Response<array<\Affise\Sdk\OtherManaging\SmartLinkCategoryDto>>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#smartlink-categories134
     */
    public function smartLinkCategories(array $filters = []): Response
    {
        $response = $this->transport->get('/3.0/admin/smartlink/categories', $filters);

        $items = array_map(fn(array $item) => new SmartLinkCategoryDto($item), $response['data']);

        return new Response($response['status'], $items);
    }

    /**
     * Add new SmartLink category.
     *
     * @param array<string, mixed> $data
     * @psalm-param array{
     *  name: string,
     *  domain_id?: int,
     *  description?: string,
     * } $data
     *
     * @return \Affise\Sdk\Helper\Response<\Affise\Sdk\OtherManaging\SmartLinkCategoryDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#smartlink-category
     */
    public function smartLinkAddCategory(array $data): Response
    {
        if (empty($data['name'])) {
            throw new InvalidArgumentException("Parameter 'name' is required");
        }

        $response = $this->transport->post('/3.0/admin/smartlink/category', $data);

        return new Response($response['status'], new SmartLinkCategoryDto($response['data']));
    }

    /**
     * Edit a SmartLink category.
     *
     * @param string $id
     * @param array<string, mixed> $data
     * @psalm-param array{
     *  name?: string,
     *  domain_id?: int,
     *  description?: string,
     * } $data
     *
     * @return \Affise\Sdk\Helper\Response<\Affise\Sdk\OtherManaging\SmartLinkCategoryDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#smartlink-edit-category
     */
    public function smartLinkEditCategory(string $id, array $data = []): Response
    {
        $response = $this->transport->post(sprintf('/3.0/admin/smartlink/category/%s', $id), $data);

        return new Response($response['status'], new SmartLinkCategoryDto($response['data']));
    }

    /**
     * Remove a SmartLink category.
     *
     * @param string $id
     *
     * @return \Affise\Sdk\Helper\Response<\Affise\Sdk\OtherManaging\SmartLinkCategoryDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#smartlink-category-remove
     */
    public function smartLinkCategoryRemove(string $id): Response
    {
        $response = $this->transport->post(sprintf('/3.0/admin/smartlink/category/%s/remove', $id));

        return new Response($response['status'], new SmartLinkCategoryDto($response['data']));
    }

    /**
     * SmartLink offer count.
     *
     * @param string $id
     *
     * @return \Affise\Sdk\Helper\Response<\Affise\Sdk\OtherManaging\SmartLinkOfferCountDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#smartlink-offer-count138
     */
    public function smartLinkOfferCount(string $id): Response
    {
        $response = $this->transport->get(sprintf('/3.0/admin/smartlink/category/%s/offers-count', $id));

        return new Response($response['status'], new SmartLinkOfferCountDto($response['data']));
    }
}
