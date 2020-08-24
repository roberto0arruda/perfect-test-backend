<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SaleResource;
use App\Sale;

class DashboardController extends Controller
{
    public function index()
    {
        $sales = SaleResource::collection(Sale::all());

        foreach ($sales as $sale) {
            $grouped = $sales->where('status', $sale['status']);
            $results[$sale['status']] = [
                'quantity' => $grouped->count(),
                'total' => number_format($grouped->sum('product.price') - $grouped->sum('discount'), 2)
            ];
        }

        return $results;
    }
}
