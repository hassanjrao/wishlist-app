@extends('layouts.front')

@section('page-title', 'Register')

@section('styles')

    <style>
        .list-inline-with-bullets {
            list-style-type: disc;
            padding-left: 0;
        }

        .list-inline-with-bullets .list-inline-item::before {
            content: "\2022";
            /* Unicode for bullet */
            padding-right: 8px;
        }

        .list-inline-with-bullets .list-inline-item {
            display: inline-block;
            padding-right: 15px;
        }
    </style>

@endsection

@section('content')


    <div class="hero-static bg-body-extra-light py-5">

        <div class="p-4 w-100 flex-grow-1 d-flex align-items-center">
            <div class="w-100">
                <register />
            </div>
        </div>

    </div>


    </div>
    <!-- END Page Content -->
@endsection
