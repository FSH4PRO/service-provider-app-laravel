@extends('layouts.admin')

@section('content')
    <h2 class="mb-4">Manage Categories</h2>

    {{-- رسائل الأخطاء --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- رسائل النجاح --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- إضافة فئة جديدة --}}
    <form action="{{ route('admin.categories.store') }}" method="POST" class="row g-2 mb-4">
        @csrf
        <div class="col-md-4">
            <input type="text" name="name" class="form-control" placeholder="Category name" value="{{ old('name') }}"
                required>
        </div>

        <div class="col-md-4">
            <select name="parent_id" class="form-select">
                <option value="">No Parent</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" @if (old('parent_id') == $cat->id) selected @endif>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4">
            <button class="btn btn-success w-100">Add Category</button>
        </div>
    </form>

    {{-- جدول الفئات --}}
    <table class="table table-bordered mb-5 text-center">
        <thead>
            <tr>
                <th>Name</th>
                <th>Parent</th>
                <th style="width:150px">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $cat)
                <tr>
                    <td>{{ $cat->name }}</td>
                    <td>{{ $cat->parent?->name ?? '-' }}</td>
                    <td>
                        {{-- زر تعديل --}}
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                            data-bs-target="#editCat{{ $cat->id }}">Edit</button>

                        {{-- مودال التعديل --}}
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

                                        <select name="parent_id" class="form-select mt-2">
                                            <option value="">No Parent</option>
                                            @foreach ($categories as $p)
                                                <option value="{{ $p->id }}"
                                                    @if ($p->id == $cat->parent_id) selected @endif>
                                                    {{ $p->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button class="btn btn-success">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- زر الحذف --}}
                        <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- ======================== --}}
    <h2 class="mb-4">Manage Services</h2>

    {{-- جدول الخدمات --}}
    <table class="table table-bordered text-center">
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
