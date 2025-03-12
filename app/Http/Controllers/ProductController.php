<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        
        $products = DB::select('CALL spLeverancierProductTotals(?, ?)', [
            $startDate ?? null,
            $endDate ?? null
        ]);
        
        return view('product.index', ['products' => $products]);
    }
}
