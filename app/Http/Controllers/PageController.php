<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PageController extends Controller
{
    public function index()
    {
        return Inertia::render('Pages/Index', [
            'pages' => Page::roots()->withCount('children')->get()
        ]);
    }

    public function create()
    {
        return Inertia::render('Pages/Create', [
            'pages' => Page::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'parent_id' => 'nullable|exists:pages,id',
            'slug' => 'required|string|max:255',
            'title' => 'required|string|max:255',
        ]);

        Page::create($validated);

        return Redirect::route('pages.index')
            ->with('success', 'Page created successfully.');
    }

    public function edit(Page $page)
    {
        return Inertia::render('Pages/Edit', [
            'page' => $page,
            'pages' => Page::where('id', '!=', $page->id)->get(),
        ]);
    }

    public function update(Request $request, Page $page)
    {
        $validated = $request->validate([
            'parent_id' => 'nullable|exists:pages,id',
            'slug' => 'required|string|max:255',
            'title' => 'required|string|max:255',
        ]);

        $page->update($validated);

        return redirect()->route('pages.index')
            ->with('success', 'Page updated successfully.');
    }

    public function destroy(Page $page)
    {
        $page->delete();

        return redirect()->route('pages.index')
            ->with('success', 'Page deleted successfully.');
    }

    public function show(Request $request)
    {
        $path = '/' . trim($request->path(), '/');
        $page = Page::where('path', $path)->with(['children'])->withCount('children')->get();

        if ($page->isEmpty()) {
            abort(404);
        }

        return Inertia::render('Pages/Index', [
            'pages' => $page,
        ]);
    }
}
