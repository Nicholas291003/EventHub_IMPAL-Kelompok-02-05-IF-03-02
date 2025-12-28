<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    /**
     * Menampilkan Riwayat Transaksi.
     */
    public function index()
    {
        // Ambil data dari tabel TICKETS
        $tickets = Ticket::with('event')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        // Kirim variable $tickets
        return view('user.transactions.index', compact('tickets'));
    }

    /**
     * Proses Beli Tiket (KF-05).
     */
    public function store(Request $request, Event $event)
    {
        // 1. Validasi & Cek Stok (Masih Sama)
        $request->validate(['jumlah_tiket' => 'required|integer|min:1']);
        if ($event->stokTiket < $request->jumlah_tiket) {
            return back()->with('error', 'Stok tidak cukup!');
        }

        // 2. Simpan Transaksi Induk (Catatan Keuangan)
        $total = $event->hargaTiket * $request->jumlah_tiket;

        $transaction = Transaction::create([
            'user_id' => Auth::id(),
            'event_id' => $event->id,
            'jumlah_tiket' => $request->jumlah_tiket,
            'total_harga' => $total,
            'status' => 'Lunas'
        ]);

        // 3. GENERATE TIKET SATUAN (Logic Baru Revisi 2)
        // Kita looping sebanyak jumlah tiket yang dibeli
        for ($i = 0; $i < $request->jumlah_tiket; $i++) {
            Ticket::create([
                'transaction_id' => $transaction->id,
                'user_id' => Auth::id(),
                'event_id' => $event->id,
                // Buat kode unik: TIKET-[ID_EVENT]-[RANDOM_STRING]
                'ticket_code' => 'TIKET-' . $event->id . '-' . strtoupper(Str::random(6)),
                'status' => 'Valid'
            ]);
        }

        // 4. Kurangi Stok Event
        $event->decrement('stokTiket', $request->jumlah_tiket);
        if ($event->stokTiket == 0) {
            $event->update(['statusTiket' => 'Habis']);
        }

        return redirect()->route('transactions.index')->with('success', 'Pembelian berhasil!');
    }
}
