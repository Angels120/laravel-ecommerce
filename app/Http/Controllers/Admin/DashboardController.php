<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $breadcrumb = [

            'breadcrumbs' => [
                'current_menu' => 'Dashboard',
            ],

        ];
        return view('admin.dashboard.dashboard',compact('breadcrumb'));
    }
}
