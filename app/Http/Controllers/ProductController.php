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

    public function show(Request $request, $id)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        $results = DB::select('CALL spGetProductDetails(?, ?, ?)', [
            $id,
            $startDate,
            $endDate
        ]);

        $productInfo = null;
        $deliveries = [];

        if (!empty($results)) {
            $productInfo = (object)[
                'ProductNaam' => $results[0]->ProductNaam,
                'Allergenen' => $results[0]->Allergenen
            ];
            
            $deliveries = array_map(function($row) {
                return (object)[
                    'DatumLevering' => $row->DatumLevering,
                    'Aantal' => $row->Aantal
                ];
            }, $results);
        }

        return view('product.show', [
            'product' => $productInfo,
            'deliveries' => $deliveries
        ]);
    }
}
