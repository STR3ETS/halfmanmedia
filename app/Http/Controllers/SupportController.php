<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SupportTicket;
use App\Models\SupportTicketMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupportController extends Controller
{
    public function index()
    {
        $gebruiker = Auth::user();
        $tickets = SupportTicket::where('user_id', $gebruiker->id)->latest()->get();
        return view('klantenportaal.support', compact('gebruiker', 'tickets'));
    }
    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        SupportTicket::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'message' => $request->message,
            'status' => 'in_behandeling',
        ]);

        return redirect()->back()->with('success', 'Support ticket succesvol aangemaakt.');
    }
    public function show($id)
    {
        $ticket = SupportTicket::findOrFail($id);
        $gebruiker = Auth::user();
        return view('klantenportaal.support-ticket', compact('gebruiker', 'ticket'));
    }
    public function addMessage(Request $request, $ticketId)
    {
        $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        $ticket = SupportTicket::findOrFail($ticketId);

        SupportTicketMessage::create([
            'support_ticket_id' => $ticket->id,
            'user_id' => auth()->id(),
            'message' => $request->message,
        ]);

        return redirect()->back()->with('success', 'Bericht toegevoegd aan ticket.');
    }
}
