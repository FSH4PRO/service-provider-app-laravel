@extends('layouts.admin')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">قائمة الطلبات</h2>

        <form method="GET" action="{{ route('admin.orders.index') }}" class="row mb-3 g-2">
            <div class="col-md-4">
                <input type="text" name="search_service" value="{{ request('search_service') }}" class="form-control"
                    placeholder="Search By service_id">
            </div>
            <div class="col-md-3">
                <input type="text" name="search_client" value="{{ request('search_client') }}" class="form-control"
                    placeholder="Search By client_id">
            </div>
            <div class="col-md-3">
                <input type="text" name="search_provider" value="{{ request('search_provider') }}" class="form-control"
                    placeholder="Search By provider_id">
            </div>

            <div class="col-md-4">
                <select name="status" class="form-select">
                    <option value="">All Status </option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>processing</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>completed</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>cancelled</option>
                </select>
            </div>

            <div class="col-md-4">
                <select name="sort_by" class="form-select">
                    <option value="id" {{ request('sort_by') == 'id' ? 'selected' : '' }}>By ID</option>
                    <option value="price" {{ request('sort_by') == 'price' ? 'selected' : '' }}>By Price</option>
                    <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>By date</option>
                </select>
            </div>

            <div class="col-md-4">
                <select name="sort_order" class="form-select">
                    <option value="asc" {{ request('sort_order') == 'asc' ? 'selected' : '' }}>Ascending</option>
                    <option value="desc" {{ request('sort_order') == 'desc' ? 'selected' : '' }}>Descending</option>
                </select>
            </div>

            <div class="col-md-1">
                <button type="submit" class="btn btn-primary w-100">Search</button>
            </div>
        </form>

        <table class="table table-bordered mb-5 text-center align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Client</th>
                    <th>Provider</th>
                    <th>Service</th>
                    <th>Price</th>
                    <th>Staus</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->client_id }}</td>
                        <td>{{ $order->provider_id }}</td>
                        <td>{{ $order->service_id }}</td>
                        <td>{{ $order->price }}$</td>
                        <td>
                            @switch($order->status)
                                @case('pending')
                                    <span class="badge bg-warning">pending</span>
                                @break

                                @case('processing')
                                    <span class="badge bg-info">processing</span>
                                @break

                                @case('completed')
                                    <span class="badge bg-success">completed</span>
                                @break

                                @case('cancelled')
                                    <span class="badge bg-danger">cancelled</span>
                                @break
                            @endswitch
                        </td>
                        <td>{{ $order->created_at->format('Y-m-d') }}</td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="7">No orders Found!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                {{ $data->links() }}
            </div>
        </div>
    @endsection
