@if($user->hasRole('admin'))

    {{-- ADMIN ACTIONS --}}
    <div class="dropdown">
        <button class="btn btn-sm btn-outline-primary dropdown-toggle"
                data-bs-toggle="dropdown">
            Update Status
        </button>

        <ul class="dropdown-menu">
            <li>
                <button class="dropdown-item text-success"
                        data-id="{{ $tool->id }}"
                        data-status="active">
                    Approve
                </button>
            </li>

            <li>
                <button class="dropdown-item text-warning"
                        data-id="{{ $tool->id }}"
                        data-status="pending">
                    Pending
                </button>
            </li>

            <li>
                <button class="dropdown-item text-danger"
                        data-id="{{ $tool->id }}"
                        data-status="rejected">
                    Reject
                </button>
            </li>
        </ul>
    </div>

@else

    {{-- NORMAL USER ACTIONS --}}
    <div class="btn-group btn-group-sm">
        <a href="{{ route('tools.show', $tool->id) }}"
           class="btn btn-outline-primary">
            View
        </a>

        <a href="{{ route('tools.edit', $tool->id) }}"
           class="btn btn-outline-warning">
            Edit
        </a>
    </div>

@endif
