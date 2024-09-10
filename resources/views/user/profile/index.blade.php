@extends('layouts.front')

@section('page-title', 'Profie')
@section('content')

    <!-- Page Content -->

    <div id="one-hero-after" class="bg-body-extra-light py-5">

        <div class="content content-boxed">

            <div class="row">
                <div class="col-lg-12">
                    @if (auth()->user()->has_tax_return && !auth()->user()->is_verified_low_income)
                        <div class="alert alert-info">
                            We are reviewing your income. We will notify you once your it's verified
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

                <div class="col-lg-12">
                    @if ($user->isIncomeCertificateExpired())
                        <div class="alert alert-danger">
                            Your income certificate is expired. Please upload a new one.
                        </div>
                    @endif
                </div>
            </div>

            <div class="block block-rounded">
                <div class="block-header block-header-default d-flex">
                    <h3 class="block-title"> {{ $user->name }}</h3>


                </div>
                <div class="block-content">
                    <form action="{{ route('user.profile.update', $user->id) }}" method="POST"
                        enctype="multipart/form-data">
                        {{--  --}}
                        @csrf
                        @method('PUT')

                        <div class="row push justify-content-center">

                            <div class="col-lg-12 ">

                                <div class="row mb-4">
                                    <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                                        <label class="form-label" for="label">Name</label>
                                        <input required type="text" value="{{ $user->name }}" class="form-control"
                                            id="name" name="name">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                                        <label class="form-label" for="label">Email</label>
                                        <input required type="text" value="{{ $user->email }}" class="form-control"
                                            id="email" name="email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                                        <label class="form-label" for="label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>

                                </div>

                                <div class="row mb-4">

                                    <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                                        <label class="form-label" for="label">State</label>
                                        <select required class="form-select" id="state" name="state">
                                            <option value="">Select State</option>
                                            @foreach ($states as $state)
                                                <option value="{{ $state->id }}"
                                                    @if ($user->state_id == $state->id) selected @endif>
                                                    {{ $state->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('state')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                                        <label class="form-label" for="label">Income</label>
                                        <input required type="number" step=".01" value="{{ $user->income }}"
                                            class="form-control" id="income" name="income">
                                        @error('income')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                                        <label class="form-label" for="label">Tax Return Certificate</label>
                                        @php
                                            $required = true;
                                        @endphp

                                        @if ($user->latestIncomeCertificate)
                                            <a href="{{ $user->latestIncomeCertificate->certificate_url }}"
                                                target="_blank">View</a>
                                        @endif



                                        <input type="file" class="form-control" id="tax_return_certificate"
                                            name="tax_return_certificate">
                                        @error('tax_return_certificate')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>



                                </div>



                            </div>



                        </div>

                        <div class="d-flex justify-content-end mb-4">

                            <button type="submit" class="btn btn-primary  border">Update</button>

                        </div>




                    </form>
                </div>
            </div>





        </div>
    </div>
    <!-- END Page Content -->
@endsection
