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
        $existingEmails = [];
        $newRecords = [];

        foreach ($this->data as $batch) {
            $batchInput = array_combine($this->header, $batch);

            // Check if the email already exists
            $existingData = Student::where('email', $batchInput['email'])
                ->exists();

            if ($existingData) {
                $existingEmails[] = $batchInput['email'];
            } else {
                try {
                    Student::create($batchInput);
                    $newRecords[] = $batchInput['email'];
                } catch (\Exception $e) {
                    \Log::error('Error creating record: ', [
                        'error' => $e->getMessage(),
                        'data' => $batchInput,
                    ]);
                }
            }
        }

        \Cache::put('existing_emails', $duplicateData, now()->addMinutes(1));

        // \Log::info('Import Summary', [
        //     'existing' => $duplicateData,
        //     'new' => $newRecords,
        // ]);
    }
}
