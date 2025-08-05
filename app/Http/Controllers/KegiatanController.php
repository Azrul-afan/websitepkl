<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Jenis;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KegiatanController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            // $kegiatan = Kegiatan::with(['unit','user'])->get();
            $kegiatan = Kegiatan::with(['unit', 'user']);
            //searching
            if (request()->has('search') && request()->search['value'] != '') {
                $search = request()->search['value'];

                $kegiatan = $kegiatan->where(function ($query) use ($search) {
                    $query->where('tanggal', 'like', "%{$search}%")
                        ->orWhere('tema', 'like', "%{$search}%")
                        ->orWhere('status', 'like', "%{$search}%")
                        ->orWhere('catatan', 'like', "%{$search}%");
                });
            }
            $kegiatan = $kegiatan->get();


            return datatables()->of($kegiatan)
                ->addColumn('aksi', function ($kegiatan) {
                    $button = '<button class="btn btn-warning btn-sm edit-kegiatan" data-id="' . $kegiatan->id . '"><i class="bi bi-pencil"></i></button>';
                    $button .= ' ';
                    $button .= '<button class="btn btn-danger btn-sm hapus-kegiatan" data-id="' . $kegiatan->id . '"><i class="bi bi-trash"></i></button>';
                    return $button;
                })
                ->addColumn('unit', function ($row) {
                    return optional($row->unit)->nama ?: 'n/a';
                })
                ->addColumn('user', function ($row) {
                    return optional($row->user)->nama ?: 'n/a'; // Ganti 'name' sesuai field nama user lo
                })
                ->addColumn('durasi', function ($durasi) {
                    return 'durasi';
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }

        $unit = Unit::all();
        $user = User::all();

        return view('kegiatan.index', compact('unit', 'user'));
    }

    public function storeOrUpdate(Request $request, $id = null)
    {
        $rules = [
            'tanggal' => 'required|date',
            'tema' => 'nullable|string|max:255',
            'jenis_kegiatan' => 'required|integer',
            'unit_id' => 'required|integer',
            'status' => 'nullable|string',
            'catatan' => 'nullable|string|max:255',
            'user_id' => 'nullable|integer',
        ];
        $user = Auth::user()->id;

        $validatedData = $request->validate($rules);

        $validatedData['user_id'] = $user;

        $kegiatan = $id ? Kegiatan::findOrFail($id) : new Kegiatan();
        $kegiatan->fill($validatedData);
        $kegiatan->save();

        $message = $id ? 'Kegiatan berhasil diperbarui.' : 'Kegiatan berhasil ditambahkan.';
        return response()->json(['message' => $message], 200);
    }

    public function edit($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        return response()->json($kegiatan);
    }

    public function destroy($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);
        $kegiatan->delete();

        // Hapus thumbnail jika ada
        if ($kegiatan->thumbnail && file_exists(public_path('uploads/kegiatan/' . $kegiatan->thumbnail))) {
            unlink(public_path('uploads/kegiatan/' . $kegiatan->thumbnail));
        }

        return response()->json(['message' => 'Kegiatan berhasil dihapus.']);
    }
}
