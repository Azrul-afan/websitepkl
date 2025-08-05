<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $roles = Role::all();
            return datatables()->of($roles)
                ->addColumn('aksi', function ($role) {
                    $button = '<button class="btn btn-warning btn-sm edit-role" data-id="' . $role->id . '" name="edit"><i class="bi bi-pencil"></i></button>';
                    $button .= ' ';
                    $button .= '<button class="btn btn-danger btn-sm hapus-role" data-id="' . $role->id . '" name="edit"><i class="bi bi-trash"></i></button>';
                    return $button;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        return view('user&role.index');
    }

    public function storeOrUpdate(Request $request, $id = null)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        if ($id) {
            // Update existing record
            $role = Role::findOrFail($id);
            $role->update($validatedData);
            return response()->json(['message' => 'Role updated successfully!']);
        } else {
            // Create new record
            Role::create($validatedData);
            return response()->json(['message' => 'Role created successfully!']);
        }
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return response()->json($role);
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return response()->json([
            'message' => 'Role successfully deleted.',
        ]);
    }
}
