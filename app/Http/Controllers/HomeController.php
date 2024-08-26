<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);
        Excel::import(new ProductsImport, $request->file('file'));
        return back()->with('success', 'Products imported successfully.');
    }
}
