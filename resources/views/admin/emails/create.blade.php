@extends('layouts.backend')

@section('page-name', 'Compose Email')
@section('content')

    <!-- Page Content -->
    <div class="content content-boxed">

        <div class="block block-rounded">
            <div class="block-header block-header-default d-flex">
                <h3 class="block-title">Composer</h3>

                <a href="{{ route('admin.emails.index') }}" class="btn btn-primary">Back</a>


            </div>
            <div class="block-content">

                <form action="{{ route('admin.emails.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf


                    <div class="row push justify-content-center">

                        <div class="col-lg-12 ">



                            <div class="row mb-4">

                                <div class="col-lg-6 col-md-6 col-sm-12 mb-4">

                                    <label class="form-label" for="label"> To <span class="text-danger">*</span></label>
                                    <select required class="form-select" id="users" name="users[]" multiple>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->email }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('users')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 mb-4">

                                    <label class="form-label" for="label"> Subject <span
                                            class="text-danger">*</span></label>
                                    <input required type="text" class="form-control" id="subject" name="subject"
                                        placeholder="Write Subject">
                                    @error('subject')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 mb-4">

                                    <label class="form-label" for="label"> Body <span
                                            class="text-danger">*</span></label>

                                    <textarea id="editor" name="body" style="display: none;"></textarea>

                                    @error('body')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>

                            </div>

                        </div>

                    </div>


                    <div class="d-flex justify-content-end mb-4">



                        <button type="submit" class="btn btn-primary  border">Send</button>

                    </div>

                </form>
            </div>

        </div>

    </div>

@endsection
@section('js_after')

    <!-- Page JS Plugins -->
    {{-- <script src="{{ asset('js/plugins/ckeditor5-classic/build/ckeditor.js') }}"></script> --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

    <!-- Page JS Helpers (CKEditor 5 plugins) -->
    {{-- <script>One.helpersOnLoad(['js-ckeditor5']);</script> --}}

    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {

            })
            .catch(error => {
                console.error(error);
            });
    </script>


@endsection
