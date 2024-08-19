@extends('layouts.front')

@section('page-title', 'Profie')
@section('content')

    <!-- Page Content -->
    <div class="content content-boxed">

        <div class="row">
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

            <div class="col-lg-12">
                @if($user->isIncomeCertificateExpired())
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
                <form action="{{ route('user.profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
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
                                    <input required type="text" value="{{ $user->state }}"
                                        class="form-control" id="state" name="state">
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
                                    <label class="form-label" for="label">Income Certificate</label>
                                    @php
                                        $required = true;
                                    @endphp

                                    @if ($user->latestIncomeCertificate)
                                        <a href="{{ $user->latestIncomeCertificate->certificate_url }}"
                                            target="_blank">View</a>
                                    @endif



                                    <input type="file" class="form-control" id="income_certificate"
                                        name="income_certificate">
                                    @error('income_certificate')
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
    <!-- END Page Content -->
@endsection
