<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard with dynamic data.
     */
    public function index()
    {
        // Stats Cards Data
        // *** MUKHYA SUDHARO AHIYA CHHE ***
        // Have, 'Cancelled' sivay na badha j orders revenue ma ganashe.
        $totalRevenue = Order::where('status', '!=', 'Cancelled')->sum('total');
        $totalOrders = Order::count();
        $totalCustomers = User::where('role', '!=', 'user')->count();
        $pendingOrders = Order::where('status', 'Pending')->count();

        // Recent Orders Table Data
        $recentOrders = Order::with('user')->latest()->take(5)->get();

        // Sales Overview Chart Data (Last 7 Days)
        // *** MUKHYA SUDHARO AHIYA CHHE ***
        // Chart pan have 'Cancelled' sivay na badha j orders no data batavshe.
        $salesData = Order::where('status', '!=', 'Cancelled')
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('SUM(total) as revenue'))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
            
        $salesChartLabels = $salesData->pluck('date')->map(fn($date) => Carbon::parse($date)->format('M d'));
        $salesChartData = $salesData->pluck('revenue');

        // Order Status Chart Data
        $orderStatusData = Order::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status');

        $orderStatusChartLabels = $orderStatusData->keys();
        $orderStatusChartData = $orderStatusData->values();

        return view('admin.dashboard', compact(
            'totalRevenue',
            'totalOrders',
            'totalCustomers',
            'pendingOrders',
            'recentOrders',
            'salesChartLabels',
            'salesChartData',
            'orderStatusChartLabels',
            'orderStatusChartData'
        ));
    }
}

