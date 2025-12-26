@extends('layouts.dashboard')

@section('content')

    <div class="page_title d-flex justify-content-between">
        <h1>Profile Details</h1>
    </div>

    <div class="right_body-conent">
        <div class="wrapper">

            <div class="user-card">

                {{-- LEFT IMAGE (ORIGINAL – DO NOT CHANGE) --}}
                <div class="user-card-img">
                    <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEjxivAs4UknzmDfLBXGMxQkayiZDhR2ftB4jcIV7LEnIEStiUyMygioZnbLXCAND-I_xWQpVp0jv-dv9NVNbuKn4sNpXYtLIJk2-IOdWQNpC2Ldapnljifu0pnQqAWU848Ja4lT9ugQex-nwECEh3a96GXwiRXlnGEE6FFF_tKm66IGe3fzmLaVIoNL/s1600/img_avatar.png"
                        alt="Profile Avatar">
                </div>

                {{-- RIGHT FORM --}}
                <div class="user-card-info">
                    <h2>{{ $user->display_name ?? $user->name }}</h2>

                    {{-- SUCCESS MESSAGE --}}
                    <div class="alert alert-success d-none" id="successBox"></div>

                    <form id="profileForm" method="POST" action="{{ route('profile.update') }}"
                        enctype="multipart/form-data" class="needs-validation" novalidate>
                        @csrf
                        @method('PUT')

                        <div class="row">

                            {{-- ================= USER FIELDS ================= --}}
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
                                        value="{{ $user->display_name }}" required>
                                    <div class="invalid-feedback">Display name is required</div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ $user->email }}"
                                        required>
                                    <div class="invalid-feedback">Enter a valid email</div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Mobile</label>
                                    <input type="text" name="mobile" class="form-control" value="{{ $user->mobile }}"
                                        required>
                                    <div class="invalid-feedback">Mobile number is required</div>
                                </div>
                            </div>

                            {{-- ================= EXPERT FIELDS ================= --}}
                            @if ($user->hasRole('expert') && $expert)
                                {{-- TAGS (selectpicker) --}}
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Tags</label>
                                        <select class="form-control selectpicker" name="tags[]" multiple
                                            data-live-search="true" required>
                                            @foreach (['AI', 'Automation', 'Chatbot', 'Machine Learning', 'Data Analytics'] as $tag)
                                                <option value="{{ $tag }}"
                                                    {{ in_array($tag, explode(',', $expert->tags ?? '')) ? 'selected' : '' }}>
                                                    {{ $tag }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Please select at least one tag
                                        </div>
                                    </div>
                                </div>

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
                                        <input type="url" name="portfolio_url" class="form-control"
                                            value="{{ $expert->portfolio_url }}" required>
                                        <div class="invalid-feedback">Enter a valid URL</div>
                                    </div>
                                </div>

                                {{-- FILE INPUT --}}
                                {{-- PROFILE IMAGE UPLOAD + PREVIEW (RIGHT SIDE ONLY) --}}
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Profile Image</label>

                                        <input type="file" name="profile_image" class="form-control" accept="image/*"
                                            onchange="previewProfileImage(event)">

                                        {{-- Existing image preview --}}
                                        @if (!empty($expert->profile_file))
                                            <div class="mt-2">
                                                <img id="existingProfileImage"
                                                    src="{{ asset('storage/' . $expert->profile_file) }}"
                                                    alt="Profile Image" class="img-thumbnail" style="max-width:120px;">
                                            </div>
                                        @endif

                                        {{-- New image preview --}}
                                        <div class="mt-2 d-none" id="newImagePreviewBox">
                                            <img id="newProfileImage" class="img-thumbnail" style="max-width:120px;">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Short Bio</label>
                                        <textarea name="short_bio" class="form-control" rows="2" required>{{ $expert->short_bio }}</textarea>
                                        <div class="invalid-feedback">Short bio is required</div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Profile Bio</label>
                                        <textarea name="profile_bio" class="form-control" rows="2" required>{{ $expert->profile_bio }}</textarea>
                                        <div class="invalid-feedback">Profile bio is required</div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="col-12">
                            <button type="submit" id="submitBtn" class="btn btn-primary d-block text-center">
                                Update Profile
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const form = document.getElementById('profileForm');
            const submitBtn = document.getElementById('submitBtn');
            const successBox = document.getElementById('successBox');

            // clear selectpicker validation
            $('.selectpicker').on('changed.bs.select', function() {
                this.classList.remove('is-invalid');
            });

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                successBox.classList.add('d-none');
                successBox.innerText = '';

                if (!form.checkValidity()) {
                    form.classList.add('was-validated');
                    return;
                }

                submitBtn.disabled = true;
                submitBtn.innerText = 'Updating...';

                const formData = new FormData(form);

                fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: formData
                    })
                    .then(async res => {
                        submitBtn.disabled = false;
                        submitBtn.innerText = 'Update Profile';

                        if (res.status === 422) {
                            const data = await res.json();
                            showErrors(data.errors);
                            return;
                        }

                        if (!res.ok) {
                            alert('Something went wrong');
                            return;
                        }

                        const data = await res.json();
                        successBox.classList.remove('d-none');
                        successBox.innerText = data.message || 'Profile updated successfully';
                        form.classList.remove('was-validated');
                    })
                    .catch(() => {
                        submitBtn.disabled = false;
                        submitBtn.innerText = 'Update Profile';
                        alert('Network error');
                    });
            });

            function showErrors(errors) {
                form.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));

                let firstError = null;

                for (const field in errors) {
                    let input = form.querySelector(`[name="${field}"]`);
                    if (!input) {
                        input = form.querySelector(`[name="${field}[]"]`);
                    }

                    if (!input) continue;

                    input.classList.add('is-invalid');

                    if (input.classList.contains('selectpicker')) {
                        $(input).selectpicker('setStyle', 'is-invalid', 'add');
                    }

                    let feedback = input.closest('.mb-3')?.querySelector('.invalid-feedback');
                    if (!feedback) {
                        feedback = document.createElement('div');
                        feedback.className = 'invalid-feedback';
                        input.closest('.mb-3').appendChild(feedback);
                    }
                    feedback.innerText = errors[field][0];

                    if (!firstError) firstError = input;
                }

                if (firstError) {
                    firstError.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                    firstError.focus();
                }
            }
        });
    </script>
    <script>
        function previewProfileImage(event) {
            const input = event.target;
            const previewBox = document.getElementById('newImagePreviewBox');
            const previewImg = document.getElementById('newProfileImage');

            if (!input.files || !input.files[0]) return;

            const reader = new FileReader();

            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewBox.classList.remove('d-none');
            };

            reader.readAsDataURL(input.files[0]);
        }
    </script>
@endpush
