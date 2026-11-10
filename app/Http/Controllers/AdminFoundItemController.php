<?php

namespace App\Http\Controllers;

use App\Models\FoundItem;
use App\Models\ItemRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AdminFoundItemController extends Controller
{
    public function index(): View
    {
        return view('found-items.admin.index', [
            'items' => FoundItem::query()
                ->with(['itemRequests' => fn ($query) => $query->latest()])
                ->latest('found_at')
                ->latest()
                ->paginate(12),
            'requestCount' => ItemRequest::query()->count(),
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

        return to_route('admin.found-items.index')->with('success', 'Item cadastrado com sucesso.');
    }

    public function edit(FoundItem $item): View
    {
        return view('found-items.admin.edit', ['item' => $item]);
    }

    public function update(Request $request, FoundItem $item): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'description' => ['required', 'string', 'max:2000'],
            'found_at' => ['required', 'date', 'before_or_equal:today'],
            'location' => ['nullable', 'string', 'max:160'],
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,webp', 'max:5120'],
        ]);

        $oldImagePath = $item->image_path;

        if ($request->hasFile('photo')) {
            $validated['image_path'] = $request->file('photo')->store('found-items', 'public');
        }

        unset($validated['photo']);
        $item->update($validated);

        if ($item->image_path !== $oldImagePath) {
            Storage::disk('public')->delete($oldImagePath);
        }

        return to_route('admin.found-items.index')->with('success', 'Item atualizado com sucesso.');
    }

    public function destroy(FoundItem $item): RedirectResponse
    {
        $imagePath = $item->image_path;

        $item->delete();
        Storage::disk('public')->delete($imagePath);

        return to_route('admin.found-items.index')->with('success', 'Item excluído com sucesso.');
    }
}
