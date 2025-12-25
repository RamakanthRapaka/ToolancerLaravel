@extends('layouts.dashboard')

@section('content')

@php
    $isEdit = $mode === 'edit';
@endphp

<div class="page_title d-flex justify-content-between align-items-center mb-4">
    <h1>Profile Details</h1>

    @if(!$isEdit)
        <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-primary">
            Edit Profile
        </a>
    @endif
</div>

<div class="card">
    <div class="card-body">
        <form
            method="POST"
            action="{{ $isEdit ? route('profile.update') : '#' }}"
            enctype="multipart/form-data"
        >
            @csrf
            @if($isEdit)
                @method('PUT')
            @endif

            <div class="row">

                {{-- Profile Image --}}
                <div class="col-md-12 mb-4 text-center">
                    <img
                        src="{{ $expert && $expert->profile_file
                            ? asset('storage/'.$expert->profile_file)
                            : asset('img/default-avatar.png') }}"
                        class="rounded-circle mb-3"
                        width="120"
                        height="120"
                    >

                    @if($isEdit && $user->hasRole('expert'))
                        <input type="file" name="profile_image" class="form-control w-50 mx-auto">
                    @endif
                </div>

                {{-- ================= USER FIELDS ================= --}}

                <div class="col-md-4 mb-3">
                    <label class="form-label">User Name</label>
                    <input type="text" class="form-control"
                        value="{{ $user->name }}"
                        {{ $isEdit ? '' : 'readonly' }}>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Display Name</label>
                    <input type="text" name="display_name" class="form-control"
                        value="{{ $user->display_name }}"
                        {{ $isEdit ? '' : 'readonly' }}>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control"
                        value="{{ $user->email }}"
                        {{ $isEdit ? '' : 'readonly' }}>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Mobile</label>
                    <input type="text" name="mobile" class="form-control"
                        value="{{ $user->mobile }}"
                        {{ $isEdit ? '' : 'readonly' }}>
                </div>

                {{-- ================= EXPERT ONLY ================= --}}
                @if($user->hasRole('expert') && $expert)

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Expertise Tags</label>
                        <input type="text" name="expertise_tags" class="form-control"
                            value="{{ $expert->expertise_tags }}"
                            {{ $isEdit ? '' : 'readonly' }}>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Tools Known</label>
                        <input type="text" name="tools_known" class="form-control"
                            value="{{ $expert->tools_known }}"
                            {{ $isEdit ? '' : 'readonly' }}>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Skills</label>
                        <input type="text" name="skills" class="form-control"
                            value="{{ $expert->skills }}"
                            {{ $isEdit ? '' : 'readonly' }}>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Location</label>
                        <input type="text" name="location" class="form-control"
                            value="{{ $expert->location }}"
                            {{ $isEdit ? '' : 'readonly' }}>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Languages</label>
                        <input type="text" name="languages" class="form-control"
                            value="{{ $expert->languages }}"
                            {{ $isEdit ? '' : 'readonly' }}>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Hourly Rate</label>
                        <input type="text" name="rate" class="form-control"
                            value="{{ $expert->rate }}"
                            {{ $isEdit ? '' : 'readonly' }}>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Portfolio URL</label>
                        <input type="url" name="portfolio_url" class="form-control"
                            value="{{ $expert->portfolio_url }}"
                            {{ $isEdit ? '' : 'readonly' }}>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Short Bio</label>
                        <textarea name="short_bio" class="form-control"
                            {{ $isEdit ? '' : 'readonly' }}>{{ $expert->short_bio }}</textarea>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Profile Bio</label>
                        <textarea name="profile_bio" rows="4" class="form-control"
                            {{ $isEdit ? '' : 'readonly' }}>{{ $expert->profile_bio }}</textarea>
                    </div>

                @endif

            </div>

            {{-- ACTIONS --}}
            @if($isEdit)
                <div class="mt-4 text-end">
                    <a href="{{ route('profile.show') }}" class="btn btn-secondary">
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Update Profile
                    </button>
                </div>
            @endif

        </form>
    </div>
</div>

@endsection
