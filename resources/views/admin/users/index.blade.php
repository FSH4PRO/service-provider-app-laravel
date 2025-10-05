@extends('layouts.admin')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-3">Users List</h2>

        <table class="table table-bordered mb-5 text-center align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                        <td> <form action="{{ route('admin.users.destroy', $user->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit " class="btn btn-primary w-100">Delete</button>
                            </form> </td>

                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>
@endsection
