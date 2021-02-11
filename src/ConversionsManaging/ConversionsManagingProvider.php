<?php 

declare(strict_types=1);

namespace Affise\Sdk\ConversionsManaging;

use Affise\Sdk\Helper\AbstractProvider;
use Affise\Sdk\Helper\ResponseWithMessage;
use InvalidArgumentException;

/**
* Class ConversionsManagingProvider
*
* Conversions managing
*/
class ConversionsManagingProvider extends AbstractProvider
{
    /**
    * Edit a conversion.
    *
    * @param array<string, mixed> $data
    * @psalm-param array{
    *  ids: array<string>,
    *  status?: string,
    *  currency?: string,
    *  payouts?: int,
    *  revenue?: int,
    *  comment?: string,
    * } $data
    *
    * @return \Affise\Sdk\Helper\ResponseWithMessage<\Affise\Sdk\ConversionsManaging\EditConversionDto>
    *
    * @throws \Affise\Sdk\Exception\TransportException
    *
    * @see https://api.affise.com/docs3.1/#edit-conversion
    */
    public function editConversion(array $data): ResponseWithMessage
    {
        if (empty($data['ids'])) {
            throw new InvalidArgumentException("Parameter 'ids' is required");
        }

        $response = $this->transport->post('/3.0/admin/conversion/edit', $data, ['Content-Type' => 'application/x-www-form-urlencoded']);

        return new ResponseWithMessage($response['status'], new EditConversionDto($response['data']), $response['message']);
    }

    /**
     * Import a single conversion.
     *
     * @param array<string, mixed> $data
     * @psalm-param array{
     *  offer: int,
     *  pid: int,
     *  custom_field_6?: string,
     *  custom_field_5?: string,
     *  custom_field_4?: string,
     *  custom_field_3?: string,
     *  custom_field_2?: string,
     *  custom_field_1?: string,
     *  sum?: int,
     *  status?: string,
     *  comment?: string,
     *  ua?: string,
     *  ip?: string,
     *  goal?: int,
     *  click_id?: string,
     *  action_id?: string,
     *  custom_field_7?: string,
     * } $data
     *
     * @return \Affise\Sdk\Helper\ResponseWithMessage<\Affise\Sdk\ConversionsManaging\ConversionDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#import-single-conversion
     */
    public function importSingleConversion(array $data): ResponseWithMessage
    {
        if (empty($data['offer'])) {
            throw new InvalidArgumentException("Parameter 'offer' is required");
        }

        if (empty($data['pid'])) {
            throw new InvalidArgumentException("Parameter 'pid' is required");
        }

        $response = $this->transport->post('/3.0/admin/conversion/import', $data, ['Content-Type' => 'application/x-www-form-urlencoded']);

        return new ResponseWithMessage($response['status'], new ConversionDto($response['data']), $response['message']);
    }

    /**
     * Import multiple conversions.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{
     *  list: array<array{
     *   offer: int,
     *   pid: int,
     *   custom_field_6?: string,
     *   custom_field_5?: string,
     *   custom_field_4?: string,
     *   custom_field_3?: string,
     *   custom_field_2?: string,
     *   custom_field_1?: string,
     *   sum?: int,
     *   status?: string,
     *   comment?: string,
     *   ua?: string,
     *   ip?: string,
     *   goal?: int,
     *   click_id?: string,
     *   action_id?: string,
     *   custom_field_7?: string,
     *  }>
     * } $filters
     *
     * @return \Affise\Sdk\Helper\ResponseWithMessage<\Affise\Sdk\ConversionsManaging\ImportMultipleConversionsDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#import-multiple-conversions
     */
    public function importMultipleConversions(array $filters): ResponseWithMessage
    {
        if (empty($filters['list'])) {
            throw new InvalidArgumentException("Parameter 'list' is required");
        }

        $response = $this->transport->post('/3.0/admin/conversions/import', $filters, ['Content-Type' => 'application/x-www-form-urlencoded']);

        return new ResponseWithMessage($response['status'], new ImportMultipleConversionsDto($response['data']), $response['message']);
    }
}
