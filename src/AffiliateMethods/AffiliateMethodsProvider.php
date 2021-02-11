<?php 

declare(strict_types=1);

namespace Affise\Sdk\AffiliateMethods;

use Affise\Sdk\Affiliate\AffiliateProvider;
use Affise\Sdk\Helper\AbstractProvider;
use Affise\Sdk\Helper\MessageResponse;
use Affise\Sdk\Helper\NewsResponse;
use Affise\Sdk\Helper\PaginableResponse;
use Affise\Sdk\Helper\Pagination;
use Affise\Sdk\Helper\Response;
use Affise\Sdk\Offers\OffersListPartnerDto;
use Affise\Sdk\OtherManaging\PixelDto;
use Affise\Sdk\OtherManaging\SmartLinkCategoryDto;
use Affise\Sdk\OtherManaging\SmartLinkOfferCountDto;
use Affise\Sdk\Transport\TransportInterface;
use InvalidArgumentException;

/**
* Class AffiliateMethodsProvider
*
* Affiliate methods
*/
class AffiliateMethodsProvider extends AbstractProvider
{
    /**
     * @var \Affise\Sdk\Affiliate\AffiliateProvider
     */
    private AffiliateProvider $affiliateProvider;

    /**
     * AffiliateMethodsProvider constructor.
     *
     * @param \Affise\Sdk\Transport\TransportInterface $transport
     * @param \Affise\Sdk\Affiliate\AffiliateProvider|null $affiliateProvider
     */
    public function __construct(TransportInterface $transport, AffiliateProvider $affiliateProvider = null)
    {
        parent::__construct($transport);

        $this->affiliateProvider = $affiliateProvider ?? new AffiliateProvider($this->transport);
    }

    /**
    * Get partner own data.
    *
    * @return \Affise\Sdk\Helper\Response<\Affise\Sdk\AffiliateMethods\GetPartnerOwnDataDto>
    *
    * @throws \Affise\Sdk\Exception\TransportException
    *
    * @see https://api.affise.com/docs3.1/#get-partner-own-data
    */
    public function getPartnerOwnData(): Response
    {
        $response = $this->transport->get('/3.1/partner/me');

        return new Response($response['status'], new GetPartnerOwnDataDto($response['user']));
    }

    /**
     * Get list of available partner offers.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     *  q?: string,
     *  ids?: array<string>,
     *  int_id?: array<int>,
     *  countries?: array<string>,
     *  categories?: array<string>,
     *  sort?: array<string, string>,
     *  page?: int,
     *  limit?: int,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\PaginableResponse<\Affise\Sdk\Offers\OffersListPartnerDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#offer-list
     */
    public function offerList(array $filters = []): PaginableResponse
    {
        $response = $this->transport->get('/3.0/partner/offers', $filters);

        $pagination = Pagination::createFromArray($response['pagination']);
        $items = array_map(fn(array $item) => new OffersListPartnerDto($item), $response['offers']);

        return new PaginableResponse($response['status'], $items, $pagination);
    }

    /**
     * Get list of a live offers.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     *  q?: string,
     *  ids?: array<string>,
     *  int_id?: array<int>,
     *  countries?: array<string>,
     *  categories?: array<string>,
     *  sort?: array<string, string>,
     *  page?: int,
     *  limit?: int,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\Response<array<\Affise\Sdk\Offers\OffersListPartnerDto>>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#live-offer-list
     */
    public function liveOfferList(array $filters = []): Response
    {
        $response = $this->transport->get('/3.0/partner/live-offers', $filters);

        $items = array_map(fn(array $item) => new OffersListPartnerDto($item), $response['offers']);

        return new Response($response['status'], $items);
    }

    /**
     * Connect to an offer.
     *
     * @param array<string, mixed> $data
     * @psalm-param array{
     *  offer_id: int,
     *  comment: string,
     * } $data
     *
     * @return \Affise\Sdk\Helper\MessageResponse<string>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#activation-offer
     */
    public function activationOffer(array $data): MessageResponse
    {
        if (empty($data['offer_id'])) {
            throw new InvalidArgumentException("Parameter 'offer_id' is required");
        }

        if (empty($data['comment'])) {
            throw new InvalidArgumentException("Parameter 'comment' is required");
        }

        $response = $this->transport->post('/3.0/partner/activation/offer', $data, ['Content-Type' => 'application/x-www-form-urlencoded']);

        return new MessageResponse($response['status'], $response['message']);
    }

    /**
     * Add postback.
     *
     * @param array<string, mixed> $data
     * @psalm-param array{
     *  pid: int,
     *  url: string,
     *  offer_id?: int,
     *  status?: string,
     *  goal?: string,
     * } $data
     *
     * @return \Affise\Sdk\Helper\Response<\Affise\Sdk\Affiliate\AddPartnerPostbackDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#add-postback
     * @see \Affise\Sdk\Affiliate\AffiliateProvider::addPartnerPostback()
     */
    public function addPostback(array $data): Response
    {
        return $this->affiliateProvider->addPartnerPostback($data);
    }

    /**
     * Edit postback.
     *
     * @param int $id
     * @param array<string, mixed> $data
     * @psalm-param array{
     *  url: string,
     *  status?: string,
     *  goal?: string,
     * } $data
     *
     * @return \Affise\Sdk\Helper\Response<\Affise\Sdk\Affiliate\EditPartnerPostbackDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#edit-postback
     * @see \Affise\Sdk\Affiliate\AffiliateProvider::editPartnerPostback()
     */
    public function editPostback(int $id, array $data): Response
    {
        return $this->affiliateProvider->editPartnerPostback($id, $data);
    }

    /**
     * Delete postback.
     *
     * @param int $id
     *
     * @return \Affise\Sdk\Helper\Response<\Affise\Sdk\Affiliate\DeletePartnerPostbackDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#delete-postback
     * @see \Affise\Sdk\Affiliate\AffiliateProvider::deletePartnerPostback()
     */
    public function deletePostback(int $id): Response
    {
        return $this->affiliateProvider->deletePartnerPostback($id);
    }

    /**
     * Delete postbacks by affiliates ids.
     *
     * @param array<string, mixed> $data
     * @psalm-param array{
     *  ids?: array<int>,
     * } $data
     *
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#delete-postbacks-by-affiliates-ids
     * @see \Affise\Sdk\Affiliate\AffiliateProvider::deletePartnersPostbacksByAffiliatesIds()
     */
    public function deletePostbacksByAffiliatesIds(array $data = []): void
    {
        $this->affiliateProvider->deletePartnersPostbacksByAffiliatesIds($data);
    }

    /**
     * Delete postbacks by offers ids.
     *
     * @param array<string, mixed> $data
     * @psalm-param array{
     *  ids?: array<int>,
     * } $data
     *
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#delete-postbacks-by-offers-ids
     * @see \Affise\Sdk\Affiliate\AffiliateProvider::deletePartnersPostbacksByOffersIds()
     */
    public function deletePostbacksByOffersIds(array $data = []): void
    {
        $this->affiliateProvider->deletePartnersPostbacksByOffersIds($data);
    }

    /**
     * News list.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     *  limit?: int,
     *  skip?: int,
     *  fixed?: int,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\NewsResponse
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#news-list
     */
    public function newsList(array $filters = []): NewsResponse
    {
        $response = $this->transport->get('/3.0/news', $filters);

        $items = array_map(fn(array $item) => new NewsDto($item), $response['items']);

        return new NewsResponse($response['status'], $items, $response['all_items']);
    }

    /**
     * Get news by ID.
     *
     * @param string $id
     *
     * @return \Affise\Sdk\Helper\Response<\Affise\Sdk\AffiliateMethods\NewsDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#news-get-by-id
     */
    public function newsGetById(string $id): Response
    {
        $response = $this->transport->get(sprintf('/3.0/news/%s', $id));

        return new Response($response['status'], new NewsDto($response['news']));
    }

    /**
     * Get list of a partner’s pixels.
     *
     * @return \Affise\Sdk\Helper\PaginableResponse<\Affise\Sdk\OtherManaging\PixelDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#pixel-list
     */
    public function pixelList(): PaginableResponse
    {
        $response = $this->transport->get('/3.0/partner/pixels');

        $pagination = Pagination::createFromArray($response['pagination']);
        $items = array_map(fn(array $item) => new PixelDto($item), $response['pixel']);

        return new PaginableResponse($response['status'], $items, $pagination);
    }

    /**
     * Add a partner’s pixel.
     *
     * @param array<string, mixed> $data
     * @psalm-param array{
     *  offer_id: int,
     *  name: string,
     *  code: string,
     *  code_type: string,
     * } $data
     *
     * @return \Affise\Sdk\Helper\Response<\Affise\Sdk\OtherManaging\PixelDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#pixel-add
     */
    public function pixelAdd(array $data): Response
    {
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
     * } $data
     *
     * @return \Affise\Sdk\Helper\Response<\Affise\Sdk\OtherManaging\PixelDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#pixel-edit
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
     * @see https://api.affise.com/docs3.1/#pixel-remove
     */
    public function pixelRemove(int $id): Response
    {
        $response = $this->transport->delete(sprintf('/3.0/partner/pixel/%s/remove', $id));

        return new Response($response['status'], new PixelDto($response['pixel']));
    }

    /**
     * Get current affiliate balance.
     *
     * @return \Affise\Sdk\Helper\Response<\Affise\Sdk\AffiliateMethods\AffiliateBalanceDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#affiliate-balance
     */
    public function affiliateBalance(): Response
    {
        $response = $this->transport->get('/3.0/balance');

        return new Response($response['status'], new AffiliateBalanceDto($response['balance']));
    }

    /**
     * SmartLink categories list.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     *  id?: array<string>,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\Response<array<\Affise\Sdk\OtherManaging\SmartLinkCategoryDto>>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#smartlink-categories
     */
    public function smartLinkCategories(array $filters = []): Response
    {
        $response = $this->transport->get('/3.0/partner/smartlink/categories', $filters);

        $items = array_map(fn(array $item) => new SmartLinkCategoryDto($item), $response['data']);

        return new Response($response['status'], $items);
    }

    /**
     * Add new SmartLink category.
     *
     * @param string $id
     *
     * @return \Affise\Sdk\Helper\Response<\Affise\Sdk\OtherManaging\SmartLinkOfferCountDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#smartlink-offer-count
     */
    public function smartLinkOfferCount(string $id): Response
    {
        $response = $this->transport->get(sprintf('/3.0/partner/smartlink/category/%s/offers-count', $id));

        return new Response($response['status'], new SmartLinkOfferCountDto($response['data']));
    }

    /**
     * Get referrals by partner ID.
     *
     * @param int $id
     *
     * @return \Affise\Sdk\Helper\PaginableResponse<\Affise\Sdk\Affiliate\AffiliateDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#get-referrals
     * @see \Affise\Sdk\Affiliate\AffiliateProvider::getReferrals()
     */
    public function getReferrals(int $id): PaginableResponse
    {
        return $this->affiliateProvider->getReferrals($id);
    }
}
