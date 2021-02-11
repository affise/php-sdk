<?php 

declare(strict_types=1);

namespace Affise\Sdk\Statistics;

use Affise\Sdk\Helper\AbstractProvider;
use Affise\Sdk\Helper\PaginableResponse;
use Affise\Sdk\Helper\Pagination;
use Affise\Sdk\Helper\Response;
use InvalidArgumentException;

/**
* Class StatisticsProvider
*
* Statistics
*/
class StatisticsProvider extends AbstractProvider
{
    /**
    * Get custom statistics.
    *
    * @param array<string, mixed> $filters
    * @psalm-param array{
    *  slice: array<string>,
    *  filter: array{
    *   date_from: string,
    *   date_to: string,
    *   offer_tag?: string,
    *   affiliate_tag?: string,
    *   advertiser_tag?: string,
    *   nonzero?: int,
    *   smart_id?: string|array<string>,
    *   device?: string|array<string>,
    *   sub4?: string|array<string>,
    *   sub5?: string|array<string>,
    *   sub3?: string|array<string>,
    *   sub2?: string|array<string>,
    *   sub1?: string|array<string>,
    *   goal?: string|array<string>,
    *   os?: string|array<string>,
    *   country?: string|array<string>,
    *   partner?: string|array<string>,
    *   advertiser_manager_id?: string|array<string>,
    *   manager?: string|array<string>,
    *   offer?: array<int>,
    *   advertiser?: string|array<string>,
    *   currency?: array<string>,
    * },
    *  order?: array<string>,
    *  orderType?: string,
    *  limit?: int,
    *  page?: int,
    *  conversionTypes?: array<string>,
    *  locale?: string,
    *  timezone?: string,
    * } $filters
    *
    * @return \Affise\Sdk\Helper\PaginableResponse<\Affise\Sdk\Statistics\StatisticDto>
    *
    * @throws \Affise\Sdk\Exception\TransportException
    *
    * @see https://api.affise.com/docs3.1/#custom-statistics
    */
    public function customStatistics(array $filters): PaginableResponse
    {
        if (empty($filters['slice'])) {
            throw new InvalidArgumentException("Parameter 'slice' is required");
        }

        if (empty($filters['filter']['date_from'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_from]' is required");
        }

        if (empty($filters['filter']['date_to'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_to]' is required");
        }

        $response = $this->transport->get('/3.0/stats/custom', $filters);

        $pagination = Pagination::createFromArray($response['pagination']);
        $items = array_map(fn(array $item) => new StatisticDto($item), $response['stats']);

        return new PaginableResponse($response['status'], $items, $pagination);
    }

    /**
     * Get conversions.
     *
     * @param string $id
     *
     * @return \Affise\Sdk\Helper\Response<\Affise\Sdk\Statistics\ConversionDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#conversion
     */
    public function conversion(string $id): Response
    {
        $response = $this->transport->get('/3.0/stats/conversionsbyid', compact('id'));

        return new Response($response['status'], new ConversionDto($response['conversion']));
    }

    /**
     * Get conversions.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     *  date_from?: string,
     *  subid2?: string,
     *  custom_field_3?: string,
     *  custom_field_4?: string,
     *  custom_field_5?: string,
     *  custom_field_6?: string,
     *  custom_field_7?: string,
     *  subid1?: string,
     *  subid3?: string,
     *  custom_field_1?: string,
     *  subid4?: string,
     *  subid5?: string,
     *  partner?: array<int>,
     *  revenue?: float,
     *  page?: int,
     *  limit?: int,
     *  custom_field_2?: string,
     *  timezone?: string,
     *  date_to?: string,
     *  browser?: string,
     *  update_from_date?: string,
     *  update_from_hour?: int,
     *  status?: array<int>,
     *  offer?: array<int>,
     *  advertiser?: array<string>,
     *  country?: array<string>,
     *  action_id?: string,
     *  hour?: int,
     *  clickid?: string,
     *  os?: string,
     *  goal?: string,
     *  device?: string,
     *  payouts?: float,
     *  currency?: int,
     *  raw_export?: int,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\PaginableResponse<\Affise\Sdk\Statistics\ConversionsDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#conversions
     */
    public function conversions(array $filters = []): PaginableResponse
    {
        $response = $this->transport->get('/3.0/stats/conversions', $filters);

        $pagination = Pagination::createFromArray($response['pagination']);
        $items = array_map(fn(array $item) => new ConversionsDto($item), $response['conversions']);

        return new PaginableResponse($response['status'], $items, $pagination);
    }

    /**
     * Get clicks.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     *  date_from: string,
     *  date_to: string,
     *  hour?: int,
     *  offer?: array<int>,
     *  partner?: array<int>,
     *  country?: array<string>,
     *  advertisers?: array<string>,
     *  timezone?: string,
     *  page?: int,
     *  limit?: int,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\PaginableResponse<\Affise\Sdk\Statistics\ClicksDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#clicks
     */
    public function clicks(array $filters): PaginableResponse
    {
        if (empty($filters['date_from'])) {
            throw new InvalidArgumentException("Parameter 'date_from' is required");
        }

        if (empty($filters['date_to'])) {
            throw new InvalidArgumentException("Parameter 'date_to' is required");
        }

        $response = $this->transport->get('/3.0/stats/clicks', $filters);

        $pagination = Pagination::createFromArray($response['pagination']);
        $items = array_map(fn(array $item) => new ClicksDto($item), $response['clicks']);

        return new PaginableResponse($response['status'], $items, $pagination);
    }

    /**
     * Get statistics by date.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     *  filter: array{
     *   date_to: string,
     *   date_from: string,
     *   affiliate_tag?: string,
     *   advertiser_tag?: string,
     *   device?: string|array<string>,
     *   sub8?: string|array<string>,
     *   sub7?: string|array<string>,
     *   sub6?: string|array<string>,
     *   sub5?: string|array<string>,
     *   sub4?: string|array<string>,
     *   sub3?: string|array<string>,
     *   sub2?: string|array<string>,
     *   sub1?: string|array<string>,
     *   os?: string|array<string>,
     *   goal?: string|array<string>,
     *   country?: string|array<string>,
     *   partner?: string|array<string>,
     *   advertiser_manager_id?: string|array<string>,
     *   manager?: string|array<string>,
     *   offer?: array<int>,
     *   advertiser?: string|array<string>,
     *   currency?: array<string>,
     *   offer_tag?: string,
     * },
     *  locale?: string,
     *  timezone?: string,
     *  orderType?: string,
     *  limit?: int,
     *  page?: int,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\PaginableResponse<\Affise\Sdk\Statistics\StatisticDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#by-date
     */
    public function byDate(array $filters): PaginableResponse
    {
        if (empty($filters['filter']['date_from'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_from]' is required");
        }

        if (empty($filters['filter']['date_to'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_to]' is required");
        }

        $response = $this->transport->get('/3.0/stats/getbydate', $filters);

        $pagination = Pagination::createFromArray($response['pagination']);
        $items = array_map(fn(array $item) => new StatisticDto($item), $response['stats']);

        return new PaginableResponse($response['status'], $items, $pagination);
    }

    /**
     * Get statistics by hour.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     * filter: array{
     *  date_from: string,
     *  date_to: string,
     *  currency?: array<string>,
     *  advertiser?: string|array<string>,
     *  offer?: array<int>,
     *  manager?: string|array<string>,
     *  advertiser_manager_id?: string|array<string>,
     *  partner?: string|array<string>,
     *  country?: string|array<string>,
     *  os?: string|array<string>,
     *  goal?: string|array<string>,
     *  sub1?: string|array<string>,
     *  sub2?: string|array<string>,
     *  sub3?: string|array<string>,
     *  sub4?: string|array<string>,
     *  sub5?: string|array<string>,
     *  sub6?: string|array<string>,
     *  sub7?: string|array<string>,
     *  sub8?: string|array<string>,
     *  device?: string|array<string>,
     *  advertiser_tag?: string,
     *  affiliate_tag?: string,
     *  offer_tag?: string,
     * },
     * locale?: string,
     * timezone?: string,
     * page?: int,
     * limit?: int,
     * orderType?: string,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\PaginableResponse<\Affise\Sdk\Statistics\StatisticDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#hourly
     */
    public function hourly(array $filters): PaginableResponse
    {
        if (empty($filters['filter']['date_from'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_from]' is required");
        }

        if (empty($filters['filter']['date_to'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_to]' is required");
        }

        $response = $this->transport->get('/3.0/stats/getbyhour', $filters);

        $pagination = Pagination::createFromArray($response['pagination']);
        $items = array_map(fn(array $item) => new StatisticDto($item), $response['stats']);

        return new PaginableResponse($response['status'], $items, $pagination);
    }

    /**
     * Get statistics by sub.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     * filter: array{
     *  date_from: string,
     *  date_to: string,
     *  currency?: array<string>,
     *  advertiser?: string|array<string>,
     *  offer: array<int>,
     *  manager?: string|array<string>,
     *  advertiser_manager_id?: string|array<string>,
     *  country?: string|array<string>,
     *  os?: string|array<string>,
     *  goal?: string|array<string>,
     *  sub1?: string|array<string>,
     *  sub2?: string|array<string>,
     *  sub3?: string|array<string>,
     *  sub4?: string|array<string>,
     *  sub5?: string|array<string>,
     *  sub6?: string|array<string>,
     *  sub7?: string|array<string>,
     *  sub8?: string|array<string>,
     *  device?: string|array<string>,
     *  advertiser_tag?: string,
     *  affiliate_tag?: string,
     *  offer_tag?: string,
     * },
     * locale?: string,
     * timezone?: string,
     * page?: int,
     * limit?: int,
     * orderType?: string,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\PaginableResponse<\Affise\Sdk\Statistics\StatisticDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#by-sub
     */
    public function bySub(array $filters): PaginableResponse
    {
        if (empty($filters['filter']['date_from'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_from]' is required");
        }

        if (empty($filters['filter']['date_to'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_to]' is required");
        }

        if (empty($filters['filter']['offer'])) {
            throw new InvalidArgumentException("Parameter 'filter[offer]' is required");
        }

        $response = $this->transport->get('/3.0/stats/getbysub', $filters);

        $pagination = Pagination::createFromArray($response['pagination']);
        $items = array_map(fn(array $item) => new StatisticDto($item), $response['stats']);

        return new PaginableResponse($response['status'], $items, $pagination);
    }

    /**
     * Get statistics by offer.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     * filter: array{
     *  date_from: string,
     *  date_to: string,
     *  currency?: array<string>,
     *  advertiser?: string|array<string>,
     *  offer?: array<int>,
     *  manager?: string|array<string>,
     *  advertiser_manager_id?: string|array<string>,
     *  partner?: string|array<string>,
     *  country?: string|array<string>,
     *  os?: string|array<string>,
     *  goal?: string|array<string>,
     *  sub1?: string|array<string>,
     *  sub2?: string|array<string>,
     *  sub3?: string|array<string>,
     *  sub4?: string|array<string>,
     *  sub5?: string|array<string>,
     *  sub6?: string|array<string>,
     *  sub7?: string|array<string>,
     *  sub8?: string|array<string>,
     *  device?: string|array<string>,
     *  advertiser_tag?: string,
     *  affiliate_tag?: string,
     *  offer_tag?: string,
     * },
     * locale?: string,
     * timezone?: string,
     * page?: int,
     * limit?: int,
     * orderType?: string,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\PaginableResponse<\Affise\Sdk\Statistics\StatisticDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#by-offer
     */
    public function byOffer(array $filters): PaginableResponse
    {
        if (empty($filters['filter']['date_from'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_from]' is required");
        }

        if (empty($filters['filter']['date_to'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_to]' is required");
        }

        $response = $this->transport->get('/3.0/stats/getbyprogram', $filters);

        $pagination = Pagination::createFromArray($response['pagination']);

        $items = array_map(function (array $item) {
            $slice = $item['slice'];
            $slice['offer'] = new OfferWithExternalDto($slice['offer']);
            $item['slice'] = $slice;

            return new StatisticDto($item);
        }, $response['stats']);

        return new PaginableResponse($response['status'], $items, $pagination);
    }

    /**
     * Get statistics by advertiser.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     * filter: array{
     *  date_from: string,
     *  date_to: string,
     *  currency?: array<string>,
     *  advertiser?: string|array<string>,
     *  offer?: array<int>,
     *  manager?: string|array<string>,
     *  advertiser_manager_id?: string|array<string>,
     *  partner?: string|array<string>,
     *  country?: string|array<string>,
     *  os?: string|array<string>,
     *  goal?: string|array<string>,
     *  sub1?: string|array<string>,
     *  sub2?: string|array<string>,
     *  sub3?: string|array<string>,
     *  sub4?: string|array<string>,
     *  sub5?: string|array<string>,
     *  sub6?: string|array<string>,
     *  sub7?: string|array<string>,
     *  sub8?: string|array<string>,
     *  device?: string|array<string>,
     *  advertiser_tag?: string,
     *  affiliate_tag?: string,
     *  offer_tag?: string,
     * },
     * locale?: string,
     * timezone?: string,
     * page?: int,
     * limit?: int,
     * orderType?: string,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\PaginableResponse<\Affise\Sdk\Statistics\StatisticDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#by-advertiser
     */
    public function byAdvertiser(array $filters): PaginableResponse
    {
        if (empty($filters['filter']['date_from'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_from]' is required");
        }

        if (empty($filters['filter']['date_to'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_to]' is required");
        }

        $response = $this->transport->get('/3.0/stats/getbyadvertiser', $filters);

        $pagination = Pagination::createFromArray($response['pagination']);

        $items = array_map(function (array $item) {
            $slice = $item['slice'];
            $slice['advertiser'] = new AdvertiserDto($slice['advertiser']);
            $item['slice'] = $slice;

            return new StatisticDto($item);
        }, $response['stats']);

        return new PaginableResponse($response['status'], $items, $pagination);
    }

    /**
     * Get statistics by accounts managers.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     * filter: array{
     *  date_from: string,
     *  date_to: string,
     *  currency?: array<string>,
     *  advertiser?: string|array<string>,
     *  offer?: array<int>,
     *  manager?: string|array<string>,
     *  advertiser_manager_id?: string|array<string>,
     *  partner?: string|array<string>,
     *  country?: string|array<string>,
     *  os?: string|array<string>,
     *  goal?: string|array<string>,
     *  sub1?: string|array<string>,
     *  sub2?: string|array<string>,
     *  sub3?: string|array<string>,
     *  sub4?: string|array<string>,
     *  sub5?: string|array<string>,
     *  sub6?: string|array<string>,
     *  sub7?: string|array<string>,
     *  sub8?: string|array<string>,
     *  device?: string|array<string>,
     *  advertiser_tag?: string,
     *  affiliate_tag?: string,
     *  offer_tag?: string,
     * },
     * locale?: string,
     * timezone?: string,
     * page?: int,
     * limit?: int,
     * orderType?: string,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\PaginableResponse<\Affise\Sdk\Statistics\StatisticDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#by-accounts-managers
     */
    public function byAccountsManagers(array $filters): PaginableResponse
    {
        if (empty($filters['filter']['date_from'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_from]' is required");
        }

        if (empty($filters['filter']['date_to'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_to]' is required");
        }

        $response = $this->transport->get('/3.0/stats/getbyaccountmanager', $filters);

        $pagination = Pagination::createFromArray($response['pagination']);

        $items = array_map(function (array $item) {
            $slice = $item['slice'];
            $slice['advertiser_manager_id'] = new AdvertiserManagerDto($slice['advertiser_manager_id']);
            $item['slice'] = $slice;

            return new StatisticDto($item);
        }, $response['stats']);

        return new PaginableResponse($response['status'], $items, $pagination);
    }

    /**
     * Get statistics by affiliates managers.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     *  filter: array{
     *  date_from: string,
     *  date_to: string,
     *  currency?: array<string>,
     *  advertiser?: string|array<string>,
     *  offer?: array<int>,
     *  manager?: string|array<string>,
     *  advertiser_manager_id?: string|array<string>,
     *  partner?: string|array<string>,
     *  country?: string|array<string>,
     *  os?: string|array<string>,
     *  goal?: string|array<string>,
     *  sub1?: string|array<string>,
     *  sub2?: string|array<string>,
     *  sub3?: string|array<string>,
     *  sub4?: string|array<string>,
     *  sub5?: string|array<string>,
     *  sub6?: string|array<string>,
     *  sub7?: string|array<string>,
     *  sub8?: string|array<string>,
     *  device?: string|array<string>,
     *  advertiser_tag?: string,
     *  affiliate_tag?: string,
     *  offer_tag?: string,
     * },
     * locale?: string,
     * timezone?: string,
     * page?: int,
     * limit?: int,
     * orderType?: string,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\PaginableResponse<\Affise\Sdk\Statistics\StatisticDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#by-affiliates-managers
     */
    public function byAffiliatesManagers(array $filters): PaginableResponse
    {
        if (empty($filters['filter']['date_from'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_from]' is required");
        }

        if (empty($filters['filter']['date_to'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_to]' is required");
        }

        $response = $this->transport->get('/3.0/stats/getbyaffiliatemanager', $filters);

        $pagination = Pagination::createFromArray($response['pagination']);

        $items = array_map(function (array $item) {
            $slice = $item['slice'];
            $slice['affiliate_manager_id'] = new AffiliateManagerDto($slice['affiliate_manager_id']);
            $item['slice'] = $slice;

            return new StatisticDto($item);
        }, $response['stats']);

        return new PaginableResponse($response['status'], $items, $pagination);
    }

    /**
     * Get statistics by affiliate.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     * filter: array{
     *  date_from: string,
     *  date_to: string,
     *  currency?: array<string>,
     *  advertiser?: string|array<string>,
     *  offer?: array<int>,
     *  manager?: string|array<string>,
     *  advertiser_manager_id?: string|array<string>,
     *  partner?: string|array<string>,
     *  country?: string|array<string>,
     *  os?: string|array<string>,
     *  goal?: string|array<string>,
     *  sub1?: string|array<string>,
     *  sub2?: string|array<string>,
     *  sub3?: string|array<string>,
     *  sub4?: string|array<string>,
     *  sub5?: string|array<string>,
     *  sub6?: string|array<string>,
     *  sub7?: string|array<string>,
     *  sub8?: string|array<string>,
     *  device?: string|array<string>,
     *  advertiser_tag?: string,
     *  affiliate_tag?: string,
     *  offer_tag?: string,
     * },
     * locale?: string,
     * timezone?: string,
     * page?: int,
     * limit?: int,
     * orderType?: string,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\PaginableResponse<\Affise\Sdk\Statistics\StatisticDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#by-affiliate
     */
    public function byAffiliate(array $filters): PaginableResponse
    {
        if (empty($filters['filter']['date_from'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_from]' is required");
        }

        if (empty($filters['filter']['date_to'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_to]' is required");
        }

        $response = $this->transport->get('/3.0/stats/getbypartner', $filters);

        $pagination = Pagination::createFromArray($response['pagination']);

        $items = array_map(function (array $item) {
            $slice = $item['slice'];
            $slice['affiliate'] = new AffiliateDto($slice['affiliate']);
            $item['slice'] = $slice;

            return new StatisticDto($item);
        }, $response['stats']);

        return new PaginableResponse($response['status'], $items, $pagination);
    }

    /**
     * Get statistics by affiliate and date.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     * filter: array{
     *  date_from: string,
     *  date_to: string,
     *  currency?: array<string>,
     *  advertiser?: string|array<string>,
     *  offer?: array<int>,
     *  manager?: string|array<string>,
     *  advertiser_manager_id?: string|array<string>,
     *  partner?: string|array<string>,
     *  country?: string|array<string>,
     *  os?: string|array<string>,
     *  goal?: string|array<string>,
     *  sub1?: string|array<string>,
     *  sub2?: string|array<string>,
     *  sub3?: string|array<string>,
     *  sub4?: string|array<string>,
     *  sub5?: string|array<string>,
     *  sub6?: string|array<string>,
     *  sub7?: string|array<string>,
     *  sub8?: string|array<string>,
     *  device?: string|array<string>,
     *  advertiser_tag?: string,
     *  affiliate_tag?: string,
     *  offer_tag?: string,
     * },
     * locale?: string,
     * timezone?: string,
     * page?: int,
     * limit?: int,
     * orderType?: string,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\PaginableResponse<\Affise\Sdk\Statistics\StatisticDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#by-affiliate-and-date
     */
    public function byAffiliateAndDate(array $filters): PaginableResponse
    {
        if (empty($filters['filter']['date_from'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_from]' is required");
        }

        if (empty($filters['filter']['date_to'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_to]' is required");
        }

        $response = $this->transport->get('/3.0/stats/getbypartnerbydate', $filters);

        $pagination = Pagination::createFromArray($response['pagination']);

        $items = array_map(function (array $item) {
            $slice = $item['slice'];
            $slice['affiliate'] = new AffiliateDto($slice['affiliate']);
            $item['slice'] = $slice;

            return new StatisticDto($item);
        }, $response['stats']);

        return new PaginableResponse($response['status'], $items, $pagination);
    }

    /**
     * Get statistics by country.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     * filter: array{
     *  date_from: string,
     *  date_to: string,
     *  currency?: array<string>,
     *  advertiser?: string|array<string>,
     *  offer?: array<int>,
     *  manager?: string|array<string>,
     *  advertiser_manager_id?: string|array<string>,
     *  partner?: string|array<string>,
     *  country?: string|array<string>,
     *  os?: string|array<string>,
     *  goal?: string|array<string>,
     *  sub1?: string|array<string>,
     *  sub2?: string|array<string>,
     *  sub3?: string|array<string>,
     *  sub4?: string|array<string>,
     *  sub5?: string|array<string>,
     *  sub6?: string|array<string>,
     *  sub7?: string|array<string>,
     *  sub8?: string|array<string>,
     *  device?: string|array<string>,
     *  advertiser_tag?: string,
     *  affiliate_tag?: string,
     *  offer_tag?: string,
     * },
     * locale?: string,
     * timezone?: string,
     * page?: int,
     * limit?: int,
     * orderType?: string,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\PaginableResponse<\Affise\Sdk\Statistics\StatisticDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#by-country
     */
    public function byCountry(array $filters): PaginableResponse
    {
        if (empty($filters['filter']['date_from'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_from]' is required");
        }

        if (empty($filters['filter']['date_to'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_to]' is required");
        }

        $response = $this->transport->get('/3.0/stats/getbycountries', $filters);

        $pagination = Pagination::createFromArray($response['pagination']);
        $items = array_map(fn(array $item) => new StatisticDto($item), $response['stats']);

        return new PaginableResponse($response['status'], $items, $pagination);
    }

    /**
     * Get statistics by browser.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     * filter: array{
     *  date_from: string,
     *  date_to: string,
     *  currency?: array<string>,
     *  advertiser?: string|array<string>,
     *  offer?: array<int>,
     *  manager?: string|array<string>,
     *  advertiser_manager_id?: string|array<string>,
     *  partner?: string|array<string>,
     *  country?: string|array<string>,
     *  os?: string|array<string>,
     *  goal?: string|array<string>,
     *  sub1?: string|array<string>,
     *  sub2?: string|array<string>,
     *  sub3?: string|array<string>,
     *  sub4?: string|array<string>,
     *  sub5?: string|array<string>,
     *  sub6?: string|array<string>,
     *  sub7?: string|array<string>,
     *  sub8?: string|array<string>,
     *  device?: string|array<string>,
     *  advertiser_tag?: string,
     *  affiliate_tag?: string,
     *  offer_tag?: string,
     * },
     * locale?: string,
     * timezone?: string,
     * page?: int,
     * limit?: int,
     * orderType?: string,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\PaginableResponse<\Affise\Sdk\Statistics\StatisticDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#by-browser
     */
    public function byBrowser(array $filters): PaginableResponse
    {
        if (empty($filters['filter']['date_from'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_from]' is required");
        }

        if (empty($filters['filter']['date_to'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_to]' is required");
        }

        $response = $this->transport->get('/3.0/stats/getbybrowsers', $filters);

        $pagination = Pagination::createFromArray($response['pagination']);
        $items = array_map(fn(array $item) => new StatisticDto($item), $response['stats']);

        return new PaginableResponse($response['status'], $items, $pagination);
    }

    /**
     * Get statistics by browser version.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     *  filter: array{
     *   date_from: string,
     *   date_to: string,
     *   currency?: array<string>,
     *   advertiser?: string|array<string>,
     *   offer?: array<int>,
     *   manager?: string|array<string>,
     *   advertiser_manager_id?: string|array<string>,
     *   partner?: string|array<string>,
     *   country?: string|array<string>,
     *   os?: string|array<string>,
     *   goal?: string|array<string>,
     *   sub1?: string|array<string>,
     *   sub2?: string|array<string>,
     *   sub3?: string|array<string>,
     *   sub4?: string|array<string>,
     *   sub5?: string|array<string>,
     *   sub6?: string|array<string>,
     *   sub7?: string|array<string>,
     *   sub8?: string|array<string>,
     *   device?: string|array<string>,
     *   advertiser_tag?: string,
     *   affiliate_tag?: string,
     *   offer_tag?: string,
     *  },
     *  locale?: string,
     *  timezone?: string,
     *  page?: int,
     *  limit?: int,
     *  orderType?: string,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\PaginableResponse<\Affise\Sdk\Statistics\StatisticDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#by-browser-version
     */
    public function byBrowserVersion(array $filters): PaginableResponse
    {
        if (empty($filters['filter']['date_from'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_from]' is required");
        }

        if (empty($filters['filter']['date_to'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_to]' is required");
        }

        $response = $this->transport->get('/3.0/stats/getbybrowsersversion', $filters);

        $pagination = Pagination::createFromArray($response['pagination']);
        $items = array_map(fn(array $item) => new StatisticDto($item), $response['stats']);

        return new PaginableResponse($response['status'], $items, $pagination);
    }

    /**
     * Get statistics by landing.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     *  filter: array{
     *   date_from: string,
     *   date_to: string,
     *   currency?: array<string>,
     *   advertiser?: string|array<string>,
     *   offer?: array<int>,
     *   manager?: string|array<string>,
     *   advertiser_manager_id?: string|array<string>,
     *   partner?: string|array<string>,
     *   country?: string|array<string>,
     *   os?: string|array<string>,
     *   goal?: string|array<string>,
     *   sub1?: string|array<string>,
     *   sub2?: string|array<string>,
     *   sub3?: string|array<string>,
     *   sub4?: string|array<string>,
     *   sub5?: string|array<string>,
     *   sub6?: string|array<string>,
     *   sub7?: string|array<string>,
     *   sub8?: string|array<string>,
     *   device?: string|array<string>,
     *   advertiser_tag?: string,
     *   affiliate_tag?: string,
     *   offer_tag?: string,
     *  },
     *  locale?: string,
     *  timezone?: string,
     *  page?: int,
     *  limit?: int,
     *  orderType?: string,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\PaginableResponse<\Affise\Sdk\Statistics\StatisticDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#by-landing
     */
    public function byLanding(array $filters): PaginableResponse
    {
        if (empty($filters['filter']['date_from'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_from]' is required");
        }

        if (empty($filters['filter']['date_to'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_to]' is required");
        }

        $response = $this->transport->get('/3.0/stats/getbylanding', $filters);

        $pagination = Pagination::createFromArray($response['pagination']);
        $items = array_map(fn(array $item) => new StatisticDto($item), $response['stats']);

        return new PaginableResponse($response['status'], $items, $pagination);
    }

    /**
     * Get statistics by prelanding.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     *  filter: array{
     *   date_from: string,
     *   date_to: string,
     *   currency?: array<string>,
     *   advertiser?: string|array<string>,
     *   offer?: array<int>,
     *   manager?: string|array<string>,
     *   advertiser_manager_id?: string|array<string>,
     *   partner?: string|array<string>,
     *   country?: string|array<string>,
     *   os?: string|array<string>,
     *   goal?: string|array<string>,
     *   sub1?: string|array<string>,
     *   sub2?: string|array<string>,
     *   sub3?: string|array<string>,
     *   sub4?: string|array<string>,
     *   sub5?: string|array<string>,
     *   sub6?: string|array<string>,
     *   sub7?: string|array<string>,
     *   sub8?: string|array<string>,
     *   device?: string|array<string>,
     *   advertiser_tag?: string,
     *   affiliate_tag?: string,
     *   offer_tag?: string,
     *  },
     *  locale?: string,
     *  timezone?: string,
     *  page?: int,
     *  limit?: int,
     *  orderType?: string,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\PaginableResponse<\Affise\Sdk\Statistics\StatisticDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#by-prelanding
     */
    public function byPrelanding(array $filters): PaginableResponse
    {
        if (empty($filters['filter']['date_from'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_from]' is required");
        }

        if (empty($filters['filter']['date_to'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_to]' is required");
        }

        $response = $this->transport->get('/3.0/stats/getbyprelanding', $filters);

        $pagination = Pagination::createFromArray($response['pagination']);
        $items = array_map(fn(array $item) => new StatisticDto($item), $response['stats']);

        return new PaginableResponse($response['status'], $items, $pagination);
    }

    /**
     * Get statistics by mobile carrier.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     *  filter: array{
     *   date_from: string,
     *   date_to: string,
     *   currency?: array<string>,
     *   advertiser?: string|array<string>,
     *   offer?: array<int>,
     *   manager?: string|array<string>,
     *   advertiser_manager_id?: string|array<string>,
     *   partner?: string|array<string>,
     *   country?: string|array<string>,
     *   os?: string|array<string>,
     *   goal?: string|array<string>,
     *   sub1?: string|array<string>,
     *   sub2?: string|array<string>,
     *   sub3?: string|array<string>,
     *   sub4?: string|array<string>,
     *   sub5?: string|array<string>,
     *   sub6?: string|array<string>,
     *   sub7?: string|array<string>,
     *   sub8?: string|array<string>,
     *   device?: string|array<string>,
     *   advertiser_tag?: string,
     *   affiliate_tag?: string,
     *   offer_tag?: string,
     *  },
     *  locale?: string,
     *  timezone?: string,
     *  page?: int,
     *  limit?: int,
     *  orderType?: string,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\PaginableResponse<\Affise\Sdk\Statistics\StatisticDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#by-mobile-carrier
     */
    public function byMobileCarrier(array $filters): PaginableResponse
    {
        if (empty($filters['filter']['date_from'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_from]' is required");
        }

        if (empty($filters['filter']['date_to'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_to]' is required");
        }

        $response = $this->transport->get('/3.0/stats/getbymobilecarrier', $filters);

        $pagination = Pagination::createFromArray($response['pagination']);
        $items = array_map(fn(array $item) => new StatisticDto($item), $response['stats']);

        return new PaginableResponse($response['status'], $items, $pagination);
    }

    /**
     * Get statistics by connection type.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     *  filter: array{
     *   date_from: string,
     *   date_to: string,
     *   currency?: array<string>,
     *   advertiser?: string|array<string>,
     *   offer?: array<int>,
     *   manager?: string|array<string>,
     *   advertiser_manager_id?: string|array<string>,
     *   partner?: string|array<string>,
     *   country?: string|array<string>,
     *   os?: string|array<string>,
     *   goal?: string|array<string>,
     *   sub1?: string|array<string>,
     *   sub2?: string|array<string>,
     *   sub3?: string|array<string>,
     *   sub4?: string|array<string>,
     *   sub5?: string|array<string>,
     *   sub6?: string|array<string>,
     *   sub7?: string|array<string>,
     *   sub8?: string|array<string>,
     *   device?: string|array<string>,
     *   advertiser_tag?: string,
     *   affiliate_tag?: string,
     *   offer_tag?: string,
     *  },
     *  locale?: string,
     *  timezone?: string,
     *  page?: int,
     *  limit?: int,
     *  orderType?: string,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\PaginableResponse<\Affise\Sdk\Statistics\StatisticDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#by-connection-type
     */
    public function byConnectionType(array $filters): PaginableResponse
    {
        if (empty($filters['filter']['date_from'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_from]' is required");
        }

        if (empty($filters['filter']['date_to'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_to]' is required");
        }

        $response = $this->transport->get('/3.0/stats/getbyconnectiontype', $filters);

        $pagination = Pagination::createFromArray($response['pagination']);
        $items = array_map(fn(array $item) => new StatisticDto($item), $response['stats']);

        return new PaginableResponse($response['status'], $items, $pagination);
    }

    /**
     * Get statistics by OS.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     *  filter: array{
     *   date_from: string,
     *   date_to: string,
     *   currency?: array<string>,
     *   advertiser?: string|array<string>,
     *   offer?: array<int>,
     *   manager?: string|array<string>,
     *   advertiser_manager_id?: string|array<string>,
     *   partner?: string|array<string>,
     *   country?: string|array<string>,
     *   os?: string|array<string>,
     *   goal?: string|array<string>,
     *   sub1?: string|array<string>,
     *   sub2?: string|array<string>,
     *   sub3?: string|array<string>,
     *   sub4?: string|array<string>,
     *   sub5?: string|array<string>,
     *   sub6?: string|array<string>,
     *   sub7?: string|array<string>,
     *   sub8?: string|array<string>,
     *   device?: string|array<string>,
     *   advertiser_tag?: string,
     *   affiliate_tag?: string,
     *   offer_tag?: string,
     *  },
     *  locale?: string,
     *  timezone?: string,
     *  page?: int,
     *  limit?: int,
     *  orderType?: string,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\PaginableResponse<\Affise\Sdk\Statistics\StatisticDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#by-os
     */
    public function byOs(array $filters): PaginableResponse
    {
        if (empty($filters['filter']['date_from'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_from]' is required");
        }

        if (empty($filters['filter']['date_to'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_to]' is required");
        }

        $response = $this->transport->get('/3.0/stats/getbyos', $filters);

        $pagination = Pagination::createFromArray($response['pagination']);
        $items = array_map(fn(array $item) => new StatisticDto($item), $response['stats']);

        return new PaginableResponse($response['status'], $items, $pagination);
    }

    /**
     * Get statistics by os version.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     *  filter: array{
     *   date_from: string,
     *   date_to: string,
     *   currency?: array<string>,
     *   advertiser?: string|array<string>,
     *   offer?: array<int>,
     *   manager?: string|array<string>,
     *   advertiser_manager_id?: string|array<string>,
     *   partner?: string|array<string>,
     *   country?: string|array<string>,
     *   os?: string|array<string>,
     *   goal?: string|array<string>,
     *   sub1?: string|array<string>,
     *   sub2?: string|array<string>,
     *   sub3?: string|array<string>,
     *   sub4?: string|array<string>,
     *   sub5?: string|array<string>,
     *   sub6?: string|array<string>,
     *   sub7?: string|array<string>,
     *   sub8?: string|array<string>,
     *   device?: string|array<string>,
     *   advertiser_tag?: string,
     *   affiliate_tag?: string,
     *   offer_tag?: string,
     *  },
     *  locale?: string,
     *  timezone?: string,
     *  page?: int,
     *  limit?: int,
     *  orderType?: string,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\PaginableResponse<\Affise\Sdk\Statistics\StatisticDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#by-os-version
     */
    public function byOsVersion(array $filters): PaginableResponse
    {
        if (empty($filters['filter']['date_from'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_from]' is required");
        }

        if (empty($filters['filter']['date_to'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_to]' is required");
        }

        $response = $this->transport->get('/3.0/stats/getbyversions', $filters);

        $pagination = Pagination::createFromArray($response['pagination']);
        $items = array_map(fn(array $item) => new StatisticDto($item), $response['stats']);

        return new PaginableResponse($response['status'], $items, $pagination);
    }

    /**
     * Get statistics by goal.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     *  filter: array{
     *   date_from: string,
     *   date_to: string,
     *   currency?: array<string>,
     *   advertiser?: string|array<string>,
     *   offer?: array<int>,
     *   manager?: string|array<string>,
     *   advertiser_manager_id?: string|array<string>,
     *   partner?: string|array<string>,
     *   country?: string|array<string>,
     *   os?: string|array<string>,
     *   goal?: string|array<string>,
     *   sub1?: string|array<string>,
     *   sub2?: string|array<string>,
     *   sub3?: string|array<string>,
     *   sub4?: string|array<string>,
     *   sub5?: string|array<string>,
     *   sub6?: string|array<string>,
     *   sub7?: string|array<string>,
     *   sub8?: string|array<string>,
     *   device?: string|array<string>,
     *   advertiser_tag?: string,
     *   affiliate_tag?: string,
     *   offer_tag?: string,
     *  },
     *  locale?: string,
     *  timezone?: string,
     *  page?: int,
     *  limit?: int,
     *  orderType?: string,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\PaginableResponse<\Affise\Sdk\Statistics\StatisticDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#by-goal
     */
    public function byGoal(array $filters): PaginableResponse
    {
        if (empty($filters['filter']['date_from'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_from]' is required");
        }

        if (empty($filters['filter']['date_to'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_to]' is required");
        }

        $response = $this->transport->get('/3.0/stats/getbygoal', $filters);

        $pagination = Pagination::createFromArray($response['pagination']);
        $items = array_map(fn(array $item) => new StatisticDto($item), $response['stats']);

        return new PaginableResponse($response['status'], $items, $pagination);
    }

    /**
     * Get statistics by city.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     *  filter: array{
     *   date_from: string,
     *   date_to: string,
     *   currency?: array<string>,
     *   advertiser?: string|array<string>,
     *   offer?: array<int>,
     *   manager?: string|array<string>,
     *   advertiser_manager_id?: string|array<string>,
     *   partner?: string|array<string>,
     *   country?: string|array<string>,
     *   os?: string|array<string>,
     *   goal?: string|array<string>,
     *   sub1?: string|array<string>,
     *   sub2?: string|array<string>,
     *   sub3?: string|array<string>,
     *   sub4?: string|array<string>,
     *   sub5?: string|array<string>,
     *   sub6?: string|array<string>,
     *   sub7?: string|array<string>,
     *   sub8?: string|array<string>,
     *   device?: string|array<string>,
     *   advertiser_tag?: string,
     *   affiliate_tag?: string,
     *   offer_tag?: string,
     *  },
     *  locale?: string,
     *  timezone?: string,
     *  page?: int,
     *  limit?: int,
     *  orderType?: string,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\PaginableResponse<\Affise\Sdk\Statistics\StatisticDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#by-city
     */
    public function byCity(array $filters): PaginableResponse
    {
        if (empty($filters['filter']['date_from'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_from]' is required");
        }

        if (empty($filters['filter']['date_to'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_to]' is required");
        }

        $response = $this->transport->get('/3.0/stats/getbycities', $filters);

        $pagination = Pagination::createFromArray($response['pagination']);
        $items = array_map(fn(array $item) => new StatisticDto($item), $response['stats']);

        return new PaginableResponse($response['status'], $items, $pagination);
    }

    /**
     * Get statistics by device.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     *  filter: array{
     *   date_from: string,
     *   date_to: string,
     *   currency?: array<string>,
     *   advertiser?: string|array<string>,
     *   offer?: array<int>,
     *   manager?: string|array<string>,
     *   advertiser_manager_id?: string|array<string>,
     *   partner?: string|array<string>,
     *   country?: string|array<string>,
     *   os?: string|array<string>,
     *   goal?: string|array<string>,
     *   sub1?: string|array<string>,
     *   sub2?: string|array<string>,
     *   sub3?: string|array<string>,
     *   sub4?: string|array<string>,
     *   sub5?: string|array<string>,
     *   sub6?: string|array<string>,
     *   sub7?: string|array<string>,
     *   sub8?: string|array<string>,
     *   device?: string|array<string>,
     *   advertiser_tag?: string,
     *   affiliate_tag?: string,
     *   offer_tag?: string,
     *  },
     *  locale?: string,
     *  timezone?: string,
     *  page?: int,
     *  limit?: int,
     *  orderType?: string,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\PaginableResponse<\Affise\Sdk\Statistics\StatisticDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#by-device
     */
    public function byDevice(array $filters): PaginableResponse
    {
        if (empty($filters['filter']['date_from'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_from]' is required");
        }

        if (empty($filters['filter']['date_to'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_to]' is required");
        }

        $response = $this->transport->get('/3.0/stats/getbydevices', $filters);

        $pagination = Pagination::createFromArray($response['pagination']);
        $items = array_map(fn(array $item) => new StatisticDto($item), $response['stats']);

        return new PaginableResponse($response['status'], $items, $pagination);
    }

    /**
     * Get statistics by device model.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     *  filter: array{
     *   date_from: string,
     *   date_to: string,
     *   currency?: array<string>,
     *   advertiser?: string|array<string>,
     *   offer?: array<int>,
     *   manager?: string|array<string>,
     *   advertiser_manager_id?: string|array<string>,
     *   partner?: string|array<string>,
     *   country?: string|array<string>,
     *   os?: string|array<string>,
     *   goal?: string|array<string>,
     *   sub1?: string|array<string>,
     *   sub2?: string|array<string>,
     *   sub3?: string|array<string>,
     *   sub4?: string|array<string>,
     *   sub5?: string|array<string>,
     *   sub6?: string|array<string>,
     *   sub7?: string|array<string>,
     *   sub8?: string|array<string>,
     *   device?: string|array<string>,
     *   advertiser_tag?: string,
     *   affiliate_tag?: string,
     *   offer_tag?: string,
     *  },
     *  locale?: string,
     *  timezone?: string,
     *  page?: int,
     *  limit?: int,
     *  orderType?: string,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\PaginableResponse<\Affise\Sdk\Statistics\StatisticDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#by-device-model
     */
    public function byDeviceModel(array $filters): PaginableResponse
    {
        if (empty($filters['filter']['date_from'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_from]' is required");
        }

        if (empty($filters['filter']['date_to'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_to]' is required");
        }

        $response = $this->transport->get('/3.0/stats/getbydevicemodels', $filters);

        $pagination = Pagination::createFromArray($response['pagination']);
        $items = array_map(fn(array $item) => new StatisticDto($item), $response['stats']);

        return new PaginableResponse($response['status'], $items, $pagination);
    }

    /**
     * Get statistics by referral payments.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     *  date_from: string,
     *  date_to: string,
     *  pid?: int,
     *  ref?: int,
     *  is_paid?: int,
     *  status?: int,
     *  page?: int,
     *  limit?: int,
     *  currency?: int,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\PaginableResponse<\Affise\Sdk\Statistics\ByReferralPaymentsDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#by-referral-payments
     */
    public function byReferralPayments(array $filters): PaginableResponse
    {
        if (empty($filters['date_from'])) {
            throw new InvalidArgumentException("Parameter 'date_from' is required");
        }

        if (empty($filters['date_to'])) {
            throw new InvalidArgumentException("Parameter 'date_to' is required");
        }

        $response = $this->transport->get('/3.0/stats/getreferralpayments', $filters);

        $pagination = Pagination::createFromArray($response['pagination']);
        $items = array_map(fn(array $item) => new ByReferralPaymentsDto($item), $response['ref_payments']);

        return new PaginableResponse($response['status'], $items, $pagination);
    }

    /**
     * Get sub accounts.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     *  sub1?: string,
     *  sub2?: string,
     *  sub3?: string,
     *  sub4?: string,
     *  sub5?: string,
     *  page?: int,
     *  limit?: int,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\PaginableResponse<array<string, string>>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#find-subs
     */
    public function findSubs(array $filters = []): PaginableResponse
    {
        $response = $this->transport->get('/3.0/stats/find-subs', $filters);

        $pagination = Pagination::createFromArray($response['pagination']);

        return new PaginableResponse($response['status'], $response['subs'], $pagination);
    }

    /**
     * Get server postbacks.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     *  date_from: string,
     *  date_to: string,
     *  offer?: array<int>,
     *  partner?: array<int>,
     *  supplier?: array<string>,
     *  action_id?: string,
     *  click_id?: string,
     *  goal?: string,
     *  status?: string,
     *  timezone?: string,
     *  page?: int,
     *  limit?: int,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\PaginableResponse<\Affise\Sdk\Statistics\ByServerPostbackDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#by-server-postback
     */
    public function byServerPostback(array $filters): PaginableResponse
    {
        if (empty($filters['date_from'])) {
            throw new InvalidArgumentException("Parameter 'date_from' is required");
        }

        if (empty($filters['date_to'])) {
            throw new InvalidArgumentException("Parameter 'date_to' is required");
        }

        $response = $this->transport->get('/3.0/stats/serverpostbacks', $filters);

        $pagination = Pagination::createFromArray($response['pagination']);
        $items = array_map(fn(array $item) => new ByServerPostbackDto($item), $response['postbacks']);

        return new PaginableResponse($response['status'], $items, $pagination);
    }

    /**
     * Get partner postbacks.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     *  date_from: string,
     *  date_to: string,
     *  offer?: array<int>,
     *  partner?: array<int>,
     *  goal?: string,
     *  status?: int,
     *  http_code?: int,
     *  timezone?: string,
     *  page?: int,
     *  limit?: int,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\PaginableResponse<\Affise\Sdk\Statistics\ByPartnerPostbackDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#by-partner-postback
     */
    public function byPartnerPostback(array $filters): PaginableResponse
    {
        if (empty($filters['date_from'])) {
            throw new InvalidArgumentException("Parameter 'date_from' is required");
        }

        if (empty($filters['date_to'])) {
            throw new InvalidArgumentException("Parameter 'date_to' is required");
        }

        $response = $this->transport->get('/3.0/stats/affiliatepostbacks', $filters);

        $pagination = Pagination::createFromArray($response['pagination']);
        $items = array_map(fn(array $item) => new ByPartnerPostbackDto($item), $response['postbacks']);

        return new PaginableResponse($response['status'], $items, $pagination);
    }

    /**
     * Get stats by cap.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     *  offer_id: array<int>,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\Response<\Affise\Sdk\Statistics\ByCapDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#by-cap
     */
    public function byCap(array $filters): Response
    {
        if (empty($filters['offer_id'])) {
            throw new InvalidArgumentException("Parameter 'offer_id' is required");
        }

        $response = $this->transport->get('/3.1/stats/caps', $filters);

        return new Response($response['status'], new ByCapDto($response['stats']));
    }

    /**
     * Get statistics by trafficback.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     *  filter: array{
     *   date_from: string,
     *   date_to: string,
     *   advertiser?: string|array<string>,
     *   offer?: array<int>,
     *   partner?: string|array<string>,
     *   country?: string|array<string>,
     *   advertiser_tag?: string,
     *   affiliate_tag?: string,
     *   offer_tag?: string,
     *  },
     *  locale?: string,
     *  timezone?: string,
     *  page?: int,
     *  limit?: int,
     *  orderType?: string,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\PaginableResponse<\Affise\Sdk\Statistics\ByTrafficbackDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#by-trafficback
     */
    public function byTrafficback(array $filters): PaginableResponse
    {
        if (empty($filters['filter']['date_from'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_from]' is required");
        }

        if (empty($filters['filter']['date_to'])) {
            throw new InvalidArgumentException("Parameter 'filter[date_to]' is required");
        }

        $response = $this->transport->get('/3.0/stats/getbytrafficback', $filters);

        $pagination = Pagination::createFromArray($response['pagination']);
        $items = array_map(fn(array $item) => new ByTrafficbackDto($item), $response['stats']);

        return new PaginableResponse($response['status'], $items, $pagination);
    }

    /**
     * Get stats retention rate.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     *  date_from: string,
     *  date_to: string,
     *  offer: int,
     *  base_event: string,
     *  events: array<string>,
     *  affiliate_id?: int,
     *  timezone?: string,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\PaginableResponse<\Affise\Sdk\Statistics\RetentionRateDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#retention-rate
     */
    public function retentionRate(array $filters): PaginableResponse
    {
        if (empty($filters['date_from'])) {
            throw new InvalidArgumentException("Parameter 'date_from' is required");
        }

        if (empty($filters['date_to'])) {
            throw new InvalidArgumentException("Parameter 'date_to' is required");
        }

        if (empty($filters['offer'])) {
            throw new InvalidArgumentException("Parameter 'offer' is required");
        }

        if (empty($filters['base_event'])) {
            throw new InvalidArgumentException("Parameter 'base_event' is required");
        }

        if (empty($filters['events'])) {
            throw new InvalidArgumentException("Parameter 'events' is required");
        }

        $response = $this->transport->get('/3.0/stats/retentionrate', $filters);

        $pagination = Pagination::createFromArray($response['pagination']);
        $items = array_map(fn(array $item) => new RetentionRateDto($item), $response['stats']);

        return new PaginableResponse($response['status'], $items, $pagination);
    }

    /**
     * Get Time to action report.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     *  date_from: string,
     *  date_to: string,
     *  offer_id: int,
     *  timezone?: string,
     *  goal?: string,
     *  affiliate_ids?: int,
     *  page?: int,
     *  limit?: int,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\PaginableResponse<\Affise\Sdk\Statistics\TimeToActionDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#time-to-action
     */
    public function timeToAction(array $filters): PaginableResponse
    {
        if (empty($filters['date_from'])) {
            throw new InvalidArgumentException("Parameter 'date_from' is required");
        }

        if (empty($filters['date_to'])) {
            throw new InvalidArgumentException("Parameter 'date_to' is required");
        }

        if (empty($filters['offer_id'])) {
            throw new InvalidArgumentException("Parameter 'offer_id' is required");
        }

        $response = $this->transport->get('/3.0/stats/time-to-action', $filters);

        $pagination = Pagination::createFromArray($response['pagination']);
        $items = array_map(fn(array $item) => new TimeToActionDto($item), $response['data']);

        return new PaginableResponse($response['status'], $items, $pagination);
    }
}
