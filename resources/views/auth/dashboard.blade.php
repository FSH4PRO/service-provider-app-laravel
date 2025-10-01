@extends('layouts.app')

@section('title', 'Admin Dashboard - Laravel CRUD')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Admin Dashboard</h2>
            <a href="{{ route('home') }}" class="btn btn-secondary">
                <i class="bi bi-house"></i> Back to Home
            </a>
        </div>

        <!-- Statistics Cards -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">Total Users</h5>
                        <h2>0</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Admin Users</h5>
                        <h2>0</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h5 class="card-title">Moderators</h5>
                        <h2>0</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title">Regular Users</h5>
                        <h2>0</h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Quick Actions</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @can('manage-users')
                            <div class="col-md-3 mb-3">
                                <a href="{{ route('admin.users') }}" class="btn btn-primary w-100">
                                    <i class="bi bi-people"></i> Manage Users
                                </a>
                            </div>
                            @endcan
                            
                            @can('manage-categories')
                            <div class="col-md-3 mb-3">
                                <a href="{{ route('categories.index') }}" class="btn btn-success w-100">
                                    <i class="bi bi-tags"></i> Manage Categories
                                </a>
                            </div>
                            @endcan
                            
                            @can('moderate-posts')
                            <div class="col-md-3 mb-3">
                                <a href="{{ route('posts.index') }}" class="btn btn-warning w-100">
                                    <i class="bi bi-file-text"></i> Moderate Posts
                                </a>
                            </div>
                            @endcan
                            
                            @can('manage-system-settings')
                            <div class="col-md-3 mb-3">
                                <button class="btn btn-danger w-100" disabled>
                                    <i class="bi bi-gear"></i> System Settings
                                </button>
                            </div>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Users -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Recent Users</h5>
            </div>
        </div>
    </div>
</div>
@endsection