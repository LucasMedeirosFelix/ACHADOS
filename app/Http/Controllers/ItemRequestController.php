<?php

namespace App\Http\Controllers;

use App\Models\FoundItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ItemRequestController extends Controller
{
    public function store(Request $request, FoundItem $item): RedirectResponse
    {
        $validated = $request->validate([
            'student_name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:255'],
            'contact_number' => ['required', 'string', 'max:30'],
            'message' => ['required', 'string', 'max:1500'],
        ]);

        $item->itemRequests()->create($validated);

        return to_route('found-items.index')->with('success', 'Solicitação enviada. A equipe responsável entrará em contato.');
    }
}
