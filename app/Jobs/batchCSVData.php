<?php

namespace App\Jobs;

use App\Models\Student;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class batchCSVData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

    public $header;
    public $data;

    /**

     * Create a new job instance.

     */

    public function __construct($data, $header)
    {

        $this->data = $data;

        $this->header = $header;

    }

    /**

     * Execute the job.

     */

    public function handle(): void
    {

        foreach ($this->data as $batch) {

            
            \Log::info('Job started...');

            $batchInput = array_combine($this->header, $batch);
            Student::create($batchInput);
            
            \Log::info('Job finished successfully!');
        }

    }
}
