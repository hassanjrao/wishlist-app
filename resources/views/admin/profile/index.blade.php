@extends('layouts.backend')

@section('page-title', 'Profie')
@section('content')

    <!-- Page Content -->
    <div class="content content-boxed">

        <div class="block block-rounded">
            <div class="block-header block-header-default d-flex">
                <h3 class="block-title"> {{ $user->name }}</h3>


            </div>
            <div class="block-content">
                <form action="{{ route('admin.profile.update', $user->id) }}" method="POST"
                    enctype="multipart/form-data">
                    {{--  --}}
                    @csrf
                    @method('PUT')

                    <div class="row push justify-content-center">

                        <div class="col-lg-12 ">

                            <div class="row mb-4">
                                <div class="col-4">
                                    <label class="form-label" for="label">Name</label>
                                    <input required type="text" value="{{ $user->name }}" class="form-control"
                                        id="name" name="name">
                                </div>
                                <div class="col-4">
                                    <label class="form-label" for="label">Email</label>
                                    <input required type="text" value="{{ $user->email }}" class="form-control"
                                        id="email" name="email">
                                </div>


                            </div>

                            <div class="row mb-4">
                                <div class="col-6">
                                    <label class="form-label" for="label">Old Password</label>
                                    <input type="password"  class="form-control"
                                        id="old_password" name="old_password">

                                </div>
                                <div class="col-6">
                                    <label class="form-label" for="label">Password</label>
                                    <input type="password"  class="form-control"
                                        id="password" name="password">
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


