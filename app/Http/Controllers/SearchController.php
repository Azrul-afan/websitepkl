<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use App\Models\Jenis;
use App\Models\Kegiatan;
use App\Models\Unit;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Pencarian di tabel Kegiatan
        $kegiatan = Kegiatan::with(['unit', 'user'])
            ->where('tema', 'like', "%$search%")
            ->orWhere('jenis_kegiatan', 'like', "%$search%")
            ->orWhere('status', 'like', "%$search%")
            ->orWhere('catatan', 'like', "%$search%")
            ->get();

        // Pencarian di tabel Inventaris (misalnya lo mau juga)
        $inventaris = Inventaris::with(['jenis', 'unit'])
            ->where('nama', 'like', "%$search%")
            ->orWhere('ip_address', 'like', "%$search%")
            ->orWhere('spesifikasi', 'like', "%$search%")
            ->orWhere('keterangan', 'like', "%$search%")
            ->get();

        return view('search.index', compact('search', 'kegiatan', 'inventaris'));
    }
}

