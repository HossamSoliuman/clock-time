<?php
namespace App\Jobs;

use App\Imports\GmtsImport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportGmtsBatchJob implements ShouldQueue
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
            (new GmtsImport)->model($row);
        }
    }
}

