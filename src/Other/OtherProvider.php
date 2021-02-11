<?php

declare(strict_types=1);

namespace Affise\Sdk\Other;

use Affise\Sdk\Helper\AbstractProvider;
use Affise\Sdk\Helper\PaginableResponse;
use Affise\Sdk\Helper\Pagination;
use Affise\Sdk\Helper\Response;
use InvalidArgumentException;

/**
* Class OtherProvider
*
* Other managing
*/
class OtherProvider extends AbstractProvider
{
    /**
    * Get ISP list.
    *
    * @param array<string, mixed> $filters
    * @psalm-param array{
    *  country: string,
    *  q?: string,
    * } $filters
    *
    * @return \Affise\Sdk\Helper\PaginableResponse<\Affise\Sdk\Other\ISPListDto>
    *
    * @throws \Affise\Sdk\Exception\TransportException
    *
    * @see https://api.affise.com/docs3.1/#isp-list
    */
    public function ispList(array $filters): PaginableResponse
    {
        if (empty($filters['country'])) {
            throw new InvalidArgumentException("Parameter 'country' is required");
        }

        $response = $this->transport->get('/3.1/isp', $filters);

        $pagination = Pagination::createFromArray($response['pagination']);
        $items = array_map(fn(array $item) => new ISPListDto($item), $response['isps']);

        return new PaginableResponse($response['status'], $items, $pagination);
    }

    /**
     * Get countries list.
     *
     * @return \Affise\Sdk\Helper\Response<array<\Affise\Sdk\Other\CountriesListDto>>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#countries-list
     */
    public function countriesList(): Response
    {
        $response = $this->transport->get('/3.1/countries');

        $items = array_map(fn(array $item) => new CountriesListDto($item), $response['countries']);

        return new Response($response['status'], $items);
    }

    /**
     * Get region list.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     *  country: array<string>,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\Response<array<\Affise\Sdk\Other\RegionsListDto>>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#regions-list
     */
    public function regionsList(array $filters): Response
    {
        if (empty($filters['country'])) {
            throw new InvalidArgumentException("Parameter 'country' is required");
        }

        $response = $this->transport->get('/3.1/regions', $filters);
        $items = [];

        if (isset($response['regions'])) {
            $items = array_map(fn(array $item) => new RegionsListDto($item), $response['regions']);
        }

        return new Response($response['status'], $items);
    }

    /**
     * Get connection types list.
     *
     * @return \Affise\Sdk\Helper\Response<array<string>>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#connection-types-list
     */
    public function connectionTypesList(): Response
    {
        $response = $this->transport->get('/3.1/connection-types');

        return new Response($response['status'], $response['types']);
    }

    /**
     * Get vendors list.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     *  q?: string,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\Response<array<string>>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#vendors-list
     */
    public function vendorsList(array $filters = []): Response
    {
        $response = $this->transport->get('/3.1/vendors', $filters);

        return new Response($response['status'], $response['vendors']);
    }

    /**
     * Get oses list.
     *
     * @return \Affise\Sdk\Helper\PaginableResponse<string>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#oses-list
     */
    public function osesList(): PaginableResponse
    {
        $response = $this->transport->get('/3.1/oses');

        $pagination = Pagination::createFromArray($response['pagination']);

        return new PaginableResponse($response['status'], $response['oses'], $pagination);
    }

    /**
     * Get os versions list.
     *
     * @param string $os
     *
     * @return \Affise\Sdk\Helper\PaginableResponse<string>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#os-versions-list
     */
    public function osVersionsList(string $os): PaginableResponse
    {
        $response = $this->transport->get(sprintf('/3.1/oses/%s', $os));

        $pagination = Pagination::createFromArray($response['pagination']);

        return new PaginableResponse($response['status'], $response['versions'], $pagination);
    }
}
