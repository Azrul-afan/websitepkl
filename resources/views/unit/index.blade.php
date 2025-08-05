@extends('layout.app')
@push('style')
    <style>
        .card {
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background: linear-gradient(to right, #006400, #00c853);
            color: white;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
        }

        .modal-content {
            border-radius: 15px;
        }

        .form-label {
            font-weight: bold;
        }

        #table_unit_wrapper .row:nth-child(1) {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        #table_unit_filter label input {
            border-radius: 10px;
            border: 1px solid #ccc;
            padding: 5px 10px;
        }

        #table_unit {
            font-size: 14px;
        }

        #table_unit thead {
            background-color: #00a44e;
            color: white;
        }

        #table_unit tbody tr:hover {
            background-color: #f2f2f2;
        }
    </style>
@endpush
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Unit</h1>
    </div>
    <a class="btn btn-success" href="{{ route('unit.create') }}"
        style="background: linear-gradient(to right, darkgreen,rgb(0, 136, 0));"><i class="bi bi-plus-circle me-2"></i>
        <i class="bi bi-plus"></i> Buat baru</a>
    <hr>
    <div>
        <div class="card shadow">
            <div class="card-header bg-dark text-white">
                <h5 style="text-align: center">Data Unit</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered border-primary table-sm table-striped">
                        <thead>
                            <td><b>NO</b></td>
                            <td><b>Nama</b></td>
                            <td width="10%"><b>ACTION</b></td>
                        </thead>
                        <tbody>
                            @foreach ($data_unit as $unit)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $unit->nama }}</td>
                                    <td><a href="{{ route('unit.edit', $unit->id) }}" class="btn btn-sm btn-warning"><i
                                                class="bi bi-pencil"></i></a>
                                        <form id="delete-form-{{ $unit->id }}"
                                            action="{{ route('unit.destroy', $unit->id) }}" method="POST"
                                            style="display: inline">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="btn btn-sm btn-danger"
                                                onclick="hapus('{{ $unit->id }}','{{ $unit->nama }}')"><i
                                                    class="bi bi-trash3"></i></a>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endsection
        @push('script')
            <script>
                function hapus(id, nama) {
                    swal.fire({
                        title: 'Hapus data?',
                        text: "Yakin ingin menghapus:" + nama + "?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            document.getElementById('delete-form-' + id).submit();
                        }
                    });
                }
            </script>
        @endpush
