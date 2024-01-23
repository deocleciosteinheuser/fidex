<?php

namespace App\Http\Controllers;

use App\View\Components\DashboardNps;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return (new DashboardNps())->render();
    }
}
