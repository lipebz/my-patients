<?php

namespace App\Jobs;

use App\Http\Controllers\ImportacaoController;
use App\Models\Importacao;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportCsvJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private $importacao)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        (new ImportacaoController)->importarCsv($this->importacao);
        
        
    }

    
}
