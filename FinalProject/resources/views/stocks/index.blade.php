@php
    $pageTitle = 'Stocks';
@endphp

@extends('layouts.admin')

@section('content-small')
<div class="container mt-5">

    <div class="card mb-5 shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Stocks List</h4>
        </div>
        <div class="card-body">
            <a href="{{ route('stocks.create') }}" class="btn btn-primary mb-3">Create New Stock</a>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-sm">
                    <thead class="table-light">
                        <tr>
                            <th>Item</th>
                            <th>Quantity</th>
                            <th>Unit Cost</th>
                            <th>Total Cost</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stocks as $stock)
                            <tr>
                                <td>{{ $stock->item->item_name }}</td>
                                <td>{{ $stock->quantity }}</td>
                                <td>{{ number_format($stock->unit_cost, 2) }}</td>
                                <td>{{ number_format($stock->total_cost, 2) }}</td>
                                <td>
                                    <a href="{{ route('stocks.edit', $stock->id) }}" class="btn btn-warning btn-sm">Add Stock</a>
                                    <form action="{{ route('stocks.destroy', $stock->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination (if any) --}}
            {{ $stocks->links() }}
        </div>
    </div>
</div>
@endsection
