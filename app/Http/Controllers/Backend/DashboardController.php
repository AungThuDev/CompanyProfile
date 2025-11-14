<?php 

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{ 
    /**
     * Create a new controller instance.
     */

    /**
     * Show the dashboard.
     */
    public function index()
    { 
        return view('dashboard.index');
    }
}