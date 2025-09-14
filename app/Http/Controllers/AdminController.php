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

    public function urls()
    {
        $urls = Url::with('user')->latest()->paginate(15);
        return view('admin.urls.index', compact('urls'));
    }

    public function editUrl(Url $url)
    {
        return view('admin.urls.edit', compact('url'));
    }
    
    public function updateUrl(Request $request, Url $url)
    {
        $request->validate([
            'full_url' => 'required|url|max:2048',
            'title' => 'nullable|string|max:255',
        ]);

        $url->update($request->only('full_url', 'title'));

        return redirect()->route('admin.urls')->with('success', 'URL updated successfully.');
    }

    public function deleteUrl(Url $url)
    {
        $url->delete();
        return redirect()->route('admin.urls')->with('success', 'URL deleted successfully.');
    }

    public function users()
    {
        $users = User::latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function deleteUser(User $user)
    {
        if (auth()->id() === $user->id) {
            return redirect()->route('admin.users')->with('error', 'You cannot delete your own account.');
        }

        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }
}
