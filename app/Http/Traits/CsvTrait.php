<?php
namespace App\Traits;
use Illuminate\Support\Facades\Storage;

trait CsvTrait
{
    /**
    * Export CSV file
    *
    * @param array $rows
    * @param string $fileName
    * @return mixed
    */
    public function convertCsv(array $rows = [],$user_id)
    {
        $path = public_path('movements/');

        $fileName = uniqid().'.csv';
        

        $file = fopen($path.$fileName, 'w');

        if($user_id) {
            fputcsv($file,array('Nome','Thiago'));
            fputcsv($file,array('E-mail','thiagogaldiano@gmail.com'));
            fputcsv($file,array('Data de aniversário','07/01/1986'));
            fputcsv($file,array('',''));
        }

        foreach ($rows as $row) {
            fputcsv($file, $row);
        }
        fclose($file);

        return $fileName;
    }
}