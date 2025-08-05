<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            // $users = User::all();\
            $user = User::with('role')->get();
            return datatables()->of($user)
                ->addColumn('aksi', function ($user) {
                    $button = '<button class="btn btn-warning btn-sm edit-user" data-id="' . $user->id . '" name="edit"><i class="bi bi-pencil"></i></button>';
                    $button .= ' ';
                    $button .= '<button class="btn btn-danger btn-sm hapus-user" data-id="' . $user->id . '" name="edit"><i class="bi bi-trash"></i></button>';
                    return $button;
                })
                ->addColumn('role',function($role){
                    return optional($role->role)->nama ?: 'n/a';
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }
        $roles=Role::all();
        return view('user&role.index',compact('roles'));
    }

    public function storeOrUpdate(Request $request, $id = null)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => $id ? 'nullable|string':'required|string:',
            'status' => 'required',
            'role_id'=> 'numeric',
        ]);

        if ($id) {

            $user = User::findOrFail($id);
            $user->update($validatedData);
            return response()->json(['message' => 'User updated successfully!']);
        } else {

            User::create($validatedData);
            return response()->json(['message' => 'User created successfully!']);
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'message' => 'User successfully deleted.',
        ]);
    }
}
