@extends('layout.app')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Form edit jenis</h1>
    </div>
    {{-- tag form --}}
    <form action="{{route('jenis.update', $jenis->id) }}" method="post">
        @csrf
        @method('put')
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" 
                value="{{old('nama',$jenis->nama ?? '')}}" placeholder="Nama Jenis Barang" required>
            </div>
        </div>
        <a class="btn btn-success"><i class="bi bi-check"></i>Simpan</a>
        <a href="/jenis" class="btn btn-danger"><i class="bi bi-arrow-bar-up"></i>Kembali</a>
    </form>
@endsection
