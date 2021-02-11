<?php 

declare(strict_types=1);

namespace Affise\Sdk\Presets;

use Affise\Sdk\Helper\AbstractProvider;
use Affise\Sdk\Helper\BaseResponse;
use Affise\Sdk\Helper\Response;
use InvalidArgumentException;

/**
* Class PresetsProvider
*
* Presets (admin methods)
*/
class PresetsProvider extends AbstractProvider
{
    /**
    * Get presets list.
    *
    * @param array<string, mixed> $filters
    * @psalm-param array{
    *  page?: int,
    *  limit?: int,
    * } $filters
    *
    * @return \Affise\Sdk\Helper\Response<array<\Affise\Sdk\Presets\PresetDto>>
    *
    * @throws \Affise\Sdk\Exception\TransportException
    *
    * @see https://api.affise.com/docs3.1/#get-list-of-presets
    */
    public function getListOfPresets(array $filters = []): Response
    {
        $response = $this->transport->get('/3.1/presets', $filters);

        $items = array_map(fn(array $item) => new PresetDto($item), $response['presets']);

        return new Response($response['status'], $items);
    }

    /**
     * Create preset using JSON dataset.
     *
     * @param array<string, mixed> $data
     * @psalm-param array{
     *  name: string,
     *  permissions: array{
     *   automation: array<string, array<string, string>>,
     *   general: array<string, array<string, string>>,
     *   notificator: array<string, array<string, string>>,
     *   stats: array<string, array<string, mixed>>,
     *   users: array<string, array<string, mixed>>,
     *  },
     *  type: string,
     * } $data
     *
     * @return \Affise\Sdk\Helper\Response<\Affise\Sdk\Presets\PresetDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#create-preset
     */
    public function createPreset(array $data): Response
    {
        if (empty($data['name'])) {
            throw new InvalidArgumentException("Parameter 'name' is required");
        }

        /** @psalm-suppress DocblockTypeContradiction */
        if (empty($data['permissions'])) {
            throw new InvalidArgumentException("Parameter 'permissions' is required");
        }

        if (empty($data['type'])) {
            throw new InvalidArgumentException("Parameter 'type' is required");
        }

        $response = $this->transport->post('/3.1/presets', $data);

        return new Response($response['status'], new PresetDto($response['preset']));
    }

    /**
     * Update preset using JSON dataset.
     *
     * @param string $id
     * @param array<string, mixed> $data
     * @psalm-param array{
     *  name?: string,
     *  permissions?: array{
     *   automation?: array<string, array<string, string>>,
     *   general?: array<string, array<string, string>>,
     *   notificator?: array<string, array<string, string>>,
     *   stats?: array<string, array<string, mixed>>,
     *   users?: array<string, array<string, mixed>>,
     *  },
     * } $data
     *
     * @return \Affise\Sdk\Helper\Response<\Affise\Sdk\Presets\PresetDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#update-preset
     */
    public function updatePreset(string $id, array $data): Response
    {
        $response = $this->transport->post(sprintf('/3.1/presets/%s', $id), $data);

        return new Response($response['status'], new PresetDto($response['preset']));
    }

    /**
     * Delete preset by id.
     *
     * @param string $id
     *
     * @return \Affise\Sdk\Helper\BaseResponse
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#delete-preset
     */
    public function deletePreset(string $id): BaseResponse
    {
        $response = $this->transport->delete(sprintf('/3.1/presets/%s', $id));

        return new BaseResponse($response['status']);
    }
}
