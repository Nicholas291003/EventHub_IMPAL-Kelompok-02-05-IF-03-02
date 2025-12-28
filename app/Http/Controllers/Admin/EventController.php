<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Menampilkan daftar event (Halaman Utama Admin).
     */
    public function index()
    {
        // 1. Data Statistik Utama
        $totalEvents = Event::count();
        $totalTransaksi = \App\Models\Transaction::sum('jumlah_tiket');
        $pendapatan = \App\Models\Transaction::sum('total_harga');
        $totalUsers = \App\Models\User::count();
        $allUsers = \App\Models\User::latest()->get(); // Untuk tabel di modal

        // 2. Data untuk Grafik (Chart.js)
        // Kita ambil nama event dan jumlah tiket terjualnya
        $events = Event::with(['transactions.user'])->latest()->get();

        $chartLabels = $events->pluck('namaEvent'); // Ambil nama-nama event
        $chartData = $events->map(function($event) {
            return $event->transactions->sum('jumlah_tiket'); // Ambil total tiket per event
        });

        // 3. Data Transaksi Terbaru (5 Terakhir)
        $recents = \App\Models\Transaction::with(['user', 'event'])->latest()->take(5)->get();

        return view('admin.events.index', compact(
            'events', 'totalEvents', 'totalTransaksi', 'pendapatan',
            'chartLabels', 'chartData', 'recents',
            'totalUsers', 'allUsers'
        ));
    }

    /**
     * Menampilkan form untuk membuat event baru.
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Menyimpan event baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi input sesuai SKPL
        $request->validate([
            'namaEvent' => 'required',
            'deskripsiEvent' => 'required',
            'tanggalEvent' => 'required|date',
            'lokasiEvent' => 'required',
            'hargaTiket' => 'required|numeric',
            'stokTiket' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240' // Validasi gambar
        ]);

        // Simpan data
        $input = $request->all();

        // Cek jika ada upload gambar
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');

            // Beri nama unik: time() + nama asli
            $destinationPath = 'images/events/';
            $profileImage = time() . "." . $image->getClientOriginalExtension();

            // Pindahkan file ke public/images/events
            $image->move(public_path($destinationPath), $profileImage);

            // Simpan nama file saja ke database
            $input['gambar'] = $profileImage;
        }

        Event::create($input);

        return redirect()->route('events.index')
            ->with('success','Event berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit.
     */
    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    /**
     * Menyimpan perubahan (Update).
     */
    public function update(Request $request, Event $event)
    {
        // Validasi (Gambar nullable agar tidak wajib upload ulang)
        $request->validate([
            'namaEvent' => 'required',
            'deskripsiEvent' => 'required',
            'tanggalEvent' => 'required|date',
            'lokasiEvent' => 'required',
            'hargaTiket' => 'required|numeric',
            'stokTiket' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240' // 10MB
        ]);

        $input = $request->all();

        // Logika Update Gambar
        if ($image = $request->file('gambar')) {
            // Hapus gambar lama jika ada (opsional, biar hemat storage)
            if ($event->gambar && file_exists(public_path('images/events/' . $event->gambar))) {
                unlink(public_path('images/events/' . $event->gambar));
            }

            $destinationPath = 'images/events/';
            $profileImage = time() . "." . $image->getClientOriginalExtension();
            $image->move(public_path($destinationPath), $profileImage);
            $input['gambar'] = "$profileImage";
        } else {
            // Jika tidak upload gambar baru, pakai gambar lama
            unset($input['gambar']);
        }

        $event->update($input);

        return redirect()->route('events.index')
            ->with('success','Event berhasil diperbarui.');
    }

    /**
     * Menghapus event.
     */
    public function destroy(Event $event)
    {
        // Hapus file gambar dari folder public agar tidak menumpuk
        if ($event->gambar && file_exists(public_path('images/events/' . $event->gambar))) {
            unlink(public_path('images/events/' . $event->gambar));
        }

        // Hapus data dari database
        $event->delete();

        return redirect()->route('events.index')
            ->with('success','Event berhasil dihapus.');
    }
}
