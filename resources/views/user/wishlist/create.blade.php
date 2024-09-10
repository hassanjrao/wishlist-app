@extends('layouts.front')

@section('page-title', 'Home')

@section('content')
    <!-- Hero -->

    @php
            $genders=json_encode(\App\Models\WishList::genders());

    @endphp

    <div id="one-hero-after" class="bg-body-extra-light py-5">

        <div class="content content-boxed">

            <div class="hero-static">


                <div class="col-lg-12">
                    @if (auth()->user()->has_tax_return && !auth()->user()->is_verified_low_income)
                        <div class="alert alert-info">
                            We are reviewing your income. We will notify you once it's verified
                        </div>
                    @elseif (auth()->user()->has_tax_return && auth()->user()->is_verified_low_income)
                        <div class="alert alert-info">
                            Your income is verified.
                        </div>
                    @elseif (!auth()->user()->is_approved)
                        <div class="alert alert-danger">
                            Your account has been disabled.
                        </div>
                    @endif
                </div>

                <wishlist :genders='{{ $genders }}'/>

            </div>
        </div>
    </div>
    <!-- END Hero -->
@endsection
