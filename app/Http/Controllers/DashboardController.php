<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->roles->pluck('name')[0] == 'member') {
            return redirect('/frontend');
        }
        return view('pages.dashboard.index');
    }
}
