<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class MyEventController extends Controller
{
    public function index(): View
    {
        $registrations = auth()->user()
            ->registrations()
            ->with('organizer', 'category')
            ->orderBy('date_time')
            ->get();

        return view('my-events.index', compact('registrations'));
    }
}
