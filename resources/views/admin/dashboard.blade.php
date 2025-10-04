@extends('layouts.admin')

@section('content')
    <h1 class="mb-4">Welcome, {{ $user->name }}</h1>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">Categories Management</div>
                <div class="card-body">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-primary">Manage Categories & services</a>
                </div>
            </div>
        </div>


    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">Categories Management</div>
                <div class="card-body">
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">Manage Orders</a>
                </div>
            </div>
        </div>


    </div>
@endsection
