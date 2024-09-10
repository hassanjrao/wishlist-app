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
                                <th>Income Verified</th>
                                <th>Income</th>
                                <th>Tax Return Certificate</th>
                                <th>Tax Return Certificate Expired</th>
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
                                            <input class="form-check-input" type="checkbox" id="approveCheck"
                                            name="is_approved"
                                            onchange="approveDisapprove({{ $user->id }},this)"
                                                {{ $user->is_approved ? 'checked' : '' }} >

                                                <form id="form-app-{{ $user->id }}" method="POST"
                                                    action="{{ route('admin.users.approve', $user->id) }}">
                                                    @csrf
                                                    @method('PUT')
                                                </form>

                                          </div>

                                    </td>
                                    <td>
                                        {{-- switch --}}
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="verifyCheck"
                                            name="is_verified_low_income"
                                            onchange="verifyLowIncome({{ $user->id }},this)"
                                                {{ $user->is_verified_low_income ? 'checked' : '' }} >

                                                <form id="form-verify-{{ $user->id }}" method="POST"
                                                    action="{{ route('admin.users.verifyLowIncome', $user->id) }}">
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

<script>
    function approveDisapprove(id,elem){
        let form=document.getElementById('form-app-'+id);

        // add hidden input
        let input=document.createElement('input');
        input.type='hidden';
        input.name='is_approved';
        input.value=elem.checked ? 1 : 0;
        form.appendChild(input);

        form.submit();
    }

    function verifyLowIncome(id,elem){
        let form=document.getElementById('form-verify-'+id);

        // add hidden input
        let input=document.createElement('input');
        input.type='hidden';
        input.name='is_verified_low_income';
        input.value=elem.checked ? 1 : 0;
        form.appendChild(input);

        form.submit();
    }
</script>

@endsection
