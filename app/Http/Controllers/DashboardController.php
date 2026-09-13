<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('admin.admin');
    }

    public function kasir()
    {
        return view('kasir.kasir');
    }
}