<?php

namespace App\Http\Controllers\Apps;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class WarehouseController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // Get current date
        $today = Carbon::now()->format('Y-m-d');

        // Get stock movements for the last 7 days
        $stock_movements_week = DB::table('stock_movements')
            ->addSelect(DB::raw('DATE(created_at) as date, SUM(quantity) as total_quantity'))
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->get();

        if (count($stock_movements_week)) {
            foreach ($stock_movements_week as $result) {
                $movement_date[] = $result->date;
                $total_quantity[] = (int)$result->total_quantity;
            }
        } else {
            $movement_date[] = "";
            $total_quantity[] = "";
        }

        // Count products with low stock (e.g., less than or equal to 10)
        $low_stock_products = Product::where('stock', '<=', 10)->get();

        // Get the latest stock movements
        $latest_stock_movements = StockMovement::with('product')
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->get();

        return Inertia::render('Apps/Warehouse/Index', [
            'movement_date'          => $movement_date,
            'total_quantity'         => $total_quantity,
            'low_stock_products'     => $low_stock_products,
            'latest_stock_movements' => $latest_stock_movements,
        ]);
    }
}