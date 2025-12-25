@extends('layouts.dashboard')

@section('content')

<div class="page_title d-flex justify-content-between mb-3">
    <h1>Users</h1>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-striped w-100" id="usersTable">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function () {
    $('#usersTable').DataTable({
        processing: true,
        ajax: "{{ route('users.grid.data') }}",

        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'email' },
            { data: 'role' },
            {
                data: 'status',
                orderable: false,
                searchable: false
            },
            {
                data: 'actions',
                orderable: false,
                searchable: false
            }
        ]
    });
});
</script>
@endpush
