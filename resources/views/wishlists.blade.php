@extends('layouts.front')

@section('page-title', 'Wishlists')


@section('content')
    <!-- Hero -->


    <div id="one-hero-after" class="bg-body-extra-light py-5">
        <div class="content">

            <form method="GET" action="{{ route('wishlists') }}">


                <div class="row align-items-center">


                    <div class="col-md-3 col-xl-3 mb-5">
                        <div class="form-group">
                            <label for="month">Filter By Month</label>
                            <select id="monthSelect" name="month" class="form-select">
                                <option {{ $month == 'all' ? 'selected' : '' }} value="all">All</option>
                                <option {{ $month == '01' ? 'selected' : '' }} value="01">January</option>
                                <option {{ $month == '02' ? 'selected' : '' }} value="02">February</option>
                                <option {{ $month == '03' ? 'selected' : '' }} value="03">March</option>
                                <option {{ $month == '04' ? 'selected' : '' }} value="04">April</option>
                                <option {{ $month == '05' ? 'selected' : '' }} value="05">May</option>
                                <option {{ $month == '06' ? 'selected' : '' }} value="06">June</option>
                                <option {{ $month == '07' ? 'selected' : '' }} value="07">July</option>
                                <option {{ $month == '08' ? 'selected' : '' }} value="08">August</option>
                                <option {{ $month == '09' ? 'selected' : '' }} value="09">September</option>
                                <option {{ $month == '10' ? 'selected' : '' }} value="10">October</option>
                                <option {{ $month == '11' ? 'selected' : '' }} value="11">November</option>
                                <option {{ $month == '12' ? 'selected' : '' }} value="12">December</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3 col-xl-3 mb-5">
                        <div class="form-group">
                            <label for="dob">Filter By Age</label>
                            <input type="number" class="form-control" id="age" name="age" placeholder="Age"
                                value="{{ request()->age }}">
                        </div>
                    </div>

                    <div class="col-md-3 col-xl-3 mb-5">
                        <div class="form-group">
                            <label for="state">Filter By State</label>
                            <select required class="form-select" id="state" name="state">
                                <option value="all">All</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}" @if ($state->id == request()->state) selected @endif>
                                        {{ $state->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3 col-xl-3 mb-5 mt-4 d-flex">
                        {{-- filter button --}}
                        <div>
                            <label for=""></label>
                            <button class="btn btn-primary" id="filter">Filter</button>
                        </div>
                        {{-- clear filter --}}
                        <div>
                            <label for=""></label>
                            <a href="{{ route('wishlists') }}" class="btn btn-danger">Clear Filters</a>
                        </div>
                    </div>
                </div>

            </form>

            <div class="row">

                @foreach ($wishLists as $wishList)
                    <div class="col-sm-6 col-xs-6 col-md-3 col-xl-3 mb-5">
                        <div class="block block-rounded h-100 mb-0">
                            <div class="block-content p-1">
                                <div class="options-container" style="height: 200px; width:100%">
                                    @if ($wishList->image_url)
                                        <img class="img-fluid options-item" style="height: 200px; width:100%"
                                            src="{{ $wishList->image_url }}" alt="">
                                    @else
                                        <img class="img-fluid options-item" style="height: 200px; width:100%"
                                            src="{{ asset('media/wishlist.png') }}" alt="">
                                    @endif
                                    <div class="options-overlay bg-black-75">
                                        <div class="options-overlay-content">
                                            <a class="btn btn-sm btn-alt-secondary" target="_blank"
                                                href="{{ $wishList->wish_list_link }}">
                                                View Wishlist
                                                <i class="fa fa-link"></i>
                                            </a>


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="block-content">
                                <div class="mb-1 d-flex justify-content-between text-left">

                                    <p class="h6"><span>Name:</span><br>{{ $wishList->name }}</p>

                                    <p class="h6"><span>DOB:</span><br>{{ $wishList->date_of_birth }}</p>
                                </div>

                                <div class="mb-1 d-flex justify-content-between text-start">

                                    <p class="h6"><span>Age:</span> {{ $wishList->age }}</p>
                                    <p class="h6"><span>State:</span> {{ $wishList->user->state->name }}</p>

                                </div>
                                <p class="fs-sm text-muted">
                                    {{ $wishList->about }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="col-lg-12 d-flex justify-content-center">
                    {{ $wishLists->links() }}
                </div>

            </div>

        </div>
    </div>

@endsection
