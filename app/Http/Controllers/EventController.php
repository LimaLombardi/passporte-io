<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class EventController extends Controller
{
    public function show(Event $event): View
    {
        $event->load(['organizer', 'category']);
        $participantsCount = $event->participants()->count();
        $isRegistered = auth()->check() && auth()->user()->registrations()->where('event_id', $event->id)->exists();

        return view('events.show', compact('event', 'participantsCount', 'isRegistered'));
    }

    public function index(): View
    {
        $this->authorize('viewAny', Event::class);

        $events = auth()->user()
            ->events()
            ->with('category')
            ->orderByDesc('date_time')
            ->get();

        return view('organizer.events.index', compact('events'));
    }

    public function create(): View
    {
        $this->authorize('create', Event::class);

        $categories = Category::orderBy('name')->get();

        return view('organizer.events.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', Event::class);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'date_time' => ['required', 'date', 'after:now'],
            'location' => ['required', 'string', 'max:255'],
            'capacity' => ['required', 'integer', 'min:1'],
            'category_id' => ['required', 'exists:categories,id'],
            'banner' => ['nullable', 'image', 'max:2048'],
        ]);

        $bannerPath = null;
        if ($request->hasFile('banner')) {
            $extension = $request->file('banner')->getClientOriginalExtension();
            $filename = Str::uuid()->toString().'.'.$extension;
            $bannerPath = $request->file('banner')->storeAs('banners', $filename, 'public');
        }

        auth()->user()->events()->create([
            'category_id' => $validated['category_id'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'date_time' => $validated['date_time'],
            'location' => $validated['location'],
            'capacity' => $validated['capacity'],
            'banner_path' => $bannerPath,
        ]);

        return redirect()
            ->route('organizer.events.index')
            ->with('success', 'Evento criado.');
    }

    public function edit(Event $event): View
    {
        $this->authorize('update', $event);

        $categories = Category::orderBy('name')->get();

        return view('organizer.events.edit', compact('event', 'categories'));
    }

    public function update(Request $request, Event $event): RedirectResponse
    {
        $this->authorize('update', $event);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'date_time' => ['required', 'date', 'after:now'],
            'location' => ['required', 'string', 'max:255'],
            'capacity' => ['required', 'integer', 'min:1'],
            'category_id' => ['required', 'exists:categories,id'],
            'banner' => ['nullable', 'image', 'max:2048'],
        ]);

        $data = [
            'category_id' => $validated['category_id'],
            'title' => $validated['title'],
            'description' => $validated['description'],
            'date_time' => $validated['date_time'],
            'location' => $validated['location'],
            'capacity' => $validated['capacity'],
        ];

        if ($request->hasFile('banner')) {
            if ($event->banner_path) {
                Storage::disk('public')->delete($event->banner_path);
            }

            $extension = $request->file('banner')->getClientOriginalExtension();
            $filename = Str::uuid()->toString().'.'.$extension;
            $data['banner_path'] = $request->file('banner')->storeAs('banners', $filename, 'public');
        }

        $event->update($data);

        return redirect()
            ->route('organizer.events.index')
            ->with('success', 'Evento atualizado.');
    }

    public function destroy(Event $event): RedirectResponse
    {
        $this->authorize('delete', $event);

        if ($event->hasParticipants()) {
            return back()->with('error', 'Não é possível excluir eventos com participantes inscritos.');
        }

        if ($event->banner_path) {
            Storage::disk('public')->delete($event->banner_path);
        }

        $event->delete();

        return redirect()
            ->route('organizer.events.index')
            ->with('success', 'Evento excluído.');
    }
}
