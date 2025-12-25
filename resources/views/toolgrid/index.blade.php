@extends('layouts.dashboard')

@section('content')

<div class="page_title d-flex justify-content-between align-items-center mb-3">
    <h1>Categories</h1>

    <a href="{{ route('toolupload.index') }}" class="btn btn-sm btn-primary">
        Upload Tool
    </a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-striped align-middle w-100" id="toolsTable">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Sub Category</th>
                    <th>Pricing Type</th>
                    <th>Pricing Detail</th>
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
        $('#toolsTable').DataTable({
            processing: true,
            serverSide: false, // change to true later if needed
            ajax: "{{ route('tools.grid.data') }}",

            columns: [
                {data: 'id'},
                { data: 'tool_name' },
                { data: 'category' },
                { data: 'sub_category' },
                { data: 'pricing_type' },
                { data: 'pricing_detail' },
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
