@if($experts->count())
    @foreach($experts as $expert)
        <div class="col-lg-4 col-sm-6 mb-4">
            <div class="colWidget">
                <div class="card p-3 h-100">
                    <div class="cardRow d-flex align-items-center">
                        <div class="cardImg">
                            <img src="{{ $expert->profile_photo_url ?? asset('img/default-user.png') }}"
                                 class="card-img-top" alt="{{ $expert->name }}">
                        </div>

                        <div class="card-body p-0 ms-2">
                            <h5 class="card-title text-truncate">
                                {{ $expert->name }}
                            </h5>
                            <small class="text-muted">
                                {{ $expert->expert->headline ?? 'Tool Expert' }}
                            </small>
                        </div>
                    </div>

                    <p class="text-truncate mt-2">
                        {{ $expert->expert->skills ?? '—' }}
                    </p>

                    <div class="mt-auto">
                        <a href="#"
                           class="arrowLink d-block text-center">
                            Hire Details
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="col-12 text-center text-muted">
        No experts found
    </div>
@endif
