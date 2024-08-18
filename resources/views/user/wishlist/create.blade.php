@extends('layouts.front')

@section('page-title', 'Home')

@section('content')
    <!-- Hero -->
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
            <div class="p-4 w-100 flex-grow-1 d-flex align-items-center">
                <div class="w-100">
                    <wishlist />
                </div>
            </div>

        </div>
    </div>
    <!-- END Hero -->
@endsection
