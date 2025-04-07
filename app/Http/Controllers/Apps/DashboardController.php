<?php

namespace App\Http\Controllers\Apps;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
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
            ->addSelect(DB::raw('DATE(created_at) as date, SUM(quantity) as total_quantity, SUM(CASE WHEN movement_type = "in" THEN quantity ELSE 0 END) as total_in, SUM(CASE WHEN movement_type = "out" THEN quantity ELSE 0 END) as total_out'))
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->get();

        $movement_date = [];
        $total_quantity = [];
        $total_in = [];
        $total_out = [];

        if (count($stock_movements_week)) {
            foreach ($stock_movements_week as $result) {
                $movement_date[] = $result->date;
                $total_quantity[] = (int)$result->total_quantity;
                $total_in[] = (int)$result->total_in;
                $total_out[] = (int)$result->total_out;
            }
        }

        // Count products with low stock (e.g., less than or equal to 0)
        $low_stock_products = Product::where('quantity', '<=', 0)->get(); // Barang habis

        // Get the latest stock movements
        $latest_stock_movements = StockMovement::with('product')
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->get();

        // Get log activity (last 5 activities)
        $activity_log = StockMovement::with('product')
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->get();

        // Filter data based on request
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $filtered_stock_movements_week = []; // Variabel baru untuk menyimpan hasil filter

        if ($startDate && $endDate) {
            // Pastikan format tanggal sesuai
            $startDate = Carbon::parse($startDate)->startOfDay();
            $endDate = Carbon::parse($endDate)->endOfDay();

            $filtered_stock_movements_week = DB::table('stock_movements')
                ->addSelect(DB::raw('DATE(created_at) as date, SUM(quantity) as total_quantity, SUM(CASE WHEN movement_type = "in" THEN quantity ELSE 0 END) as total_in, SUM(CASE WHEN movement_type = "out" THEN quantity ELSE 0 END) as total_out'))
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy('date')
                ->get();
        }

        // Jika ada hasil filter, gunakan itu, jika tidak, gunakan hasil sebelumnya
        if (count($filtered_stock_movements_week)) {
            foreach ($filtered_stock_movements_week as $result) {
                $movement_date[] = $result->date;
                $total_quantity[] = (int)$result->total_quantity;
                $total_in[] = (int)$result->total_in;
                $total_out[] = (int)$result->total_out;
            }
        }

        return Inertia::render('Apps/Dashboard/Index', [
            'movement_date'          => $movement_date,
            'total_quantity'         => $total_quantity,
            'total_in'              => $total_in,
            'total_out'             => $total_out,
            'low_stock_products'     => $low_stock_products,
            'latest_stock_movements' => $latest_stock_movements,
            'activity_log'          => $activity_log,
        ]);
    }
}