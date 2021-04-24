<?php
namespace App\Traits;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

trait CsvTrait
{
    /**
    * Export CSV file
    *
    * @param array $rows
    * @param string $fileName
    * @return mixed
    */
    public function convertCsv(array $rows = [],$user_id,$total_balance)
    {
        $path = public_path('movements/');

        $fileName = uniqid().'.csv';
        
        if($rows){
            $keys = array_keys($rows[0]);     
        }else{
            $keys = array();
        }

        $file = fopen($path.$fileName, 'w');

        if($user_id) {
            $user = User::find($user_id);
            fputcsv($file,array('Nome',$user->name));
            fputcsv($file,array('E-mail',$user->email));
            fputcsv($file,array('Data de aniversário',$user->birthday));
            fputcsv($file,array('Saldo inicial',$user->balance));
            fputcsv($file,array('Saldo atual',$total_balance));
            fputcsv($file,array('',''));
        }    
        
        fputcsv($file,$keys);

        foreach ($rows as $row) {
            fputcsv($file, $row);
        }
        fclose($file);

        return $fileName;
    }
}