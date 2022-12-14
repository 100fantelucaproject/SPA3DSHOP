<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    //Download selected file
    public function downloadFile(File $file)
    {
    	$filePath = 'public/' . $file->path;
    	$fileName = time().'.glb';

        return Storage::download($filePath, $fileName);
    }
}
