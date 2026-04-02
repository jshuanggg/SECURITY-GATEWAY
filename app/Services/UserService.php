<?php

namespace App\Services;

// This must match the filename and namespace in app/Traits/ConsumesExternalService.php
use App\Traits\ConsumesExternalService;

class UserService
{
    use ConsumesExternalService;

    /**
     * The base uri to consume the User1 Service
     * @var string
     */
    public $baseUri;

    /**
     * The secret to consume the User1 Service
     * @var string
     */
    public $secret;

    public function __construct()
    {
        // These pull directly from the .env file you shared earlier
        $this->baseUri = env('USERS1_SERVICE_BASE_URL');
        $this->secret = env('USERS1_SERVICE_SECRET');
    }

    public function getUsers()
    {
        return $this->performRequest('GET', '/users');
    }

    public function createUser($data)
    {
        return $this->performRequest('POST', '/users', $data);
    }

    public function showUser($id)
    {
        return $this->performRequest('GET', "/users/{$id}");
    }

    public function updateUser($id, $data)
    {
        return $this->performRequest('PUT', "/users/{$id}", $data);
    }

    public function deleteUser($id)
    {
        return $this->performRequest('DELETE', "/users/{$id}");
    }
}