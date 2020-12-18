<?php


namespace App\Services;


class FileManageService
{
    public function saveFileToPath($file) {
        return $file->store('csv_files');
    }
}
