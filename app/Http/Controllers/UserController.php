<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\PostUserRequest;
use App\Http\Requests\PostEditBalanceRequest;

use App\Interfaces\UserInterface;

class UserController extends Controller
{

    protected $user;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    //Cadastrar usuário
    public function register(PostUserRequest $request)
    {
        return $this->user->register($request);
    }

    public function index()
    {
        return $this->user->list();
    }

    public function show($userId)
    {
        return $this->user->show($userId);
    }

    public function deleteUser($userId)
    {
        return $this->user->deleteUser($userId);
    }

    public function editBalance(PostEditBalanceRequest $request)
    {
        return $this->user->editBalance($request);
    }
}
