@extends('layouts.front')

@section('page-title', 'Register')

@section('content')
    <!-- Page Content -->
            <!-- Meta Info Section -->
            {{-- <div class="hero-static col-lg-4  d-lg-flex flex-column justify-content-center">
                <div class="p-4 p-xl-5 flex-grow-1 d-flex align-items-center">
                    <div class="w-100">
                        <a class="link-fx fw-semibold fs-2 text-white" href="index.html">
                            {{ config('app.name') }}
                        </a>
                        <p class="text-white-75 me-xl-8 mt-2">
                            Creat a new account to register wishlists of your children.

                        </p>
                        <p class="text-white">
                            Your income should be in following range:
                        </p>
                        <ul class="text-white">
                            <li>$25,820 1 kid</li>
                            <li>
                                $31,200 2 kid</li>
                            <li>
                                $36,580 3 kid</li>
                            <li>
                                $41,960 4 kid</li>
                            <li>
                                $47,340 5 kid</li>
                            <li>
                                $52,720 6 kid</li>
                        </ul>
                        <p class="text-white">
                            We will verify income levels based on tax returns and verify kids by birth certificates
                        </p>
                    </div>
                </div>

            </div> --}}
            <!-- END Meta Info Section -->

            <!-- Main Section -->

            <!-- END Main Section -->
        {{-- </div> --}}

        <div class="hero-static">

            <div class="p-4 w-100 flex-grow-1 d-flex align-items-center">
                <div class="w-100">
                   <register/>
                </div>
            </div>

        </div>


    </div>
    <!-- END Page Content -->
@endsection
