<?php

namespace App\Http\Controllers\WEB\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{ /**
     * 📋 عرض لوحة التحكم
     */
   public function index()
    {
        return view('admin.auth.dashboard');
    }
}
