<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;


class DashboardController extends Controller
{
    public function index()
    {
        $breadcrumb = [

            'breadcrumbs' => [
                'current_menu' => 'Dashboard',
            ],

        ];
        $totalOrders = Order::where('status', '!=', 'cancelled')->count();
        $totalProducts = Product::count();
        $totalCustomers = Role::where('id', 3)->count();
        $user = Auth::user();
        $totalRevenue=Order::where('status','!=','cancelled')->sum('grand_total');
        //This month revenue
        $startOfMonth=Carbon::now()->startOfMonth()->format('Y-m-d');
        $currentDate=Carbon::now()->format('Y-m-d');
        $revenueThisMonth=Order::where('status','!=','cancelled')
        ->whereDate('created_at','>=',$startOfMonth)
        ->whereDate('created_at','>=',$currentDate)
        ->sum('grand_total');

        //Last month revenue
        $lastMonthStartDate=Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
        $lastMonthEndDate=Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');
        $revenueLastMonth=Order::where('status','!=','cancelled')
        ->whereDate('created_at','>=',$lastMonthStartDate)
        ->whereDate('created_at','>=',$lastMonthEndDate)
        ->sum('grand_total');

        return view('admin.dashboard.dashboard', compact('breadcrumb', 'user','totalOrders','totalCustomers','totalProducts','totalRevenue','revenueLastMonth','revenueThisMonth'));
    }
}
