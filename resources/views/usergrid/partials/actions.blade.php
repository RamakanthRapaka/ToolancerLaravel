<div class="btn-group btn-group-sm">
    <a href="{{ route('users.show', $user->id) }}"
       class="btn btn-outline-primary">
        View
    </a>

    @if(auth()->user()->hasRole('admin'))
        <a href="{{ route('users.edit', $user->id) }}"
           class="btn btn-outline-warning">
            Edit
        </a>
    @endif
</div>
