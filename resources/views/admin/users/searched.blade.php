@extends('admin.layout.base')

@section('title')
    | @if ($search)
        Search result for "{{ $search }}"
    @else
        No users found
    @endif
@endsection

@section('content')
    <div class="d-flex justify-content-between">
        <h3 class="mb-4 text-color">Users</h3>
        <button class="btn mb-4 text-white" style="background: #d09b71;" onclick="goBack()">Back</button>
    </div>
    @if ($search)
        <div class="table-responsive">
            <table class="table table-warning">
                <thead>
                    <tr>
                        <th>ID.</th>
                        <th>Profile picture</th>
                        <th>Last name</th>
                        <th>First name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Mobile number</th>
                        <th>Gender</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>
                                <img style="width: 40px; height: 40px; margin-top: -10px;" class="rounded-circle border"
                                    src="{{ $user->profile_image === null && $user->gender === 'Male'
                                        ? url('images/boy.png')
                                        : ($user->profile_image === null && $user->gender === 'Female'
                                            ? url('images/girl.png')
                                            : Storage::url($user->profile_image)) }}"
                                    alt="">
                            </td>
                            <td>{{ $user->lname }}</td>
                            <td>{{ $user->fname }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->address }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->gender }}</td>
                            <td>
                                @foreach ($user->roles as $role)
                                    @if ($role->id === 1)
                                        <span class="badge rounded-pill text-bg-primary">Admin</span>
                                    @break

                                @else
                                    <span class="badge rounded-pill text-bg-warning">User</span>
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @if ($user->email_verified_at != null)
                                <span class="badge rounded-pill text-bg-info text-white">Verified</span>
                            @else
                                <span class="badge rounded-pill text-bg-danger text-white">Not Verified</span>
                            @endif
                        </td>
                        <td>
                            <a href="/admin/users/update/{{ $user->id }}" class="btn btn-primary mb-1"><i
                                    class="far fa-pen-to-square"></i> Edit</a>
                            <a href="#" class="btn btn-danger mb-1" data-bs-toggle="modal"
                                data-bs-target="#delete{{ $user->id }}"><i class="far fa-trash"></i> Delete</a>
                        </td>
                    </tr>
                    @include('admin.users.delete')
                @empty
                    <tr>
                        <td colspan="11" class="text-center">
                            No data found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@else
    <div class="table-responsive">
        <table class="table table-warning">
            <thead>
                <tr>
                    <th>ID.</th>
                    <th>Profile picture</th>
                    <th>Last name</th>
                    <th>First name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Mobile number</th>
                    <th>Gender</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="11" class="text-center">
                        No data found.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <button class="btn btn-dark" onclick="goBack()">Back <i class="far fa-arrow-left"></i></button>
@endif
@endsection
