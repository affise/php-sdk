<?php 

declare(strict_types=1);

namespace Affise\Sdk\AdvertiserBilling;

use Affise\Sdk\Helper\AbstractProvider;
use Affise\Sdk\Helper\MessageResponse;
use Affise\Sdk\Helper\PaginableResponse;
use Affise\Sdk\Helper\Pagination;
use Affise\Sdk\Helper\Response;
use InvalidArgumentException;

/**
* Class AdvertiserBillingProvider
*
* Advertiser billing managing (admin methods)
*/
class AdvertiserBillingProvider extends AbstractProvider
{
    /**
    * Get list of invoices.
    *
    * @param array<string, mixed> $filters
    *
    * @psalm-param array{
    *  page?: int,
    *  limit?: int,
    *  status?: string,
    *  start_date?: string,
    *  end_date?: string,
    * } $filters
    *
    * @return \Affise\Sdk\Helper\PaginableResponse<\Affise\Sdk\AdvertiserBilling\InvoiceDto>
    *
    * @throws \Affise\Sdk\Exception\TransportException
    *
    * @see https://api.affise.com/docs3.1/#invoices-list
    */
    public function invoicesList(array $filters = []): PaginableResponse
    {
        $response = $this->transport->get('/3.0/admin/advertiser-invoices', $filters, ['Content-Type' => 'multipart/form-data']);

        $pagination = Pagination::createFromArray($response['pagination']);
        $items = array_map(fn(array $item) => new InvoiceDto($item), $response['message']);

        return new PaginableResponse($response['status'], $items, $pagination);
    }

    /**
     * Get a invoice.
     *
     * @param int $number
     *
     * @return \Affise\Sdk\Helper\Response<\Affise\Sdk\AdvertiserBilling\InvoiceDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#invoices-view
     */
    public function invoicesView(int $number): Response
    {
        $response = $this->transport->get(sprintf('/3.0/admin/advertiser-invoice/%s', $number));

        return new Response($response['status'], new InvoiceDto($response['message']));
    }

    /**
     * Add new invoice.
     *
     * @param array<string, mixed> $data
     * @psalm-param array{
     *  supplier_id: string,
     *  currency: string,
     *  start_date?: string,
     *  end_date?: string,
     *  status?: string,
     *  comment?: string,
     *  detail?: array<array{
     *   offer_id?: int,
     *   payout_type?: string,
     *   actions?: int,
     *   amount?: int,
     *   comment?: string,
     *  }>,
     * } $data
     *
     * @return \Affise\Sdk\Helper\MessageResponse<string>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#add-invoice
     */
    public function addInvoice(array $data): MessageResponse
    {
        if (empty($data['supplier_id'])) {
            throw new InvalidArgumentException("Parameter 'supplier_id' is required");
        }

        if (empty($data['currency'])) {
            throw new InvalidArgumentException("Parameter 'currency' is required");
        }

        $response = $this->transport->post('/3.0/admin/advertiser-invoice', $data);

        return new MessageResponse($response['status'], $response['message']);
    }

    /**
     * Change an invoice’s data.
     *
     * @param string $number
     * @param array<string, mixed> $data
     * @psalm-param array{
     *  supplier_id: string,
     *  currency?: string,
     *  start_date?: string,
     *  end_date?: string,
     *  status?: string,
     *  comment?: string,
     *  detail?: array<array{
     *   offer_id?: int,
     *   payout_type?: string,
     *   actions?: int,
     *   amount?: int,
     *   comment?: string,
     *  }>,
     * } $data
     *
     * @return \Affise\Sdk\Helper\MessageResponse<string>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#edit-invoice
     */
    public function editInvoice(string $number, array $data): MessageResponse
    {
        if (empty($data['supplier_id'])) {
            throw new InvalidArgumentException("Parameter 'supplier_id' is required");
        }

        $response = $this->transport->post(sprintf('/3.0/admin/advertiser-invoice/%s', $number), $data);

        return new MessageResponse($response['status'], $response['message']);
    }
}
