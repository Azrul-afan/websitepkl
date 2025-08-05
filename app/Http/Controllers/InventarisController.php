<?php

namespace App\Http\Controllers;

use App\Models\Inventaris;
use App\Models\Jenis;
use App\Models\Unit;
use Illuminate\Http\Request;

use function PHPUnit\Framework\fileExists;

class InventarisController extends Controller
{
    //
    // public function index() {
    //     return view('inventaris.index');
    // }
    public function index()
    {
        if (request()->ajax()) {
            $inventaris = Inventaris::with(['jenis', 'unit'])->get();
            // dd($inventaris);
            return datatables()->of($inventaris)
                ->addColumn('aksi', function ($inventaris) {
                    $button = '<button class="btn btn-warning btn-sm edit-inventaris" data-id="' . $inventaris->id . '"><i class="bi bi-pencil"></i></button>';
                    $button .= ' ';
                    $button .= '<button class="btn btn-danger btn-sm hapus-inventaris" data-id="' . $inventaris->id . '"><i class="bi bi-trash"></i></button>';
                    return $button;
                })
                ->addColumn('jenis', function ($jenis) {
                    return optional($jenis->jenis)->nama ?: 'n/a';
                })
                ->addColumn('unit', function ($unit) {
                    return optional($unit->unit)->nama ?: 'n/a';
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        $jenis = Jenis::all();
        $unit = Unit::all();
        // dd($jenis);
        return view('inventaris.index', compact('jenis', 'unit'));
    }

    public function storeOrUpdate(Request $request, $id = null)
    {
        // Validasi input
        $rules = [
            'nama' => $id ? 'nullable|string|max:50' : 'required|string|max:50',
            'thumbnail' => 'nullable|image|max:2048',
            'jenis_id' => $id ? 'nullable|integer' : 'required|integer',
            'ip_address' => 'nullable|string|max:25',
            'id_anydesk' => 'nullable|string|max:25',
            'unit_id' => $id ? 'nullable|integer' : 'required|integer',
            'kondisi' => 'nullable|string',
            'spesifikasi' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:100',
        ];

        $validatedData = $request->validate($rules);

        // Ambil data lama (kalau edit), atau buat baru
        $inventaris = $id ? Inventaris::findOrFail($id) : new Inventaris();

        // Handle upload thumbnail baru
        if ($request->hasFile('thumbnail')) {
            // Hapus file lama jika ada
            if ($inventaris->thumbnail && file_exists(public_path('uploads/inventaris/' . $inventaris->thumbnail))) {
                unlink(public_path('uploads/inventaris/' . $inventaris->thumbnail));
            }

            $thumbnail = $request->file('thumbnail');
            $thumbnailName = time() . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move(public_path('uploads/inventaris/'), $thumbnailName);
            $validatedData['thumbnail'] = $thumbnailName;
        }

        // Simpan data
        $inventaris->fill($validatedData);
        $inventaris->save();

        $message = $id ? 'Inventaris berhasil diperbarui.' : 'Inventaris berhasil ditambahkan.';
        return response()->json(['message' => $message], 200);


        if ($id) {
            $inventaris = Inventaris::findOrFail($id);
            $inventaris->update($validatedData);
            return response()->json(['message' => 'Inventaris berhasil diperbarui.']);
        } else {
            Inventaris::create($validatedDa);
            return response()->json(['message' => 'Inventaris berhasil ditambahkan.']);
        }
    }

    public function edit($id)
    {
        $inventaris = Inventaris::findOrFail($id);
        return response()->json($inventaris);
    }

    public function destroy($id)
    {
        $inventaris = Inventaris::findOrFail($id);
        $inventaris->delete();
        if ($inventaris->thumbnail && file_exists(public_path('uploads/inventaris/' . $inventaris->thumbnail))) {
            unlink(public_path('uploads/inventaris/' . $inventaris->thumbnail));

            return response()->json(['message' => 'Inventaris berhasil dihapus.']);
        }
    }
}
