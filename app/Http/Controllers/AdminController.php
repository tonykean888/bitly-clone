<?php

namespace App\Http\Controllers;

use App\Models\Url;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function dashboard()
    {   
        $totalUrls = Url::count();
        $totalUsers = User::count();
        $recentUrls = Url::with('user')->latest()->take(5)->get();
        
        return view('admin.dashboard', compact('totalUrls', 'totalUsers', 'recentUrls'));
    }
}
