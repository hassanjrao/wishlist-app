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
                    @if (!auth()->user()->is_approved)
                        <div class="alert alert-info">
                            We are reviewing your income and kids information. We will notify you once your wishlists are
                            approved.
                        </div>
                    @else
                        <div class="alert alert-success">
                            Your wishlists are approved.
                        </div>
                    @endif
                </div>

                <wishlist :genders='{{ $genders }}'/>

            </div>
        </div>
    </div>
    <!-- END Hero -->
@endsection
