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
                        16% of all children in the United States — 11.6 million kids total — are living in
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
                        <div class="col-sm-6 col-xs-6 col-md-3 col-xl-3 ml-5" style="margin-right: 30px !important">
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
                <a class="btn btn-primary" href="{{ route('wishlists') }}">
                    View All
                </a>
            </div>

            <br>

        </div>
    </div>


    <div id="one-hero-after" class="bg-body-extra-light py-5" >
        <div class="content pb-4" id="faqs">

            <h1 class='text-center'>FAQs</h1>

            <div id="faq3" role="tablist" aria-multiselectable="true">
                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                    <div class="block-header block-header-default" class="block-header block-header-default" role="tab" id="faq1" data-bs-toggle="collapse" data-bs-parent="#faq1" href="#faq1_q1"
                    aria-expanded="true" aria-controls="faq1" style="cursor: pointer">
                        <a >What do I need to Register to have my wish list
                            posted?</a>
                    </div>
                    <div id="faq1_q1" class="collapse" role="tabpanel" aria-labelledby="faq1" data-bs-parent="#faq1">
                        <div class="block-content">
                            <p>You need to click <a href="{{ route('register') }}">register</a> and upload your tax return
                                and add a Birth certificate for each child. Image files of type jpg, png are allowed of max
                                size 10mb are allowed.</p>
                        </div>
                    </div>
                </div>
                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                    <div class="block-header block-header-default" role="tab" id="faq2" data-bs-toggle="collapse" data-bs-parent="#faq2" href="#faq2_q2"
                    aria-expanded="true" aria-controls="faq2" style="cursor: pointer">
                        <a>What maximum income can I have and are incomes
                            verified?</a>
                    </div>
                    <div id="faq2_q2" class="collapse" role="tabpanel" aria-labelledby="faq2" data-bs-parent="#faq2">
                        <div class="block-content">
                            <ul>
                                <li>$25,820 with 1 kid</li>
                                <li>
                                    $31,200 with 2 kids</li>
                                <li>
                                    $36,580 with 3 kids</li>
                                <li>
                                    $41,960 with 4 kids</li>
                                <li>
                                    $47,340 with 5 kids</li>
                                <li>
                                    $52,720 with 6 kids
                                </li>

                            </ul>
                            <p>A person will need to upload an image of their tax return to prove their income level.</p>
                        </div>
                    </div>
                </div>

                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                    <div class="block-header block-header-default" role="tab" id="faq4" data-bs-toggle="collapse" data-bs-parent="#faq4" href="#faq4_q2"
                    aria-expanded="true" aria-controls="faq4_q2" style="cursor: pointer">
                        <a>How do I create an Amazon Wish list to use on your site? </a>
                    </div>
                    <div id="faq4_q2" class="collapse" role="tabpanel" aria-labelledby="faq4" data-bs-parent="#faq4">
                        <div class="block-content">

                            <p>You can make a wish list on either the desktop website or mobile app.</p>

                            <h4>On Desktop</h4>
                            <ol>
                                <li>Go to the Amazon website and log in to your account.</li>
                                <li>Hover your mouse over the <strong>Accounts and Lists</strong> tab in the top-right corner of the page.</li>
                                <li>In the menu that appears, click <strong>Create a list</strong> in the <em>Your Lists</em> section.</li>
                                <li>The Wish Lists page will load with a pop-up for creating a list. Give your new list a name and hit the <strong>Create list</strong> button.</li>
                                <li>Your list will now be created, and it will be available in the <em>Your lists</em> tab on the Wish Lists page.</li>
                                <li>You can change the settings for your list by hovering over the three-dot icon on that page and hitting <strong>Manage list</strong>.</li>
                                <li>From there, you can do things like make the list public or private, assign the list to yourself or an organization, and allow Alexa to add items to the list.</li>
                            </ol>

                            <h4>On the Mobile App</h4>
                            <ol>
                                <li>Open the Amazon Shopping app and log into your account.</li>
                                <li>Tap the account icon in the bottom menu.</li>
                                <li>Tap <strong>Your Lists</strong>.</li>
                                <li>Tap <strong>Create a list</strong> in the top-right corner of the screen.</li>
                                <li>In the pop-up, give the new list a name, and then tap the <strong>Create List</strong> button.</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                    <div class="block-header block-header-default" role="tab" id="faq5" data-bs-toggle="collapse" data-bs-parent="#faq5" href="#faq5_q2"
                    aria-expanded="true" aria-controls="faq5_q2" style="cursor: pointer">
                        <a>How Do I add to my Amazon Wish list?</a>
                    </div>
                    <div id="faq5_q2" class="collapse" role="tabpanel" aria-labelledby="faq5" data-bs-parent="#faq5">
                        <div class="block-content">

                            <p>Once you've created your wish list, you can start adding items to it on the desktop website or mobile app.</p>

                            <h4>On Desktop</h4>
                            <ol>
                                <li>When you see an item you want to add to your list, click on it.</li>
                                <li>On the item's product page, click the <strong>Add to list</strong> button – it will be under the options to add the item to your cart.</li>
                                <li>If you have more than one list, select the down-arrow next to the button and choose the desired list.</li>
                            </ol>

                            <h4>On the Mobile App</h4>
                            <ol>
                                <li>Tap the item you want to add to your list to see its product page.</li>
                                <li>Scroll down and tap the <strong>Add to list</strong> link.</li>
                                <li>Choose the list you want to add the item to by tapping on it.</li>
                            </ol>
                        </div>
                    </div>
                </div>


                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                    <div class="block-header block-header-default" role="tab" id="faq6" data-bs-toggle="collapse" data-bs-parent="#faq6" href="#faq6_q2"
                    aria-expanded="true" aria-controls="faq6_q2" style="cursor: pointer">
                        <a>How do I get the Amazon Wish List to share on Birthday Bonanza?</a>
                    </div>
                    <div id="faq6_q2" class="collapse" role="tabpanel" aria-labelledby="faq6" data-bs-parent="#faq6">
                        <div class="block-content">

                            <p>Once you've created your wish list, you can start adding items to it on the desktop website or mobile app.</p>

                            <h4>On Desktop</h4>
                            <ol>
                                <li>Go to the Amazon website and log in to your account.</li>
                                <li>Hover your cursor over the <strong>Account and Lists</strong> tab in the top-right corner of the page.</li>
                                <li>Select the list you want to share in the <em>Your Lists</em> section.</li>
                                <li>Click the <strong>Send list to others</strong> link.</li>
                                <li>In the pop-up, click <strong>View Only</strong> – this will allow others to see the items on your list, but they can't edit anything.</li>
                                <li>Click either <strong>Copy Link</strong> to get the URL so you can send it to others, or click <strong>Invite by email</strong> and choose an email app, such as Mail or Outlook, to send the email to a recipient.</li>
                            </ol>

                            <h4>On Mobile</h4>
                            <ol>
                                <li>Open the Amazon Shopping app and log into your account.</li>
                                <li>Tap the account icon in the bottom menu.</li>
                                <li>Tap <strong>Your Lists</strong>.</li>
                                <li>Tap on the list you want to share.</li>
                                <li>Tap <strong>Invite</strong> in the top-left corner.</li>
                                <li>In the pop-up, tap <strong>View Only</strong>.</li>
                                <li>Tap <strong>Copy Link</strong> to manually share it with others.</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="block block-rounded block-bordered overflow-hidden mb-1">
                    <div class="block-header block-header-default" role="tab" id="faq7" data-bs-toggle="collapse" data-bs-parent="#faq7" href="#faq7_q2"
                    aria-expanded="true" aria-controls="faq7_q2" style="cursor: pointer">
                        <a> Do I have to verify each year my income</a>
                    </div>
                    <div id="faq7_q2" class="collapse" role="tabpanel" aria-labelledby="faq7" data-bs-parent="#faq7">
                        <div class="block-content">

                            <p>At the anniversary of your account approval you will have to submit a new tax return</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
