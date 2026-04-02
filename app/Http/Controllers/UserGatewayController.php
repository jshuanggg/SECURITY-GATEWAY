<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;

class UserGatewayController extends Controller
{
    protected $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function index()
    {
        return $this->userService->getUsers();
    }

    public function store(Request $request)
    {
        return $this->userService->createUser($request->all());
    }

    public function show($id)
    {
        return $this->userService->showUser($id);
    }

    public function update(Request $request, $id)
    {
        return $this->userService->updateUser($id, $request->all());
    }

    public function delete($id)
    {
        return $this->userService->deleteUser($id);
    }
}