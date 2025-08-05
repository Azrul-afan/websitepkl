<?php

namespace App\Http\Controllers;

use App\Models\Jenis;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    public function index(){
        // ambil data
        $data_jenis = Jenis::all();
        return view('jenis.index',compact('data_jenis'));
    }

    public function create(){
        return view('jenis.create');
    }

    public function store(Request $request){
        $request->validate([
            'nama'=>'required|max:15|min:3',
        ]);
        Jenis::create($request->all());
        return redirect()->route('jenis.index')->with('success','berhasil disimpan');
    }

    public function edit(Jenis $id){
        return view('jenis.edit',['jenis'=>$id]);
    }

    public function update(Request $request, Jenis $id){
        $request->validate(['nama' => 'required']);
        $id->update($request->all());
        return redirect()->route('jenis.index')->with('success','berhasil diperbaharui');
    }

    public function destroy(Jenis $id){
        $id->delete();
        return back()->with('success','berhasil dihapus');
    }
    
}
