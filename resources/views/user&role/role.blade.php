<div class="row">
    <div class="col">
        <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal"
            data-bs-target="#roleModal" id="addRoleButton"
            style="background: linear-gradient(to right, darkgreen,rgb(0, 136, 0));"><i
                class="bi bi-plus-circle me-2"></i>
            Tambah Data
        </button>
    </div>
</div>

<div class="modal fade" id="roleModal" tabindex="-1" aria-labelledby="roleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="roleModalLabel">Add Role</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="roleForm">
                <div class="modal-body">
                    <input type="hidden" id="role_id" name="role_id">
                    <div class="mb-3">
                        <label for="role_name" class="form-label">Nama Role</label>
                        <input type="text" class="form-control" id="role_name" name="nama" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="saveRole">Save</button>
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
            <div class="card-header bg-primary text-white">
                <h5>Data Role</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table_role" class="table table-bordered border-primary table-sm table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th width='8%'>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- modal --}}

    @push('script')
        <script>
            $(document).ready(function() {
                fetchData();

                // Include CSRF token in all AJAX requests
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // ambil data
                function fetchData() {
                    $('#table_role').DataTable({
                        serverSide: true,
                        processing: true,
                        ajax: {
                            url: "{{ route('role.index') }}",
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
                        ], // Default ordering by the second column (kode_role)
                        responsive: true, // Makes the table responsive
                        autoWidth: false, // Prevents auto-sizing of columns
                        lengthMenu: [
                            [10, 25, 50, -1],
                            [10, 25, 50, "All"]
                        ], // Prevents auto-sizing of columns
                        pageLength: 10, // Default page length
                    })
                }

                // Show modal for creating a new record
                $('#addRoleButton').click(function() {
                    $('#roleForm')[0].reset(); // Clear the form
                    $('#role_id').val(''); // Clear hidden input
                    $('#roleModalLabel').text('Add Role'); // Set modal title
                    $('#saveRole').text('Create'); // Change button text
                    $('#roleModal').modal('show'); // Show modal
                    setTimeout(function() {
                        $('#role_name').focus();
                    }, 500); //focus input
                    $('#roleModal').modal('show'); // Show modal
                });

                // Show modal for updating an existing record
                $(document).on('click', '.edit-role', function() {
                    let id = $(this).data('id');
                    // Fetch data from server using the ID
                    $.get(`/role/${id}/edit`, function(data) {
                        $('#role_id').val(data.id); // Populate hidden input
                        $('#role_name').val(data.nama); // Populate nama
                        $('#roleModalLabel').text('Edit Role'); // Set modal title
                        $('#saveRole').text('Update'); // Change button text
                        $('#roleModal').modal('show');
                    });
                });

                // Handle form submission for both create and update
                $('#roleForm').submit(function(e) {
                    e.preventDefault(); // Prevent default form submission
                    let id = $('#role_id').val();
                    let url = id ? `/role/${id}` : '/role'; // Update if ID exists, otherwise create
                    let method = id ? 'PUT' : 'POST'; // HTTP method
                    let formData = {
                        nama: $('#role_name').val(),
                        _token: $('meta[name="csrf-token"]').attr('content'),
                    };

                    $.ajax({
                        url: url,
                        type: method,
                        data: formData,
                        success: function(response) {
                            $('#table_role').DataTable().ajax.reload();
                            Swal.fire({
                                title: 'Success!',
                                text: response.message,
                                icon: 'success',
                                timer: 3000,
                                toast: true,
                                position: 'top-end',
                            });
                            $('#roleModal').modal('hide'); // Hide the modal
                            // Refresh the data table or UI
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
                $(document).on('click', '.hapus-role', function() {
                    let id = $(this).data('id');
                    let deleteUrl = '{{ route('role.destroy', ':id') }}'.replace(':id', id);

                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'This action cannot be undone!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Yes, delete it!',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: deleteUrl,
                                type: 'DELETE',
                                data: {
                                    _token: "{{ csrf_token() }}"
                                },
                                success: function(response) {
                                    $('#table_role').DataTable().ajax
                                        .reload(); // Reload the DataTable
                                    Swal.fire('Deleted!', response.message, 'success');
                                },
                                error: function(xhr) {
                                    Swal.fire('Error!', 'Failed to delete record.',
                                        'error ');
                                },
                            });
                        }
                    });
                });
            })
        </script>
    @endpush
