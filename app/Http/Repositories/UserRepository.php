<?php
namespace App\Repositories;

use App\Models\User;
use App\Interfaces\UserInterface;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class UserRepository implements UserInterface
{
    protected $user;
    protected $page;
    
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->page = 1;
    }

    public function register(Request $request)
    {

        $user = $this->user->register($request);

        return response()->json([
            'message' => 'Usuário cadastrado com sucesso!',
        ], 200);

    }   
    
    public function list()
    {
        return $this->user->paginate(30);
    }

    public function show($userId)
    {
        return $this->user->find($userId);
    }

    public function deleteUser($userId)
    {

        try {
            
            $del = $this->user->deleteUser($userId);;

            return response()->json([
                'message' => 'Usuário excluído com sucesso!',
            ], 200);

        } catch (\Throwable $th) {

            return response()->json([
                'message' => 'Erro ao excluír o usuário!',
            ], 500);

        }
        
    }    

}
?>