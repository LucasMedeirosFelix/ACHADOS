<?php

namespace App\Http\Controllers;

use App\Models\FoundItemActivity;
use Illuminate\View\View;

class AdminFoundItemActivityController extends Controller
{
    public function index(): View
    {
        return view('found-items.admin.activities', [
            'activities' => FoundItemActivity::query()
                ->with('foundItem')
                ->latest('created_at')
                ->latest('id')
                ->paginate(15),
        ]);
    }
}
