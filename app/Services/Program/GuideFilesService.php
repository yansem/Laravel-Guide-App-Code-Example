<?php

namespace App\Services\Program;

use App\Models\Chapter;
use App\Models\GuideFiles;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class GuideFilesService
{
    public function store(UploadedFile $file, int $guideId): void
    {
        try {
            $fileExtension = $file->extension();
            $fileName = date('d_m_Y H_i_s') . '.' . $fileExtension;
            $path = $file->storeAs('guides/' . $guideId, $fileName, 'public');
            GuideFiles::create([
                'guide_id' => $guideId,
                'path' => '/storage/' . $path,
                'name' => $fileName
            ]);
        } catch (\Exception $exception) {
            throw new \Exception(__('Error saving the instruction file.'));
        }
    }
}
