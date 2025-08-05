<div class="row">
    <div class="col">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#userModal" id="addUserButton"
            style="background: linear-gradient(to right, darkgreen,rgb(0, 136, 0));"><i
                class="bi bi-plus-circle me-2"></i>
            Tambah Data
        </button>
    </div>
</div>

<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">Add User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
            </div>

            <form id="userForm">
                <div class="modal-body">
                    <input type="hidden" id="user_id" name="user_id">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama User</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div>
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div>
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                </div>
                <div class="modal-body">
                    <label for="status" class="form-label">Status</label>
                    <select class="form-select mb-3" aria-label="Default select example" id="status" name="status">
                        <option selected>Pilih status</option>
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                </div>
                <div class="modal-body">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-select mb-3" aria-label="Default select example" id="role_id" name="role_id">
                        @foreach ($roles as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="saveUser">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>
<hr>
{{-- table --}}

<div class="row">
    <div class="col">
        <div class="card shadow">
            <div class="card-header bg-success text-white">
                <h5>Data User</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table_user" class=" table table-bordered border-primary table-sm table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>username</th>
                                <th>Status</th>
                                <th>Role</th>
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
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function fetchData() {
                $('#table_user').DataTable({
                    serverSide: true,
                    processing: true,
                    ajax: {
                        url: "{{ route('user.index') }}",
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
                            data: 'username',
                            name: 'username',
                        },
                        {
                            data: 'status',
                            name: 'status',
                            orderable: false,
                            render: function(data, type, row) {
                                if (data === 1) {
                                    return '<span class="badge bg-success">Aktif</span>';
                                } else {
                                    return '<span class="badge bg-danger">Tidak Aktif</span>';
                                }
                            }
                        },
                        {
                            data: 'role',
                            name: 'role',
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
            $('#addUserButton').click(function() {
                $('#userForm')[0].reset();
                $('#user_id').val('');
                $('#userModalLabel').text('Add user');
                $('#saveUser').text('create');
                $('#userModal').modal('show');
                setTimeout(function() {
                    $('#nama').focus();
                    // $('#user_password').focus();
                }, 500);
                $('#userModal').modal('show');
            });

            // Show modal for updating an existing record
            $(document).on('click', '.edit-user', function() {
                let id = $(this).data('id');

                $.get(`/user/${id}/edit`, function(data) {
                    $('#user_id').val(data.id);
                    $('#nama').val(data.nama);
                    $('#username').val(data.username);
                    $('#status').val(data.status);
                    $('#role_id').val(data.role_id);
                    $('#userModalLabel').text('Edit User');
                    $('#saveUser').text('Update');
                    $('#userModal').modal('show');
                });
            });

            // Handle form submission for both create and update
            $('#userForm').submit(function(e) {
                e.preventDefault();
                let id = $('#user_id').val();
                let url = id ? `/user/${id}` : '/user';
                let method = id ? 'PUT' : 'POST';
                let formData = {
                    nama: $('#nama').val(),
                    username: $('#username').val(),
                    password: $('#password').val(),
                    status: $('#status').val(),
                    role_id: $('#role_id').val(),
                    _token: $('meta[name="csrf-token"]').attr('content'),
                };

                $.ajax({
                    url: url,
                    type: method,
                    data: formData,
                    success: function(response) {
                        $('#table_user').DataTable().ajax.reload();
                        Swal.fire({
                            title: 'success!',
                            text: response.message,
                            icon: 'success',
                            timer: 3000,
                            toast: true,
                            position: 'top-end',
                        });
                        $('#userModal').modal('hide');
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Something went wrong.',
                            icon: 'error',
                            timer: 3000,
                            toast: true,
                            position: 'top-end',
                        });
                    },
                });
            });

            // Hapus Data
            $(document).on('click', '.hapus-user', function() {
                let id = $(this).data('id');
                let deleteUrl = '{{ route('user.destroy', ':id') }}'.replace(':id', id);

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
                                $('#table_user').DataTable().ajax
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
