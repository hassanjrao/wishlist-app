@extends('layouts.backend')

@section('page-name', 'Users')
@section('css_before')
    <!-- Page JS Plugins CSS -->

@endsection



@section('content')
    <!-- Page Content -->
    <div class="content">


        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    Users
                </h3>

            </div>

            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
                <div class="table-responsive">

                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Approved</th>
                                <th>Income</th>
                                <th>Income Certificate</th>
                                <th>Income Certificate Expired</th>
                                <th>Total WishLists</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>

                            </tr>


                        </thead>

                        <tbody>
                            @foreach ($users as $ind => $user)
                                <tr>

                                    <td>{{ $ind + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        {{-- switch --}}
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault"
                                            onchange="event.preventDefault();document.getElementById('form-app-{{ $user->id }}').submit();"
                                                {{ $user->is_approved ? 'checked' : '' }} >

                                                <form id="form-app-{{ $user->id }}" method="POST"
                                                    action="{{ route('admin.users.approve', $user->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                </form>

                                          </div>

                                    </td>
                                    <td>{{ $user->income }}</td>
                                    <td>
                                        @if ($user->latestIncomeCertificate)
                                            <a href="{{ $user->latestIncomeCertificate->certificate_url }}" target="_blank">View</a>
                                        @else
                                            No Certificate
                                        @endif
                                    </td>
                                    <td>
                                        @if($user->isIncomeCertificateExpired())
                                            <span class="badge bg-danger">Expired</span>
                                        @else
                                            <span class="badge bg-success">Not Expired</span>
                                        @endif

                                    </td>
                                    <td>
                                        <a href="{{ route('admin.users.wishlists',$user) }}">{{ $user->wishLists->count() }}</a>
                                    </td>
                                    <td>{{ $user->created_at }}</td>
                                    <td>{{ $user->updated_at }}</td>

                                    <td>

                                        <form id="form-{{ $user->id }}"
                                            action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="button" onclick="confirmDelete({{ $user->id }})" class="btn btn-sm btn-danger" data-toggle="tooltip"
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
