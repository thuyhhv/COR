<?php

namespace App\Traits;

trait CsvTrait
{
    /**
    * Export CSV file
    *
    * @param array $rows
    * @param string $fileName
    * @return mixed
    */
    public function exportCsv(array $rows = [], string $filename = 'csvExport.csv')
    {
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=" . $filename,
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $callback = function () use ($rows) {
            $file = fopen('php://output', 'w');
            foreach ($rows as $row) {
                fputcsv($file, $row);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}