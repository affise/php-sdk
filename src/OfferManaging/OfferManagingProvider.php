<?php 

declare(strict_types=1);

namespace Affise\Sdk\OfferManaging;

use Affise\Sdk\Helper\AbstractProvider;
use Affise\Sdk\Helper\CountableResponse;
use Affise\Sdk\Helper\IdResponse;
use Affise\Sdk\Helper\MessageResponse;
use Affise\Sdk\Helper\RemovableResponse;
use Affise\Sdk\Helper\Response;
use InvalidArgumentException;

/**
* Class OfferManagingProvider
*
* Offer managing (admin methods)
*/
class OfferManagingProvider extends AbstractProvider
{
    /**
    * Get count of offers in status ‘active’ .
    *
    *
    * @return \Affise\Sdk\Helper\CountableResponse
    *
    * @throws \Affise\Sdk\Exception\TransportException
    *
    * @see https://api.affise.com/docs3.1/#count-of-active-offers
    */
    public function countOfActiveOffers(): CountableResponse
    {
        $response = $this->transport->get('/3.0/offers/count');

        return new CountableResponse($response['status'], $response['count']);
    }

    /**
     * Add new offer.
     *
     * @param array<string, mixed> $data
     *
     * @psalm-param array{
     * title: string,
     * advertiser: string,
     * url: string,
     * smartlink_categories?: array<string>,
     * allowed_ip?: string,
     * allow_deeplink?: int,
     * hide_referer?: int,
     * redirect_type?: string,
     * start_at?: string,
     * send_emails?: int,
     * is_redirect_overcap?: int,
     * hide_payments?: int,
     * click_session?: string,
     * minimal_click_session?: string,
     * sub_account_1?: string,
     * sub_account_2?: string,
     * sub_account_1_except?: int,
     * sub_account_2_except?: int,
     * kpi?: array<string>,
     * impressions_url?: string,
     * note_sales?: string,
     * allow_impressions?: int,
     * targeting?: array{
     *  country?: array{allow?: array<string>, deny?: array<string>},
     *  region?: array{allow?: array<string, int>, deny?: array<string, int>},
     *  city?: array{allow?: array<string, int>, deny?: array<string, int>},
     *  os?: array{allow: array<array<string, string>>},
     *  isp?: array{allow?: array<string, array<string>>},
     *  ip?: array{allow?: array<string>, deny?: array<string>},
     *  device_type?: array<string>,
     *  browser?: array{allow?: array<string>, deny?: array<string>},
     *  brand?: array{allow?: array<string>, deny?: array<string>},
     *  sub?: array{
     *   allow?: array<string, array<string>>,
     *   deny?: array<string, array<string>>,
     *   deny_groups?: array<array<string, string>>,
     *  },
     *  connection?: array<string>,
     *  block_proxy?: bool,
     *  affiliate_id?: array<int>,
     *  url?: string,
     *  urls?: array<array<string, mixed>>,
     * },
     * caps_goal_overcap?: string,
     * search_empty_sub?: int,
     * hide_caps?: int,
     * disallowed_ip?: string,
     * note_aff?: string,
     * notes?: string,
     * bundle_id?: string,
     * external_offer_id?: string,
     * restriction_isp?: array<string>,
     * strictly_isp?: array<string>,
     * rejectNotUniqIp?: int,
     * uniqIpOnly?: int,
     * sub_restrictions?: array<array<string, string>>,
     * hold_period?: int,
     * categories?: array<string>,
     * privacy?: string,
     * cross_postback_url?: string,
     * macro_url?: string,
     * url_preview?: string,
     * trafficback_url?: string,
     * domain_url?: int,
     * description_lang?: array<string>,
     * stopDate?: string,
     * creativeFiles?: array<\Affise\Sdk\Transport\FileInterface>,
     * creativeUrls?: array<string>,
     * creativeDownloads?: array<string>,
     * sources?: array<string>,
     * logo?: string,
     * status?: string,
     * tags?: array<string>,
     * is_top?: int,
     * enabled_commission_tiers?: int,
     * restriction_os?: array<string>,
     * commission_tiers?: array{
     *  timeframe?: string,
     *  type?: string,
     *  value?: int|float,
     *  modifier_value?: float,
     *  modifier_type?: float,
     *  goals?: array<string>,
     *  target_goals?: array<string>,
     *  affiliate_type?: array<string>,
     *  affiliates?: array<int>,
     *  modifier_payment_type?: array<int>,
     *  conversion_status?: array<string>,
     * },
     * caps_timezone?: string,
     * caps_status?: array<string>,
     * strictly_brands?: array<string>,
     * caps?: array{
     *  period?: string,
     *  type?: string,
     *  value?: int|float,
     *  goals?: array<string>,
     *  goal_type?: string,
     *  affiliates?: array<int>,
     *  affiliate_type?: string,
     *  country?: array<string>,
     *  country_type?: string,
     * },
     * strictly_devices?: array<string>,
     * strictly_os?: array<string>,
     * is_cpi?: int,
     * strictly_connection_type?: string,
     * strictly_country?: int,
     * landings?: array<string>,
     * notice_percent_overcap?: int,
     * partner_payments?: array<string>,
     * payments?: array<string>,
     * consider_personal_targeting_only?: string,
     * } $data
     *
     * @return \Affise\Sdk\Helper\IdResponse<\Affise\Sdk\OfferManaging\AddOfferDto, int>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#add-offer
     */
    public function addOffer(array $data): IdResponse
    {
        if (empty($data['title'])) {
            throw new InvalidArgumentException("Parameter 'title' is required");
        }

        if (empty($data['advertiser'])) {
            throw new InvalidArgumentException("Parameter 'advertiser' is required");
        }

        if (empty($data['url'])) {
            throw new InvalidArgumentException("Parameter 'url' is required");
        }

        $response = $this->transport->post(
            '/3.0/admin/offer',
            $data,
            ['Content-Type' => 'application/x-www-form-urlencoded']
        );

        return new IdResponse($response['status'], new AddOfferDto($response['offer']), $response['id']);
    }

    /**
     * Change an offer settings.
     *
     * @param int $id
     * @param array<string, mixed> $data
     * @psalm-param array{
     * title: string,
     * advertiser: string,
     * url: string,
     * smartlink_categories?: array<string>,
     * allowed_ip?: string,
     * allow_deeplink?: int,
     * hide_referer?: int,
     * redirect_type?: string,
     * start_at?: string,
     * send_emails?: int,
     * is_redirect_overcap?: int,
     * hide_payments?: int,
     * click_session?: string,
     * minimal_click_session?: string,
     * sub_account_1?: string,
     * sub_account_2?: string,
     * sub_account_1_except?: int,
     * sub_account_2_except?: int,
     * kpi?: array<string>,
     * impressions_url?: string,
     * note_sales?: string,
     * allow_impressions?: int,
     * targeting?: array{
     *  country?: array{allow?: array<string>, deny?: array<string>},
     *  region?: array{allow?: array<string, int>, deny?: array<string, int>},
     *  city?: array{allow?: array<string, int>, deny?: array<string, int>},
     *  os?: array{allow: array<array<string, string>>},
     *  isp?: array{allow?: array<string, array<string>>},
     *  ip?: array{allow?: array<string>, deny?: array<string>},
     *  device_type?: array<string>,
     *  browser?: array{allow?: array<string>, deny?: array<string>},
     *  brand?: array{allow?: array<string>, deny?: array<string>},
     *  sub?: array{
     *   allow?: array<string, array<string>>,
     *   deny?: array<string, array<string>>,
     *   deny_groups?: array<array<string, string>>,
     *  },
     *  connection?: array<string>,
     *  block_proxy?: bool,
     *  affiliate_id?: array<int>,
     *  url?: string,
     *  urls?: array<array<string, mixed>>,
     * },
     * caps_goal_overcap?: string,
     * search_empty_sub?: int,
     * hide_caps?: int,
     * disallowed_ip?: string,
     * note_aff?: string,
     * notes?: string,
     * bundle_id?: string,
     * external_offer_id?: string,
     * restriction_isp?: array<string>,
     * strictly_isp?: array<string>,
     * rejectNotUniqIp?: int,
     * uniqIpOnly?: int,
     * sub_restrictions?: array<array<string, string>>,
     * hold_period?: int,
     * categories?: array<string>,
     * privacy?: string,
     * cross_postback_url?: string,
     * macro_url?: string,
     * url_preview?: string,
     * trafficback_url?: string,
     * domain_url?: int,
     * description_lang?: array<string>,
     * stopDate?: string,
     * creativeFiles?: array<\Affise\Sdk\Transport\FileInterface>,
     * creativeUrls?: array<string>,
     * creativeDownloads?: array<string>,
     * sources?: array<string>,
     * logo?: string,
     * status?: string,
     * tags?: array<string>,
     * is_top?: int,
     * enabled_commission_tiers?: int,
     * restriction_os?: array<string>,
     * commission_tiers?: array{
     *  timeframe?: string,
     *  type?: string,
     *  value?: int|float,
     *  modifier_value?: float,
     *  modifier_type?: float,
     *  goals?: array<string>,
     *  target_goals?: array<string>,
     *  affiliate_type?: array<string>,
     *  affiliates?: array<int>,
     *  modifier_payment_type?: array<int>,
     *  conversion_status?: array<string>,
     * },
     * caps_timezone?: string,
     * caps_status?: array<string>,
     * strictly_brands?: array<string>,
     * caps?: array{
     *  period?: string,
     *  type?: string,
     *  value?: int|float,
     *  goals?: array<string>,
     *  goal_type?: string,
     *  affiliates?: array<int>,
     *  affiliate_type?: string,
     *  country?: array<string>,
     *  country_type?: string,
     * },
     * strictly_devices?: array<string>,
     * strictly_os?: array<string>,
     * is_cpi?: int,
     * strictly_connection_type?: string,
     * strictly_country?: int,
     * landings?: array<string>,
     * notice_percent_overcap?: int,
     * partner_payments?: array<string>,
     * payments?: array<string>,
     * consider_personal_targeting_only?: string,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\IdResponse
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#edit-offer
     */
    public function editOffer(int $id, array $data = []): IdResponse
    {
        $response = $this->transport->post(
            sprintf('/3.0/admin/offer/%s', $id),
            $data,
            ['Content-Type' => 'application/x-www-form-urlencoded']
        );

        return new IdResponse($response['status'], new EditOfferDto($response['offer']), $response['id']);
    }

    /**
     * Delete the offer.
     *
     * @param array<string, mixed> $data
     * @psalm-param array{
     *  offer_id: array<int>
     * } $data
     *
     * @return \Affise\Sdk\Helper\MessageResponse<string>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#delete-offer
     */
    public function deleteOffer(array $data): MessageResponse
    {
        if (empty($data['offer_id'])) {
            throw new InvalidArgumentException("Parameter 'offer_id' is required");
        }

        $response = $this->transport->post('/3.0/admin/offer/delete', $data, ['Content-Type' => 'application/x-www-form-urlencoded']);

        return new MessageResponse($response['status'], $response['message']);
    }

    /**
     * Get list of sources.
     *
     * @return \Affise\Sdk\Helper\Response<array<\Affise\Sdk\OfferManaging\SourcesDto>>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#sources
     */
    public function sources(): Response
    {
        $response = $this->transport->get('/3.0/admin/offer/sources');
        $items = array_map(fn(array $item) => new SourcesDto($item), $response['sources']);

        return new Response($response['status'], $items);
    }

    /**
     * Get list of sources.
     *
     * @param array<string, mixed> $data
     * @psalm-param array{
     *  title_lang: array<string, string>,
     * } $data
     *
     * @return \Affise\Sdk\Helper\Response<\Affise\Sdk\OfferManaging\SourceAddDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#source-add
     */
    public function sourceAdd(array $data): Response
    {
        if (empty($data['title_lang'])) {
            throw new InvalidArgumentException("Parameter 'title_lang' is required");
        }

        $response = $this->transport->post('/3.0/admin/offer/source', $data, ['Content-Type' => 'application/x-www-form-urlencoded']);

        return new Response($response['status'], new SourceAddDto($response['source']));
    }

    /**
     * Get list of sources.
     *
     * @param string $id
     * @param array<string, mixed> $data
     * @psalm-param array{
     *  title_lang: array<string, string>,
     * } $data
     *
     * @return \Affise\Sdk\Helper\Response<\Affise\Sdk\OfferManaging\SourceEditDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#source-edit
     */
    public function sourceEdit(string $id, array $data): Response
    {
        if (empty($data['title_lang'])) {
            throw new InvalidArgumentException("Parameter 'title_lang' is required");
        }

        $response = $this->transport->post(sprintf('/3.0/admin/offer/source/%s', $id), $data, ['Content-Type' => 'application/x-www-form-urlencoded']);

        return new Response($response['status'], new SourceEditDto($response['source']));
    }

    /**
     * Get list of sources.
     *
     * @param string $id
     *
     * @return \Affise\Sdk\Helper\Response<\Affise\Sdk\OfferManaging\SourceRemoveDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#source-remove
     */
    public function sourceRemove(string $id): Response
    {
        $response = $this->transport->delete(sprintf('/3.0/admin/offer/source/%s', $id));

        return new Response($response['status'], new SourceRemoveDto($response['source']));
    }

    /**
     * Add new category.
     *
     * @param array<string, mixed> $data
     * @psalm-param array{
     *  title: string,
     * } $data
     *
     * @return \Affise\Sdk\Helper\Response<\Affise\Sdk\OfferManaging\CategoryAddDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#category-add
     */
    public function categoryAdd(array $data): Response
    {
        if (empty($data['title'])) {
            throw new InvalidArgumentException("Parameter 'title' is required");
        }

        $response = $this->transport->post('/3.0/admin/category', $data, ['Content-Type' => 'application/x-www-form-urlencoded']);

        return new Response($response['status'], new CategoryAddDto($response['category']));
    }

    /**
     * Change a category.
     *
     * @param string $id
     * @param array<string, mixed> $data
     * @psalm-param array{
     *  title: string,
     * } $data
     *
     * @return \Affise\Sdk\Helper\Response<\Affise\Sdk\OfferManaging\CategoryEditDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#category-edit
     */
    public function categoryEdit(string $id, array $data): Response
    {
        if (empty($data['title'])) {
            throw new InvalidArgumentException("Parameter 'title' is required");
        }

        $response = $this->transport->post(sprintf('/3.0/admin/category/%s', $id), $data, ['Content-Type' => 'application/x-www-form-urlencoded']);

        return new Response($response['status'], new CategoryEditDto($response['category']));
    }

    /**
     * Сonnection an affiliate to offer.
     *
     * @param array<string, mixed> $data
     * @psalm-param array{
     *  offer_id: int|array<int>,
     *  pid: int,
     *  notice?: int,
     * } $data
     *
     * @return \Affise\Sdk\Helper\MessageResponse<string>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#enable-affiliate
     */
    public function enableAffiliate(array $data): MessageResponse
    {
        if (empty($data['offer_id'])) {
            throw new InvalidArgumentException("Parameter 'offer_id' is required");
        }

        if (empty($data['pid'])) {
            throw new InvalidArgumentException("Parameter 'pid' is required");
        }

        $response = $this->transport->post('/3.0/offer/enable-affiliate', $data, ['Content-Type' => 'application/x-www-form-urlencoded']);

        return new MessageResponse($response['status'], $response['message']);
    }

    /**
     * Disconnect an affiliate from offer.
     *
     * @param array<string, mixed> $data
     * @psalm-param array{
     *  offer_id: int|array<int>,
     *  pid: int,
     *  notice?: int,
     * } $data
     *
     * @return \Affise\Sdk\Helper\MessageResponse<string>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#disable-affiliate
     */
    public function disableAffiliate(array $data): MessageResponse
    {
        if (empty($data['offer_id'])) {
            throw new InvalidArgumentException("Parameter 'offer_id' is required");
        }

        if (empty($data['pid'])) {
            throw new InvalidArgumentException("Parameter 'pid' is required");
        }

        $response = $this->transport->post('/3.0/offer/disable-affiliate', $data, ['Content-Type' => 'application/x-www-form-urlencoded']);

        return new MessageResponse($response['status'], $response['message']);
    }

    /**
     * Update offers status.
     *
     * @param array<string, mixed> $data
     * @psalm-param array{
     * offer_id: array<int>,
     * status?: string,
     * privacy?: string,
     * } $data
     *
     * @return \Affise\Sdk\Helper\MessageResponse<string>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#update-offer-s-status
     */
    public function updateOfferStatus(array $data): MessageResponse
    {
        if (empty($data['offer_id'])) {
            throw new InvalidArgumentException("Parameter 'offer_id' is required");
        }

        $response = $this->transport->post('/3.0/admin/offer/mass-update', $data, ['Content-Type' => 'multipart/form-data']);

        return new MessageResponse($response['status'], $response['message']);
    }

    /**
     * Disconnect all affiliates from private or protected offer.
     *
     * @param string $id
     *
     * @return \Affise\Sdk\Helper\MessageResponse<string>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#disable-affiliates
     */
    public function disableAffiliates(string $id): MessageResponse
    {
        $response = $this->transport->post(sprintf('/3.0/admin/offer/%s/disable-affiliates', $id));

        return new MessageResponse($response['status'], $response['message']);
    }

    /**
     * Disconnect all private or protected offers from affiliate.
     *
     * @param string $id
     *
     * @return \Affise\Sdk\Helper\MessageResponse<string>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#disable-offers
     */
    public function disableOffers(string $id): MessageResponse
    {
        $response = $this->transport->post(sprintf('/3.0/admin/affiliate/%s/disable-offers', $id));

        return new MessageResponse($response['status'], $response['message']);
    }

    /**
     * Remove creative from offer by creative id.
     *
     * @param string $id
     * @param array<string, mixed> $data
     * @psalm-param array{
     *  creatives: array<int>,
     * } $data
     *
     * @return \Affise\Sdk\Helper\RemovableResponse
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#remove-creative-from-offer
     */
    public function removeCreativeFromOffer(string $id, array $data): RemovableResponse
    {
        if (empty($data['creatives'])) {
            throw new InvalidArgumentException("Parameter 'creatives' is required");
        }

        $response = $this->transport->delete(sprintf('/3.0/admin/offer/%s/remove-creative', $id), $data);

        return new RemovableResponse($response['status'], $response['removed']);
    }
}
