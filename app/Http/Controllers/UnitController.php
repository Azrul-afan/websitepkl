<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index(){
        $data_unit = Unit::all();
        return view('unit.index',compact('data_unit'));
    }

    public function create(){
        return view('unit.create');
    }

    public function store(Request $request){
        $request->validate([
            'nama'=>'required|max:15',
        ]);
        Unit::create($request->all());
        return redirect()->route('unit.index')->with('success','berhasil disimpan');
    }

    public function edit(Unit $id){
        return view('unit.edit',['unit'=>$id]);
    }

    public function update(Request $request,Unit $id){
        $request->validate(['nama' => 'required']);
        $id->update($request->all());
        return redirect()->route('unit.index')->with('success','berhasil diperbarui');
    }

    public function destroy(unit $id){
        $id->delete();
        return back()->with('success','berhasil dihapus');
    }
}
