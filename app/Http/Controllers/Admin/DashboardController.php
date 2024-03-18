<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
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
        $totalRevenue=Order::where('status','!=','cancelled')->sum('grand_total');
        $totalCustomers = Role::where('id', 3)->count();

        $user = Auth::user();
        return view('admin.dashboard.dashboard', compact('breadcrumb', 'user','totalOrders','totalCustomers','totalProducts','totalRevenue'));
    }
}
