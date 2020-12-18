<?php
namespace App\Repositories;

use App\Models\CsvFile;
use App\Services\FileManageService;

class CsvFileRepository implements BaseRepository
{

    private $userRepository;
    private $fileManageRepository;

    /**
     * CsvFileRepository constructor.
     * @param UserRepository $userRepository
     * @param FileManageService $fileManageRepository
     */
    public function __construct(UserRepository $userRepository, FileManageService $fileManageRepository)
    {
        $this->userRepository = $userRepository;
        $this->fileManageRepository = $fileManageRepository;
    }

    public function create($csvData)
    {
        $file = $csvData->file('csv_file');
        $pathToFile = $this->fileManageRepository->saveFileToPath($file);

        $csvFile = new CsvFile([
            'name' => $csvData->name,
            'user_id' => $this->userRepository->getAuthenticatedUser()->id,
            'csv_file' => $pathToFile
        ]);

        return $csvFile->save() ? $csvFile : null;
    }
}
