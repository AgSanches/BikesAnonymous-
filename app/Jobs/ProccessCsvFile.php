<?php

namespace App\Jobs;

use App\Models\CsvFile;
use App\Notifications\FileUpload;
use App\Repositories\UserRepository;
use App\Services\FileReader;
use App\Services\ProccessPdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProccessCsvFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $csvFilePath;
    private $defaultPath = '../storage/app/';

    /**
     * Create a new job instance.
     *
     * @param $csvFilePath
     */
    public function __construct($csvFilePath)
    {
        $this->csvFilePath = $this->defaultPath . '' . $csvFilePath;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $fileRef = fopen($this->csvFilePath, 'r');

        $pdfProcess = new ProccessPdf();
        $userRepo = new UserRepository();
        $admin = $userRepo->fetchAdmin();

        // Skip header
        fgetcsv($fileRef);

        while (!feof($fileRef)) {
            $pdf = $pdfProcess->generatePdfReport(fgetcsv($fileRef, 0, ';'));
            $admin->notify(new FileUpload($pdf));
        }

        fclose($fileRef);
    }
}
