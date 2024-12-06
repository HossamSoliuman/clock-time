<?php
//
//namespace App\Jobs;
//
//use Maatwebsite\Excel\Facades\Excel;
//use App\Imports\CitiesImport; // Import your CitiesImport class
//use Illuminate\Bus\Queueable;
//use Illuminate\Contracts\Queue\ShouldQueue;
//use Illuminate\Foundation\Bus\Dispatchable;
//use Illuminate\Queue\InteractsWithQueue;
//use Illuminate\Queue\SerializesModels;
//
//class ImportCitiesJob implements ShouldQueue
//{
//    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
//
//    protected $filePath;
//
//    public function __construct($filePath)
//    {
//        $this->filePath = $filePath;
//    }
//
//    public function handle()
//    {
//        try {
//            \Log::error('file: ' . storage_path('app/private/' . $this->filePath));
//            // Import the data using the CitiesImport class
//            Excel::import(new CitiesImport, storage_path('app/private/' . $this->filePath));
//        } catch (\Exception $e) {
//            \Log::error('Error importing data: ' . $e->getMessage());
//        }
//    }
//}


namespace App\Jobs;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CitiesImport; // Import your CitiesImport class
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportRelationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filePath;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    public function handle()
    {
        try {
            $fullPath = storage_path('app/private/' . $this->filePath);
            \Log::info('Importing from file: ' . $fullPath);

            // Load the spreadsheet
            $spreadsheet = IOFactory::load($fullPath);
            $worksheet = $spreadsheet->getActiveSheet();
            $highestRow = $worksheet->getHighestRow();
            $dataIteration=[];

            $batchSize = 100;
            for ($row = 2; $row <= $highestRow; $row += $batchSize) {
                // Get the current batch
                $data = [];
                for ($i = 0; $i < $batchSize && ($row + $i) <= $highestRow; $i++) {
                    $data[] = [
                        'zone' => $worksheet->getCell("A" . ($row + $i))->getValue(),
                        'code' => $worksheet->getCell("B" . ($row + $i))->getValue(),
                        'abb' => $worksheet->getCell("C" . ($row + $i))->getValue(),
                        'gmt' => $worksheet->getCell("D" . ($row + $i))->getValue(),
                        'dst' => $worksheet->getCell("E" . ($row + $i))->getValue(),
                    ];
                }

                $dataIteration[] = $data;
                // Dispatch a new job for this batch

            }
            for($i = 0; $i < count($dataIteration); $i++){
                ImportRelationsBatchJob::dispatch($dataIteration[$i]);
            }

        } catch (\Exception $e) {
            \Log::error('Error importing data: ' . $e->getMessage());
        }
    }
}
