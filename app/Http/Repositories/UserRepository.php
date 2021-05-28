<?php
namespace App\Repositories;

use App\Models\User;
use App\Models\Movement;
use App\Interfaces\UserInterface;
use App\Http\Resources\UserResource;

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
        return UserResource::collection($this->user->paginate(30));
    }

    public function show($userId)
    {
        return new UserResource($this->user->find($userId));
    }

    public function deleteUser($userId)
    {

        try {
            $moviments = Movement::where('user_id',$userId)->count();

            if($moviments > 0){

                return response()->json([
                    'message' => 'Este usuário não pode ser excluído por possuir movimentação!',
                ], 400);

            } else {

                $del = $this->user->deleteUser($userId);
                return response()->json([
                    'message' => 'Usuário excluído com sucesso!',
                ], 200);

            }

        } catch (\Throwable $th) {

            return response()->json([
                'message' => 'Erro ao excluír o usuário!',
            ], 500);

        }

    }

    public function editBalance(Request $request)
    {
        $user = $this->user->editBalance($request);

        return response()->json([
            'message' => 'Saldo inicial alterado com sucesso!',
        ], 200);
    }

}
?>
