<?php

namespace App\Http\Controllers;

use App\Models\CsvFile;
use App\Models\User;
use App\Notifications\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CsvFileController extends AuthController
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),
            [
                'name' => 'required|max:191',
                'csv_file' => 'required|file|max:2048|mimetypes:text/csv,text/plain' // I tried to use mimes:text/csv but doesnt validate correctly
            ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $file = $request->file('csv_file');

        // Get path of the saved file
        $pathToFile = $this->saveFile($file);

        $user = $this->guard()->user();

        $csvFile = new CsvFile([
           'name' => $request->name,
           'user_id' => $user->id,
            'csv_file' => $pathToFile
        ]);

        if ($csvFile->save()) {
            $admin = $this->getAdmin();
            // First row is header.
            $rowCount = $this->getFileRows($file->getPathname());
            $admin->notify(new FileUpload($rowCount));
            return response()->json(['content' => 'File Upload!'], 201);
        } else {
            return response()->json(['error' => 'The file could not be upload, please try again'], 500);
        }
    }


    private function getAdmin() {
        return User::query()->where('role', '=', 1)->first();
    }

    private function saveFile($file) {
        return $file->store('csv_files');
    }

    private function getFileRows($pathName) {
        return count(file($pathName)) - 1;
    }

}
