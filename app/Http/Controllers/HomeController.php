<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductsImport;

class HomeController extends Controller
{
    public function __construct()
    {

    }

    public function welcome()
    {
        return view('welcome');
    }

    public function import(Request $request)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_FILES['file'])) {
                $fileError = $_FILES['file']['error'];
                switch ($fileError) {
                    case UPLOAD_ERR_OK:
                        dd('File uploaded successfully!');
                        echo 'File uploaded successfully!';
                        break;
                    case UPLOAD_ERR_INI_SIZE:
                        dd('The uploaded file exceeds the upload_max_filesize directive in php.ini.');
                        echo 'The uploaded file exceeds the upload_max_filesize directive in php.ini.';
                        break;
                    case UPLOAD_ERR_FORM_SIZE:
                        dd('The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.');
                        echo 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.';
                        break;
                    case UPLOAD_ERR_PARTIAL:
                        dd('The uploaded file was only partially uploaded.');
                        echo 'The uploaded file was only partially uploaded.';
                        break;
                    case UPLOAD_ERR_NO_FILE:
                        dd('No file was uploaded.');
                        echo 'No file was uploaded.';
                        break;
                    case UPLOAD_ERR_NO_TMP_DIR:
                        dd('Missing a temporary folder.');
                        echo 'Missing a temporary folder.';
                        break;
                    case UPLOAD_ERR_CANT_WRITE:
                        dd('Failed to write file to disk.');
                        echo 'Failed to write file to disk.';
                        break;
                    case UPLOAD_ERR_EXTENSION:
                        dd('A PHP extension stopped the file upload.');
                        echo 'A PHP extension stopped the file upload.';
                        break;
                    default:
                        dd('Unknown upload error.');
                        echo 'Unknown upload error.';
                        break;
                }
            } else {
                dd('No file uploaded.');
                echo 'No file uploaded.';
            }
        }

        try {
            $request->validate([
                'file' => 'required|mimes:xlsx',
            ]);
            Excel::import(new ProductsImport, $request->file('file'));
            return back()->with('success', 'Products imported successfully.');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return false;
        }
    }
}
