@extends('layout.app')

@section('content')
    <div class="container">
        <h3>Hasil Pencarian untuk: "{{ $search }}"</h3>

        <h4 class="mt-4">Hasil dari Kegiatan:</h4>
        @forelse($kegiatan as $item)
            <div class="card mb-2 p-2">
                <strong>{{ $item->tema }}</strong><br>
                Jenis: {{ $item->jenis_kegiatan }} <br>
                Status: {{ $item->status }} <br>
                Catatan: {{ $item->catatan }}
            </div>
        @empty
            <p>Tidak ada data kegiatan.</p>
        @endforelse

        <h4 class="mt-4">Hasil dari Inventaris:</h4>
        @forelse($inventaris as $item)
            <div class="card mb-2 p-2">
                <strong>{{ $item->nama }}</strong><br>
                IP: {{ $item->ip_address }}<br>
                Spesifikasi: {{ $item->spesifikasi }}
            </div>
        @empty
            <p>Tidak ada data inventaris.</p>
        @endforelse
    </div>
@endsection
