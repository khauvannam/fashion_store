<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;

class BlobService
{

    /**
     * Handle file upload and store it in the public directory.
     *
     * @param UploadedFile $file
     * @param string $directory
     * @return string The URL of the uploaded file.
     */
    public function uploadFile(UploadedFile $file, string $directory = 'uploads'): string
    {
        // Store the file in the public directory
        $filePath = $file->store($directory, 'public');

        // Return the URL of the uploaded file
        return asset("storage/{$filePath}");
    }
}
