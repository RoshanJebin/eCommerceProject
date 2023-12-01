<?php

namespace App\Traits;

trait FileUploadTrait
{
    /* File Upload */
    public function uploadFile($file, $folder)
    {
        $fileNameWithExtension = $file->getClientOriginalName();
        $fileName = pathinfo($fileNameWithExtension, PATHINFO_FILENAME);
        $fileExtension = $file->getClientOriginalExtension();
        $database_path = $fileName . '-' . time() . '.' . $fileExtension;

        $path = public_path('/storage/images/'.$folder);
        $file->move($path, $database_path);

        # return file name
        return $database_path;
    }
}
