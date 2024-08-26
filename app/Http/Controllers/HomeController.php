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
