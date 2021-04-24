<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Movement;
use Illuminate\Http\Request;
use App\Http\Requests\PostMovementRequest;
use App\Http\Requests\PostReportRequest;

use App\Interfaces\MovementInterface;

class MovementController extends Controller
{

    protected $movement;

    public function __construct(MovementInterface $movement)
    {
        $this->movement = $movement;
    }

    //Novo movimento na conta de um usuário
    public function register(PostMovementRequest $request)
    {
        return $this->movement->register($request);
    }

    public function listMovementUser($userId)
    {
        return $this->movement->listMovementUser($userId);
    }

    public function index()
    {
        return $this->movement->list();
    }

    public function exportCsv(PostReportRequest $request)
    {
        return $this->movement->exportCsv($request);
    }

    public function totalBalance($userId)
    {
        return $this->movement->totalBalance($userId);
    }

}
