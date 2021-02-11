<?php 

declare(strict_types=1);

namespace Affise\Sdk\Affiliate;

use Affise\Sdk\Helper\AbstractProvider;
use Affise\Sdk\Helper\BaseResponse;
use Affise\Sdk\Helper\IdResponse;
use Affise\Sdk\Helper\MessageResponse;
use Affise\Sdk\Helper\PaginableResponse;
use Affise\Sdk\Helper\Pagination;
use Affise\Sdk\Helper\Response;
use InvalidArgumentException;

/**
* Class AffiliateProvider
*
* Affiliate managing (admin methods)
*/
class AffiliateProvider extends AbstractProvider
{
    /**
    * Get affiliate.
    *
    * @param int $id
    *
    * @return \Affise\Sdk\Helper\IdResponse<\Affise\Sdk\Affiliate\AffiliateDto, int>
    *
    * @throws \Affise\Sdk\Exception\TransportException
    *
    * @see https://api.affise.com/docs3.1/#get-affiliate
    */
    public function getAffiliate(int $id): IdResponse
    {
        $response = $this->transport->get(sprintf('/3.0/admin/partner/%s', $id));

        return new IdResponse($response['status'], new AffiliateDto($response['partner']), $response['id']);
    }

    /**
     * Get list of a partners.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     * id?: array<int>,
     * with_balance?: int,
     * limit?: int,
     * page?: int,
     * updated_at?: string,
     * status_partner?: string,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\PaginableResponse<\Affise\Sdk\Affiliate\AffiliateDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#affiliate-list
     */
    public function affiliateList(array $filters = []): PaginableResponse
    {
        $response = $this->transport->get('/3.0/admin/partners', $filters);

        $pagination = Pagination::createFromArray($response['pagination']);
        $items = array_map(fn(array $item) => new AffiliateDto($item), $response['partners']);

        return new PaginableResponse($response['status'], $items, $pagination);
    }

    /**
     * Add new partner.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     * email: string,
     * country: string,
     * password: string,
     * ref?: int,
     * tipalti_payee_id?: int,
     * notify?: int,
     * sub_account_2_except?: int,
     * sub_account_1_except?: int,
     * sub_account_2?: string,
     * sub_account_1?: string,
     * payment_systems?: array<string>,
     * custom_fields?: array<string>,
     * manager_id?: string,
     * status?: string,
     * notes?: string,
     * ref_percent?: string,
     * contact_person?: string,
     * login?: string,
     * tags?: array<string>,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\IdResponse<\Affise\Sdk\Affiliate\AffiliateDto, int>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#new-affiliate
     */
    public function newAffiliate(array $filters): IdResponse
    {
        if (empty($filters['email'])) {
            throw new InvalidArgumentException("Parameter 'email' is required");
        }

        if (empty($filters['password'])) {
            throw new InvalidArgumentException("Parameter 'password' is required");
        }

        if (empty($filters['country'])) {
            throw new InvalidArgumentException("Parameter 'country' is required");
        }

        $response = $this->transport->post('/3.0/admin/partner', $filters, ['Content-Type' => 'multipart/form-data']);

        return new IdResponse($response['status'], new AffiliateDto($response['partner']), $response['id']);
    }

    /**
     * Edit a partner.
     *
     * @param int $id
     * @param array<string, mixed> $data
     * @psalm-param array{
     * password?: string,
     * custom_fields?: array<string>,
     * tipalti_payee_id?: int,
     * sub_account_2_except?: int,
     * sub_account_1_except?: int,
     * sub_account_2?: string,
     * sub_account_1?: string,
     * ref?: int,
     * payment_systems?: array<string>,
     * login?: string,
     * manager_id?: string,
     * status?: string,
     * notes?: string,
     * ref_percent?: string,
     * contact_person?: string,
     * country?: string,
     * tags?: array<string>,
     * } $data
     *
     * @return \Affise\Sdk\Helper\IdResponse<\Affise\Sdk\Affiliate\AffiliateDto, int>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#edit-affiliate
     */
    public function editAffiliate(int $id, array $data = []): IdResponse
    {
        $response = $this->transport->post(sprintf('/3.0/admin/partner/%s', $id), $data, ['Content-Type' => 'multipart/form-data']);

        return new IdResponse($response['status'], new AffiliateDto($response['partner']), $response['id']);
    }

    /**
     * Update status and manager.
     *
     * @param array<string, mixed> $data
     * @psalm-param array{
     * id: array<int>,
     * manager_id?: string,
     * status?: string,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\BaseResponse
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#mass-update
     */
    public function massUpdate(array $data): BaseResponse
    {
        if (empty($data['id'])) {
            throw new InvalidArgumentException("Parameter 'id' is required");
        }

        $response = $this->transport->post('/3.0/admin/partners/mass-update', $data, ['Content-Type' => 'multipart/form-data']);

        return new BaseResponse($response['status']);
    }

    /**
     * Change a partner’s password.
     *
     * @param int $id
     *
     * @return \Affise\Sdk\Helper\Response<\Affise\Sdk\Affiliate\ChangeAffiliatePasswordDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#change-affiliate-password
     */
    public function changeAffiliatePassword(int $id): Response
    {
        $response = $this->transport->post(sprintf('/3.0/admin/partner/password/%s', $id));

        return new Response($response['status'], new ChangeAffiliatePasswordDto($response['partner']));
    }

    /**
     * Add a partner’s postback.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     * url: string,
     * pid: int,
     * offer_id?: int,
     * status?: string,
     * goal?: string,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\Response<\Affise\Sdk\Affiliate\AddPartnerPostbackDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#add-partner-postback
     */
    public function addPartnerPostback(array $filters): Response
    {
        if (empty($filters['url'])) {
            throw new InvalidArgumentException("Parameter 'url' is required");
        }

        if (empty($filters['pid'])) {
            throw new InvalidArgumentException("Parameter 'pid' is required");
        }

        $response = $this->transport->post('/3.0/partner/postback', $filters, ['Content-Type' => 'application/x-www-form-urlencoded']);

        return new Response($response['status'], new AddPartnerPostbackDto($response['postback']));
    }

    /**
     * Edit a partner’s postback.
     *
     * @param int $id
     * @param array<string, mixed> $data
     * @psalm-param array{
     * url: string,
     * status?: string,
     * goal?: string,
     * } $data
     *
     * @return \Affise\Sdk\Helper\Response<\Affise\Sdk\Affiliate\EditPartnerPostbackDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#edit-partner-postback
     */
    public function editPartnerPostback(int $id, array $data): Response
    {
        if (empty($data['url'])) {
            throw new InvalidArgumentException("Parameter 'url' is required");
        }

        $response = $this->transport->post(sprintf('/3.0/partner/postback/%s', $id), $data, ['Content-Type' => 'application/x-www-form-urlencoded']);

        return new Response($response['status'], new EditPartnerPostbackDto($response['postback']));
    }

    /**
     * Delete a partner’s postback.
     *
     * @param int $id
     *
     * @return \Affise\Sdk\Helper\Response<\Affise\Sdk\Affiliate\DeletePartnerPostbackDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#delete-partner-postback
     */
    public function deletePartnerPostback(int $id): Response
    {
        $response = $this->transport->delete(sprintf('/3.0/partner/postback/%s/remove', $id));

        return new Response($response['status'], new DeletePartnerPostbackDto($response['postback']));
    }

    /**
     * Delete partners postbacks by affiliates ids.
     *
     * @param array<string, mixed> $data
     * @psalm-param array{
     * ids?: array<int>,
     * } $filters
     *
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#delete-partners-postbacks-by-affiliates-ids
     */
    public function deletePartnersPostbacksByAffiliatesIds(array $data = []): void
    {
        $this->transport->delete('/3.0/partner/postbacks/by-affiliates', $data);
    }

    /**
     * Delete partners postbacks by offers ids.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     * ids?: array<int>,
     * } $filters
     *
     * @return void
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#delete-partners-postbacks-by-offers-ids
     */
    public function deletePartnersPostbacksByOffersIds(array $filters = []): void
    {
        $this->transport->delete('/3.0/partner/postbacks/by-offers', $filters);
    }

    /**
     * Get a list of partner postbacks.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     * partner_id: int,
     * limit?: int,
     * page?: int,
     * } $filters
     *
     * @return \Affise\Sdk\Helper\PaginableResponse<\Affise\Sdk\Affiliate\AffiliatePostbacksListDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#affiliate-postbacks-list
     */
    public function affiliatePostbacksList(array $filters): PaginableResponse
    {
        if (empty($filters['partner_id'])) {
            throw new InvalidArgumentException("Parameter 'partner_id' is required");
        }

        $response = $this->transport->get('/3.0/admin/postbacks', $filters);

        $pagination = Pagination::createFromArray($response['pagination']);
        $items = array_map(fn(array $item) => new AffiliatePostbacksListDto($item), $response['postbacks']);

        return new PaginableResponse($response['status'], $items, $pagination);
    }

    /**
     * Change partner api key.
     *
     * @return \Affise\Sdk\Helper\Response<\Affise\Sdk\Affiliate\ChangePartnerApiKeyDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#change-partner-api-key
     */
    public function changePartnerApiKey(): Response
    {
        $response = $this->transport->post('/3.1/partner/api_key');

        return new Response($response['status'], new ChangePartnerApiKeyDto($response['user']));
    }

    /**
     * Update a partner’s locale.
     *
     * @param int $id
     * @param array<string, mixed> $data
     * @psalm-param array{
     * lang?: string,
     * timezone?: string,
     * } $data
     *
     * @return \Affise\Sdk\Helper\MessageResponse<array<string>>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#update-partner-locale
     */
    public function updatePartnerLocale(int $id, array $data = []): MessageResponse
    {
        $response = $this->transport->post(sprintf('/3.0/admin/partner/%s/locale', $id), $data, ['Content-Type' => 'multipart/form-data']);

        return new MessageResponse($response['status'], $response['message']);
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
     */
    public function getReferrals(int $id): PaginableResponse
    {
        $response = $this->transport->get(sprintf('/3.0/admin/partner/%s/referrals', $id));

        $pagination = Pagination::createFromArray($response['pagination']);
        $items = array_map(fn(array $item) => new AffiliateDto($item), $response['referrals']);

        return new PaginableResponse($response['status'], $items, $pagination);
    }
}
