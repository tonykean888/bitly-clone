<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Url;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreUrlRequest;

class UrlController extends Controller
{
    public function index()
    {
        $urls = Url::where('user_id', Auth::id())
                ->orderBy('id', 'desc')
                ->paginate(10);
        return view('urls.index', compact('urls'));
    }

    public function create()
    {
        return view('urls.create');
    }

    public function store(StoreUrlRequest $request)
    {
        DB::transaction(function () use ($request) {
            $validated = $request->validated();

            $url = Url::create([
                'full_url' => $validated['full_url'],
                'user_id' => Auth::id(),
                'title' => $validated['title']??null,
            ]);

            $shortKey = base64_encode($url->id);
            $url->update(['short_key' => $shortKey]);
        });

        return Redirect::route('urls.index')->with('success', 'URL shortened successfully!');
        
    }

    public function redirect($shortKey)
    {   
        $id = base64_decode($shortKey);

        $url = Url::find($id);

        if (!$url) {
            return redirect()->route('404');
        }

        return redirect($url->full_url);
    }

    public function edit(Url $url)
    {
        if ($url->user_id !== Auth::id()) {
            return redirect()->route('urls.index')->with('error', 'Unauthorized action.');
        }

        return view('urls.edit', compact('url'));
    }

    public function update(StoreUrlRequest $request, Url $url)
    {
        if ($url->user_id !== Auth::id()) {
            return redirect()->route('urls.index')->with('error', 'Unauthorized action.');
        }

        // $request->validate([
        //     'full_url' => 'required|url|max:2048',
        //     'title' => 'nullable|string|max:255',
        // ]);
        $validated = $request->validated();
                
        $url->update([
            'full_url' => $validated['full_url'],
            'title' => $validated['title'],
        ]);

        return redirect()->route('urls.index')->with('success', 'URL updated successfully.');
    }

    public function destroy(Url $url)
    {
        if ($url->user_id !== Auth::id()) {
            return redirect()->route('urls.index')->with('error', 'Unauthorized action.');
        }

        $url->delete();

        return redirect()->route('urls.index')->with('success', 'URL deleted successfully.');
    }
}
