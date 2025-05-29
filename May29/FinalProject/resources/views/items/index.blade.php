@extends('layouts.admin')
@php
    $pageTitle = 'Item Management';
@endphp
@section('content')
    <a href="{{ route('items.create') }}" class="btn btn-primary mb-3">Create New Item</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Description</th>
                <th>Supply Type</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item->item_name }}</td>
                    <td>{{ $item->item_description }}</td>
                    <td>{{ $item->supply_type }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') }}</td> 
                    <td>
                        <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            <a href="{{ route('items.stockcard', $item->id) }}" class="btn btn-primary btn-sm">View</a>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


@endsection
