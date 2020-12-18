<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadFileRequest;
use App\Jobs\ProccessCsvFile;
use App\Repositories\CsvFileRepository;
use Illuminate\Http\JsonResponse;


class CsvFileController extends AuthController
{

    /**
     * Store a newly created resource in storage.
     *
     * @param UploadFileRequest $request
     * @param CsvFileRepository $csvFileRepository
     * @return JsonResponse
     */
    public function store(UploadFileRequest $request, CsvFileRepository $csvFileRepository)
    {
        $csvFile = $csvFileRepository->create($request);

        if ($csvFile) {
            ProccessCsvFile::dispatchAfterResponse($csvFile->csv_file);
            return response()->json(['content' => 'The file have been upload succesfully!'], 201);
        } else {
            return response()->json(['error' => 'The file could not be upload, please try again'], 500);
        }
    }
}
