@extends('layouts.dashboard')

@section('content')
    <div class="page_title d-flex justify-content-between">
        <h1>Tool Upload</h1>
    </div>

    <div class="right_body-conent">
        <div class="toolUpload py-4">
            <div class="card mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tool upload</h6>
                </div>

                <div class="card-body">

                    {{-- Success message --}}
                    <div class="alert alert-success d-none" id="successBox"></div>

                    <form id="toolUploadForm" class="row needs-validation" method="POST"
                        action="{{ route('toolupload.store') }}" enctype="multipart/form-data" novalidate>
                        @csrf

                        {{-- Tool Name --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Name of the Tool</label>
                            <input type="text" name="tool_name" class="form-control" required>
                            <div class="invalid-feedback">Tool name is required</div>
                        </div>

                        {{-- Tool Category --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Tool Category</label>
                            <select name="tool_category_id" class="form-select" required>
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Please select a category</div>
                        </div>

                        {{-- Sub Category --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Sub Category</label>
                            <select name="sub_category_id" class="form-select" required>
                                <option value="">Select Sub Category</option>
                                @foreach ($subCategories as $sub)
                                    <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Please select a sub category</div>
                        </div>

                        {{-- Affiliate Link --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Your affiliate link</label>
                            <input type="url" name="affiliate_link" class="form-control">
                            <div class="invalid-feedback">Enter a valid affiliate link</div>
                        </div>

                        {{-- Pricing Type --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Pricing Type</label>
                            <select name="pricing_type_id" class="form-select" required>
                                <option value="">Select</option>
                                @foreach ($pricingTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Pricing type is required</div>
                        </div>

                        {{-- Pricing Details --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Pricing Details</label>
                            <select name="pricing_details_id" class="form-select">
                                <option value="">Select</option>
                                @foreach ($pricingDetails as $detail)
                                    <option value="{{ $detail->id }}">{{ $detail->label }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">Pricing Details is required</div>
                        </div>

                        {{-- Tool Logo --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Tool Logo</label>
                            <input type="file" name="tool_logo" class="form-control" accept="image/*">
                            <div class="invalid-feedback">Upload a valid image</div>
                        </div>

                        {{-- Demo Video --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Demo Video of Tool</label>
                            <input type="file" name="tool_video" class="form-control" accept="video/*">
                            <div class="invalid-feedback">Upload a valid video</div>
                        </div>

                        {{-- Video Link --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Video of Tool link</label>
                            <input type="url" name="tool_video_link" class="form-control">
                            <div class="invalid-feedback">Enter a valid URL</div>
                        </div>

                        {{-- Tags --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Tags</label>
                            <input type="text" name="tags" class="form-control"
                                placeholder="GPT, No-Code, Automation">
                            <div class="invalid-feedback">Enter valid tags</div>
                        </div>

                        {{-- Reviews URL --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Official Reviews URL</label>
                            <input type="url" name="official_reviews_url" class="form-control">
                            <div class="invalid-feedback">Enter valid Official Reviews URL</div>
                        </div>

                        {{-- Comparison Group --}}
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Tool Comparison Group</label>
                            <input type="text" name="comparison_group" class="form-control">
                            <div class="invalid-feedback">Enter valid Tool Comparison Group</div>
                        </div>

                        {{-- Use Cases --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Use Cases</label>
                            <textarea name="use_cases" class="form-control" rows="3" required></textarea>
                            <div class="invalid-feedback">Use cases required</div>
                        </div>

                        {{-- Features --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Features</label>
                            <textarea name="features" class="form-control" rows="3" required></textarea>
                            <div class="invalid-feedback">Features required</div>
                        </div>

                        {{-- Descriptions --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Short Description</label>
                            <textarea name="short_description" class="form-control" rows="3" required></textarea>
                            <div class="invalid-feedback">Short Description Required</div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Full Description</label>
                            <textarea name="full_description" class="form-control" rows="3" required></textarea>
                            <div class="invalid-feedback">Full Description Required</div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                Submit
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{-- AJAX + Bootstrap Validation --}}
    <script src="{{ asset('js/tool-upload-form.js') }}"></script>
    <script src="{{ asset('js/tool-upload-single.js') }}"></script>
    <script src="{{ asset('js/tool-upload-bulk.js') }}"></script>
@endpush
