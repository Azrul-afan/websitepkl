<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function index(){
        $user = User::all();
        $useraktif = User::where('status',1)->get();
        $usertidakaktif = User::where('status',0)->get();
        return view('welcome',compact('user','useraktif','usertidakaktif'));
    }
}
