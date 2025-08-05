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

        #table_kegiatan_wrapper .row:nth-child(1) {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        #table_kegiatan_filter label input {
            border-radius: 10px;
            border: 1px solid #ccc;
            padding: 5px 10px;
        }

        #table_kegiatan {
            font-size: 14px;
        }

        #table_kegiatan thead {
            background-color: #00a44e;
            color: white;
        }

        #table_kegiatan tbody tr:hover {
            background-color: #f2f2f2;
        }
    </style>
@endpush
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Kegiatan</h1>
    </div>

    <div class="row">
        <div class="col">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#kegiatanModal"
                id="addkegiatanButton" style="background: linear-gradient(to right, darkgreen,rgb(0, 136, 0));"><i
                    class="bi bi-plus-circle me-2"></i>Tambah Data</button>
            <div class="modal fade" id="kegiatanModal" tabindex="-1" aria-labelledby="kegiatanModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title" id="kegiatanModalLabel">Kegiatan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                        </div>

                        <form id="kegiatanForm">
                            <div class="modal-body">
                                <div class="row">
                                    {{-- Kolom Kiri --}}
                                    <div class="col-md-6">
                                        <input type="hidden" id="kegiatan_id" name="kegiatan_id">

                                        <div class="mb-3">
                                            <label for="tanggal" class="form-label">Tanggal</label>
                                            <input type="date" class="form-control" id="tanggal" name="tanggal"
                                                required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="tema" class="form-label">Tema</label>
                                            <input type="text" class="form-control" id="tema" name="tema">
                                        </div>

                                        <div class="mb-3">
                                            <label for="jenis_kegiatan" class="form-label">Jenis Kegiatan</label>
                                            <select class="form-select mb-3" aria-label="Default select example"
                                                id="jenis_kegiatan" name="jenis_kegiatan">
                                                <option value="" selected>Pilih jenis_kegiatan</option>
                                                <option value="1">Perbaikan</option>
                                                <option value="2">maintenence</option>
                                                <option value="3">Help Desk</option>
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Kolom Kanan --}}
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="unit_id" class="form-label">Unit ID</label>
                                            <select class="form-control" id="unit_id" name="unit_id" required>
                                                <option value="" selected>Pilih Unit</option>
                                                @foreach ($unit as $unit)
                                                    <option value="{{ $unit->id }}">{{ $unit->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="status" class="form-label">status</label>
                                            <select class="form-select" id="status" name="status">
                                                <option value="" selected>Pilih status</option>
                                                <option value="on progress">On progress</option>
                                                <option value="done">Done</option>
                                            </select>
                                        </div>

                                        {{-- <div class="mb-3">
                                            <label for="user_id" class="form-label">User ID</label>
                                            <select class="form-control" id="user_id" name="user_id" required>
                                                <option value="" selected>Pilih User</option>
                                                @foreach ($user as $user)
                    <option value="{{ $user->id }}">{{ $user->nama }}</option>
                @endforeach
                                            </select>
                                        </div> --}}
                                    </div>

                                    {{-- Catatan full width --}}
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="catatan" class="form-label">Catatan</label>
                                            <textarea class="form-control" id="catatan" name="catatan" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="savekegiatan">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col">
                    <div class="card shadow">
                        <div class="card-header bg-success text-white">
                            <h5>Data Kegiatan</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="table_kegiatan"
                                    class=" table table-bordered border-primary table-sm table-striped">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>Tanggal</th>
                                            <th>Tema</th>
                                            <th>Jenis Kegiatan</th>
                                            <th>Unit</th>
                                            <th>Status</th>
                                            <th>Durasi</th>
                                            <th>Catatan</th>
                                            <th>User</th>
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

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')
                            }
                        });

                        function fetchData() {
                            $('#table_kegiatan').DataTable({
                                serverSide: true,
                                processiing: true,
                                ajax: {
                                    url: "{{ route('kegiatan.index') }}",
                                    type: 'GET'
                                },
                                columns: [{
                                        orderable: false,
                                        render: function(data, type, row, meta) {
                                            return meta.row + meta.settings._iDisplayStart + 1;
                                        }

                                    },
                                    {
                                        data: 'tanggal',
                                        name: 'tanggal',
                                    },
                                    {
                                        data: 'tema',
                                        name: 'tema',
                                    },
                                    {
                                        data: 'jenis_kegiatan',
                                        name: 'jenis_kegiatan',
                                        orderable: false,
                                        render: function(data, type, row) {
                                            // let badgeClass = 'secondary';
                                            if (data === 1) {
                                                return '<span class="badge bg-success">Perbaikan</span>';
                                            } else if (data === 2) {
                                                return '<span class="badge bg-danger">Maintenence</span>';
                                            } else {
                                                return '<span class="badge bg-warning">Help Desk</span>';
                                            }
                                        },
                                    },
                                    {
                                        data: 'unit',
                                        name: 'unit',
                                    },
                                    {
                                        data: 'status',
                                        name: 'status',
                                        orderable: false,
                                        render: function(data, type, row) {
                                            // let badgeClass = 'secondary';
                                            if (data === 'done') {
                                                return '<span class="badge bg-success">Done</span>';
                                            } else {
                                                return '<span class="badge bg-primary">On progress</span>';
                                            }
                                        },
                                    },
                                    {
                                        data: 'durasi',
                                        name: 'durasi',
                                    },
                                    {
                                        data: 'catatan',
                                        name: 'catatan',
                                    },
                                    {
                                        data: 'user',
                                        name: 'user',
                                    },
                                    {
                                        data: 'aksi',
                                        name: 'aksi',
                                        orderable: false
                                    },
                                ],
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
                        $('#addKegiatanButton').click(function() {
                            $('#kegiatanForm')[0].reset();
                            $('#kegiatan_id').val('');
                            $('#kegiatanModalLabel').text('Add kegiatan');
                            $('#savekegiatan').text('simpan');
                            $('#kegiatanModal').modal('show');
                            setTimeout(function() {
                                $('#tanggal').focus();
                                // $('#kegiatan_password').focus();
                            }, 500);
                            $('#kegiatanModal').modal('show');
                        });

                        $(document).on('click', '.edit-kegiatan', function() {
                            let id = $(this).data('id');

                            $.get(`/kegiatan/${id}/edit`, function(data) {
                                $('#kegiatan_id').val(data.id);
                                $('#tanggal').val(data.tanggal);
                                $('#tema').val(data.tema);
                                $('#jenis_kegiatan').val(data.jenis_kegiatan);
                                $('#unit_id').val(data.unit_id);
                                $('#status').val(data.status); // biar cocok sama value <option>
                                $('#catatan').val(data.catatan);
                                $('#user_id').val(data.user_id);

                                $('#kegiatanModalLabel').text('Edit Kegiatan');
                                $('#savekegiatan').text('Update');
                                $('#kegiatanModal').modal('show');
                            });
                        });

                        $('#kegiatanForm').submit(function(e) {
                            e.preventDefault();
                            let id = $('#kegiatan_id').val();
                            let url = id ? `/kegiatan/${id}` : '/kegiatan';
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
                                    $('#table_kegiatan').DataTable().ajax.reload();
                                    Swal.fire({
                                        title: 'Success!',
                                        text: response.message,
                                        icon: 'success',
                                        timer: 3000,
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                    });
                                    $('#kegiatanModal').modal('hide');
                                    $('#kegiatanForm')[0].reset();
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
                        $(document).on('click', '.hapus-kegiatan', function() {
                            let id = $(this).data('id');
                            let deleteUrl = '{{ route('kegiatan.destroy', ':id') }}'.replace(':id', id);

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
                                            $('#table_kegiatan').DataTable().ajax
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
