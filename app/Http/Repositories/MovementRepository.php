<?php
namespace App\Repositories;

use App\Models\Movement;
use App\Models\Report;
use App\Models\User;
use App\Interfaces\MovementInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\CsvTrait;
use Carbon\Carbon;

class MovementRepository implements MovementInterface
{
    use CsvTrait;

    protected $movement;
    
    public function __construct(Movement $movement)
    {
        $this->movement = $movement;
    }

    public function register(Request $request)
    {

        $user = $this->movement->register($request);

        return response()->json([
            'message' => 'Movimentação do usuário criada com sucesso!',
        ], 200);

    }  

    public function listMovementUser($userId)
    {
        return $this->movement
                    ->join('users','users.id','=','movements.user_id')
                    ->join('movement_types','movement_types.id','=','movements.movement_type_id')
                    ->where('user_id','=',$userId)
                    ->paginate(30);
    }

    public function list()
    {
        return $this->movement
                    ->join('users','users.id','=','movements.user_id')
                    ->join('movement_types','movement_types.id','=','movements.movement_type_id')
                    ->paginate(30);
    }

    public function exportCsv(Request $request)
    {
        $movement = $this->movement;
        if($request->user_id) {
            $movement = $movement->select(array('movement_types.type', 'movements.value', 'movements.created_at'));
        } else {
            $movement = $movement->select(array('users.id','users.name','users.email', 'users.birthday', 'movement_types.type', 'movements.value', 'movements.created_at'));
        }        
        $movement = $movement->join('users','users.id','=','movements.user_id');
        $movement = $movement->join('movement_types','movement_types.id','=','movements.movement_type_id');
        
        if($request->user_id) {
            $movement = $movement->where('user_id','=',$request->user_id);
        }        

        if($request->filter == 1) {
            $movement = $movement->whereDate('movements.created_at', '>', Carbon::now()->subDays(30));
        } else if($request->filter == 2) {
            if($request->year AND $request->month) {
                $movement = $movement->whereYear('movements.created_at', '=', $request->year);
                $movement = $movement->whereMonth('movements.created_at', '=', $request->month);
            }            
        } 

        $movement = $movement->get();

        $total_balance = $this->totalBalance($request->user_id);

        $csv_report = $this->convertCsv($movement->toArray(),$request->user_id,$total_balance);

        $report = new Report;
        $report->archive = $csv_report;
        $report->user_id = $request->user_id;
        $report->save();

        return url('/movements/'.$csv_report);

    }

    public function totalBalance($userId)
    {
        $balance = User::find($userId)->balance;

        $totalCredit = $this->movement
                            ->where('user_id','=',$userId)
                            ->where('movement_type_id','=',1)
                            ->sum('value');

        $totalDebit = $this->movement
                           ->where('user_id','=',$userId)
                           ->where('movement_type_id','=',2)
                           ->sum('value');

        $totalReversal = $this->movement
                              ->where('user_id','=',$userId)
                              ->where('movement_type_id','=',3)
                              ->sum('value');

        return $balance + $totalCredit - $totalDebit - $totalReversal;
    }

}
?>