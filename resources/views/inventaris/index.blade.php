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

        #table_inventaris_wrapper .row:nth-child(1) {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        #table_inventaris_filter label input {
            border-radius: 10px;
            border: 1px solid #ccc;
            padding: 5px 10px;
        }

        #table_inventaris {
            font-size: 14px;
        }

        #table_inventaris thead {
            background-color: #00a44e;
            color: white;
        }

        #table_inventaris tbody tr:hover {
            background-color: #f2f2f2;
        }
    </style>
@endpush
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Inventaris</h1>
    </div>

    <div class="row">
        <div class="col">
            <button type="button" class="btn btn-success shadow fw-semibold px-4 py-2 rounded-3" data-bs-toggle="modal"
                data-bs-target="#inventarisModal" id="addInventarisButton"
                style="background: linear-gradient(to right, darkgreen,rgb(0, 136, 0));"><i
                    class="bi bi-plus-circle me-2"></i>Tambah Data</button>
            <div class="modal fade" id="inventarisModal" tabindex="-1" aria-labelledby="inventarisModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title" id="inventarisModalLabel">Add Inventaris</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                        </div>

                        <form id="inventarisForm">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="hidden" id="inventaris_id" name="inventaris_id">
                                        <div>
                                            <label for="name" class="form-label">Nama </label>
                                            <input type="text" class="form-control" id="nama" name="nama"
                                                required>
                                        </div>
                                        <div>
                                            <label for="ip_address" class="form-label">IP Address</label>
                                            <input type="text" class="form-control" id="ip_address" name="ip_address">
                                        </div>
                                        <div>
                                            <label for="unit_id" class="form-label">Unit ID</label>
                                            <select class="form-control" id="unit_id" name="unit_id" required>
                                                <option value="" selected>Pilih Unit</option>
                                                @foreach ($unit as $unit)
                                                    <option value="{{ $unit->id }}">{{ $unit->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <label for="jenis_id" class="form-label">Jenis</label>
                                        <select id="jenis_id" name="jenis_id" class="form-control" required>
                                            <option value="" selected>Pilih Jenis</option>
                                            @foreach ($jenis as $jenis)
                                                <option value="{{ $jenis->id }}">{{ $jenis->nama }}</option>
                                            @endforeach
                                        </select>
                                        <div>
                                            <label for="id_anydesk" class="form-label">ID Anydesk</label>
                                            <input type="number" class="form-control" id="id_anydesk" name="id_anydesk">
                                        </div>
                                        <div>
                                            <label for="kondisi" class="form-label">Kondisi</label>
                                            <select class="form-select mb-3" aria-label="Default select example"
                                                id="kondisi" name="kondisi">
                                                <option value="" selected>Pilih Kondisi</option>
                                                <option value="1">Bagus</option>
                                                <option value="2">Rusak</option>
                                                <option value="3">perlu perbaikan</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <label for="spesifikasi" class="form-label">Spesifikasi</label>
                                    <input type="text" class="form-control" id="spesifikasi" name="spesifikasi">
                                </div>
                                <div>
                                    <label for="keterangan" class="form-label">keterangan</label>
                                    <textarea type="text" class="form-control" id="keterangan" name="keterangan"></textarea>
                                </div>
                                <div>
                                    <label for="thumbnail" class="form-label">Thumbnail</label>
                                    <input type="file" class="form-control" id="thumbnail" name="thumbnail"
                                        accept="image/*">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="saveInventaris">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        {{-- table --}}

        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header bg-success text-white">
                        <h5>Data Inventaris</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table_inventaris"
                                class=" table table-bordered border-primary table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Thumbnail</th>
                                        <th>Jenis</th>
                                        <th>IP Address</th>
                                        <th>ID Anydesk</th>
                                        <th>Unit</th>
                                        <th>Kondisi</th>
                                        <th>Spesifikasi</th>
                                        <th>Keterangan</th>
                                        <th width='8%'>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- modal --}}
        @push('script')
            <script>
                $(document).ready(function() {
                    fetchData();

                    //include CSRF token in all AJAX request
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')
                        }
                    });

                    function fetchData() {
                        var storageBaseUrl = '{{ asset('uploads/inventaris/') }}';
                        $('#table_inventaris').DataTable({
                            serverSide: true,
                            processing: true,
                            ajax: {
                                url: "{{ route('inventaris.index') }}",
                                type: 'GET'
                            },
                            columns: [{
                                    orderable: false,
                                    render: function(data, type, row, meta) {
                                        return meta.row + meta.settings._iDisplayStart + 1;
                                    }
                                },
                                {
                                    data: 'nama',
                                    name: 'nama',
                                },
                                {
                                    data: 'thumbnail',
                                    name: 'thumbnail',
                                    orderable: false,
                                    render: function(data, type, row) {
                                        if (data) {
                                            return `<img src="${storageBaseUrl}/${data}" class="rounded" style="width:100px; height:100px; object-fit:cover;"/>`;
                                        } else {
                                            return `<span class="text-muted">no photo</span>`;
                                        }
                                    }
                                },
                                {
                                    data: 'jenis',
                                    name: 'jenis',
                                },
                                {
                                    data: 'ip_address',
                                    name: 'ip_address',
                                },
                                {
                                    data: 'id_anydesk',
                                    name: 'id_anydesk',
                                },
                                {
                                    data: 'unit',
                                    name: 'unit',
                                },
                                {
                                    data: 'kondisi',
                                    name: 'kondisi',
                                    orderable: false,
                                    // render: function(data, type, row) {
                                    //     if (data === 1) {
                                    //         return '<span class="badge bg-success">rusak/span>';
                                    //     } else {
                                    //         return '<span class="badge bg-success">perlu perbaikan</span>';
                                    //     }
                                    // }
                                    render: function(data, type, row) {
                                        // let badgeClass = 'secondary';
                                        if (data === 1) {
                                            return '<span class="badge bg-success">Bagus</span>';
                                        } else if (data === 2) {
                                            return '<span class="badge bg-danger">Rusak</span>';
                                        } else if (data === 3) {
                                            return '<span class="badge bg-warning">Perbaikan</span>';
                                        }
                                    },
                                },
                                {
                                    data: 'spesifikasi',
                                    name: 'spesifikasi',
                                },
                                {
                                    data: 'keterangan',
                                    name: 'keterangan',
                                },
                                {
                                    data: 'aksi',
                                    name: 'aksi',
                                    orderable: false
                                },
                            ],
                            // "columnDefs": [{
                            // "targets": [3], // Center Price, Quantity, and Total columns
                            // "className": "text-center"
                            // }],
                            order: [
                                [1, 'asc']
                            ],
                            responsive: true, // Makes the table responsive
                            autoWidth: false, // Prevents auto-sizing of columns
                            lengthMenu: [
                                [5, 10, 25, 50, -1],
                                [5, 10, 25, 50, "All"]
                            ], // Prevents auto-sizing of columns
                            pageLength: 10, // Default page length
                        })
                    }

                    // Show modal for creating a new record
                    $('#addInventarisButton').click(function() {
                        $('#inventarisForm')[0].reset();
                        $('#inventaris_id').val('');
                        $('#inventarisModalLabel').text('Add inventaris');
                        $('#saveInventaris').text('simpan');
                        $('#inventarisModal').modal('show');
                        setTimeout(function() {
                            $('#nama').focus();
                            // $('#inventaris_password').focus();
                        }, 500);
                        $('#inventarisModal').modal('show');
                    });

                    // Show modal for updating an existing record
                    $(document).on('click', '.edit-inventaris', function() {
                        let id = $(this).data('id');

                        $.get(`/inventaris/${id}/edit`, function(data) {
                            $('#inventaris_id').val(data.id);
                            $('#nama').val(data.nama);
                            $('#jenis_id').val(data.jenis_id);
                            $('#ip_address').val(data.ip_address);
                            $('#id_anydesk').val(data.id_anydesk);
                            $('#unit_id').val(data.unit_id);
                            $('#kondisi').val(String(data.kondisi)); // biar cocok sama value <option>
                            $('#spesifikasi').val(data.spesifikasi);
                            $('#keterangan').val(data.keterangan);

                            $('#inventarisModalLabel').text('Edit Inventaris');
                            $('#saveInventaris').text('Update');
                            $('#inventarisModal').modal('show');
                        });
                    });

                    // Handle form submission for both create and update
                    $('#inventarisForm').submit(function(e) {
                        e.preventDefault();
                        let id = $('#inventaris_id').val();
                        let url = id ? `/inventaris/${id}` : '/inventaris';
                        let formData = new FormData(this);
                        if (id) {
                            formData.append('_method', 'PUT');
                        }

                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                            success: function(response) {
                                $('#table_inventaris').DataTable().ajax.reload();
                                Swal.fire({
                                    title: 'Success!',
                                    text: response.message,
                                    icon: 'success',
                                    timer: 3000,
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                });
                                $('#inventarisModal').modal('hide');
                                $('#inventarisForm')[0].reset();
                            },
                            error: function(xhr) {
                                let errorMsg = 'Terjadi kesalahan.';
                                if (xhr.responseJSON && xhr.responseJSON.errors) {
                                    const errors = xhr.responseJSON.errors;
                                    errorMsg = Object.values(errors).flat().join('\n');
                                }
                                Swal.fire({
                                    title: 'Error!',
                                    text: errorMsg,
                                    icon: 'error',
                                    timer: 3000,
                                    toast: true,
                                    position: 'top-end',
                                });
                            },
                        });
                    });

                    // Hapus Data
                    $(document).on('click', '.hapus-inventaris', function() {
                        let id = $(this).data('id');
                        let deleteUrl = '{{ route('Inventaris.destroy', ':id') }}'.replace(':id', id);

                        Swal.fire({
                            title: 'Apakah anda yakin?',
                            text: 'This action cannot be undone!',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Ya,Hapus saja!',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: deleteUrl,
                                    type: 'DELETE',
                                    data: {
                                        _token: "{{ csrf_token() }}"
                                    },
                                    success: function(response) {
                                        $('#table_inventaris').DataTable().ajax
                                            .reload();
                                        Swal.fire('Deleted', response.message, 'success');
                                    },
                                    error: function(xhr) {
                                        Swal.fire('Error!', 'Failed to delete record.',
                                            'error');
                                    },
                                });
                            }
                        });
                    });
                })
            </script>
        @endpush
    @endsection
