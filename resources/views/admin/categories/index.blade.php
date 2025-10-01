@extends('layouts.admin')

@section('content')
    <h2 class="mb-4">Manage Categories</h2>


    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif


    <form action="{{ route('admin.categories.store') }}" method="POST" class="row g-2 mb-4">
        @csrf
        <div class="col-md-8">
            <input type="text" name="name" class="form-control" placeholder="Category name" required>
        </div>
        <div class="col-md-8">
            <input type="text" name="parent_id" class="form-control" placeholder="parent_id" required>
        </div>
        <div class="col-md-4">
            <button class="btn btn-success w-100">Add Category</button>
        </div>
    </form>


    <table class="table table-bordered mb-5">
        <thead>
            <tr>
                <th style = 'width: 5%'>ID</th>
                <th style = 'width: 20%'>Name</th>
                <th style = 'width: 20%'>Parent id</th>

                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $cat)
                <tr>
                    <td>{{ $cat->id }}</td>
                    <td>{{ $cat->name }}</td>
                    <td>{{ $cat->parent_id }}</td>
                    <td>

                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                            data-bs-target="#editCat{{ $cat->id }}">Edit</button>


                        <div class="modal fade" id="editCat{{ $cat->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <form action="{{ route('admin.categories.update', $cat->id) }}" method="POST"
                                    class="modal-content">
                                    @csrf @method('PUT')
                                    <div class="modal-header">
                                        <h5>Edit Category</h5>
                                    </div>
                                    <div class="modal-body">
                                        <input type="text" name="name" value="{{ $cat->name }}"
                                            class="form-control" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button class="btn btn-success">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>


                        <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>



    <h2 class="mb-4">Manage Services</h2>


    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Provider</th>
                <th>Category</th>
                <th>Status</th>
                <th>Price</th>
                <th style="width:180px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($services as $srv)
                <tr>
                    <td>{{ $srv->title }}</td>
                    <td>{{ $srv->provider->name ?? '-' }}</td>
                    <td>{{ $srv->category->name ?? '-' }}</td>
                    <td>
                        <form action="{{ route('admin.services.updateStatus', $srv->id) }}" method="POST">
                            @csrf @method('PUT')
                            <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                <option value="pending" @if ($srv->status == 'pending') selected @endif>Pending</option>
                                <option value="active" @if ($srv->status == 'active') selected @endif>Active</option>
                                <option value="inactive" @if ($srv->status == 'inactive') selected @endif>Inactive</option>
                            </select>
                        </form>
                    </td>
                    <td>{{ $srv->price }}</td>
                    <td>
                        <form action="{{ route('admin.services.destroy', $srv->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
