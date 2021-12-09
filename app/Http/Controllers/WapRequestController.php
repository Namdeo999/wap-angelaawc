<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\WapRequest;
use App\MyApp;

class WapRequestController extends Controller
{
    public function index()
    {
        return view('wap_request');
    }
}
