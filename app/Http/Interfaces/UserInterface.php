<?php
namespace App\Interfaces;

use Illuminate\Http\Request;
use App\Models\User;

interface UserInterface
{

    public function register(Request $request);

    public function list();

    public function show(int $userId);

    public function deleteUser(int $userId);  
    
    public function editBalance(Request $request);

}

?>