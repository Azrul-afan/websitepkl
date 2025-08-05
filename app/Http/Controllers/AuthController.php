<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function login()
    {
        if (Auth::guard('admin')->check()) {
            return redirect('dashboard');
        }
        return view('auth.login');
    }

    public function auth_login(Request $request)
    {
        $rules = [
            'username' => 'required|string|exists:users,username',
            'password' => 'required|string',
        ];

        $messages = [
            'username.required' => 'username wajib diisi',
            'username.exists' => 'username tidak terdaftar',
            'password.required' => 'password wajib diisi',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {

            if ($request->ajax()) {
                return response()->json(['success' => 0, 'message' => $validator->errors()->first()], 422);
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if (Auth::guard('admin')->attempt($request->only('username', 'password'))) {

            $user = Auth::guard('admin')->user();

            // check if the user is active
            if (!$user->status) {
                Auth::guard('admin')->logout();
                if ($request->ajax()) {
                    return response()->json(['success' => 0, 'message' => 'Akun Anda tidak aktif.Silahkan hubungi administrator.']);
                }
                return redirect()->route('login')->withErrors(['email' => 'Akun Anda tidak aktif.Silahkan hubungi administrator.']);
            }
            // Check if the request is an AJAX request,return a JSON response if it is
            if ($request->ajax()) {
                return response()->json(['success' => 1, 'message' => 'Selamat! Anda berhasil Login.']);
            }
            // If authentication is successful, redirect to the intended route
            return redirect()->intended(route('dashboard'))->with('success', 'Selamat! Anda berhasil Login.');

            // Check if the user is already logged in on another device
            if ($user->session_id) {
                // Destroy the previous session
                \Illuminate\Support\Facades\Session::getHandler()->destroy($user->session_id);
            }

            $user->session_id = session()->getId();
            $user->save();

            if ($request->ajax()) {
                return response()->json(['success' => 1, 'message' => 'Selamat! Anda berhasil Login.']);
            }
            return redirect()->intended(route('dashboard'))->with('success', 'Selamat! Anda berhasil Login.');
        }


        $errorMessage = 'Username atau Password salah';

        if ($request->ajax()) {
            return response()->json(['success' => 0, 'message' => $errorMessage], 401);
        }
        return redirect()->back()->with('error', $errorMessage)->withInput($request->only('username'));
    }

    public function logout(Request $request)
    {
        $user = Auth::user();

        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
        }
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
