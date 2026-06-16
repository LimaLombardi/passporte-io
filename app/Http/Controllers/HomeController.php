<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(Request $request): View
    {
        $query = Event::with(['organizer', 'category'])
            ->orderBy('date_time');

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $events = $query->get();
        $categories = Category::orderBy('name')->get();

        return view('events.index', compact('events', 'categories'));
    }
}
