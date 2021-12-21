<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\WapRequest;
use App\Models\Template;
use App\MyApp;

class DashboardController extends Controller
{
    //admin dashboard
    public function index()
    {
        return view('admin.dashboard');
    }


    //user dashboard
    public function userDashboard(Request $req)
    {
        return view('/dashboard');
    }
}
