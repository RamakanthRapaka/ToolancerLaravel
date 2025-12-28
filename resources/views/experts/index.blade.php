@extends('layouts.app')

@section('content')
    <section class="heroBanner py-5 position-relative">
        <div class="container py-lg-5 pb-5">
            <div class="row align-items-center">
                <div class="col-md-6 offset-lg-1 text-white pb-lg-0 pb-5">
                    <h2>Navigate the AI Wave with Expertice</h2>
                    <p>Find the right AI Tool and tools expert to power your business.</p>
                    <div class="d-flex gap-3">
                        <div class="d-flex justify-content-end">
                            <a class="arrowLink" href="{{ route('expert.tools') }}">Latest Tools</a>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a class="arrowLink_Nbg border border-1" href="{{ route('expert.users') }}">Tools Expert</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="bannerImg">
                        <img src="{{ asset('img/banner1.jpg') }}" alt="banner" class="img-fluid">
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="servicesSec py-5">
        <div class="container">
            <div class="row">
                <div class="tabsForservice">
                    <div class="mb-3">
                        <span class="search-container position-relative">
                            <input type="text" class="form-control search-input" placeholder="Search...">
                            <span class="search-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-search" viewBox="0 0 16 16">
                                    <path
                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                </svg>
                            </span>
                        </span>
                    </div>
                    <ul class="list-unstyled d-flex flex-wrap gap-4 justify-content-center">
                        <li data-aos="fade-up" data-aos-duration="200" id="all" class="active">All</li>
                        <li data-aos="fade-up" data-aos-duration="100" id="marketing">Marketing</li>
                        <li data-aos="fade-up" data-aos-duration="200" id="ai">AI</li>
                        <li data-aos="fade-up" data-aos-duration="200" id="automation">Automation</li>
                        <li data-aos="fade-up" data-aos-duration="200" id="crm">CRM</li>
                        <li data-aos="fade-up" data-aos-duration="200" id="design">Design</li>
                        <li data-aos="fade-up" data-aos-duration="200" id="email">Email</li>
                        <li data-aos="fade-up" data-aos-duration="200" id="analytics">Analytics</li>
                    </ul>
                </div>
                <div class="tabContent gridcontent py-4">
                    <div class="tabs">
                        <div class="col-10 m-auto">
                            <div class="row justify-content-start" id="expertsContainer">
                                {{-- AJAX experts will load here --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
<script>
    window.EXPERT_AJAX_URL = "{{ route('expert.users.ajax') }}";
</script>
