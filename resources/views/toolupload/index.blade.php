@extends('layouts.dashboard')

@section('content')
<div class="content-body">
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
                    <form class="row"
                          method="POST"
                          action="{{ route('toolupload.store') }}"
                          enctype="multipart/form-data">
                        @csrf

                        {{-- Tool Name --}}
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Name of the Tool</label>
                                <input type="text" name="tool_name" class="form-control">
                            </div>
                        </div>

                        {{-- Tool Category --}}
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Tool Category</label>
                                <select name="tool_category" class="form-control form-select">
                                    <option value="">Select Category</option>
                                    <option>AI Writing</option>
                                    <option>Automation</option>
                                    <option>SEO</option>
                                </select>
                            </div>
                        </div>

                        {{-- Sub Category --}}
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Sub Category</label>
                                <select name="sub_category" class="form-control form-select">
                                    <option value="">Select Category</option>
                                    <option>AI Writing</option>
                                    <option>Automation</option>
                                    <option>SEO</option>
                                </select>
                            </div>
                        </div>

                        {{-- Affiliate Link --}}
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Affiliate Link</label>
                                <input type="text" name="affiliate_link" class="form-control">
                            </div>
                        </div>

                        {{-- Pricing Type --}}
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Pricing Type</label>
                                <select name="pricing_type" class="form-control form-select">
                                    <option value="">Select</option>
                                    <option>Free</option>
                                    <option>Freemium</option>
                                    <option>Paid</option>
                                    <option>Lifetime</option>
                                </select>
                            </div>
                        </div>

                        {{-- Pricing Details --}}
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Pricing Details</label>
                                <select name="pricing_details" class="form-control form-select">
                                    <option value="">Select</option>
                                    <option>Starts at $9/month</option>
                                    <option>Free for 3 users</option>
                                </select>
                            </div>
                        </div>

                        {{-- Logo --}}
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Tool Logo</label>
                                <input type="file" name="tool_logo" class="form-control">
                            </div>
                        </div>

                        {{-- Video --}}
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Demo Video</label>
                                <input type="file" name="tool_video" class="form-control">
                            </div>
                        </div>

                        {{-- Video Link --}}
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Video Link</label>
                                <input type="text" name="tool_video_link" class="form-control">
                            </div>
                        </div>

                        {{-- Tags --}}
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Tags</label>
                                <input type="text" name="tags" class="form-control">
                            </div>
                        </div>

                        {{-- Reviews --}}
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Official Reviews URL</label>
                                <input type="text" name="official_reviews_url" class="form-control">
                            </div>
                        </div>

                        {{-- Comparison Group --}}
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Comparison Group</label>
                                <input type="text" name="comparison_group" class="form-control">
                            </div>
                        </div>

                        {{-- Rating --}}
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Rating</label>
                                <input type="text" name="rating" class="form-control">
                            </div>
                        </div>

                        {{-- Status --}}
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Status</label>
                                <select name="status" class="form-control form-select">
                                    <option value="">Select</option>
                                    <option>Active</option>
                                    <option>Rejected</option>
                                    <option>Pending</option>
                                </select>
                            </div>
                        </div>

                        {{-- Use Cases --}}
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Use Cases</label>
                                <textarea name="use_cases" class="form-control" rows="3"></textarea>
                            </div>
                        </div>

                        {{-- Features --}}
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Features</label>
                                <textarea name="features" class="form-control" rows="3"></textarea>
                            </div>
                        </div>

                        {{-- Descriptions --}}
                        <div class="col-md-6">
                            <label class="form-label">Short Description</label>
                            <textarea name="short_description" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Full Description</label>
                            <textarea name="full_description" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="col-md-12 mt-3">
                            <button class="btn btn-primary">Submit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
