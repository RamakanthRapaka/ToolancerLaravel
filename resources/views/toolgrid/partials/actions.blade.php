@php
    $isAdmin = $user->hasRole('admin');
    $isOwner = $tool->user_id === $user->id;
@endphp

@if ($isAdmin)
    {{-- ADMIN ACTIONS --}}
    <div class="dropdown">
        <button class="btn btn-sm btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">
            Update Status
        </button>

        <ul class="dropdown-menu">
            <li>
                <button class="dropdown-item text-success" data-id="{{ $tool->id }}" data-status="active">
                    Approve
                </button>
            </li>

            <li>
                <button class="dropdown-item text-warning" data-id="{{ $tool->id }}" data-status="pending">
                    Pending
                </button>
            </li>

            <li>
                <button class="dropdown-item text-danger" data-id="{{ $tool->id }}" data-status="rejected">
                    Reject
                </button>
            </li>
        </ul>
    </div>
@elseif($isOwner)
    {{-- NORMAL USER ACTIONS (OWNER ONLY) --}}
    <div class="btn-group btn-group-sm">
        <a href="{{ route('tools.show', $tool->id) }}" class="btn btn-outline-primary">
            View
        </a>

        <a href="{{ route('tools.edit', $tool->id) }}" class="btn btn-outline-warning">
            Edit
        </a>
    </div>
@else
    {{-- NORMAL USER (NOT OWNER) --}}
    <div class="btn-group btn-group-sm">
        <a href="{{ route('tools.show', $tool->id) }}" class="btn btn-outline-primary">
            View
        </a>
    </div>
@endif
