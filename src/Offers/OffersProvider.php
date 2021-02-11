<?php 

declare(strict_types=1);

namespace Affise\Sdk\Offers;

use Affise\Sdk\Helper\AbstractProvider;
use Affise\Sdk\Helper\PaginableResponse;
use Affise\Sdk\Helper\Pagination;
use Affise\Sdk\Helper\Response;

/**
* Class OffersProvider
*
* Offers
*/
class OffersProvider extends AbstractProvider
{
    /**
    * Get a list of offers.
    *
    * @param array<string, mixed> $filters
    * @psalm-param array{
    * q?: string,
    * ids?: array<string>,
    * int_id?: array<int>,
    * countries?: array<string>,
    * os?: array<string>,
    * categories?: array<string>,
    * sort?: array<string>,
    * page?: int,
    * limit?: int,
    * status?: array<string>,
    * advertiser?: array<string>,
    * privacy?: array<int>,
    * updated_at?: string,
    * is_top?: int,
    * bundle_id?: string,
    * } $filters
    *
    * @return \Affise\Sdk\Helper\PaginableResponse<\Affise\Sdk\Offers\OffersListDto|\Affise\Sdk\Offers\OffersListPartnerDto>
    *
    * @throws \Affise\Sdk\Exception\TransportException
    *
    * @see https://api.affise.com/docs3.1/#offers-list
    */
    public function offersList(array $filters = []): PaginableResponse
    {
        $response = $this->transport->get('/3.0/offers', $filters);

        $pagination = Pagination::createFromArray($response['pagination']);
        $offers = $response['offers'];
        $index = array_key_first($offers);

        if ($index !== null && isset($offers[$index]['advertiser'])) {
            $items = array_map(fn(array $item) => new OffersListDto($item), $offers);
        } else {
            $items = array_map(fn(array $item) => new OffersListPartnerDto($item), $offers);
        }

        return new PaginableResponse($response['status'], $items, $pagination);
    }

    /**
     * Get full information of an offer.
     *
     * @param int $id
     *
     * @return \Affise\Sdk\Helper\Response<\Affise\Sdk\Offers\OfferByIdDto|\Affise\Sdk\Offers\OfferByIdPartnerDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#offer-by-id
     */
    public function offerById(int $id): Response
    {
        $response = $this->transport->get(sprintf('/3.0/offer/%s', $id));
        $offer = $response['offer'];

        $dto = isset($offer['advertiser']) ? new OfferByIdDto($offer) : new OfferByIdPartnerDto($offer);

        return new Response($response['status'], $dto);
    }

    /**
     * List of a categories.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     * page?: int,
     * limit?: int,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\PaginableResponse<\Affise\Sdk\Offers\CategoriesDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#categories
     */
    public function categories(array $filters = []): PaginableResponse
    {
        $response = $this->transport->get('/3.0/offer/categories', $filters);

        $pagination = Pagination::createFromArray($response['pagination']);
        $items = array_map(fn(array $item) => new CategoriesDto($item), $response['categories']);

        return new PaginableResponse($response['status'], $items, $pagination);
    }
}
