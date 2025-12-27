{{-- resources/views/home.blade.php --}}
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
                            <a class="arrowLink" href="{{ url('expert-tools') }}">Latest Tools</a>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a class="arrowLink_Nbg border border-1" href="{{ url('expert-users') }}">Tools Expert</a>
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

    <section class="howit py-5">
        <div class="container-lg">
            <div class="row justify-content-center">
                <div class="col-11 offset-lg-1">
                    <div class="mainTitle pb-3">
                        <h2>How It Works</h2>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="colWidget text-center">
                        <div class="card border border-0">
                            <div class="cardImg">
                                <img src="{{ asset('img/tellus.png') }}" class="card-img-top" alt="iconImage">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Tell us your goal</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="colWidget text-center">
                        <div class="card border border-0">
                            <div class="cardImg">
                                <img src="{{ asset('img/recommend.png') }}" class="card-img-top" alt="iconImage">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">We recommend tools</h5>
                                <p>(of you browse)</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="colWidget text-center">
                        <div class="card border border-0">
                            <div class="cardImg">
                                <img src="{{ asset('img/hireexp.png') }}" class="card-img-top" alt="iconImage">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Hire Experts</h5>
                                <p>to execute(if need)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="exploreTool py-5">
        <div class="container-lg">
            <div class="col-10 offset-1">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class=" mainTitle pb-4">
                            <h2>Explore Tools</h2>
                        </div>
                    </div>

                    {{-- Repeated cards – you can later loop these from DB --}}
                    @foreach ($tools as $tool)
                        <div class="col-sm-6 col-md-4 col-lg-3">
                            <div class="colWidget">
                                <div class="card px-3 py-2">
                                    <div class="cardRow d-flex align-items-center">
                                        <div class="cardImg">
                                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRTaA3_cb-XzsW4FflXlD9nbnk5UCj0lzM9Fg&s"
                                                class="card-img-top" alt="iconImage">
                                        </div>
                                        <div class="card-body p-0">
                                            <h5 class="card-title text-truncate">Slack Team</h5>
                                        </div>
                                    </div>
                                    <p class="text-truncate">Team Communication</p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    {{-- copy/paste your other cards as they are – no PHP needed --}}
                    {{-- ... (keep the rest of your tool cards unchanged) ... --}}

                    <div class="d-flex justify-content-end">
                        <a class="arrowLink" href="{{ url('expert-tools') }}">
                            View All Tools
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="meetTolancer py-5">
        <div class="container-lg">
            <div class="col-10 offset-1">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class=" mainTitle pb-4">
                            <h2>Meet Toolancer <small>(Tools Expert)</small></h2>
                        </div>
                    </div>

                    @foreach ($experts as $expert)
                    <div class="col-lg-3 col-sm-6">
                        <div class="colWidget">
                            <div class="card p-3">
                                <div class="cardRow d-flex align-items-center">
                                    <div class="cardImg">
                                        <img src="https://s3.amazonaws.com/media.mixrank.com/profilepic/bcafe3d79a402d97856f8f5368888019"
                                            class="card-img-top" alt="iconImage">
                                    </div>
                                    <div class="card-body p-0">
                                        <h5 class="card-title text-truncate">Mak Johnson</h5>
                                        <h6>405th</h6>
                                    </div>
                                </div>
                                <p class="text-truncate">SEO, Ahrets</p>
                                <div class="col-12">
                                    <a class="arrowLink d-block text-center" href="#">Hire Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

                    {{-- repeat the other 3 expert cards same as your original --}}

                    <div class="d-flex justify-content-end">
                        <a class="arrowLink" href="{{ url('expert-users') }}">View All Experts</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
