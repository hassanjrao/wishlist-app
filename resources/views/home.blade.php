@extends('layouts.front')

@section('page-title', 'Home')


@section('content')
    <!-- Hero -->

    <div id="one-hero-after" class="bg-body-light py-5">
        <div class="content">

            <h1 class='text-center'>How it Works?</h1>
            <div class="row py-5">
                <div class="col-6 col-md-4">
                    <div class="item item-rounded my-4 text-amethyst bg-amethyst-lighter">
                        <i class="fab fa-fw fa-2x fa-wpforms"></i>
                    </div>
                    <h4 class="mb-2">Enter your Information</h4>
                    <p class="text-muted">
                        Name, Email, Password
                    </p>
                </div>
                <div class="col-6 col-md-4">
                    <div class="item item-rounded my-4 text-amethyst bg-amethyst-lighter">
                        <i class="fa fa-fw fa-2x fa-certificate"></i>
                    </div>
                    <h4 class="mb-2">Upload your Income Certificate</h4>

                </div>

                <div class="col-6 col-md-4">
                    <div class="item item-rounded my-4 text-amethyst bg-amethyst-lighter">
                        <i class="fa fa-solid fa-2x fa-heart"></i>
                    </div>
                    <h4 class="mb-2">Submit WishLists</h4>

                </div>


            </div>
        </div>
    </div>


    <div class="bg-image"
        style="background-image: url('{{ asset('media/photos/balloons.jpg') }}'); height: 200px; background-position: 0% 80%;">
        <div class="bg-primary-dark-op d-flex align-items-center"
            style='height:inherit; background-color: rgba(96, 85, 99, 0.5) !important'>
            <div class="content content-full">
                <div class="py-3 text-center">

                    <h2 class="h3 fw-medium text-white mb-0">
                        Currently, 16% of all children in the United States — 11.6 million kids total — are living in
                        poverty
                    </h2>
                </div>
            </div>
        </div>
    </div>


    <div id="one-hero-after" class="bg-body-light py-5">


        <div class="content">

            <h1 class='text-center'>This month Birthdays</h1>
            <br>
            <div class="row">
                <div class="js-slider" data-autoplay="true" data-dots="true" data-arrows="true" data-slides-to-show="3">

                    @foreach ($wishLists as $wishList)
                        <div class="col-sm-6 col-xs-6 col-md-6 col-xl-4 ml-5" style="margin-right: 30px !important">
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
                                                <a class="btn btn-sm btn-alt-secondary" target="__blank"
                                                    href="{{ $wishList->wish_list_link }}">
                                                    View Wishlist
                                                    <i class="fa fa-link"></i>
                                                </a>

                                                <a class="btn btn-sm btn-alt-secondary"
                                                    href="be_pages_ecom_store_product.html">
                                                    View Details
                                                </a>


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="block-content">
                                    <div class="mb-1 d-flex justify-content-between">

                                        <p class="h6"><span>Name:</span><br>{{ $wishList->name }}</p>

                                        <p class="h6"><span>DOB:</span><br>{{ $wishList->date_of_birth }}</p>
                                    </div>

                                    <div class="mb-1 d-flex justify-content-between">

                                        <p class="h6"><span>Age:</span>{{ $wishList->age }}</p>

                                    </div>
                                    <p class="fs-sm text-muted">
                                        {{ $wishList->about }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>


            </div>

            {{-- view all --}}

            <div class="text-center">
                <a class="btn btn-primary" href="">
                    View All
                </a>
            </div>

            <br>

        </div>
    </div>

    <div id="one-hero-after" class="bg-body-extra-light py-5">
        <div class="content">

            <h1 class='text-center'>FAQs</h1>

            <div id="faq3" role="tablist" aria-multiselectable="true">
                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                    <div class="block-header block-header-default" role="tab" id="faq3_h1">
                        <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq3" href="#faq3_q1"
                            aria-expanded="true" aria-controls="faq3_q1">Is there any free plan?</a>
                    </div>
                    <div id="faq3_q1" class="collapse" role="tabpanel" aria-labelledby="faq3_h1" data-bs-parent="#faq3">
                        <div class="block-content">
                            <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing
                                luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis
                                tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti
                                vestibulum quis in sit varius lorem sit metus mi.</p>
                            <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing
                                luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis
                                tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti
                                vestibulum quis in sit varius lorem sit metus mi.</p>
                        </div>
                    </div>
                </div>
                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                    <div class="block-header block-header-default" role="tab" id="faq3_h2">
                        <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq3" href="#faq3_q2"
                            aria-expanded="true" aria-controls="faq3_q2">What are the available payment options?</a>
                    </div>
                    <div id="faq3_q2" class="collapse" role="tabpanel" aria-labelledby="faq3_h2"
                        data-bs-parent="#faq3">
                        <div class="block-content">
                            <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing
                                luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis
                                tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti
                                vestibulum quis in sit varius lorem sit metus mi.</p>
                            <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing
                                luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis
                                tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti
                                vestibulum quis in sit varius lorem sit metus mi.</p>
                        </div>
                    </div>
                </div>
                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                    <div class="block-header block-header-default" role="tab" id="faq3_h3">
                        <a class="text-muted" data-bs-toggle="collapse" data-bs-parent="#faq3" href="#faq3_q3"
                            aria-expanded="true" aria-controls="faq3_q3">Can I get a refund?</a>
                    </div>
                    <div id="faq3_q3" class="collapse" role="tabpanel" aria-labelledby="faq3_h3"
                        data-bs-parent="#faq3">
                        <div class="block-content">
                            <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing
                                luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis
                                tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti
                                vestibulum quis in sit varius lorem sit metus mi.</p>
                            <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing
                                luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis
                                tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti
                                vestibulum quis in sit varius lorem sit metus mi.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
