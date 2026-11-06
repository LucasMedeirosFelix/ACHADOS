<?php

namespace App\Http\Controllers;

use App\Models\FoundItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class FoundItemController extends Controller
{
    public function index(): View
    {
        return view('found-items.index', [
            'items' => FoundItem::query()->latest('found_at')->latest()->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'description' => ['required', 'string', 'max:2000'],
            'found_at' => ['required', 'date', 'before_or_equal:today'],
            'location' => ['nullable', 'string', 'max:160'],
            'photo' => ['required', 'image', 'mimes:jpeg,png,webp', 'max:5120'],
        ]);

        $validated['image_path'] = $request->file('photo')->store('found-items', 'public');
        unset($validated['photo']);

        FoundItem::create($validated);

        return to_route('found-items.index')->with('success', 'Item cadastrado com sucesso.');
    }

    public function destroy(FoundItem $item): RedirectResponse
    {
        $imagePath = $item->image_path;

        $item->delete();
        Storage::disk('public')->delete($imagePath);

        return to_route('found-items.index')->with('success', 'Item excluído com sucesso.');
    }
}
