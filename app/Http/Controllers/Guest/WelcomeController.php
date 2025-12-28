<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Menampilkan halaman depan dengan daftar event + Fitur Pencarian.
     */
    public function index(Request $request)
    {
        // Logika Pencarian
        $query = Event::latest();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('namaEvent', 'LIKE', "%{$search}%")
                ->orWhere('lokasiEvent', 'LIKE', "%{$search}%");
        }

        // Ambil data (pagination 6 event per halaman agar rapi)
        $events = $query->paginate(6);

        return view('guest.welcome', compact('events'));
    }

    /**
     * Menampilkan detail lengkap satu event.
     */
    public function show(Event $event)
    {
        return view('guest.detail', compact('event'));
    }
}
