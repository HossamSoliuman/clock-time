<?php
namespace App\Jobs;


use App\Imports\RelationsImport;
use App\Imports\ZonesImport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportRelationsBatchJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $batchData;

    public function __construct(array $batchData)
    {
        $this->batchData = $batchData;
    }

    public function handle()
    {
        \Log::info('ImportRelationsBatchJob: Done');
        foreach ($this->batchData as $row) {
            // Call your existing import logic here
            (new RelationsImport)->model($row);
        }
    }
}

