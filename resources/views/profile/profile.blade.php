@extends('layouts.dashboard')

@section('content')

<div class="page_title d-flex justify-content-between">
    <h1>Profile Details</h1>
</div>

<div class="right_body-conent">
    <div class="wrapper">

        <div class="user-card">

            {{-- LEFT IMAGE (UNCHANGED) --}}
            <div class="user-card-img">
                <img
                    src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjxivAs4UknzmDfLBXGMxQkayiZDhR2ftB4jcIV7LEnIEStiUyMygioZnbLXCAND-I_xWQpVp0jv-dv9NVNbuKn4sNpXYtLIJk2-IOdWQNpC2Ldapnljifu0pnQqAWU848Ja4lT9ugQex-nwECEh3a96GXwiRXlnGEE6FFF_tKm66IGe3fzmLaVIoNL/s1600/img_avatar.png"
                    alt="Profile Avatar">
            </div>

            {{-- RIGHT FORM --}}
            <div class="user-card-info">
                <h2>{{ $user->display_name ?? $user->name }}</h2>

                <form method="POST"
                      action="{{ route('profile.update') }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        {{-- USER FIELDS --}}
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">User Name</label>
                                <input type="text" class="form-control" value="{{ $user->name }}" readonly>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Display Name</label>
                                <input type="text" name="display_name" class="form-control"
                                       value="{{ $user->display_name }}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control"
                                       value="{{ $user->email }}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Mobile</label>
                                <input type="text" name="mobile" class="form-control"
                                       value="{{ $user->mobile }}">
                            </div>
                        </div>

                        {{-- EXPERT FIELDS --}}
                        @if($user->hasRole('expert') && $expert)

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Expertise Tags</label>
                                    <input type="text" name="expertise_tags" class="form-control"
                                           value="{{ $expert->expertise_tags }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Tools Known</label>
                                    <input type="text" name="tools_known" class="form-control"
                                           value="{{ $expert->tools_known }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Skills</label>
                                    <input type="text" name="skills" class="form-control"
                                           value="{{ $expert->skills }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Location</label>
                                    <input type="text" name="location" class="form-control"
                                           value="{{ $expert->location }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Languages</label>
                                    <input type="text" name="languages" class="form-control"
                                           value="{{ $expert->languages }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Hourly Rate / Price Range</label>
                                    <input type="text" name="rate" class="form-control"
                                           value="{{ $expert->rate }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Portfolio URL</label>
                                    <input type="text" name="portfolio_url" class="form-control"
                                           value="{{ $expert->portfolio_url }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Profile Image</label>
                                    <input type="file" name="profile_image" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Short Bio</label>
                                    <textarea name="short_bio" class="form-control">{{ $expert->short_bio }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Profile Bio</label>
                                    <textarea name="profile_bio" class="form-control">{{ $expert->profile_bio }}</textarea>
                                </div>
                            </div>

                        @endif
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary d-block text-center">
                            Update Profile
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
