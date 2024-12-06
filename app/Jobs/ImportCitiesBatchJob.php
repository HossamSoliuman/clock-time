<?php
namespace App\Jobs;

use App\Imports\CitiesImport; // Make sure this points to your CitiesImport class
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportCitiesBatchJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $batchData;

    public function __construct(array $batchData)
    {
        $this->batchData = $batchData;
    }

    public function handle()
    {
        foreach ($this->batchData as $row) {
            // Call your existing import logic here
            (new CitiesImport)->model($row);
        }
    }
}

