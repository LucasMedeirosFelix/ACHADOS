<?php

namespace App\Http\Controllers;

use App\Models\FoundItem;
use Illuminate\View\View;

class FoundItemController extends Controller
{
    public function index(): View
    {
        return view('found-items.board', [
            'items' => FoundItem::query()->latest('found_at')->latest()->get(),
        ]);
    }
}
