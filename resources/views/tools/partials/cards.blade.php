@if($tools->count())
    @foreach($tools as $tool)
        <div class="col-md-6 mb-4">
            <div class="card p-3 h-100">

                <div class="d-flex align-items-center">
                    <img src="{{ $tool->logo_url }}" alt="{{ $tool->tool_name }}"
                         class="me-3" width="50">

                    <div class="flex-grow-1">
                        <h5 class="mb-0 text-truncate">{{ $tool->tool_name }}</h5>
                        <small class="text-muted">
                            {{ $tool->category->name ?? '' }}
                        </small>
                    </div>

                    <span class="badge rounded-pill text-grey">
                        {{ $tool->pricingType->name ?? 'Free' }}
                    </span>
                </div>

                <div class="text-end mt-3">
                    <a class="arrowLink" href="{{ route('tools.show', $tool->id) }}">
                        View Details
                    </a>
                </div>

            </div>
        </div>
    @endforeach
@else
    <div class="col-12 text-center text-muted">
        No tools found
    </div>
@endif
