@php
    $pageTitle = 'Items';
@endphp

@extends('layouts.admin')

@section('content-small')
<div class="container mt-5">

    <div class="card mb-5 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Items List</h4>
        </div>
        <div class="card-body">
            <a href="{{ route('items.create') }}" class="btn btn-primary mb-3">Create New Item</a>
            
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-sm">
                    <thead class="table-light">
                        <tr>
                            <th>Item Name</th>
                            <th>Description</th>
                            <th>Supply Type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td>{{ $item->item_name }}</td>
                                <td>{{ $item->item_description }}</td>
                                <td>{{ $item->supply_type }}</td>
                                <td>
                                    <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                    <a href="{{ route('items.stockcard', $item->id) }}" class="btn btn-primary btn-sm">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
