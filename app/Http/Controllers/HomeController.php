<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use DB;

class HomeController extends Controller
{
    public function __construct()
    {

    }

    public function welcome(Request $request)
    {
        if ($request->ajax()) {
            $products = Product::paginate(10);
            return view('product-detail', compact('products'))->render();
        }

        $products = Product::paginate(10);

        return view('welcome', compact('products'));
    }

    public function import(Request $request)
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $chunkSize = 1000;
        if ($data) {
            DB::transaction(function () use ($data, $chunkSize) {
                foreach (array_chunk($data, $chunkSize) as $chunk) {
                    Product::insert($chunk);
                }
            });
        }

        return back()->with('success', 'Products imported successfully.');
    }
}
