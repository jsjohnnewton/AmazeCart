<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class Chartcontroller extends Controller
{
    public function getData()
    {

        $recentOrders = DB::table('orders')
            ->select(DB::raw('DATE(created_at) AS date'), DB::raw('COUNT(*) AS order_count'))
            ->where('created_at', '>=', now()->subDays(30)) // Filter orders within the last 30 days
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date', 'asc') // Order by date in ascending order (most recent date at the end)
            ->get();



        // Query for sales data for the past 6 months
        $salesData = DB::table('orders')
            ->select(DB::raw('MONTHNAME(created_at) AS month'), DB::raw('SUM(price) AS total_sales'))
            ->where('created_at', '>=', Carbon::now()->subMonths(10)) // Filter orders within the last 6 months
            ->groupBy(DB::raw('MONTHNAME(created_at)'))
            ->orderByRaw('created_at ASC') // Order by month in ascending order (most recent month at the end)
            ->get();


        $topSellingProducts = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->select('products.title', DB::raw('SUM(orders.quantity) as total_quantity'))
            ->groupBy('orders.product_id', 'products.title')
            ->orderByDesc('total_quantity')
            ->take(10) // Limit to top 10 products
            ->get();



        // dd($topSellingProducts);
        // Log debug information
        // \Log::info('Recent Orders:', $recentOrders);
        // \Log::info('Sales Data:', $salesData);

        // Return data as JSON
        return response()->json([
            'recentOrders' => $recentOrders,
            'salesData' => $salesData,
            'topSellingProducts' => $topSellingProducts
        ]);
    }
}
