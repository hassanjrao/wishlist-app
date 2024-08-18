@extends('layouts.backend')

@section('page-name', 'WishLists')
@section('css_before')
    <!-- Page JS Plugins CSS -->

@endsection



@section('content')
    <!-- Page Content -->
    <div class="content">


        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                   {{ isset($user) ? $user->name."'s" : '' }} Wishlists
                </h3>

            </div>

            <div class="block-content block-content-full">
                <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/tables_datatables.js -->
                <div class="table-responsive">

                    <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Child Name</th>
                                <th>Child Image</th>
                                <th>Child DOB</th>
                                <th>Child DOB Certificate</th>
                                <th>Child Age</th>
                                <th>WishList Link</th>
                                <th>About</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>

                            </tr>


                        </thead>

                        <tbody>
                            @foreach ($wishLists as $ind => $wishList)
                                <tr>

                                    <td>{{ $ind + 1 }}</td>
                                    <td>
                                        <a href="{{ $wishList->user->name }}" target="_blank">{{ $wishList->user->name }}</a>

                                    </td>
                                    <td>{{ $wishList->name }}</td>
                                    <td>
                                        @if ($wishList->image_url)
                                            <img src="{{ $wishList->image_url }}" alt=""
                                                style="width: 100px; height: 100px;">
                                        @else
                                            No Image
                                        @endif
                                    </td>
                                    <td>{{ $wishList->date_of_birth }}</td>
                                    <td>
                                        <a href="{{ $wishList->birth_certificate_url }}" target="_blank">View</a>

                                    </td>
                                    <td>{{ $wishList->age }}</td>
                                    <td>
                                        <a href="{{ $wishList->wish_list_link }}" target="_blank">{{ $wishList->wish_list_link }}</a>
                                    </td>
                                    <td>{{ $wishList->about }}</td>

                                    <td>{{ $wishList->created_at }}</td>
                                    <td>{{ $wishList->updated_at }}</td>

                                    <td>

                                        <form id="form-{{ $wishList->id }}"
                                            action="{{ route('admin.wishlists.destroy', $wishList->id) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="button" onclick="confirmDelete({{ $wishList->id }})"
                                                class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete">
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
