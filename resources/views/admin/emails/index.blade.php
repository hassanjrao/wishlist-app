@extends('layouts.backend')

@section('page-name', 'Emails')
@section('css_before')
    <!-- Page JS Plugins CSS -->

@endsection



@section('content')
    <!-- Page Content -->
    <div class="content">


        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    Emails
                </h3>

                <a href="{{ route('admin.emails.create') }}" class="btn btn-primary">Compose</a>

            </div>

            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
                <div class="table-responsive">

                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Subject</th>
                                <th>Body</th>
                                <th>To</th>
                                <th>Created At</th>
                                <th>Action</th>

                            </tr>


                        </thead>

                        <tbody>
                            @foreach ($emails as $ind => $email)
                                <tr>

                                    <td>{{ $ind + 1 }}</td>
                                    <td>{{ $email->subject }}</td>
                                    <td>{{ $email->short_body }}</td>
                                    <td>
                                        @foreach ($email->users as $user)
                                            <span class="badge bg-primary">{{ $user->email }}</span>
                                        @endforeach
                                    </td>

                                    <td>{{ $email->created_at }}</td>

                                    <td>

                                        <form id="form-{{ $email->id }}"
                                            action="{{ route('admin.emails.destroy', $email->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="button" onclick="confirmDelete({{ $email->id }})" class="btn btn-sm btn-danger" data-toggle="tooltip"
                                                title="Delete">
                                                <i class="fa fa-trash"></i>
                                            </button>

                                        </form>
                                    </td>


                                </tr>
                            @endforeach
                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>








    </div>
    <!-- END Page Content -->
@endsection

@section('js_after')


@endsection
