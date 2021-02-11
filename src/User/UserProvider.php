<?php

declare(strict_types=1);

namespace Affise\Sdk\User;

use Affise\Sdk\Helper\AbstractProvider;
use Affise\Sdk\Helper\PaginableResponse;
use Affise\Sdk\Helper\Pagination;
use Affise\Sdk\Helper\Response;
use InvalidArgumentException;

/**
 * Class UserProvider
 *
 * User managing (admin methods)
 */
class UserProvider extends AbstractProvider
{
    /**
     * Get a list of users.
     *
     * @param array<string, mixed> $filters
     * @psalm-param array{page?: int, limit?: int, updated_at?:string, q?: string} $filters
     *
     * @return \Affise\Sdk\Helper\PaginableResponse<\Affise\Sdk\User\UserDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#users-list
     */
    public function usersList(array $filters = []): PaginableResponse
    {
        $response = $this->transport->get('/3.0/admin/users', $filters);

        $pagination = Pagination::createFromArray($response['pagination']);
        $items = array_map(fn(array $item) => new UserDto($item), $response['users']);

        return new PaginableResponse($response['status'], $items, $pagination);
    }

    /**
     * Add a new user.
     *
     * @param array<string, mixed> $data
     *
     * @psalm-param array{
     *  email: string,
     *  password: string,
     *  first_name: string,
     *  last_name: string,
     *  roles: array<Role::ROLE_*>,
     *  skype?: string,
     *  work_hours?:string,
     *  avatar?: string
     * } $data
     *
     * @return \Affise\Sdk\Helper\Response<\Affise\Sdk\User\UserDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#add-user
     */
    public function addUser(array $data): Response
    {
        if (empty($data['email'])) {
            throw new InvalidArgumentException("Parameter 'email' is required");
        }

        if (empty($data['password'])) {
            throw new InvalidArgumentException("Parameter 'password' is required");
        }

        if (empty($data['first_name'])) {
            throw new InvalidArgumentException("Parameter 'first_name' is required");
        }

        if (empty($data['last_name'])) {
            throw new InvalidArgumentException("Parameter 'last_name' is required");
        }

        if (empty($data['roles'])) {
            throw new InvalidArgumentException("Parameter 'roles' is required");
        }

        $response = $this->transport->post('/3.0/admin/user', $data);

        return new Response($response['status'], new UserDto($response['user']));
    }

    /**
     * Change the user.
     *
     * @param string $id
     * @param array<string, mixed> $data
     * @psalm-param array{
     *  email?: string,
     *  password?: string,
     *  first_name?: string,
     *  last_name?: string,
     *  roles?: array<Role::ROLE_*>,
     *  skype?: string,
     *  work_hours?:string,
     *  type?:UserDto::TYPE_*,
     *  avatar?: string
     * } $data
     *
     * @return \Affise\Sdk\Helper\Response<\Affise\Sdk\User\UserDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#edit-user
     */
    public function editUser(string $id, array $data): Response
    {
        $response = $this->transport->post('/3.0/admin/user/' . $id, $data);

        return new Response($response['status'], new UserDto($response['user']));
    }

    /**
     * Change user api key.
     *
     * @param string $id
     *
     * @return \Affise\Sdk\Helper\Response<\Affise\Sdk\User\ChangeUserApiKeyDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#change-user-api-key
     */
    public function changeUserApiKey(string $id): Response
    {
        $response = $this->transport->post('/3.0/admin/user/api_key/' . $id);

        return new Response($response['status'], new ChangeUserApiKeyDto($response['user']));
    }

    /**
     * Change user password.
     *
     * @param string $id
     * @param array<string, mixed> $data
     *
     * @return \Affise\Sdk\Helper\Response<\Affise\Sdk\User\ChangeUserPasswordDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     * @see https://api.affise.com/docs3.1/#change-user-password
     */
    public function changeUserPassword(string $id, array $data): Response
    {
        if (empty($data['password'])) {
            throw new InvalidArgumentException("Parameter 'password' is required");
        }

        $response = $this->transport->post(sprintf('/3.0/admin/user/%s/password', $id), $data);

        return new Response($response['status'], new ChangeUserPasswordDto($response['user']));
    }

    /**
     * Update user permissions.
     *
     * @param string $id
     * @param array<string, mixed> $data
     * @psalm-param array{
     *  permissions: array{
     *   automation: array<string, array<string, string>>,
     *   general: array<string, array<string, string>>,
     *   notificator: array<string, array<string, string>>,
     *   stats: array<string, array<string, mixed>>,
     *   users: array<string, array<string, mixed>>,
     *  }
     * } $data
     *
     * @return \Affise\Sdk\Helper\Response<\Affise\Sdk\User\UpdateUserPermissionsDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#update-user-permissions
     */
    public function updateUserPermissions(string $id, array $data): Response
    {
        /** @psalm-suppress DocblockTypeContradiction */
        if (empty($data['permissions'])) {
            throw new InvalidArgumentException("Parameter 'permissions' is required");
        }

        $response = $this->transport->post(sprintf('/3.1/user/%s/permissions', $id), $data);

        return new Response($response['status'], new UpdateUserPermissionsDto($response['permissions']));
    }

    /**
     * Read single user.
     *
     * @param string $id
     *
     * @return \Affise\Sdk\Helper\Response<\Affise\Sdk\User\ReadUserDto>
     *
     * @throws \Affise\Sdk\Exception\TransportException
     *
     * @see https://api.affise.com/docs3.1/#read-user
     */
    public function readUser(string $id): Response
    {
        $response = $this->transport->get('/3.0/admin/user/' . $id);

        return new Response($response['status'], new ReadUserDto($response['user']));
    }
}
