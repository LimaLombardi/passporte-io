<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class RegistrationController extends Controller
{
    public function store(Event $event): RedirectResponse
    {
        $user = auth()->user();

        if ($user->registrations()->where('event_id', $event->id)->exists()) {
            return back()->with('error', 'Você já está inscrito neste evento.');
        }

        if (! $event->hasAvailableSpots()) {
            return back()->with('error', 'Vagas esgotadas');
        }

        $event->participants()->attach($user->id, [
            'ticket_code' => Str::random(10),
            'status' => 'confirmed',
        ]);

        return back()->with('success', 'Inscrição feita.');
    }

    public function destroy(Event $event): RedirectResponse
    {
        $user = auth()->user();

        if (! $user->registrations()->where('event_id', $event->id)->exists()) {
            return back()->with('error', 'Inscrição não encontrada.');
        }

        $event->participants()->detach($user->id);

        return back()->with('success', 'Inscrição cancelada.');
    }
}
