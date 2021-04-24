<?php
namespace App\Interfaces;

use Illuminate\Http\Request;
use App\Models\Movement;

interface MovementInterface
{

    public function register(Request $request);

    public function listMovementUser(int $userId);

    public function list();

    public function exportCsv(Request $request);

}

?>